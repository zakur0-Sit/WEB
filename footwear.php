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
                    <div class="category">
                        <br>
                        <button>Category</button>
                        <form>
                            <input type="button" name="sneakers" value="Sneakers">
                            <input type="button" name="boots" value="Boots">
                            <input type="button" name="sandals" value="Sandals">
                            <input type="button" name="slippers" value="Slippers">
                            <input type="button" name="flip-flops" value="Flip-flops">
                        </form>
                    </div>

                    <div class="brand">
                        <button>Brand</button>
                        <form>
                            <input type="checkbox" name="check_brand" id="nike">
                            <label for="nike">Nike</label><br>
                            <input type="checkbox" name="check_brand" id="jordan">
                            <label for="jordan">Jordan</label><br>
                            <input type="checkbox" name="check_brand" id="adidas">
                            <label for="adidas">Adidas</label><br>
                            <input type="checkbox" name="check_brand" id="puma">
                            <label for="puma">Puma</label><br>
                            <input type="checkbox" name="check_brand" id="reebok">
                            <label for="reebok">Reebok</label><br>
                        </form>
                    </div>

                    <div class="color-form">
                        <button>Color</button>
                        <form>
                            <div class="color">
                                <input type="checkbox" name="check_color" id="red">
                                <img src="img/ico/red-drop.png" alt="ico">
                                <label for="red">Red</label><br>
                            </div>
                            <div class="color">
                                <input type="checkbox" name="check_color" id="yellow">
                                <img src="img/ico/yellow-drop.png" alt="ico">
                                <label for="yellow">Yellow</label><br>
                            </div>
                            <div class="color">
                                <input type="checkbox" name="check_color" id="green">
                                <img src="img/ico/green-drop.png" alt="ico">
                                <label for="green">Green</label><br>
                            </div>
                            <div class="color">
                                <input type="checkbox" name="check_color" id="blue">
                                <img src="img/ico/blue-drop.png" alt="ico">
                                <label for="blue">Blue</label><br>
                            </div>
                            <div class="color">
                                <input type="checkbox" name="check_color" id="black">
                                <img src="img/ico/black-drop.png" alt="ico">
                                <label for="black">Black</label><br>
                            </div>
                            <div class="color">
                                <input type="checkbox" name="check_color" id="white">
                                <img src="img/ico/white-drop.png" alt="ico">
                                <label for="white">White</label><br>
                            </div>
                        </form>
                    </div>

                    <div class="size">
                        <button>Size</button>
                        <form>
                            <input type="button" name="size-33" value="EU 33">
                            <input type="button" name="size-34" value="EU 34">
                            <input type="button" name="size-35" value="EU 35">
                            <input type="button" name="size-36" value="EU 36">
                            <input type="button" name="size-37" value="EU 37">
                            <input type="button" name="size-38" value="EU 38">
                            <input type="button" name="size-39" value="EU 39">
                            <input type="button" name="size-40" value="EU 40">
                            <input type="button" name="size-41" value="EU 41">
                            <input type="button" name="size-42" value="EU 42">
                            <input type="button" name="size-43" value="EU 43">
                            <input type="button" name="size-44" value="EU 44">
                            <input type="button" name="size-45" value="EU 45">
                        </form>
                    </div>
                    <div class="price">
                        <button>Price</button>
                        <form>
                            <output for="price-range" id="price-value">1000$</output>
                            <input type="range" id="price-range" name="price-range" min="0" max="1000" step="10" value="1000">
                        </form>
                    </div>
                    <br>
                    <button> Display</button>
                </div>
            </div>
        </div>
        <div class="container-2">
            <?php
                require_once "database.php";

                $sql = "SELECT * FROM shoes ORDER BY id DESC";
                $result = mysqli_query($connection, $sql);
                $shoes = mysqli_fetch_all($result, MYSQLI_ASSOC);

                $shoes_json = json_encode($shoes);

                foreach ($shoes as $shoe) {
                    $sqlSizes = "SELECT * FROM shoes_size WHERE id_shoes = " . intval($shoe['id']);
                    $resultSizes = mysqli_query($connection, $sqlSizes);
                    $sizes = mysqli_fetch_assoc($resultSizes);

                    if(isset($_COOKIE['user']))
                        $email = mysqli_real_escape_string($connection, $_COOKIE['user']);
                    else if(isset($_COOKIE['admin']))
                        $email = mysqli_real_escape_string($connection, $_COOKIE['admin']);
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

//                    $sqlRating = "SELECT rating FROM ratings WHERE id_shoes = " . intval($shoeId);
//                    $resultRating = mysqli_query($connection, $sqlRating);
//                    $rating = mysqli_fetch_assoc($resultRating);
//                        if($rating['rating'] === null)
//                            $averageRating = 0;
//                        else
//                            $averageRating = $rating['rating'];
//                        echo '<p class="score">' . number_format($averageRating, 1) . '/10</p>';


                    echo '<p class="score">0/10</p>';
                    echo '<img class="star" src="img/ico/star.png" alt="image">';
                    echo '</div>';

                    echo '<button class="rating-button" data-shoe-id="' . $shoeId . '" data-user-id="' . $userId . '">Rate</button>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="info-bottom">';
                    echo '<button type="button" onclick="window.location.href=\'' . htmlspecialchars($shoe['link']) . '\'">Buy now</button>';
                    echo '<div class="buttons-size">';

                    for ($size = 33; $size <= 45; $size++) {
                        if ($sizes['size_' . $size] == 1)
                            echo '<button class="size-button">EU ' .$size. '</button>';
                    }

                    echo '</div>';

                    $query = "SELECT love FROM ratings WHERE id_shoes='".$shoeId."' AND id_user='".$userId."'";

                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_assoc($result);
                    $heartImage = 'empty_heart.png';
                    if ($row)
                        $heartImage = $row['love'] == 1 ? 'full_heart.png' : 'empty_heart.png';

                    echo '<img class="like heart" src="img/ico/' .$heartImage. '" alt="image" data-user-id="' . $userId . '" data-shoe-id="' . $shoeId . '">';

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
