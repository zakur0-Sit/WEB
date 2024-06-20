<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo"><img src="img/ico/arrow.png" alt="back"></a>
        <a href="index.php" id="back" >Back</a>
    </header>
    <main>
        <div class="try">
            <div class="color-div"></div>
            <img src="img/sign-in/sign-in-deco.jpg" alt="photo" id="large-image">
        </div>
        <div class="container">
            <p id="reg">Register</p>

            <?php
                require_once "database.php";

                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query($connection, $sql);
                    $row = mysqli_fetch_assoc($result);

                    if(empty($email) || empty($password))
                        echo "<div class='alert'>All fields are required</div>";
                    else if(mysqli_num_rows($result) == 0 || !password_verify($password, $row['password']))
                        echo "<div class='alert'>Invalid email or password</div>";
                    else if($row['role'] == 'admin')
                    {
                        setcookie("admin", $email, time() + (86400 * 10), "/");
                        header("Location: admin.php");
                    }
                    else
                    {
                        setcookie("user", $email, time() + (86400 * 10), "/");
                        header("Location: account.php");
                    }
                    exit();
                }
            ?>

            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <input class="input-line register" type="text" name="email" placeholder="E-mail"><br>
                <input class="input-line register" type="password" name="password" placeholder="Password"><br>
                <button class="input-line" type="submit" name="submit">Sign In</button>

            </form>
            <br>
            <p>Or Sign In with</p>
            <br>
            <div class="reg-ico">
                <div class="google"><a href="#"><img src="img/ico/google.png" alt="google"></a></div>
                <div class="faceboock"><a href="#"><img src="img/ico/facebook.png" alt="faceboock"></a></div>
                <div class="x"><a href="#"><img src="img/ico/x.png" alt="twitter"></a></div>
            </div>
            <br>
            <div class="new-acc">
                <p>Don't have an account? &#160; </p>
                <a href="signup.php">Sign Up!</a>
            </div>
        </div>
    </main>
    
</body>
</html>