<?php
require_once "send_email.php";
require_once "database.php";

$sql = "SELECT email, username, id FROM users";
$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $email = $row['email'];
        $username = $row['username'];
        $id_user = $row['id'];

        // Obține mărimea papucilor preferată a utilizatorului
        $sqlDetails = "SELECT shoes_size FROM account_details WHERE id='$id_user'";
        $resultDetails = mysqli_query($connection, $sqlDetails);
        $details = mysqli_fetch_assoc($resultDetails);

        if ($details) {
            $shoesSize = $details['shoes_size'];

            // Obține culorile preferate ale utilizatorului
            $sqlColors = "SELECT red, yellow, blue, black, white, green FROM favorite_colors WHERE id='$id_user'";
            $resultColors = mysqli_query($connection, $sqlColors);
            $colors = mysqli_fetch_assoc($resultColors);

            $favoriteColors = [];
            if ($colors) {
                foreach ($colors as $color => $value) {
                    if ($value == 1) {
                        $favoriteColors[] = $color;
                    }
                }
            }

            if (!empty($favoriteColors)) {
                $favoriteColorsText = implode(', ', $favoriteColors);

                // Construiește condiția pentru culori
                $colorConditions = [];
                foreach ($favoriteColors as $color) {
                    $colorConditions[] = "sc.$color = 1";
                }
                $colorConditionQuery = implode(' OR ', $colorConditions);

                // Selectează papucii recomandați
                $sqlShoes = "
                    SELECT s.name_shoes, s.description, s.price, s.image, s.link 
                    FROM shoes s 
                    JOIN shoes_size ss ON s.id = ss.id_shoes
                    JOIN shoes_color sc ON s.id = sc.id_shoes
                    WHERE ss.size_$shoesSize = 1 AND ($colorConditionQuery)
                    ORDER BY s.id DESC LIMIT 1";
                $resultShoes = mysqli_query($connection, $sqlShoes);
                $shoes = mysqli_fetch_assoc($resultShoes);

                if ($shoes) {
                    $shoeName = $shoes['name_shoes'];
                    $shoePrice = $shoes['price'];
                    $shoeDescription = $shoes['description'];
                    $shoeImage = 'http://yourdomain.com/uploads/' . $shoes['image'];  // Calea completă către imagine
                    $shoeLink = $shoes['link'];

                    $subject = "Recommended Shoes for You";
                    $body = "
                        <h1>$shoeName</h1>
                        <p>Dear $username,</p>
                        <p>We have a fantastic recommendation just for you!</p>
                        <p>Check out the amazing <strong>$shoeName</strong>. Here are some reasons why you'll love them:</p>
                        <ul>
                            <li><strong>Comfort:</strong> $shoeDescription</li>
                            <li><strong>Price:</strong> $$shoePrice</li>
                        </ul>
                        <p>And the best part? They come in your favorite colors and your size!</p>
                        <p>Don't miss out on these exclusive shoes. Click the link below to buy now:</p>
                        <a href='$shoeLink'>Buy now</a>
                        <br><br>
                        <p>Happy shopping!</p>
                        <p>Best regards,</p>
                        <p>Your Favorite Shoe Store</p>
                    ";

                    send_verification_mail($email, $subject, $body);
                }
            }
        }
    }
}
?>
