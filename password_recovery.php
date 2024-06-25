<?php
session_start();
$css = "css/password_recovery.css";
require_once "send_email.php";
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (empty($email)) {
        $_SESSION['message'] = "Email field is required.";
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $verificationCode = random_int(100000, 999999);

            $subject = "Cod de verificare pentru recuperarea parolei";
            $body = "
                <h1>Cod de verificare: $verificationCode</h1>
                <p>Bună $username,</p>
                <p>Ți-am generat un cod de verificare pentru a recupera parola contului tău.</p>
                <p>Acest cod este valabil pentru următoarea oră.</p>
                <p>Dacă nu ai solicitat această acțiune, te rugăm să ignori acest email.</p>
                <br>
                <p>Cu respect,</p>
                <p>Echipa noastră</p>
            ";

            send_verification_mail($email, $subject, $body);

            $_SESSION['verification_code'] = $verificationCode;
            $_SESSION['email'] = $email;

            $_SESSION['success'] = "Un cod de verificare a fost trimis la adresa de email.";
            header("Location: verify_code.php");
            exit();
        } else {
            $_SESSION['message'] = "Nu există niciun cont asociat cu acest email.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperare Parolă</title>
    <link rel="stylesheet" href="css/password_recovery.css">
</head>
<body>
    <header>
        <a class="backbutton" href="index.php" id="back">Back</a>
    </header>
    <main>
        <div class="container">
            <h2>Password Recovery</h2>
            <p class="small-text">We have send a verification code to your email address</p>
            <?php
                if (isset($_SESSION['message'])) {
                    echo "<div class='alert'>{$_SESSION['message']}</div>";
                    unset($_SESSION['message']);
                }
                if (isset($_SESSION['success'])) {
                    echo "<div class='success'>{$_SESSION['success']}</div>";
                    unset($_SESSION['success']);
                }
            ?>
            <form action="password_recovery.php" method="post">
                <input type="email" id="email" name="email" required><br>
                <button type="submit">Send</button>
            </form>
        </div>
    </main>
</body>
</html>
