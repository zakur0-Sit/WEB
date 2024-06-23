<?php
    require_once "database.php";

    if (!isset($_COOKIE["admin"]))
    {
        header("Location: signin.php");
        exit();
    }

    session_start();

    function import_json($file_path, $connection) {
        $json_data = file_get_contents($file_path);
        $data = json_decode($json_data, true);

        if ($data === null) {
            die("JSON decoding failed: " . json_last_error_msg());
        }

        foreach ($data as $row) {
            // Inserare în tabelul 'shoes'
            $stmt = $connection->prepare("INSERT INTO shoes (name_shoes, category, brand, price, description, image, link, rating) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
            $stmt->bind_param(
                "sssssss",
                $row['name_shoes'],
                $row['category'],
                $row['brand'],
                $row['price'],
                $row['description'],
                $row['image'],
                $row['link']
            );

            if (!$stmt->execute()) {
                die("Insert into shoes failed: " . $stmt->error);
            }

            $shoe_id = $stmt->insert_id;

            // Inserare în tabelul 'shoes_color'
            $color_stmt = $connection->prepare("INSERT INTO shoes_color (id_shoes, red, yellow, green, blue, black, white) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $color_stmt->bind_param(
                "iiiiiii",
                $shoe_id,
                $row['red'],
                $row['yellow'],
                $row['green'],
                $row['blue'],
                $row['black'],
                $row['white']
            );

            if (!$color_stmt->execute()) {
                die("Insert into shoes_color failed: " . $color_stmt->error);
            }

            // Inserare în tabelul 'shoes_size'
            $size_stmt = $connection->prepare("INSERT INTO shoes_size (id_shoes, size_33, size_34, size_35, size_36, size_37, size_38, size_39, size_40, size_41, size_42, size_43, size_44, size_45) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $size_stmt->bind_param(
                "iiiiiiiiiiiiii",
                $shoe_id,
                $row['size_33'],
                $row['size_34'],
                $row['size_35'],
                $row['size_36'],
                $row['size_37'],
                $row['size_38'],
                $row['size_39'],
                $row['size_40'],
                $row['size_41'],
                $row['size_42'],
                $row['size_43'],
                $row['size_44'],
                $row['size_45']
            );

            if (!$size_stmt->execute()) {
                die("Insert into shoes_size failed: " . $size_stmt->error);
            }
        }
    }

    function import_csv($file_path, $connection) {
        $csv_file = fopen($file_path, 'r');

        if ($csv_file === false) {
            die("Failed to open CSV file");
        }

        // Citim prima linie pentru a obține antetul
        $header = fgetcsv($csv_file);
        if ($header === false) {
            die("Failed to read CSV header");
        }

        while (($row = fgetcsv($csv_file)) !== false) {
            // Mapăm valorile din CSV la cheile din antet
            $row_data = array_combine($header, $row);

            // Inserare în tabelul 'shoes'
            $stmt = $connection->prepare("INSERT INTO shoes (name_shoes, category, brand, price, description, image, link, rating) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
            $stmt->bind_param(
                "sssssss",
                $row_data['name_shoes'],
                $row_data['category'],
                $row_data['brand'],
                $row_data['price'],
                $row_data['description'],
                $row_data['image'],
                $row_data['link']
            );

            if (!$stmt->execute()) {
                die("Insert into shoes failed: " . $stmt->error);
            }

            $shoe_id = $stmt->insert_id;

            // Inserare în tabelul 'shoes_color'
            $color_stmt = $connection->prepare("INSERT INTO shoes_color (id_shoes, red, yellow, green, blue, black, white) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $color_stmt->bind_param(
                "iiiiiii",
                $shoe_id,
                $row_data['red'],
                $row_data['yellow'],
                $row_data['green'],
                $row_data['blue'],
                $row_data['black'],
                $row_data['white']
            );

            if (!$color_stmt->execute()) {
                die("Insert into shoes_color failed: " . $color_stmt->error);
            }

            // Inserare în tabelul 'shoes_size'
            $size_stmt = $connection->prepare("INSERT INTO shoes_size (id_shoes, size_33, size_34, size_35, size_36, size_37, size_38, size_39, size_40, size_41, size_42, size_43, size_44, size_45) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $size_stmt->bind_param(
                "iiiiiiiiiiiiii",
                $shoe_id,
                $row_data['size_33'],
                $row_data['size_34'],
                $row_data['size_35'],
                $row_data['size_36'],
                $row_data['size_37'],
                $row_data['size_38'],
                $row_data['size_39'],
                $row_data['size_40'],
                $row_data['size_41'],
                $row_data['size_42'],
                $row_data['size_43'],
                $row_data['size_44'],
                $row_data['size_45']
            );

            if (!$size_stmt->execute()) {
                die("Insert into shoes_size failed: " . $size_stmt->error);
            }
        }

        fclose($csv_file);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK)
        {
            $file_tmp_path = $_FILES['file']['tmp_name'];
            $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            if ($file_extension == "json")
                import_json($file_tmp_path, $connection);
            elseif ($file_extension == "csv")
                import_csv($file_tmp_path, $connection);
            else
                $_SESSION['message'] = "Invalid file type. Please upload a JSON or CSV file.";

            $_SESSION['success'] = "Data imported successfully";
        }
        else
        {
            $_SESSION['message'] = "Failed to upload file. Please try again.";
        }

        header("Location: admin.php");
        exit();
    }
?>
