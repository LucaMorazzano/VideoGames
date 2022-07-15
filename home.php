<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Home</title>
		<style type="text/css">
				@import url("home.css");
		</style>
		
		<script>
		var i=0;
			function slideshow(){
				var img =["Slideshow/img1.jpg","Slideshow/img2.jpg","Slideshow/img3.jpg","Slideshow/img4.jpg"];
				
				document.slider.src=img[i]; /*l'elemento slider del dom avrà src l'elemento dell'array*/
				if(i<img.length-1)
					i++;
				else
					i=0;
				setTimeout(slideshow,3000);
			}
			window.onload=slideshow;
		</script>
	</head>
	
	<body>
		<div id="header">
			<img src="logo.png" height="35px" width="300px" alt="logo" />
			<ul class="navbar">
				<nobr>
				<?php
				require_once("connection.php");
				session_start();
				if(isset($_SESSION['login'])){
					echo "<li><a href=\"\">ACCOUNT</a></li>";
					echo "<li><a href=\"\">CREDITI</a></li>";
					echo "<li><a href=\"\">CARRELLO</a></li>";
				}
				?>
				<li><a href="">FAQ</a></li>
				<?php
					if(isset($_SESSION['login'])){
						echo "<li><a href=\"logout.php\">LOGOUT</a></li>";
					}
					else{
						echo "<li><a href=\"\">LOGIN</a></li></nobr>";
					}
					?>
				</nobr>
			</ul>
		</div>
		
				<div class="slideshow">
					<img name="slider" height="400px" width="1000px" alt="offerte" />
					<form action="offerte.php" method="POST" >
						<input type="submit" class="bottone_offerte" value="Scopri le nostre offerte">
					</form>
				</div>
				
				<div class="platform">
					<ul>
						<nobr><li><a href="" title="Ps4"><img src="Console/ps4.png" height="100px" width="180px" alt="console" /></a></li>
						<li><a href="" title="Pc"><img src="Console/pc.png" height="100px" width="100px" alt="console" /></a></li>
						<li><a href="" title="Xbox"><img src="Console/xbox.png" height="100px" width="100px" alt="console" /></a></li></nobr>
					</ul>
				</div>
				
				<div class="catalogo">
					
				</div>
		
		<div id="footer">
		
		</div>
	</body>


</html>