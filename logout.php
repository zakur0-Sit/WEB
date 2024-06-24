<?php
    setcookie("user", "", time() - (86400 * 10), "/");
    setcookie("admin", "", time() - (86400 * 10), "/");
    header("Location: signin.php");
    exit();
?>