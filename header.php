
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href=<?=$css?>>
	<title><?=$title?></title>
</head>
<body>
	<header>
        <nav class="navbar">
            <a href="index.php"><img src="img/ico/smol-logo.png" alt="logo"></a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="footwear.php">Footwear</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="help.php">Help</a></li>
                
                <?php
                if (isset($_COOKIE['user'])) {
                    echo '<li><button id="sign-in" class="input-line" type="button" onclick="window.location.href=\'account.php\'">Account</button></li>';
                }
                else if(isset($_COOKIE['admin']))
                {
                    echo '<li><button id="sign-in" class="input-line" type="button" onclick="window.location.href=\'admin.php\'">Account</button></li>';
                }
                else {
                    echo '<li><button id="sign-in" class="input-line" type="button" onclick="window.location.href=\'signin.php\'">Sign In</button></li>';
                }
                ?>
            </ul>
            <img src="img/ico/menu-btn.png" alt="menu-button-img" class="menu-btn">
        </nav>
    </header>