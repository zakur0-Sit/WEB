<?php
session_start();
$css = "css/reset_password.css";
require_once "database.php";

if (!isset($_SESSION['verified']) || !isset($_SESSION['email'])) {
    header("Location: password_recovery.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($password) || empty($confirm_password)) {
        $_SESSION['message'] = "Toate câmpurile sunt obligatorii.";
    } elseif ($password !== $confirm_password) {
        $_SESSION['message'] = "Parolele nu coincid.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $email = $_SESSION['email'];

        $sql = "UPDATE users SET password=? WHERE email=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Parola a fost resetată cu succes.";
            unset($_SESSION['verification_code']);
            unset($_SESSION['email']);
            unset($_SESSION['verified']);
            header("Location: signin.php");
            exit();
        } else {
            $_SESSION['message'] = "Eroare la resetarea parolei.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resetare Parolă</title>
    <link rel="stylesheet" href="css/reset_password.css">
</head>
<body>
    <header>
       <a class="backbutton" href="index.php" id="back">Back</a>
    </header>
    <main>
        <div class="container">
            <h2>Resetare Parolă</h2>
            <?php
                if (isset($_SESSION['message'])) {
                    echo "<div class='alert'>{$_SESSION['message']}</div>";
                    unset($_SESSION['message']);
                }
            ?>
            <form action="reset_password.php" method="post">
                <label for="password">Parola nouă:</label>
                <input type="password" id="password" name="password" required>
                <label for="confirm_password">Confirmă parola:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <button type="submit">Resetare parolă</button>
            </form>
        </div>
    </main>
</body>
</html>
