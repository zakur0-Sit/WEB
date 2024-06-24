<?php
    $shoes = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($shoes as $shoe) {
        $sqlSizes = "SELECT * FROM shoes_size WHERE id_shoes = " . intval($shoe['id']);
        $resultSizes = mysqli_query($connection, $sqlSizes);
        $sizes = mysqli_fetch_assoc($resultSizes);

        if (isset($_COOKIE['user'])) {
            $email = mysqli_real_escape_string($connection, $_COOKIE['user']);
        } else if (isset($_COOKIE['admin'])) {
            $email = mysqli_real_escape_string($connection, $_COOKIE['admin']);
        } else {
            $email = null;
        }

        if ($email) {
            $sql = "SELECT id FROM users WHERE email='$email'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $userId = $row['id'];
        } else {
            $userId = null;
        }

        $shoeId = $sizes['id_shoes'];

        echo '<div class="element" style="position: relative;">';
        echo '<div class="admin-product">';
        echo '<img src="' . htmlspecialchars($shoe['image']) . '" alt="image" class="product-img">';
        echo '<div class="admin-ico">';
        if (isset($_COOKIE['admin'])) {
            echo '<img class="info-icon" src="img/ico/info.png" alt="Edit" data-product-id="' . $shoeId . '" data-product-name="'
                . htmlspecialchars($shoe['name_shoes']) . '" data-product-description="' . htmlspecialchars($shoe['description'])
                . '" data-product-price="' . htmlspecialchars($shoe['price']) . '" data-product-sizes=\''
                . json_encode(array_keys(array_filter($sizes))) . '\'>';
            $userEmail = mysqli_real_escape_string($connection, $_COOKIE['admin']);
            $sql = "SELECT role FROM users WHERE email = '$userEmail'";
            $result = mysqli_query($connection, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if ($user['role'] === 'admin') {
                    echo '<img src="img/ico/trash.png" alt="image" class="garbage-icon" onclick="deleteShoe(' . $shoeId . ')">';
                }
            }
        }
        echo '</div>';
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

        $sqlRating = "SELECT AVG(rating) as averageRating FROM ratings WHERE id_shoes = " . intval($shoeId);
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
        echo '<button class="rating-button" data-shoe-id="' . $shoeId . '" data-user-id="' . $userId . '">Rate</button>';
        echo '</div>';
        echo '</div>';

        echo '<div class="info-bottom">';
        echo '<button type="button" onclick="window.location.href=\'' . htmlspecialchars($shoe['link']) . '\'">Buy now</button>';

        if ($userId !== null) {
            $query = "SELECT love FROM ratings WHERE id_shoes='" . $shoeId . "' AND id_user='" . $userId . "'";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            $heartImage = 'empty_heart.png';
            if ($row) {
                $heartImage = $row['love'] == 1 ? 'full_heart.png' : 'empty_heart.png';
            }

            echo '<img class="like heart" src="img/ico/' . $heartImage . '" alt="image" data-user-id="' . $userId . '" data-shoe-id="' . $shoeId . '">';
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