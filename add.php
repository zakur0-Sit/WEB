<?php
    require_once "database.php";

    if (!isset($_COOKIE["admin"]))
    {
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
        $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_URL);

        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        $image_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if (empty($name) || empty($category) || empty($brand) || empty($price) || empty($description)) {
            $_SESSION['message'] = "All fields are required";
            header("Location: admin.php");
            exit();
        } else if (!is_numeric($price)) {
            $_SESSION['message'] = "Price must be a number";
            header("Location: admin.php");
            exit();
        } else if (!in_array($image_extension, $allowed_extensions)) {
            $_SESSION['message'] = "Only jpg, jpeg, png and gif files are allowed";
            header("Location: admin.php");
            exit();
        }

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

        $stmt = $connection->prepare("INSERT INTO shoes (name_shoes, category, brand, price, description, image, link, rating) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
        $stmt->bind_param("sssssss", $name, $category, $brand, $price, $description, $imagePath, $link);

        if ($stmt->execute()) {
            $shoe_id = $stmt->insert_id;

            // Gestionarea culorilor
            $colors = ['red' => 0, 'yellow' => 0, 'green' => 0, 'blue' => 0, 'black' => 0, 'white' => 0];
            if (!empty($_POST['colors']) && is_array($_POST['colors'])) {
                foreach ($_POST['colors'] as $color) {
                    if (array_key_exists($color, $colors)) {
                        $colors[$color] = 1;
                    }
                }
            }

            $color_sql = "INSERT INTO shoes_color (id_shoes, red, yellow, green, blue, black, white) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $color_stmt = $connection->prepare($color_sql);
            if ($color_stmt === false) {
                die("Prepare failed: " . $connection->error);
            }

            $color_stmt->bind_param("iiiiiii", $shoe_id, $colors['red'], $colors['yellow'], $colors['green'], $colors['blue'], $colors['black'], $colors['white']);

            if (!$color_stmt->execute()) {
                echo "Execute failed: " . $color_stmt->error;
            }
            $color_stmt->close();

            // Gestionarea mărimilor
            $sizes = ["size_33" => 0, "size_34" => 0, "size_35" => 0, "size_36" => 0, "size_37" => 0, "size_38" => 0, "size_39" => 0, "size_40" => 0, "size_41" => 0, "size_42" => 0, "size_43" => 0, "size_44" => 0, "size_45" => 0];
            if (!empty($_POST['sizes']) && is_array($_POST['sizes'])) {
                foreach ($_POST['sizes'] as $size) {
                    $size_key = "size_" . $size;
                    if (array_key_exists($size_key, $sizes)) {
                        $sizes[$size_key] = 1;
                    }
                }
            }

            $size_sql = "INSERT INTO shoes_size (id_shoes, size_33, size_34, size_35, size_36, size_37, size_38, size_39, size_40, size_41, size_42, size_43, size_44, size_45) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $size_stmt = $connection->prepare($size_sql);
            if ($size_stmt === false) {
                die("Error preparing statement: " . $connection->error);
            }

            $size_stmt->bind_param(
                "iiiiiiiiiiiiii",
                $shoe_id,
                $sizes['size_33'],
                $sizes['size_34'],
                $sizes['size_35'],
                $sizes['size_36'],
                $sizes['size_37'],
                $sizes['size_38'],
                $sizes['size_39'],
                $sizes['size_40'],
                $sizes['size_41'],
                $sizes['size_42'],
                $sizes['size_43'],
                $sizes['size_44'],
                $sizes['size_45']
            );

            if (!$size_stmt->execute()) {
                echo "Error saving sizes: " . $size_stmt->error;
            }

            $size_stmt->close();

            $_SESSION['success'] = "Record added successfully";
        } else {
            $_SESSION['message'] = $stmt->error;
        }

        $stmt->close();
        header("Location: admin.php");
        exit();
    }
?>
