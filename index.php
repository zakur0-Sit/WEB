<?php
    $title = "FoSA";
    $css = "css/style.css";
    require "header.php";
?>
	<div class="home">
		<div class="video-container">
			<p>FoSA</p>
			<video id="parallax-video" autoplay muted loop>
				<source src="img/home/video-cut.mp4" type="video/mp4">
				Your browser does not support the video tag.
			</video>
		</div>

		<div class="words-about">
			<p class="words">Enter the world of smart footwear assistant with FoSA! Discover a new and exciting experience in finding the right shoes for every moment of your life. 
				Every step you take with FoSA is a step towards
				 your style and confidence!
			</p><br><br>
			<div class="from">
				<img src="img/ico/logo.png" alt="logo" class="logo">
				<p>FoSA Team</p>
			</div>
		</div>
		
		<div class="container-1">
			<div class="card">
				<img src="img/home/1.jpg" alt="Special For You">
				<div class="overlay">
					<span class="text">Trending</span>
				</div>
			</div>
			<div class="card">
				<img src="img/home/2.jpg" alt="Trending">
				<div class="overlay">
					<span class="text">Best For Season</span>
				</div>
			</div>
			<div class="card">
				<img src="img/home/3.jpg" alt="Best For Season">
				<div class="overlay">
					<span class="text">New Collection</span>
				</div>
			</div>
			<div class="card">
				<img src="img/home/4.jpg" alt="New Collection">
				<div class="overlay">
					<span class="text">Special For You</span>
				</div>
			</div>
		</div>
		
	</div>


    <script src="js/menu.js"></script>
    <script src="js/home.js"></script>

<?php
    require "footer.php";
?>
