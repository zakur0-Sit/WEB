<?php
require_once "database.php";

if (!isset($_COOKIE["admin"])) {
    header("Location: signin.php");
    exit();
}

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $sql = "SELECT * FROM shoes";
    $result = mysqli_query($connection, $sql);

    if($result->num_rows > 0)
    {
        $data = array();

        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }

        $json_data = json_encode($data, JSON_PRETTY_PRINT);
        $filename = "exported_table_shoes.json";

        file_put_contents($filename, $json_data);

        $_SESSION['success'] = "Table exported successfully";
    }
    else
    {
        $_SESSION['message'] = "No data found in the table";
    }

    header("Location: admin.php");
    exit();
}