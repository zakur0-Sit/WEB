<?php
$title = "Admin";
$css = "css/account.css";
require "header.php";

require_once "database.php";

if (!isset($_COOKIE["admin"])) {
    header("Location: signin.php");
    exit();
}

session_start();
$sql_role = "SELECT role FROM users WHERE email=?";
$stmt_role = $connection->prepare($sql_role);
$stmt_role->bind_param("s", $_COOKIE["admin"]);
$stmt_role->execute();
$result_role = $stmt_role->get_result();
$row_role = $result_role->fetch_assoc();
if ($row_role['role'] != 'admin') {
    header("Location: signin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_COOKIE['admin']))
    {

        $email = $_COOKIE['admin'];
        $sql = "SELECT id, username  FROM users WHERE email='$email'";
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

            if (!empty($_FILES['profile-image']['name'])) {
                $newProfileImagePath = 'uploads/' . basename($_FILES['profile-image']['name']);
                if (move_uploaded_file($_FILES['profile-image']['tmp_name'], $newProfileImagePath)) {
                    $profileImage = mysqli_real_escape_string($connection, file_get_contents($newProfileImagePath));
                    $updateFields[] = "profile_image='$profileImage'";
                    $updateProfileImage = true;
                }
            }

            if (!empty($updateFields)) {
                $updateQuery = implode(', ', $updateFields);
                $sqlUpdateDetails = "UPDATE account_details SET $updateQuery WHERE id='$id_user'";
                mysqli_query($connection, $sqlUpdateDetails);
            }

            header("Location: admin.php");
            exit();
        }
    }
}

if (isset($_COOKIE['admin'])) {
    $email = mysqli_real_escape_string($connection, $_COOKIE['admin']);
    $sql = "SELECT id, username FROM users WHERE email=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = ucfirst(htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'));
        $id_user = $row['id'];

        $sqlDetails = "SELECT profile_image FROM account_details WHERE id=?";
        $stmtDetails = $connection->prepare($sqlDetails);
        $stmtDetails->bind_param("s", $id_user);
        $stmtDetails->execute();
        $resultDetails = $stmtDetails->get_result();
        $details = $resultDetails->fetch_assoc();
    }
}
?>

    <div class="account">
        <main>
            <div class="container-1">
                <div class="admin-buttons">
                    <button id="add-button">Add</button>
                    <button id="delete-button">Delete</button>
                    <button id="import-button">Import</button>
                    <button id="export-button">Export</button>
                </div>

                <div class="hide-content" id="hide">
                    <div id="add" class="add-content content">
                        <form action="add.php" method="post" enctype="multipart/form-data">
                            <div class="add-form">
                                <div class="first">
                                    <label>Name</label>
                                    <input name="name" type="text" placeholder="Name">
                                    <label>Price</label>
                                    <input name="price" type="text" placeholder="Price">
                                    <label>Link</label>
                                    <input name="link" type="text" placeholder="Link">

                                    <label>Category</label>
                                    <div class="category">
                                        <div class="categ">
                                            <input type="radio" name="category" value="sneakers">
                                            <label>Sneakers</label>
                                        </div>
                                        <div class="categ">
                                            <input type="radio" name="category" value="boots">
                                            <label>Boots</label>
                                        </div>
                                        <div class="categ">
                                            <input type="radio" name="category" value="sandals">
                                            <label>Sandals</label>
                                        </div>
                                        <div class="categ">
                                            <input type="radio" name="category" value="slippers">
                                            <label>Slippers</label>
                                        </div>
                                        <div class="categ">
                                            <input type="radio" name="category" value="flip-flops">
                                            <label>Flip-flops</label>
                                        </div>
                                    </div>
                                    <label>Brand</label>
                                    <div class="brand">
                                        <div class="bran">
                                            <input type="radio" name="brand" value="nike">
                                            <label>Nike</label>
                                        </div>
                                        <div class="bran">
                                            <input type="radio" name="brand" value="jordan">
                                            <label>Jordan</label>
                                        </div>
                                        <div class="bran">
                                            <input type="radio" name="brand" value="adidas">
                                            <label>Adidas</label>
                                        </div>
                                        <div class="bran">
                                            <input type="radio" name="brand" value="puma">
                                            <label>Puma</label>
                                        </div>
                                        <div class="bran">
                                            <input type="radio" name="brand" value="reebok">
                                            <label>Reebok</label>
                                        </div>
                                    </div>
                                    <label for="add-file" id="for-add-file">Set an image</label>
                                    <input name="image" type="file" id="add-file">
                                </div>
                                <div class="second">
                                    <label>Color</label>
                                    <div class="colors">
                                        <div class="color">
                                            <input type="checkbox" name="colors[]" value="red">
                                            <label>Red</label>
                                        </div>
                                        <div class="color">
                                            <input type="checkbox" name="colors[]" value="yellow">
                                            <label>Yellow</label>
                                        </div>
                                        <div class="color">
                                            <input type="checkbox" name="colors[]" value="green">
                                            <label>Green</label>
                                        </div>
                                        <div class="color">
                                            <input type="checkbox" name="colors[]" value="blue">
                                            <label>Blue</label>
                                        </div>
                                        <div class="color">
                                            <input type="checkbox" name="colors[]" value="black">
                                            <label>Black</label>
                                        </div>
                                        <div class="color">
                                            <input type="checkbox" name="colors[]" value="white">
                                            <label>White</label>
                                        </div>
                                    </div>
                                    <label>Size</label>
                                    <div class="sizes">
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="33">
                                            <label>EU 33</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="34">
                                            <label>EU 34</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="35">
                                            <label>EU 35</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="36">
                                            <label>EU 36</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="37">
                                            <label>EU 37</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="38">
                                            <label>EU 38</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="39">
                                            <label>EU 39</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="40">
                                            <label>EU 40</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="41">
                                            <label>EU 41</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="42">
                                            <label>EU 42</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="43">
                                            <label>EU 43</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="44">
                                            <label>EU 44</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" name="sizes[]" value="45">
                                            <label>EU 45</label>
                                        </div>
                                    </div>
                                    <label>Description</label>
                                    <textarea name="description" placeholder="Add description..."></textarea>
                                </div>
                            </div>
                            <input type="submit" value="Add">
                        </form>
                    </div>
                    <div id="delete" class="delete-content content">
                        <form action="delete.php" method="post">
                            <label>Delete item by id</label>
                            <div class="delete-form">
                                <input name="id" type="text" placeholder="123">
                                <input type="submit" value="Delete">
                            </div>
                        </form>
                    </div>
                    <div id="import" class="import-content content">
                        <form action="import.php" method="post" enctype="multipart/form-data">
                            <label>Import a JSON or CSV file</label><br>
                            <div class="import-buttons">
                                <label for="import-file" id="for-import-file">Choose File</label>
                                <input name="file" type="file" id="import-file">
                                <input type="submit" value="Import">
                            </div>
                        </form>
                    </div>
                    <div id="export" class="export-content content">
                        <form action="export.php" method="post">
                            <label>Export full footwear table</label><br>
                            <div class="export-buttons">
                                <input type="submit" name="export" value="Export in JSON">
                                <input type="submit" name="export" value="Export in CSV">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container-2 admin-container">
                <p><strong>ADMIN</strong></p><br>
                <img class="account-image" src="data:image/jpeg;base64,<?php echo base64_encode($details['profile_image']); ?>" alt="profile image"><br>
                <div class="user-info">
                    <p class="name"><?php echo $username; ?></p>
                    <img id="edit-icon" class="edit-ico" src="img/ico/edit.png" alt="Edit Profile">
                </div>

                <button onclick="window.location.href = 'logout.php'" class="logout">Logout</button>
                <?php
                    if (isset($_SESSION['message']))
                    {
                        echo "<div class='alert'>{$_SESSION['message']}</div>";
                        unset($_SESSION['message']);
                    }
                    else if(isset($_SESSION['success']))
                    {
                        echo "<div class='success'>{$_SESSION['success']}</div>";
                        unset($_SESSION['success']);
                    }
                ?>
            </div>

            <div id="edit-popup" style="display: none;">
                <form id="edit-form" method="post" action="admin.php" enctype="multipart/form-data">
                    <label for="profile-image">Profile picture:</label>
                    <input type="file" id="profile-image" name="profile-image">

                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">

                    <input type="submit" value="Save">
                </form>
            </div>
            <div id="popup-background" style="display: none;"></div>
        </main>

        <div class="popup-background" style="display: none;"></div>
    </div>

    <script src="js/menu.js"></script>
    <script src="js/account.js"></script>
    <script src="js/admin.js"></script>

<?php
require "footer.php";
?>