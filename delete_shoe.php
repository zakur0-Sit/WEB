<?php
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["shoe_id"])) {
        $shoeId = intval($_POST["shoe_id"]);

        // Șterge informațiile din tabelul shoes
        $sqlDeleteShoes = "DELETE FROM shoes WHERE id = $shoeId";
        mysqli_query($connection, $sqlDeleteShoes);

        // Șterge informațiile din tabelul shoes_size
        $sqlDeleteShoesSize = "DELETE FROM shoes_size WHERE id_shoes = $shoeId";
        mysqli_query($connection, $sqlDeleteShoesSize);

        // Șterge informațiile din tabelul shoes_color
        $sqlDeleteShoesColor = "DELETE FROM shoes_color WHERE id_shoes = $shoeId";
        mysqli_query($connection, $sqlDeleteShoesColor);

        // Șterge informațiile din tabelul ratings
        $sqlDeleteRatings = "DELETE FROM ratings WHERE id_shoes = $shoeId";
        mysqli_query($connection, $sqlDeleteRatings);

        header("Location: footwear.php");
        exit();
    }
}
?>
