<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Home</title>
		<style type="text/css">
				@import url("homepage.css");
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
						echo "<li><a href=\"login.php\">LOGIN</a></li></nobr>";
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
					<?php
					/*estraiamo informazioni dai file xml con metodo dom*/
						$xmlString=""; //conterra il contenuto del file xml
						foreach ( file("videogiochi.xml") as $node ) {
							$xmlString .= trim($node); //attraverso la funzione trim salviamo il contenuto senza spazi vuoti
						}
						$doc=new DomDocument(); //inizializziamo il documento
						//estraiamo i videogiochi e salviamo le informazioni nelle variabili
						$doc->loadXML($xmlString);
						$root = $doc->documentElement;
						$elements = $root->childNodes;
						//stampiamo a schermo i videogiochi estraendo le informazioni necessarie
						for($i=0; $i< sizeof($elements) ; $i++){
							$gioco=$elements->item($i);
							$id=$gioco->getAttribute('id');
							$console=$gioco->getAttribute('console'); //piattaforma su cui è disponibile il gioco
							$nome= $gioco->nextSibling;
							$nomevalue= $nome->textContent;
							$immagine= $nome->nextSibling;
							$immaginevalue= $immagine->textContent;
							$tipologia= $immagine->nextSibling;
							$tipologiavalue=$tipologia->textContent;
							$prezzo=$tipologia->nextSibling;
							$prezzovalue=(double)($prezzo->textContent); //casting necessario
							$data= $prezzo->nextSibling;
							//estraiamo gli attributi della data di uscita
							$giorno= $data->getAttribute('gg');
							$mese= $data->getAttribute('mm');
							$anno= $data->getAttribute('aaaa');
						}
						
					?>
				</div>
		
		<div id="footer">
		
		</div>
	</body>


</html>