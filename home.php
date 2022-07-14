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
			function slideshow(){
				var img =["slideshow\img1.jpg","slideshow\img2.jpg"];
				var arr= ['1','2','3','4'];
				var i=0; var time=0;
						document.write(arr[i]);
						
						i++;
						time=0;
				
			}
		</script>
	</head>
	
	<body>
		<div id="header">
			<img src="logo.png" height="35px" width="300px" alt="logo">
			<ul class="navbar">
				<li><a href="">ACCOUNT<a href=""></li>
				<li><a href="">FAQ</a></li>
				<li><a href="">CREDITI</a></li>
				<li><a href="">CARRELLO</a></li>
			</ul>
		</div>
		
		<div id="main-content"> <!-- INIZIO MAIN CONTENT -->
			<div id="left">
		
			</div>
		
			<div id="center">
			
				<div class="slideshow">
					<script>
						slideshow();
					</script>
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