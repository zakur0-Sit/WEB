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
                <div class="element">
                    <img src="img/footwear/1.jpg" alt="image">
                    <div class="info">
                        <p class="info-name"><strong>Nike Air Max Dn</strong></p><br>
                        <p class="info-descript">
                            Say hello to the next generation of Air technology. 
                            The Air Max Dn features our Dynamic Air unit system of 
                            dual-pressure tubes, creating a reactive sensation with every 
                            step. This results in a futuristic design that’s comfortable 
                            enough to wear from day to night. Go ahead—Feel the Unreal.
                        </p><br>
                        <p class="info-price">160$</p>
                        <button type="button" onclick="window.location.href='#'">Buy now</button>
                        <img class="like" src="img/ico/empty_heart.png" alt="image">
                    </div>
                </div>
                <div class="element">
                    <img src="img/footwear/2.png" alt="image">
                    <div class="info">
                        <p class="info-name"><strong>Jumpman MVP</strong></p><br>
                        <p class="info-descript">
                            We didn't invent the remix—but considering the material we get 
                            to sample, this one's a no-brainer. We took elements from the AJ6, 
                            7 and 8, making them into a completely new shoe that celebrates MJ's 
                            first 3-peat championship run. With leather, textile and nubuck 
                            details, these sneakers honour one legacy while encouraging you to 
                            cement your own.
                        </p><br>
                        <p class="info-price">210$</p>
                        <button type="button" onclick="window.location.href='#'">Buy now</button>
                        <img class="like" src="img/ico/empty_heart.png" alt="image">
                    </div>
                </div>
                <div class="element">
                    <img src="img/footwear/3.jpg" alt="image">
                    <div class="info">
                        <p class="info-name"><strong>Jordan Spizike Low</strong></p><br>
                        <p class="info-descript">
                            The Spizike takes elements of five classic Jordans, combines them 
                            and gives you one iconic sneaker. It's an homage to Spike Lee formally 
                            introducing Hollywood and hoops in a culture moment. You get a 
                            great-looking pair of kicks with some history. What more can you ask 
                            for? Ya dig?
                        </p><br>
                        <p class="info-price">200$</p>
                        <button type="button" onclick="window.location.href='#'">Buy now</button>
                        <img class="like" src="img/ico/empty_heart.png" alt="image">
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="js/footwear.js"></script>
    <script src="js/menu.js"></script>

<?php
    require "footer.php";
?>