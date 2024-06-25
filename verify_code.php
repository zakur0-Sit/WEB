<?php
session_start();
$css = "css/verify_code.css";
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_NUMBER_INT);

    if (empty($code)) {
        $_SESSION['message'] = "Codul de verificare este necesar.";
    } else {

        if ($_SESSION['verification_code'] == $code) {
            $_SESSION['verified'] = true;
            header("Location: reset_password.php");
            exit();
        } else {
            $_SESSION['message'] = "Codul de verificare este invalid sau a expirat.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificare Cod</title>
    <link rel="stylesheet" href="css/verify_code.css">
</head>
<body>
    <header>
        <a class="backbutton" href="index.php" id="back">Back</a>
    </header>
    <main>
        <div class="container">
            <h2>Verificare Cod</h2>
            <p class="small-text">Check the email for the reset code</p>
            <?php
                if (isset($_SESSION['message'])) {
                    echo "<div class='alert'>{$_SESSION['message']}</div>";
                    unset($_SESSION['message']);
                }
            ?>
            <form action="verify_code.php" method="post">
                <input type="text" id="code" name="code" required>
                <button type="submit">Send</button>
            </form>
        </div>
    </main>
</body>
</html>
