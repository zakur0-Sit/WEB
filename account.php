<?php
    $title = "Account";
    $css = "css/account.css";
    require "header.php";
?>

    <div class="account">
        <main>
            <div class="container-1">
                <h3>Favorite</h3>

                <div class="element element-1">
                    <h3>Air Jordan 1 Mid SE</h3>
                    <hr>
                    <div class="model">
                        <img src="img/account/3.png" alt="img footwear">
                        <div class="info-model">
                            <p>Play like '85.The Air Jordan 1 Mid SE brings fresh details and premium comfort to 
                                an iconic shoe.Its encapsulated Air-Sole unit cushions your foot, while the padded 
                                collar gives you a supportive feel on the move.</p><br>
                            <p class="price">200$</p>
                            <button>Buy now</button>
                        </div>   
                    </div>
                </div>
                <br>
                <div class="element element-2">
                    <h3>Nike Free Metcon 3</h3>
                    <hr>
                    <div class="model">
                        <img src="img/account/2.png" alt="img footwear">
                        <div class="info-model">
                            <br>
                            <p class="suplimentar">The Nike Free Metcon 3 combines the flexibility of a Nike Free 
                                sole with the flat, wide heel of the Metcon to keep you fast but stable on your feet 
                                from weightlifting to speed drills.</p><br>
                            <p class="price">150$</p>
                            <button>Buy now</button>
                        </div>
                    </div>
                </div>
                <div class="container">

                </div>
            </div>
            <div class="container-2">
                <img class="account-image" src="img/account/account-image.jpg" alt="profile image"><br>
                <p class="name">Zakur0</p><br>
                <div class="other">
                    <h4 class="size">Size : <i>EU 41</i></h4>
                    <h4 id="fav-color">Favorite color : <i>White, Black</i></h4>
                </div>
            </div>
        </main>
    </div>
    <script src="js/menu.js"></script>

<?php
    require "footer.php";
?>