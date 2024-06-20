<?php
require_once "database.php";

if (!isset($_COOKIE["admin"])) {
    header("Location: signin.php");
    exit();
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
    $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    $image_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if (empty($name) || empty($category) || empty($brand) || empty($price) || empty($description))
    {
        $_SESSION['message'] = "All fields are required";
        header("Location: admin.php");
        exit();
    }
    else if (!is_numeric($price))
    {
        $_SESSION['message'] = "Price must be a number";
        header("Location: admin.php");
        exit();
    }
    else if (!in_array($image_extension, $allowed_extensions))
    {
        $_SESSION['message'] = "Only jpg, jpeg, png and gif files are allowed";
        header("Location: admin.php");
        exit();
    }


    // Verificăm dimensiunea fișierului
//    if ($_FILES['image']['size'] > 500000) {
//        $_SESSION['message'] = "File size exceeds limit";
//        header("Location: admin.php");
//        exit();
//    }

    // Verificăm dacă fișierul este o imagine validă
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check === false) {
        $_SESSION['message'] = "File is not an image";
        header("Location: admin.php");
        exit();
    }

    $imagePath = 'uploads/' . uniqid() . '.' . $image_extension;
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        $_SESSION['message'] = "There was an error uploading the file";
        header("Location: admin.php");
        exit();
    }
    
    $stmt = $connection->prepare("INSERT INTO shoes (name_shoes, category, brand, price, description, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $category, $brand, $price, $description, $imagePath);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Record added successfully";
    } else {
        $_SESSION['message'] = $stmt->error;
    }
    header("Location: admin.php");
    exit();

    $stmt->close();
}
?>