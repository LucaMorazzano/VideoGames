<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<style type="text/css">
			@import url(home.css)
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
				$_SESSION['login']=true;
				if(isset($_SESSION['login'])){
					echo "<li><a href=\"\">ACCOUNT</a></li>";
					echo "<li><a href=\"\">CREDITI</a></li>";
					echo "<li><a href=\"\">CARRELLO</a></li>";
				}
				?>
				<li><a href="">FAQ</a></li>
				<?php
					if(isset($_SESSION['login'])){
						echo "<li><a href=\"\">LOGOUT</a></li>";
					}
					else{
						echo "<li><a href=\"\">LOGIN</a></li></nobr>";
					}
					?>
				</nobr>
			</ul>
		</div>
		<div id="main-content"> <!-- INIZIO MAIN CONTENT -->
			<div id="left">
				
			</div>
		
			<div id="center">
			
				<div class="slideshow">
					<img name="slider" height="400px" width="1000px" alt="offerte" />
				</div>
		
				<div class="catalogo">
					
				</div>
			
			</div>
			<div id="right">
				
			</div>
		</div> <!-- FINE MAIN CONTENT -->
		
		<div id="footer">
		
		</div>
	</body>


</html>