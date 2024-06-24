<?php
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_description']) && isset($_POST['product_price']) && isset($_POST['shoe_sizes'])) {
        $productId = intval($_POST['product_id']);
        $productName = mysqli_real_escape_string($connection, $_POST['product_name']);
        $productDescription = mysqli_real_escape_string($connection, $_POST['product_description']);
        $productPrice = floatval($_POST['product_price']);
        $sizes = $_POST['shoe_sizes'];

        $sql = "UPDATE shoes SET name_shoes='$productName', description='$productDescription', price='$productPrice' WHERE id=$productId";
        if (mysqli_query($connection, $sql)) {
            $sqlUpdateSizes = "UPDATE shoes_size SET ";
            for ($size = 33; $size <= 45; $size++) {
                $sizeField = "size_" . $size;
                $sqlUpdateSizes .= "$sizeField = " . (in_array((string)$size, $sizes) ? "1" : "0") . ", ";
            }
            $sqlUpdateSizes = rtrim($sqlUpdateSizes, ', ') . " WHERE id_shoes=$productId";
            mysqli_query($connection, $sqlUpdateSizes);

            header("Location: footwear.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
    }
}
?>