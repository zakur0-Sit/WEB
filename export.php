<?php
require_once "database.php";

if (!isset($_COOKIE["admin"])) {
    header("Location: signin.php");
    exit();
}

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $sql = "
        SELECT 
            name_shoes, category, brand, price, description, image, link, rating,
            red, yellow, green, blue, black, white,
            size_33, size_34, size_35, size_36, size_37, size_38, size_39, size_40, size_41, size_42, size_43, size_44, size_45
        FROM 
            shoes s
        LEFT JOIN 
            shoes_color sc ON s.id = sc.id_shoes
        LEFT JOIN 
            shoes_size ss ON s.id = ss.id_shoes
    ";
    $result = $connection->query($sql);

    if (!$result) {
        die("Query failed: " . $connection->error);
    }

    if($result->num_rows > 0)
    {
        $data = array();

        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }

        if(isset($_POST["export"]))
        {
            $export = $_POST["export"];
            if($export == "Export in JSON")
            {
                $json_data = json_encode($data, JSON_PRETTY_PRINT);

                if ($json_data === false) {
                    die("JSON encoding failed: " . json_last_error_msg());
                }

                $json_filename = "exported_table_shoes.json";
                if (file_put_contents($json_filename, $json_data) === false) {
                    die("Failed to write to file '$json_filename'");
                }
            }
            else if($export == "Export in CSV")
            {
                $csv_filename = "exported_table_shoes.csv";
                $csv_file = fopen($csv_filename, 'w');

                if ($csv_file === false) {
                    die("Failed to open file '$csv_filename' for writing");
                }

                // Write CSV header
                fputcsv($csv_file, array_keys($data[0]));

                // Write CSV data
                foreach ($data as $row) {
                    fputcsv($csv_file, $row);
                }

                fclose($csv_file);
            }
        }

        $_SESSION['success'] = "Table exported successfully";
    }
    else
    {
        $_SESSION['message'] = "No data found in the table";
    }

    header("Location: admin.php");
    exit();
}
?>