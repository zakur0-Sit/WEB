<?php
require_once "database.php";

header('Content-Type: application/json');

$shoeId = isset($_POST['shoe_id']) ? intval($_POST['shoe_id']) : null;
$userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
$newRating = isset($_POST['rating']) ? floatval($_POST['rating']) : null;

if (!$shoeId || !$userId || $newRating === null || $newRating < 0 || $newRating > 10) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$queryRating = "SELECT * FROM ratings WHERE id_shoes = '$shoeId' AND id_user = '$userId'";
$resultRating = mysqli_query($connection, $queryRating);

if (!$resultRating) {
    echo json_encode(['success' => false, 'message' => "Database error: " . mysqli_error($connection)]);
    exit;
}

$ratingData = mysqli_fetch_assoc($resultRating);

if ($ratingData) {
    $sqlUpdateRating = "UPDATE ratings SET rating = '$newRating' WHERE id_shoes = '$shoeId' AND id_user = '$userId'";
    if (!mysqli_query($connection, $sqlUpdateRating)) {
        echo json_encode(['success' => false, 'message' => "Error updating rating: " . mysqli_error($connection)]);
        exit;
    }
} else {
    $sqlInsertRating = "INSERT INTO ratings (id_shoes, id_user, rating, love) VALUES ('$shoeId', '$userId', '$newRating', 0)";
    if (!mysqli_query($connection, $sqlInsertRating)) {
        echo json_encode(['success' => false, 'message' => "Error inserting rating: " . mysqli_error($connection)]);
        exit;
    }
}

// Calculate the new average rating
$sqlAverageRating = "SELECT AVG(rating) as averageRating FROM ratings WHERE id_shoes = '$shoeId'";
$resultAverageRating = mysqli_query($connection, $sqlAverageRating);
$averageRatingData = mysqli_fetch_assoc($resultAverageRating);
$averageRating = round($averageRatingData['averageRating'], 1);

echo json_encode(['success' => true, 'averageRating' => $averageRating]);
?>
