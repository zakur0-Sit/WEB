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
                            <input type="checkbox" name="check" id="nike">
                            <label for="nike">Nike</label><br>
                            <input type="checkbox" name="check" id="jordan">
                            <label for="jordan">Jordan</label><br>
                            <input type="checkbox" name="check" id="adidas">
                            <label for="adidas">Adidas</label><br>
                            <input type="checkbox" name="check" id="puma">
                            <label for="puma">Puma</label><br>
                            <input type="checkbox" name="check" id="reebok">
                            <label for="reebok">Reebok</label><br>
                        </form>
                    </div>
                    
                    <div class="size">
                        <button>Size</button>
                        <form>
                            <input type="button" name="size-36" value="EU 36">
                            <input type="button" name="size-37" value="EU 37">
                            <input type="button" name="size-38" value="EU 38">
                            <input type="button" name="size-39" value="EU 39">
                            <input type="button" name="size-40" value="EU 40">
                            <input type="button" name="size-41" value="EU 41">
                            <input type="button" name="size-42" value="EU 42">
                            <input type="button" name="size-43" value="EU 43">
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
                </div>
            </div>
        </div>
        <div class="container-2">
            <?php
                require_once "database.php";

                // Interogarea bazei de date pentru a obține toate perechile de încălțăminte
                $sql = "SELECT * FROM shoes ORDER BY id ASC";
                $result = mysqli_query($connection, $sql);
                $shoes = mysqli_fetch_all($result, MYSQLI_ASSOC);

                // Convert the result to JSON format to pass to JavaScript
                $shoes_json = json_encode($shoes);
            ?>
            

            <?php
                foreach ($shoes as $shoe) {
                    echo '<div class="element">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($shoe['image']) . '" alt="image">';
                    echo '<div class="info">';
                    echo '<p class="info-name"><strong>' . htmlspecialchars($shoe['name_shoes']) . '</strong></p><br>';
                    echo '<p class="info-descript">' . nl2br(htmlspecialchars($shoe['description'])) . '</p><br>';
                    echo '<p class="info-price">' . htmlspecialchars($shoe['price']) . '$</p>';
                    echo '<button type="button" onclick="window.location.href=\'#\'">Buy now</button>';
                    echo '<button class="size-button">33</button>';
                    echo '<button class="size-button">35</button>';
                    echo '<button class="size-button">40</button>';
                    echo '<button class="size-button">45</button>';
                    echo '<div class="size-buttons">';
                
                    echo '</div>';
                    echo '<img class="like heart" src="img/ico/empty_heart.png" alt="image" style="like:hover ">';
                    echo '</div>';

                    echo '<div class="rating-container" style="position: relative; top: -100px; right: 10px; display: flex;" >';
                    echo '<p class="score">8.5/10</p>';
                    echo '<button class="rating-button">Rating</button>';
                    echo '</div>';
                    echo '</div>';
                }                               
            ?>

                            
        </div>
    </main>
</div>
<script src="js/footwear.js"></script>
<script src="js/menu.js"></script>

<<script>
document.querySelectorAll('.heart').forEach(function(heart) {
    heart.addEventListener('click', function() {
        if (this.src.endsWith('empty_heart.png')) {
            this.src = 'img/ico/full_heart.png';
        } else {
            this.src = 'img/ico/empty_heart.png';
        }
    });
});
</script>

<?php
    require "footer.php";
?>
