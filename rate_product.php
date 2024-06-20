<?php
require_once "database.php";

$shoeId = $_POST['shoe_id'];
$userId = $_POST['user_id'];
$newRating = floatval($_POST['rating']);

$queryRating = "SELECT * FROM ratings WHERE id_shoes = '".$shoeId."' AND id_user = '".$userId."'";
$resultRating = mysqli_query($connection, $queryRating);
$ratingData = mysqli_fetch_assoc($resultRating);

if ($ratingData) {
    $currentRating = floatval($ratingData['rating']);
    
    if ($currentRating == 0.0) {
        $sqlUpdateRating = "UPDATE ratings SET rating = '".$newRating."' WHERE id_shoes = '".$shoeId."' AND id_user = '".$userId."'";
        if (!mysqli_query($connection, $sqlUpdateRating)) {
            die("Error updating rating: " . mysqli_error($connection));
        }
        $averageRating = $newRating;
    } else {
        $averageRating = round(($currentRating + $newRating) / 2, 1);
        $sqlUpdateRating = "UPDATE ratings SET rating = '".$averageRating."' WHERE id_shoes = '".$shoeId."' AND id_user = '".$userId."'";
        if (!mysqli_query($connection, $sqlUpdateRating)) {
            die("Error updating rating: " . mysqli_error($connection));
        }
    }
} else {
    $sqlInsertRating = "INSERT INTO ratings (id_shoes, id_user, rating, love) VALUES ('".$shoeId."', '".$userId."', '".$newRating."', 0)";
    if (!mysqli_query($connection, $sqlInsertRating)) {
        die("Error inserting rating: " . mysqli_error($connection));
    }
    $averageRating = $newRating;
}

echo json_encode(['averageRating' => $averageRating]);
?>
