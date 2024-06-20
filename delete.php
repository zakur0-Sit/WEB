<?php
require_once "database.php";

if(!isset($_COOKIE["admin"]))
{
    header("Location: signin.php");
    exit();
}

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "DELETE FROM shoes WHERE id = '$id'";
    mysqli_query($connection, $sql);
    if(mysqli_affected_rows($connection) == 0)
    {
        $_SESSION['message'] = "No shoe found with this id";
        header("Location: admin.php");
        exit();
    }
    else
    {
        $_SESSION['success'] = "Shoe deleted successfully";
        header("Location: admin.php");
        exit();
    }
}