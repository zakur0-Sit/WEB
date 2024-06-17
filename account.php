<?php
$title = "Account";
$css = "css/account.css";
require "header.php";

// Gestionarea actualizărilor
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_COOKIE['user'])) {
        $email = $_COOKIE['user'];

        // Obținem username-ul
        $sql = "SELECT username FROM users WHERE email='$email'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);

        $username = isset($row['username']) ? $row['username'] : null;

        if ($username) {
            $updateFields = [];
            $updateProfileImage = false;
            $newProfileImagePath = "";

            // Verificăm și adăugăm câmpurile care trebuie actualizate
            if (!empty($_POST['username'])) {
                $newUsername = mysqli_real_escape_string($connection, $_POST['username']);
                $updateFields[] = "username='$newUsername'";

                // Actualizăm username-ul și în tabela users
                $sqlUpdateUsers = "UPDATE users SET username='$newUsername' WHERE email='$email'";
                mysqli_query($connection, $sqlUpdateUsers);
            }

            if (!empty($_POST['shoe-size'])) {
                $newShoeSize = mysqli_real_escape_string($connection, $_POST['shoe-size']);
                $updateFields[] = "shoes_size='$newShoeSize'";

                $sqlUpdateDetails = "UPDATE account_details SET shoes_size='$newShoeSize' WHERE username='$username'";
                mysqli_query($connection, $sqlUpdateDetails);
            }

            // Verificăm dacă a fost încărcată o imagine
            if (!empty($_FILES['profile-image']['name'])) {
                $newProfileImagePath = 'uploads/' . basename($_FILES['profile-image']['name']);
                if (move_uploaded_file($_FILES['profile-image']['tmp_name'], $newProfileImagePath)) {
                    $profileImage = mysqli_real_escape_string($connection, file_get_contents($newProfileImagePath));
                    $updateFields[] = "profile_image='$profileImage'";
                    $updateProfileImage = true;
                }
            }

            // Procesăm culorile favorite
            $colors = ['red' => 0, 'yellow' => 0, 'blue' => 0, 'black' => 0, 'white' => 0];
            if (!empty($_POST['colors'])) {
                foreach ($_POST['colors'] as $color) {
                    if (array_key_exists($color, $colors)) {
                        $colors[$color] = 1;
                    }
                }
            }

            // Construim interogarea pentru actualizarea culorilor favorite
            $colorUpdates = [];
            foreach ($colors as $color => $value) {
                $colorUpdates[] = "$color=$value";
            }
            $colorUpdateQuery = implode(', ', $colorUpdates);

            // Actualizăm tabelul favorites_colors
            $sqlUpdateColors = "UPDATE favorites_colors SET $colorUpdateQuery WHERE id=(SELECT id_colors_favorite FROM account_details WHERE username='$username')";
            mysqli_query($connection, $sqlUpdateColors);

            // Actualizăm tabelul account_details
            if (!empty($updateFields)) {
                $updateQuery = implode(', ', $updateFields);
                $sqlUpdateDetails = "UPDATE account_details SET $updateQuery WHERE username='$username'";
                mysqli_query($connection, $sqlUpdateDetails);
            }

            // Redirecționăm utilizatorul înapoi la pagina de profil pentru a vedea actualizările
            header("Location: account.php");
            exit();
        }
    }
}

// Preluare date pentru afișare
if (isset($_COOKIE['user'])) {
    $email = mysqli_real_escape_string($connection, $_COOKIE['user']);

    // Obținem username-ul și email-ul
    $sql = "SELECT username, email FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = ucfirst(htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'));
        $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');

        // Obținem informațiile din tabela account_details
        $sqlDetails = "SELECT profile_image, shoes_size, id_colors_favorite FROM account_details WHERE username='$username'";
        $resultDetails = mysqli_query($connection, $sqlDetails);
        $details = mysqli_fetch_assoc($resultDetails);

        // Obținem culorile favorite
        if ($details) {
            $id_colors_favorites = $details['id_colors_favorite'];
            $sqlColors = "SELECT red, yellow, blue, black, white FROM favorites_colors WHERE id='$id_colors_favorites'";
            $resultColors = mysqli_query($connection, $sqlColors);
            $colors = mysqli_fetch_assoc($resultColors);

            $favoriteColors = [];
            if ($colors) {
                if ($colors['red']) $favoriteColors[] = 'Red';
                if ($colors['yellow']) $favoriteColors[] = 'Yellow';
                if ($colors['blue']) $favoriteColors[] = 'Blue';
                if ($colors['black']) $favoriteColors[] = 'Black';
                if ($colors['white']) $favoriteColors[] = 'White';
            }

            if (!empty($favoriteColors)) {
                $favoriteColorsText = implode(', ', $favoriteColors);
            } else {
                $favoriteColorsText = "Unknown";
            }
        }
    }
}
?>

<div class="account">
    <main>
        <div class="container-1">
            <h3>Favorite</h3>

            <div class="element element-1">
                <h3>Air Jordan 1 Mid SE</h3>
                <hr>
                <div class="model">
                    <img src="img/account/3.png" alt="img footwear">
                    <div class="info-model">
                        <p>Play like '85. The Air Jordan 1 Mid SE brings fresh details and premium comfort to 
                            an iconic shoe. Its encapsulated Air-Sole unit cushions your foot, while the padded 
                            collar gives you a supportive feel on the move.</p><br>
                        <p class="price">200$</p>
                        <button>Buy now</button>
                    </div>   
                </div>
            </div>
            <br>
            <div class="element element-2">
                <h3>Nike Free Metcon 3</h3>
                <hr>
                <div class="model">
                    <img src="img/account/2.png" alt="img footwear">
                    <div class="info-model">
                        <br>
                        <p class="suplimentar">The Nike Free Metcon 3 combines the flexibility of a Nike Free 
                            sole with the flat, wide heel of the Metcon to keep you fast but stable on your feet 
                            from weightlifting to speed drills.</p><br>
                        <p class="price">150$</p>
                        <button>Buy now</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-2">
            <img class="account-image" src="data:image/jpeg;base64,<?php echo base64_encode($details['profile_image']); ?>" alt="profile image"><br>
            <div class="user-info">
                <p class="name"><?php echo $username; ?></p>
                <img id="edit-icon" class="edit-ico" src="img/ico/edit.png" alt="Edit Profile">
            </div>
            <div class="other">
                <h4 class="size"><br> Size : <i><?php echo isset($details['shoes_size']) ? 'EU ' . htmlspecialchars($details['shoes_size'], ENT_QUOTES, 'UTF-8') : 'Unknown'; ?></i></h4>
                <h4 id="fav-color">Favorite color : <i><?php echo $favoriteColorsText; ?></i></h4>
            </div>
        </div>

        <div id="edit-popup" style="display: none;">
            <form id="edit-form" method="post" action="account.php" enctype="multipart/form-data">
                <label for="profile-image">Profile picture:</label><br>
                <input type="file" id="profile-image" name="profile-image"><br>

                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username"><br>

                <label for="shoe-size">Shoe size:</label><br>
                <select id="shoe-size" name="shoe-size">
                    <option value="">Select size</option>
                    <option value="36">EU 36</option>
                    <option value="37">EU 37</option>
                    <option value="38">EU 38</option>
                    <option value="39">EU 39</option>
                    <option value="40">EU 40</option>
                    <option value="41">EU 41</option>
                    <option value="42">EU 42</option>
                    <option value="43">EU 43</option>
                </select><br>

                <label>Favorite colors:</label>
                <div class="color-checkbox">
                    <input type="checkbox" id="red" name="colors[]" value="red">
                    <label for="red">Red</label>

                    <input type="checkbox" id="yellow" name="colors[]" value="yellow">
                    <label for="yellow">Yellow</label>

                    <input type="checkbox" id="blue" name="colors[]" value="blue">
                    <label for="blue">Blue</label>

                    <input type="checkbox" id="black" name="colors[]" value="black">
                    <label for="black">Black</label>

                    <input type="checkbox" id="white" name="colors[]" value="white">
                    <label for="white">White</label>
                </div>

                <input type="submit" value="Save">
            </form>
        </div>
        <div id="popup-background" style="display: none;"></div>
        <script>
            const popupBackground = document.getElementById('popup-background');

            function openPopup() {
                document.getElementById('edit-popup').style.display = 'block';
                popupBackground.style.display = 'block';
            }

            function closePopup() {
                document.getElementById('edit-popup').style.display = 'none';
                popupBackground.style.display = 'none';
            }

            document.getElementById('edit-icon').addEventListener('click', openPopup);
            document.getElementById('popup-background').addEventListener('click', closePopup);
        </script>
    </main>
</div>
<?php
require "footer.php";
?>
