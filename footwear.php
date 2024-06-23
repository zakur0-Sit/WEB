<?php
$title = "Footwear";
$css = "css/footwear.css";
require "header.php";
?>
<div class="footwear">
    <main>
        <div class="container-1">
            <div class="side-bar">
                <button onclick="toggleDropdown()" class="drop">Sort by</button>
                <div id="dropdown-content" class="dropdown-content">
                    <form class="filter" action="footwear.php" method="post">
                        <div class="category">
                            <br>
                            <p>Category</p>
                            <div class="categories">
                                <input type="checkbox" name="category[]" value="sneakers" id="sneakers" onclick="checkFunction()">
                                <label for="sneakers">Sneakers</label>
                                <input type="checkbox" name="category[]" value="boots" id="boots">
                                <label for="boots">Boots</label>
                                <input type="checkbox" name="category[]" value="sandals" id="sandals">
                                <label for="sandals">Sandals</label>
                                <input type="checkbox" name="category[]" value="slippers" id="slippers">
                                <label for="slippers">Slippers</label>
                                <input type="checkbox" name="category[]" value="flip-flops" id="flip-flops">
                                <label for="flip-flops">Flip-flops</label>
                            </div>
                        </div>

                        <div class="brand">
                            <p>Brand</p>
                            <div class="brands">
                                <input type="checkbox" name="brand[]" id="nike" value="nike">
                                <label for="nike">Nike</label>
                                <input type="checkbox" name="brand[]" id="jordan" value="jordan">
                                <label for="jordan">Jordan</label>
                                <input type="checkbox" name="brand[]" id="adidas" value="adidas">
                                <label for="adidas">Adidas</label>
                                <input type="checkbox" name="brand[]" id="puma" value="puma">
                                <label for="puma">Puma</label>
                                <input type="checkbox" name="brand[]" id="reebok" value="reebok">
                                <label for="reebok">Reebok</label>
                            </div>
                        </div>

                        <div class="color-form">
                            <p>Color</p>
                            <div class="color">
                                <input type="checkbox" name="color[]" id="red">
                                <img src="img/ico/red-drop.png" alt="ico">
                                <label for="red">Red</label><br>
                            </div>
                            <div class="color">
                                <input type="checkbox" name="color[]" id="yellow">
                                <img src="img/ico/yellow-drop.png" alt="ico">
                                <label for="yellow">Yellow</label><br>
                            </div>
                            <div class="color">
                                <input type="checkbox" name="color[]" id="green">
                                <img src="img/ico/green-drop.png" alt="ico">
                                <label for="green">Green</label><br>
                            </div>
                            <div class="color">
                                <input type="checkbox" name="color[]" id="blue">
                                <img src="img/ico/blue-drop.png" alt="ico">
                                <label for="blue">Blue</label><br>
                            </div>
                            <div class="color">
                                <input type="checkbox" name="color[]" id="black">
                                <img src="img/ico/black-drop.png" alt="ico">
                                <label for="black">Black</label><br>
                            </div>
                            <div class="color">
                                <input type="checkbox" name="color[]" id="white">
                                <img src="img/ico/white-drop.png" alt="ico">
                                <label for="white">White</label><br>
                            </div>
                        </div>

                        <div class="size">
                            <p>Size</p>
                            <div class="sizes">
                                <input type="checkbox" name="size[]" value="33" id="size-33">
                                <label for="size-33">EU 33</label>
                                <input type="checkbox" name="size[]" value="34" id="size-34">
                                <label for="size-34">EU 34</label>
                                <input type="checkbox" name="size[]" value="35" id="size-35">
                                <label for="size-35">EU 35</label>
                                <input type="checkbox" name="size[]" value="36" id="size-36">
                                <label for="size-36">EU 36</label>
                                <input type="checkbox" name="size[]" value="37" id="size-37">
                                <label for="size-37">EU 37</label>
                                <input type="checkbox" name="size[]" value="38" id="size-38">
                                <label for="size-38">EU 38</label>
                                <input type="checkbox" name="size[]" value="39" id="size-39">
                                <label for="size-39">EU 39</label>
                                <input type="checkbox" name="size[]" value="40" id="size-40">
                                <label for="size-40">EU 40</label>
                                <input type="checkbox" name="size[]" value="41" id="size-41">
                                <label for="size-41">EU 41</label>
                                <input type="checkbox" name="size[]" value="42" id="size-42">
                                <label for="size-42">EU 42</label>
                                <input type="checkbox" name="size[]" value="43" id="size-43">
                                <label for="size-43">EU 43</label>
                                <input type="checkbox" name="size[]" value="44" id="size-44">
                                <label for="size-44">EU 44</label>
                                <input type="checkbox" name="size[]" value="45" id="size-45">
                                <label for="size-45">EU 45</label>
                            </div>
                        </div>

                        <div class="price">
                            <p>Price</p>
                            <output for="price-range" id="price-value">1000$</output>
                            <input type="range" id="price-range" name="price-range" min="0" max="1000" step="10" value="1000">
                        </div><br>

                        <button type="submit" id="filter-button">Display</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-2">
            <?php
            require_once "database.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $conditions = [];

                // Handle Category Filter
                if (isset($_POST["category"])) {
                    $category_filter = $_POST["category"];
                    $category_conditions = array_map(function($cat) {
                        global $connection;
                        return "category = '" . mysqli_real_escape_string($connection, $cat) . "'";
                    }, $category_filter);
                    $conditions[] = "(" . implode(" OR ", $category_conditions) . ")"; // assuming multiple categories should be an OR condition
                }

                // Handle Brand Filter
                if (isset($_POST["brand"])) {
                    $brand_filter = $_POST["brand"];
                    $brand_conditions = array_map(function($brand) {
                        global $connection;
                        return "brand = '" . mysqli_real_escape_string($connection, $brand) . "'";
                    }, $brand_filter);
                    $conditions[] = "(" . implode(" OR ", $brand_conditions) . ")"; // assuming multiple brands should be an OR condition
                }

                // Handle Color Filter
//                if (isset($_POST["color"])) {
//                    $color_filter = $_POST["color"];
//                    $color_conditions = array_map(function($color) {
//                        global $connection;
//                        return "sc." . mysqli_real_escape_string($connection, $color) . " = 1";
//                    }, $color_filter);
//                    $conditions[] = "(" . implode(" OR ", $color_conditions) . ")"; // assuming multiple colors should be an OR condition
//                }

                // Construct the WHERE clause
                if (!empty($conditions)) {
                    $sql = "SELECT * FROM shoes s LEFT JOIN shoes_color sc ON s.id = sc.id_shoes WHERE " . implode(" AND ", $conditions) . " ORDER BY s.id DESC";
                } else {
                    $sql = "SELECT * FROM shoes ORDER BY id DESC";
                }
            } else {
                $sql = "SELECT * FROM shoes ORDER BY id DESC";
            }

            $result = mysqli_query($connection, $sql);
            if (!$result) {
                die("Database query failed: " . mysqli_error($connection));
            }
            $shoes = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($shoes as $shoe) {
                $sqlSizes = "SELECT * FROM shoes_size WHERE id_shoes = " . intval($shoe['id']);
                $resultSizes = mysqli_query($connection, $sqlSizes);
                $sizes = mysqli_fetch_assoc($resultSizes);

                if (isset($_COOKIE['user'])) {
                    $email = mysqli_real_escape_string($connection, $_COOKIE['user']);
                } else if (isset($_COOKIE['admin'])) {
                    $email = mysqli_real_escape_string($connection, $_COOKIE['admin']);
                }

                $sql = "SELECT id FROM users WHERE email='$email'";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_assoc($result);
                $userId = $row['id'];
                $shoeId = $sizes['id_shoes'];

                echo '<div class="element">';
                echo '<img src="' . htmlspecialchars($shoe['image']) . '" alt="image">';
                echo '<div class="info">';
                echo '<div class="info-top">';
                echo '<div class="detalii">';
                echo '<p class="info-name"><strong>' . htmlspecialchars($shoe['name_shoes']) . '</strong></p><br>';
                echo '<p class="info-descript">' . nl2br(htmlspecialchars($shoe['description'])) . '</p><br>';
                echo '<p class="info-price">' . htmlspecialchars($shoe['price']) . '$</p>';
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
                echo '<div class="buttons-size">';

                for ($size = 33; $size <= 45; $size++) {
                    if ($sizes['size_' . $size] == 1) {
                        echo '<button class="size-button">EU ' . $size . '</button>';
                    }
                }

                echo '</div>';

                $query = "SELECT love FROM ratings WHERE id_shoes='" . $shoeId . "' AND id_user='" . $userId . "'";
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($result);
                $heartImage = 'empty_heart.png';
                if ($row) {
                    $heartImage = $row['love'] == 1 ? 'full_heart.png' : 'empty_heart.png';
                }

                echo '<img class="like heart" src="img/ico/' . $heartImage . '" alt="image" data-user-id="' . $userId . '" data-shoe-id="' . $shoeId . '">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </main>
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

<script src="js/footwear.js"></script>
<script src="js/menu.js"></script>
<script src="js/like.js"></script>
<script src="js/rating.js"></script>

<?php
require "footer.php";
?>
