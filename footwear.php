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
                        <style>
                            .checked {
                                background-color: #FF9900;
                            }

                            .unchecked {
                                background-color: transparent;
                                border: none;
                            }

                            .checked-color {
                                border: solid 2px #FF9900;
                                border-radius: 20px;
                            }
                        </style>
                        <div class="category">
                            <br>
                            <p id="toggle-category">Category</p>
                            <div class="categories">
                                <input type="checkbox" name="category[]" value="sneakers" id="sneakers" onclick="checkFunction()">
                                <label id="sneakers-label" for="sneakers">Sneakers</label>
                                <input type="checkbox" name="category[]" value="boots" id="boots" onclick="checkFunction()">
                                <label id="boots-label" for="boots">Boots</label>
                                <input type="checkbox" name="category[]" value="sandals" id="sandals" onclick="checkFunction()">
                                <label id="sandals-label" for="sandals">Sandals</label>
                                <input type="checkbox" name="category[]" value="slippers" id="slippers" onclick="checkFunction()">
                                <label id="slippers-label" for="slippers">Slippers</label>
                                <input type="checkbox" name="category[]" value="flip-flops" id="flip-flops" onclick="checkFunction()">
                                <label id="flip-flops-label" for="flip-flops">Flip-flops</label>
                            </div>
                        </div>

                        <div class="brand">
                            <p id="toggle-brand">Brand</p>
                            <div class="brands">
                                <input type="checkbox" name="brand[]" id="nike" value="nike" onclick="checkFunction()">
                                <label id="nike-label" for="nike">Nike</label>
                                <input type="checkbox" name="brand[]" id="jordan" value="jordan" onclick="checkFunction()">
                                <label id="jordan-label" for="jordan">Jordan</label>
                                <input type="checkbox" name="brand[]" id="adidas" value="adidas" onclick="checkFunction()">
                                <label id="adidas-label" for="adidas">Adidas</label>
                                <input type="checkbox" name="brand[]" id="puma" value="puma" onclick="checkFunction()">
                                <label id="puma-label" for="puma">Puma</label>
                                <input type="checkbox" name="brand[]" id="reebok" value="reebok" onclick="checkFunction()">
                                <label id="reebok-label" for="reebok">Reebok</label>
                            </div>
                        </div>

                        <div class="colors">
                            <p id="toggle-color">Color</p>
                            <div class="colors-container">
                                <div class="color" id="red-div" onclick="checkColorFunction('red')">
                                    <input type="checkbox" name="color[]" id="red" value="red">
                                    <img src="img/ico/red-drop.png" alt="ico">
                                    <label for="red">Red</label><br>
                                </div>
                                <div class="color" id="yellow-div" onclick="checkColorFunction('yellow')">
                                    <input type="checkbox" name="color[]" id="yellow" value="yellow">
                                    <img src="img/ico/yellow-drop.png" alt="ico">
                                    <label for="yellow">Yellow</label><br>
                                </div>
                                <div class="color" id="green-div" onclick="checkColorFunction('green')">
                                    <input type="checkbox" name="color[]" id="green" value="green">
                                    <img src="img/ico/green-drop.png" alt="ico">
                                    <label for="green">Green</label><br>
                                </div>
                                <div class="color" id="blue-div" onclick="checkColorFunction('blue')">
                                    <input type="checkbox" name="color[]" id="blue" value="blue">
                                    <img src="img/ico/blue-drop.png" alt="ico">
                                    <label for="blue">Blue</label><br>
                                </div>
                                <div class="color" id="black-div" onclick="checkColorFunction('black')">
                                    <input type="checkbox" name="color[]" id="black" value="black">
                                    <img src="img/ico/black-drop.png" alt="ico">
                                    <label for="black">Black</label><br>
                                </div>
                                <div class="color" id="white-div" onclick="checkColorFunction('white')">
                                    <input type="checkbox" name="color[]" id="white" value="white">
                                    <img src="img/ico/white-drop.png" alt="ico">
                                    <label for="white">White</label><br>
                                </div>
                            </div>
                        </div>

                        <div class="size">
                            <p id="toggle-size">Size</p>
                            <div class="sizes">
                                <input type="checkbox" name="size[]" value="size_33" id="size-33" onclick="checkFunction()">
                                <label id="33-label" for="size-33">EU 33</label>
                                <input type="checkbox" name="size[]" value="size_34" id="size-34" onclick="checkFunction()">
                                <label id="34-label" for="size-34">EU 34</label>
                                <input type="checkbox" name="size[]" value="size_35" id="size-35" onclick="checkFunction()">
                                <label id="35-label" for="size-35">EU 35</label>
                                <input type="checkbox" name="size[]" value="size_36" id="size-36" onclick="checkFunction()">
                                <label id="36-label" for="size-36">EU 36</label>
                                <input type="checkbox" name="size[]" value="size_37" id="size-37" onclick="checkFunction()">
                                <label id="37-label" for="size-37">EU 37</label>
                                <input type="checkbox" name="size[]" value="size_38" id="size-38" onclick="checkFunction()">
                                <label id="38-label" for="size-38">EU 38</label>
                                <input type="checkbox" name="size[]" value="size_39" id="size-39" onclick="checkFunction()">
                                <label id="39-label" for="size-39">EU 39</label>
                                <input type="checkbox" name="size[]" value="size_40" id="size-40" onclick="checkFunction()">
                                <label id="40-label" for="size-40">EU 40</label>
                                <input type="checkbox" name="size[]" value="size_41" id="size-41" onclick="checkFunction()">
                                <label id="41-label" for="size-41">EU 41</label>
                                <input type="checkbox" name="size[]" value="size_42" id="size-42" onclick="checkFunction()">
                                <label id="42-label" for="size-42">EU 42</label>
                                <input type="checkbox" name="size[]" value="size_43" id="size-43" onclick="checkFunction()">
                                <label id="43-label" for="size-43">EU 43</label>
                                <input type="checkbox" name="size[]" value="size_44" id="size-44" onclick="checkFunction()">
                                <label id="44-label" for="size-44">EU 44</label>
                                <input type="checkbox" name="size[]" value="size_45" id="size-45" onclick="checkFunction()">
                                <label id="45-label" for="size-45">EU 45</label>
                            </div>
                        </div>

                        <div class="price">
                            <p id="toggle-price">Price</p>
                            <div class="prices">
                                <input type="range" id="price-range" name="price-range" min="0" max="1000" step="10" value="1000">
                                <output for="price-range" id="price-value">1000$</output>
                            </div>
                        </div><br>

                        <button type="submit" id="filter-button">Display</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-2">
            <?php
                require_once "database.php";
                require_once "filters.php";
                require_once "product_select.php";
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

<div id="edit-product-popup" style="display: none;">
    <form id="edit-product-form" method="post" action="update_product.php">
        <input type="hidden" id="edit-product-id" name="product_id">

        <label for="product-name">Product Name:</label>
        <input type="text" id="product-name" name="product_name"><br>

        <label for="product-description">Product Description:</label>
        <input type="text" id="product-description" name="product_description"><br>

        <label for="product-price">Product Price:</label>
        <input type="text" id="product-price" name="product_price"><br>

        <label for="shoe-sizes">Available Sizes:</label>
        <div id="shoe-sizes" class="size-checkbox">
            <input type="checkbox" id="size-33" name="shoe_sizes[]" value="33">
            <label for="size-33">EU 33</label>

            <input type="checkbox" id="size-34" name="shoe_sizes[]" value="34">
            <label for="size-34">EU 34</label>

            <input type="checkbox" id="size-35" name="shoe_sizes[]" value="35">
            <label for="size-35">EU 35</label>

            <input type="checkbox" id="size-36" name="shoe_sizes[]" value="36">
            <label for="size-36">EU 36</label>

            <input type="checkbox" id="size-37" name="shoe_sizes[]" value="37">
            <label for="size-37">EU 37</label>

            <input type="checkbox" id="size-38" name="shoe_sizes[]" value="38">
            <label for="size-38">EU 38</label>

            <input type="checkbox" id="size-39" name="shoe_sizes[]" value="39">
            <label for="size-39">EU 39</label>

            <input type="checkbox" id="size-40" name="shoe_sizes[]" value="40">
            <label for="size-40">EU 40</label>

            <input type="checkbox" id="size-41" name="shoe_sizes[]" value="41">
            <label for="size-41">EU 41</label>

            <input type="checkbox" id="size-42" name="shoe_sizes[]" value="42">
            <label for="size-42">EU 42</label>

            <input type="checkbox" id="size-43" name="shoe_sizes[]" value="43">
            <label for="size-43">EU 43</label>

            <input type="checkbox" id="size-44" name="shoe_sizes[]" value="44">
            <label for="size-44">EU 44</label>

            <input type="checkbox" id="size-45" name="shoe_sizes[]" value="45">
            <label for="size-45">EU 45</label>
        </div>
        <input type="submit" value="Save">
    </form>
</div>
<div id="popup-background" style="display: none;"></div>

<form id="delete-form" method="post" action="delete_shoe.php" style="display: none;">
    <input type="hidden" name="shoe_id" id="delete-shoe-id">
</form>

<script src="js/footwear.js"></script>
<script src="js/menu.js"></script>
<script src="js/like.js"></script>
<script src="js/rating.js"></script>

<script>
function deleteShoe(shoeId) {
    document.getElementById('delete-shoe-id').value = shoeId;
    document.getElementById('delete-form').submit();
}

document.addEventListener('DOMContentLoaded', function() {
    const infoIcons = document.querySelectorAll('.info-icon');
    infoIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productDescription = this.getAttribute('data-product-description');
            const productPrice = this.getAttribute('data-product-price');
            const productSizes = JSON.parse(this.getAttribute('data-product-sizes'));

            document.getElementById('edit-product-id').value = productId;
            document.getElementById('product-name').value = productName;
            document.getElementById('product-description').value = productDescription;
            document.getElementById('product-price').value = productPrice;

            // Reset sizes select options
            document.querySelectorAll('#shoe-sizes option').forEach(option => {
                option.selected = productSizes.includes(parseInt(option.value));
            });

            document.getElementById('edit-product-popup').style.display = 'block';
            document.getElementById('popup-background').style.display = 'block';
        });
    });

    document.getElementById('popup-background').addEventListener('click', function() {
        document.getElementById('edit-product-popup').style.display = 'none';
        this.style.display = 'none';
    });
});
</script>

<?php
require "footer.php";
?>
