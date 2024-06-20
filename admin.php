<?php
$title = "Admin";
$css = "css/account.css";
require "header.php";

require_once "database.php";

if(!isset($_COOKIE["admin"]))
{
    header("Location: signin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_COOKIE['admin'])) {
        $email = $_COOKIE['admin'];
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
    $sql = "SELECT id, username FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = ucfirst(htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'));
        $id_user = $row['id'];

        $sqlDetails = "SELECT profile_image FROM account_details WHERE id='$id_user'";
        $resultDetails = mysqli_query($connection, $sqlDetails);
        $details = mysqli_fetch_assoc($resultDetails);

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

                <div class="hide-content">
                    <div id="add" class="add-content content">
                        <form action="add.php", method="post">
                            <div class="add-form">
                                <div class="first">
                                    <label>Name</label>
                                    <input name="name" type="text" placeholder="Name">
                                    <label>Category</label>
                                    <input name="category" type="text" placeholder="Name">
                                    <label>Brand</label>
                                    <input name="brand" type="text" placeholder="Name">
                                    <label>Price</label>
                                    <input name="price" type="text" placeholder="Name">
                                </div>
                                <div class="second">
                                    <label>Description</label>
                                    <textarea name="description" placeholder="Add description..."></textarea>
                                    <label for="add-file" id="for-add-file">Set an image</label>
                                    <input name="image" type="file" id="add-file">
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
                        <form action="import.php" method="post">
                            <label>Import an JSON or CSV file</label><br>
                            <div class="import-buttons">
                                <label for="import-file" id="for-import-file">Chose File</label>
                                <input name="image" type="file" id="import-file">
                                <input type="submit" value="Import">
                            </div>

                        </form>
                    </div>
                    <div id="export" class="export-content content">
                        <form action="export.php" method="post">
                            <label>Export full footwear table</label><br>
                            <input type="submit" value="Export">
                        </form>
                    </div>
                </div>
            </div>

            <div class="container-2">
                <img class="account-image" src="data:image/jpeg;base64,<?php echo base64_encode($details['profile_image']); ?>" alt="profile image"><br>
                <div class="user-info">
                    <p class="name"><?php echo $username; ?></p>
                    <img id="edit-icon" class="edit-ico" src="img/ico/edit.png" alt="Edit Profile">
                </div>

                <button onclick="window.location.href = 'logout.php'" class="logout">Logout</button>
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

    <script src="js/account.js"></script>
    <script src="js/admin.js"></script>

<?php
require "footer.php";
?>