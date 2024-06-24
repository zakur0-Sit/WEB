<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conditions = [];

        // Handle Category Filter
        if (isset($_POST["category"])) {
            $category_filter = $_POST["category"];
            $category_conditions = array_map(function($cat) {
                global $connection;
                return "category = '" . mysqli_real_escape_string($connection, $cat) . "'";
            }, $category_filter);
            $conditions[] = "(" . implode(" OR ", $category_conditions) . ")"; // assuming multiple categories should be an OR condition
        }

        // Handle Brand Filter
        if (isset($_POST["brand"])) {
            $brand_filter = $_POST["brand"];
            $brand_conditions = array_map(function($brand) {
                global $connection;
                return "brand = '" . mysqli_real_escape_string($connection, $brand) . "'";
            }, $brand_filter);
            $conditions[] = "(" . implode(" OR ", $brand_conditions) . ")"; // assuming multiple brands should be an OR condition
        }

        //Handle Color Filter
        if (isset($_POST["color"])) {
            $color_filter = $_POST["color"];
            $color_conditions = array_map(function($color) {
                global $connection;
                return "sc." . mysqli_real_escape_string($connection, $color) . " = 1";
            }, $color_filter);
            $conditions[] = "(" . implode(" OR ", $color_conditions) . ")"; // assuming multiple colors should be an OR condition
        }

        //Handle Size Filter
        if (isset($_POST["size"])) {
            $size_filter = $_POST["size"];
            $size_conditions = array_map(function($size) {
                global $connection;
                return "ss." . mysqli_real_escape_string($connection, $size) . " = 1";
            }, $size_filter);
            $conditions[] = "(" . implode(" OR ", $size_conditions) . ")"; // assuming multiple sizes should be an OR condition
        }

        // Handle Price Filter
        if (isset($_POST["price-range"])) {
            $price = intval($_POST["price-range"]);
            $conditions[] = "price <= $price";
        }

        // Construct the WHERE clause
        if (!empty($conditions)) {
            $sql = "SELECT * FROM shoes s LEFT JOIN shoes_color sc ON s.id = sc.id_shoes LEFT JOIN shoes_size ss ON s.id = ss.id_shoes WHERE " . implode(" AND ", $conditions) . " ORDER BY s.id DESC";
        } else {
            $sql = "SELECT * FROM shoes ORDER BY id DESC";
        }
    } else {
        $sql = "SELECT * FROM shoes ORDER BY id DESC";
    }

    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Database query failed: " . mysqli_error($connection));
    }