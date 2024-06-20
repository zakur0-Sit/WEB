<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo"><img src="img/ico/arrow.png" alt="back"></a>
        <a href="index.php" id="back" >Back</a>
    </header>
    <main>
        <div class="try">
            <div class="color-div"></div>
            <img src="img/sign-up/sign-up-deco.jpg" alt="photo" id="large-image">
        </div>
        <div class="container">
            <p id="reg">Create an Account</p>
            <?php
                require_once "database.php";

                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
                    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
                    $repeat_password = filter_input(INPUT_POST, 'repeat_password', FILTER_SANITIZE_SPECIAL_CHARS);
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    $errors = array();

                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query($connection, $sql);
                    if(empty($username) || empty($email) || empty($password) || empty($repeat_password))
                        array_push($errors, "All fields are required");
                    else if($password != $repeat_password)
                        array_push($errors, "Passwords do not match");
                    else if(strlen($password) < 8)
                        array_push($errors, "Password must be at least 8 characters long");

                    else if(mysqli_num_rows($result) > 0)
                        array_push($errors, "Email already exists");

                    if(count($errors) > 0)
                        foreach($errors as $error)
                        {
                            echo "<div class='alert'> $error </div>";
                        }
                    else
                    {
                        // Insert a new user
                        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password_hash', 'user')";
                        mysqli_query($connection, $sql);

                        // Get the id of the new user
                        $new_user_id = mysqli_insert_id($connection);

                        // Insert into account_details
                        $profile_image_path = 'img/account/account-image.jpg';
                        $profile_image = mysqli_real_escape_string($connection, file_get_contents($profile_image_path));
                        $shoes_size=0;
                        $sql = "INSERT INTO account_details (id, profile_image, shoes_size ) VALUES ('$new_user_id', '$profile_image', '$shoes_size')";
                        mysqli_query($connection, $sql);

                        // Insert into favorite_colors
                        $sql = "INSERT INTO favorite_colors (id, red, yellow, blue, black, white) VALUES ('$new_user_id', false, false, false, false, false)";
                        mysqli_query($connection, $sql);
                        header("Location: signin.php");
                        exit();
                    }
                }

            ?>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <input class="input-line register" type="text" name="username" placeholder="Username"><br>
                <input class="input-line register" type="text" name="email" placeholder="E-mail"><br>
                <input class="input-line register" type="password" name="password" placeholder="Password"><br>
                <input class="input-line register" type="password" name="repeat_password" placeholder="Repeat Password"><br>
                <button class="input-line" type="submit" name="submit">Sign Up</button>
            </form>
            <br>
            <p>Or Sign Up with</p>
            <br>
            <div class="reg-ico">
                <div class="google"><a href="#"><img src="img/ico/google.png" alt="google"></a></div>
                <div class="faceboock"><a href="#"><img src="img/ico/facebook.png" alt="faceboock"></a></div>
                <div class="x"><a href="#"><img src="img/ico/x.png" alt="twitter"></a></div>
            </div>
            <br>
            <div class="new-acc">
                <p>Already have an account? &#160;</p>
                <a href="signin.php">Sign In!</a>
            </div>
        </div>
    </main>

</body>
</html>