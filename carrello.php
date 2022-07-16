<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Carrello</title>
		<style type="text/css">
		#header{
	display:flex;
	background-color:#1e1e1e;
	border-radius: 20px 20px 20px 20px;
	justify-content:space-between;
	align-items:center;
	/*impostiamo menu fisso*/
	width:99%;
	position:fixed;
	margin:auto;
}
.navbar{
	list-style-type:none;
	margin-right:15%;
}
.navbar a{
	text-decoration:none;
	color:white;
}
.navbar li{
	display:inline; /*disposizione orizzontale della lista*/
	padding-right:10%;
	color:white;
	font-size:25px;
	font-family:"Courier";
}
.navbar a:hover{
	color:red;
}
/*FINE HEADER*/
#carrello{
	margin-left:auto;
	margin-right:auto;
}
</style>
	</head>
	
	<body>
		<?php
			session_start();
			if(isset($_SESSION['login'])){ //se siamo loggati
				require_once("connection.php");
		?>
		<div id="header">
			<a style="padding-left:2%" href="homepage.php"><img src="logo.png" height="35px" width="300px" alt="logo" /></a>
			<ul class="navbar">
				<nobr>
					<li><a href="">ACCOUNT</a></li>";
					<li><a href="">CREDITI</a></li>";
					<li><a href="carrello.php">CARRELLO</a></li>";
					<li><a href="">FAQ</a></li>
					<li><a href="logout.php">LOGOUT</a></li>";
				</nobr>
			</ul>
		</div>
		<div id="carrello">
			<?php
				$carrello=$_SESSION['carrello'];
				for($i=0;$i<sizeof($carrello); $i++){
					//estraiamo informazioni su elementi presenti nel carrello
					$nome=$carrello[$i]->firstChild;
					$nomevalue=$nome->textContent;
				}
			
			?>
		
		</div>
		<?php
			} /*FINE IF ISSET LOGIN*/
			else{ //se non siamo loggati ( e quindi non proveniamo da una form)
				echo "<h1 style=\"font-size:40px; font-family:Arial\">FORBIDDEN</h1>";
			}
		?>
	
	</body>
	
	
</html>