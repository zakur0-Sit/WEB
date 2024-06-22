<!-- <?php
require_once "database.php";

$shoeId = $_POST['shoe_id'];
$userId = $_POST['user_id'];
$love = $_POST['love'];

$queryRating = "SELECT * FROM ratings WHERE id_shoes = '".$shoeId."' AND id_user = '".$userId."'";
$resultRating = mysqli_query($connection, $queryRating);
$rating = mysqli_fetch_assoc($resultRating);

if ($rating) {
    $sqlUpdateRating = "UPDATE ratings SET love = '".$love."' WHERE id_shoes = '".$shoeId."' AND id_user = '".$userId."'";
    if (!mysqli_query($connection, $sqlUpdateRating)) {
        die("Error updating rating: " . mysqli_error($connection));
    }
} else {
    $sqlInsertRating = "INSERT INTO ratings (id_shoes, id_user, rating, love, numberofnotes) VALUES ('".$shoeId."', '".$userId."', 0.0, '".$love.", 0')";
    if (!mysqli_query($connection, $sqlInsertRating)) {
        die("Error insert rating: " . mysqli_error($connection));
    }
}
?> -->