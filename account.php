<?php
$title = "Account";
$css = "css/account.css";
require "header.php";
require_once "database.php";

if (!isset($_COOKIE["user"])) {
    header("Location: signin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_COOKIE['user'])) {
        $email = $_COOKIE['user'];
        $sql = "SELECT id, username FROM users WHERE email='$email'";
        $result = mysqli_query($connection, $sql);
        if (!$result) {
            die("Error: " . mysqli_error($connection));
        }
        $row = mysqli_fetch_assoc($result);
        $username = isset($row['username']) ? $row['username'] : null;
        $id_user = $row['id'];

        if ($username) {
            $updateFields = [];
            $updateProfileImage = false;
            $newProfileImagePath = "";

            if (!empty($_POST['username'])) {
                $newUsername = mysqli_real_escape_string($connection, $_POST['username']);
                $sqlUpdateUsers = "UPDATE users SET username='$newUsername' WHERE email='$email'";
                if (!mysqli_query($connection, $sqlUpdateUsers)) {
                    die("Error updating username: " . mysqli_error($connection));
                }
            }

            if (!empty($_POST['shoe-size'])) {
                $newShoeSize = mysqli_real_escape_string($connection, $_POST['shoe-size']);
                $updateFields[] = "shoes_size='$newShoeSize'";
                $sqlUpdateDetails = "UPDATE account_details SET shoes_size='$newShoeSize' WHERE id='$id_user'";
                if (!mysqli_query($connection, $sqlUpdateDetails)) {
                    die("Error updating shoe size: " . mysqli_error($connection));
                }
            }

            if (!empty($_FILES['profile-image']['name'])) {
                $newProfileImagePath = 'uploads/' . basename($_FILES['profile-image']['name']);
                if (move_uploaded_file($_FILES['profile-image']['tmp_name'], $newProfileImagePath)) {
                    $profileImage = mysqli_real_escape_string($connection, file_get_contents($newProfileImagePath));
                    $updateFields[] = "profile_image='$profileImage'";
                    $updateProfileImage = true;
                }
            }

            $colors = ['red' => 0, 'yellow' => 0, 'green' => 0, 'blue' => 0, 'black' => 0, 'white' => 0];
            if (!empty($_POST['colors'])) {
                foreach ($_POST['colors'] as $color) {
                    if (array_key_exists($color, $colors)) {
                        $colors[$color] = 1;
                    }
                }
            }

            $colorUpdates = [];
            foreach ($colors as $color => $value) {
                $colorUpdates[] = "$color=$value";
            }
            $colorUpdateQuery = implode(', ', $colorUpdates);
            $sqlUpdateColors = "UPDATE favorite_colors SET $colorUpdateQuery WHERE id='$id_user'";
            if (!mysqli_query($connection, $sqlUpdateColors)) {
                die("Error updating favorite colors: " . mysqli_error($connection));
            }

            if (!empty($updateFields)) {
                $updateQuery = implode(', ', $updateFields);
                $sqlUpdateDetails = "UPDATE account_details SET $updateQuery WHERE id='$id_user'";
                mysqli_query($connection, $sqlUpdateDetails);
            }

            header("Location: account.php");
            exit();
        }
    }
}

if (isset($_COOKIE['user'])) {
    $email = mysqli_real_escape_string($connection, $_COOKIE['user']);
    $sql = "SELECT id, username FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = ucfirst(htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'));
        $id_user = $row['id'];

        $sqlDetails = "SELECT profile_image, shoes_size FROM account_details WHERE id='$id_user'";
        $resultDetails = mysqli_query($connection, $sqlDetails);
        $details = mysqli_fetch_assoc($resultDetails);

        if ($details) {
            $sqlColors = "SELECT red, yellow, green, blue, black, white FROM favorite_colors WHERE id='$id_user'";
            $resultColors = mysqli_query($connection, $sqlColors);
            $colors = mysqli_fetch_assoc($resultColors);

            $favoriteColors = [];
            if ($colors) {
                if ($colors['red']) $favoriteColors[] = 'Red';
                if ($colors['yellow']) $favoriteColors[] = 'Yellow';
                if ($colors['green']) $favoriteColors[] = 'Green';
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
            <?php
                $email = mysqli_real_escape_string($connection, $email);

                $sql = "SELECT id FROM users WHERE email='$email'";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_assoc($result);
                $id_user = $row['id'];

                // Obține toate încălțămintea și verifică dacă este în favorite
                $sql = "SELECT s.*, r.love FROM shoes s LEFT JOIN ratings r ON s.id = r.id_shoes AND r.id_user = '$id_user' LEFT JOIN shoes_size ss ON s.id = ss.id_shoes";
                $result = mysqli_query($connection, $sql);
                $shoes = mysqli_fetch_all($result, MYSQLI_ASSOC);

                // Filtrăm doar produsele care sunt în favorite
                $favorite_shoes = array_filter($shoes, function($shoe) {
                    return isset($shoe['love']) && $shoe['love'] == 1;
                });

                foreach ($favorite_shoes as $shoe) {
                    $sqlSizes = "SELECT * FROM shoes_size WHERE id_shoes = " . intval($shoe['id']);
                    $resultSizes = mysqli_query($connection, $sqlSizes);
                    $sizes = mysqli_fetch_assoc($resultSizes);

                    echo '<div class="element" style="position: relative;">';
                    echo '<div class="admin-product">';
                    echo '<img src="' . htmlspecialchars($shoe['image']) . '" alt="image" class="product-img">';
                    echo '</div>';
                    echo '<div class="info">';
                    echo '<div class="info-top">';
                    echo '<div class="detalii">';
                    echo '<p class="info-name"><h3>' . htmlspecialchars($shoe['name_shoes']) . '</h3></p><br>';
                    echo '<p class="info-descript">' . nl2br(htmlspecialchars($shoe['description'])) . '</p><br>';
                    echo '<p class="info-price">' . htmlspecialchars($shoe['price']) . '€</p>';
                    echo '</div>';

                    echo '<div class="rating-container">';
                    echo '<div class="rating">';

                    $sqlRating = "SELECT AVG(rating) as averageRating FROM ratings WHERE id_shoes = " . intval($shoe['id']);
                    $resultRating = mysqli_query($connection, $sqlRating);
                    $ratingData = mysqli_fetch_assoc($resultRating);

                    $averageRating = $ratingData['averageRating'];
                    if ($averageRating !== null) {
                        $averageRating = (floor($averageRating) == $averageRating) ? number_format($averageRating, 0) : number_format($averageRating, 1);
                    } else {
                        $averageRating = 0;
                    }

                    echo '<p class="score">' . $averageRating . '/10</p>';
                    echo '<img class="star" src="img/ico/star.png" alt="image">';

                    echo '</div>';
                    echo '<button class="rating-button" data-shoe-id="' . $shoe['id'] . '" data-user-id="' . $id_user . '">Rate</button>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="info-bottom">';
                    echo '<button type="button" onclick="window.location.href=\'' . htmlspecialchars($shoe['link']) . '\'">Buy now</button>';

                    if ($id_user !== null) {
                        $query = "SELECT love FROM ratings WHERE id_shoes='" . $shoe['id'] . "' AND id_user='" . $id_user . "'";
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_assoc($result);
                        $heartImage = 'empty_heart.png';
                        if ($row) {
                            $heartImage = $row['love'] == 1 ? 'full_heart.png' : 'empty_heart.png';
                        }

                        echo '<img class="like heart" src="img/ico/' . $heartImage . '" alt="image" data-user-id="' . $id_user . '" data-shoe-id="' . $shoe['id'] . '">';
                    }

                    echo '</div>';
                    echo '<div class="buttons-size">';

                    for ($size = 33; $size <= 45; $size++) {
                        if ($sizes['size_' . $size] == 1) {
                            echo '<button class="size-button">EU ' . $size . '</button>';
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            ?>

        </div>

        <div class="container-2 user">
            <img class="account-image" src="data:image/jpeg;base64,<?php echo base64_encode($details['profile_image']); ?>" alt="profile image"><br>
            <div class="user-info">
                <p class="name"><?php echo $username; ?></p>
                <img id="edit-icon" class="edit-ico" src="img/ico/edit.png" alt="Edit Profile">
            </div>
            <div class="other">
                <h4 class="ssize"><br> Size : <i><?php echo isset($details['shoes_size']) ? 'EU ' . htmlspecialchars($details['shoes_size'], ENT_QUOTES, 'UTF-8') : 'Unknown'; ?></i></h4>
                <h4 id="fav-color">Favorite color : <i><?php echo $favoriteColorsText; ?></i></h4>
            </div>
            <button onclick="window.location.href = 'logout.php'" class="logout">Logout</button>
        </div>

        <div id="edit-popup" style="display: none;">
            <form id="edit-form" method="post" action="account.php" enctype="multipart/form-data">
                <label for="profile-image">Profile picture:</label>
                <input type="file" id="profile-image" name="profile-image">

                <label for="username">Username:</label>
                <input type="text" id="username" name="username">

                <label for="shoe-size">Shoe size:</label>
                <select id="shoe-size" name="shoe-size">
                    <option value="">Select size</option>
                    <option value="36">EU 33</option>
                    <option value="37">EU 34</option>
                    <option value="38">EU 35</option>
                    <option value="36">EU 36</option>
                    <option value="37">EU 37</option>
                    <option value="38">EU 38</option>
                    <option value="39">EU 39</option>
                    <option value="40">EU 40</option>
                    <option value="41">EU 41</option>
                    <option value="42">EU 42</option>
                    <option value="43">EU 43</option>
                    <option value="36">EU 44</option>
                    <option value="37">EU 45</option>
                </select>

                <label>Favorite colors:</label>
                <div class="color-checkbox">
                    <input type="checkbox" id="red" name="colors[]" value="red">
                    <label for="red">Red</label>

                    <input type="checkbox" id="yellow" name="colors[]" value="yellow">
                    <label for="yellow">Yellow</label>

                    <input type="checkbox" id="green" name="colors[]" value="green">
                    <label for="green">Green</label>

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
    </main>
    <div class="popup-background" style="display: none;"></div>
</div>

    <div id="rating-popup" class="popup">
        <div class="popup-content">
            <span class="close-button">&times;</span>
            <h2>Rate this Product</h2>
            <div class="rating-options">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <button class="rate-button" data-rating="<?php echo $i; ?>"><?php echo $i; ?></button>
                <?php endfor; ?>
            </div>
            <form id="rating-form" style="display:none;">
                <input type="hidden" name="shoe_id" id="shoe_id">
                <input type="hidden" name="user_id" id="user_id">
                <input type="hidden" name="rating" id="rating">
            </form>
        </div>
    </div>

<script src="js/account.js"></script>
<script src="js/menu.js"></script>
<script src="js/like.js"></script>
<script src="js/rating.js"></script>

<?php
require "footer.php";
?>