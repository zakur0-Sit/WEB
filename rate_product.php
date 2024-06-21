<?php
require_once "database.php";

// Activează raportarea erorilor
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Pornește bufferul de ieșire pentru a captura orice ieșire înainte de răspunsul JSON
ob_start();

$shoeId = isset($_POST['shoe_id']) ? intval($_POST['shoe_id']) : null;
$userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
$newRating = isset($_POST['rating']) ? floatval($_POST['rating']) : null;

// Validează datele primite
if (!$shoeId || !$userId || $newRating === null || $newRating < 0 || $newRating > 10) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// Interoghează baza de date pentru a găsi ratingul existent
$queryRating = "SELECT * FROM ratings WHERE id_shoes = '$shoeId' AND id_user = '$userId'";
$resultRating = mysqli_query($connection, $queryRating);

if (!$resultRating) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => "Database error: " . mysqli_error($connection)]);
    exit;
}

$ratingData = mysqli_fetch_assoc($resultRating);

if ($ratingData) {
    $numberOfNotes = intval($ratingData['numberofnotes']);
    $currentRating = floatval($ratingData['rating']);

    $newAverageRating = (($currentRating * $numberOfNotes) + $newRating) / ($numberOfNotes + 1);
    $newNumberOfNotes = $numberOfNotes + 1;

    $sqlUpdateRating = "UPDATE ratings SET rating = '$newAverageRating', numberofnotes = '$newNumberOfNotes' WHERE id_shoes = '$shoeId' AND id_user = '$userId'";
    if (!mysqli_query($connection, $sqlUpdateRating)) {
        ob_end_clean();
        echo json_encode(['success' => false, 'message' => "Error updating rating: " . mysqli_error($connection)]);
        exit;
    }
} else {
    $sqlInsertRating = "INSERT INTO ratings (id_shoes, id_user, rating, love, numberofnotes) VALUES ('$shoeId', '$userId', '$newRating', 0, 1)";
    if (!mysqli_query($connection, $sqlInsertRating)) {
        ob_end_clean();
        echo json_encode(['success' => false, 'message' => "Error inserting rating: " . mysqli_error($connection)]);
        exit;
    }
    $newAverageRating = $newRating;
}

// Curăță bufferul de ieșire și trimite răspunsul JSON
ob_end_clean();
echo json_encode(['success' => true, 'averageRating' => round($newAverageRating, 1)]);
?>
