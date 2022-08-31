<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Carrello</title>
		<style type="text/css">
body{
	display:flex;
	flex-direction:column;
}
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
	margin-top:6%;
	margin-left:auto;
	margin-right:auto;
}
.giochi{
	display:flex;
	align-items:center;
	overflow:scroll;
	background-color:#1e1e1e;
	padding:2%;
	border-radius:20px 20px 20px 20px;
}
.giochi p{
	font-family:Arial;
	font-size:20px;
	color:white;
	padding:1%;
}

.giochi p input{
	background-color: #a61022;
	color: white;
	font-size: 15px;
	font-family:Arial;
	padding: 10px 10px;
	border: none;
	border-radius: 5px;
	opacity:75%;
}
.giochi p input:hover{
	opacity:100%;
}
</style>
	</head>
	
	<body>
		<?php
			session_start();
			if(isset($_SESSION['login'])){ //se siamo loggati
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
				$xmlString="";
				foreach ( file("videogiochi.xml") as $node ) {
						$xmlString .= trim($node); //attraverso la funzione trim salviamo il contenuto senza spazi vuoti
				}
				$doc=new DomDocument(); //inizializziamo il documento
				//estraiamo i videogiochi e salviamo le informazioni nelle variabil
				$doc->loadXML($xmlString);
				$root = $doc->documentElement;
				$elements = $root->childNodes;
				
				echo "<form class=\"giochi\" action=\"carrello.php\" method=\"POST\">";
				foreach($_SESSION['carrello'] as $id){
					//cerchiamo ora nel file xml i telefoni aventi tali id
					for($i=0; $i<sizeof($elements); $i++){
						$gioco=$elements->item($i);
						$currid=$gioco->getAttribute('id');
						if($currid == $id){ // se l'id combacia allora estraiamo e stampiamo
							$nome=$gioco->firstChild;
							$nomevalue=$nome->textContent;
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
							echo"<img src=\"$immaginevalue\" height=\"170px\" width=\"150px\" alt=\"game\" /><p><nobr><strong>$nomevalue</strong></nobr> <br />$prezzovalue<img style=\"padding-left:2%\" src=\"crediti.png\" height=\"15px\" width=\"15px\" alt=\"crediti\" /><br />
									<input type=\"submit\" name=\"id\" value=\"Rimuovi\"></p>";			
						}
					}
				}
				echo "</form>";
			
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