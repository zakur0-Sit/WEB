<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "fosa";
    $connection = "";

    try {
        $connection = mysqli_connect($host, $user, $password, $database);
    }
    catch(mysqli_sql_exception $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

?>