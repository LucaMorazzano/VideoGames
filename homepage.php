<?xml version="1.0" encoding="UTF-8"?>
<?php 
	session_start();
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Home</title>
		<style type="text/css">
body{
	display:flex;
	flex-direction:column;
}
/*INIZIO HEADER*/

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
	font-family:Courier;
}
.navbar a:hover{
	color:red;
}
/*FINE HEADER*/
.platform{
	flex:5 5 100px;
	margin-top:6%;
}
.platform ul{
	list-style-type:none;
	margin:auto;
	border-bottom:solid red 5px;
	border-radius:20px 20px 20px 20px;
	width:70%;
}
.platform li{
	display:inline;
	padding-right:10%;
	padding-left:10%;
}
.platform a{
	opacity:60%;
}
.platform a:hover{
	opacity:100%;
}
/*INIZIO CATALOGO SECTION*/
.catalogo{
	width:100%;
	margin-top:6%;
	align-items:center;
	background-color:#1e1e1e;
	border-radius:20px 20px 20px 20px;
	color:white;
}

.catalogo .giochi{
	display:flex;
	align-items:center;
	overflow:scroll;
	padding:2%;
	padding-top:1%;
}
.giochi input{
	display:inline;
	background-color: #a61022;
	color: white;
	font-size: 15px;
	font-family:Arial;
	padding: 10px 10px;
	margin-top:10%;
	border: none;
	border-radius: 5px;
	opacity:75%;
}
.giochi input:hover{
	opacity:100%;
}
.giochi p{
	font-family:Arial;
	font-size:20px;
	color:white;
	padding:1%;
}
/*PERSONALIZZAZIONE SCROLLBAR*/
::-webkit-scrollbar{
	width:5px;
}
::-webkit-scrollbar-track {
  background: #f1f1f1;
}
::-webkit-scrollbar-thumb {
  background: #888;
}

::-webkit-scrollbar-thumb:hover {
  background: #a61022;
}
/*FINE SCROLLBAR*/
.slideshow{
	border: solid thin black;
	height:400px;
	width:70%;
	margin-top:6%;
	margin-right:auto;
	margin-left:auto;
}
.slideshow img{
	width:100%;
}
.slideshow input{
	position: absolute;
	top: 50%;
	left:40%;
	opacity:50%;
	background-color: #a61022;
	color: white;
	font-size: 20px;
	font-family:Arial;
	padding: 12px 24px;
	border: none;
	border-radius: 5px;
}
.slideshow input:hover{
	opacity:100%;
}
.catalogo h3{
	font-family:Courier;
	margin-left:15px;
	padding-top:15px;
	color:#a61022;
}
.selection{
	font-family:Arial;
	margin-left:15px;
}
.selection input{
	margin-left:10px;
	opacity:80%;
	background-color: #a61022;
	color: white;
	font-family:Arial;
	padding: 5px;
	border: none;
	border-radius: 5px;
}
.selection input:hover{
	opacity:100%;
}

/*FINE SEZIONE CATALOGO*/

#footer{}

@media all and (max-width: 800px){ /*da una disposizione in colonna mettendo in evidenza la il contenuto principale quando si riducono le dimensioni della finestra di visualizzazione*/
	#header{
		flex-direction:column;
		background-color:white;
		position:absolute;
	}
	#header img{
		border-bottom:solid black;
		border-radius:20px 20px 20px 20px;
		padding:2%;
	}
	.navbar{
		margin:auto;
		padding-top:2%;
	}
	.navbar li{
		display:flex;
		justify-content:center;
	}
	.navbar a{
		color:black;
	}
	.navbar a:hover{
		color:white;
		padding:3%;
		background-color:#a61022;
		border-radius:20px 20px 20px 20px;
	}
	.slideshow{
		margin-right:auto;
		margin-left:auto;
		margin-top:35%;
	}
	.slideshow input{
		margin-top:20%;
		margin-right:auto;
		margin-left:auto;
	}
	.platform{
		flex-direction:column;
		width:40%;
		margin-left:4%;
	}
	.platform ul{
		border:0px;
	}
	
}
		</style>
		
		<script>
		var i=0;
			function carrello(nome){
				alert(nome + "aggiunto al carrello");
			}
			function slideshow(){
				var img =["Slideshow/img1.jpg","Slideshow/img2.jpg","Slideshow/img3.jpg","Slideshow/img4.jpg"];
				
				document.slider.src=img[i]; /*l'elemento slider del dom avrà src l'elemento dell'array*/
				if(i<img.length-1)
					i++;
				else
					i=0;
				setTimeout(slideshow,3000);
			}
			window.onload=slideshow; /*metodo classe window del bom*/
		</script>
	</head>
	<body>	
		<div id="header">
			<a style="padding-left:2%" href="homepage.php"><img src="logo.png" height="35px" width="300px" alt="logo" /></a>
			<ul class="navbar">
				<nobr>
				<?php
				if(isset($_SESSION['login'])){
					require_once("connection.php");
					echo "<li><a href=\"\">ACCOUNT</a></li>";
					echo "<li><a href=\"\">CREDITI</a></li>";
					echo "<li><a href=\"carrello.php\">CARRELLO</a></li>";
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
					<form action="#offerte"> 
						<input type="submit" class="bottone_offerte" value="Scopri le nostre offerte">
					</form>
				</div>
				
				<div class="platform">
					<ul>
						<nobr><li><a href="" title="PlayStation"><img src="Console/ps4.png" height="100px" width="180px" alt="console" /></a></li>
						<li><a href="" title="Nintendo"><img src="Console/ndswitch.png" height="110px" width="110px" alt="console" /></a></li>
						<li><a href="" title="Xbox"><img src="Console/xbox.png" height="100px" width="100px" alt="console" /></a></li></nobr>
					</ul>
				</div>
				
				<a name="offerte">
				<div class="viewbar">
					
				</div>
				<div class="catalogo">
					<form action="homepage.php #offerte" method="POST" > <!-- FORM PER STABILIRE ORDINAMENTO CATALOGO -->
						<h3>MODALIT&Agrave VISUALIZZAZIONE CATALOGO:</h3>
						<p class="selection">
						Prodotti:<select name="prodotti">
							<option value="prodottidefault">tutti</option>
							<option value="videogiochi">Videogiochi</option>
							<option value="console">Console</option>
						</select>
						Prezzo: <select name="prezzo">
							<option value="prezzodefault">default</option>
							<option value="prezzocrescente">crescente</option>
							<option value="prezzodecrescente">decrescente</option>
						</select>
						Tipologia: <select name="tipologia"> <!-- tipologie definite nella dtd come attributi -->
							<option value="tipologiadefault">tutti</option>
							<option value="Action">Action</option>
							<option value="Adventure">Adventure</option>
							<option value="Sport">Sport</option>
							<option value="Arcade">Arcade</option>
							<option value="FPS">Fps</option>
							<option value="Fantasy">Fantasy</option>
						</select>
						Data di uscita: <select name="data">
							<option value="datadefault">default</option>
							<option value="datacrescente">crescente</option>
							<option value="datadecrescente">decrescente</option>
						</select>
						Piattaforma: <select name="piattaforma">
							<option value="consoledefault">tutte</option>
							<option value="PlayStation">PlayStation</option>
							<option value="Xbox">Xbox</option>
							<option value="Nintendo">Nintendo</option>
						</select>
						Ordine alfabetico: <select name="alfabeto">
							<option value="alfabetodefault">default</option>
							<option value="alfabetocrescente">crescente</option>
							<option value="alfabetodecrescente">crescente</option>
						</select>
							<input type="submit" name="viewbutton" value="mostra">
						</select></p><hr>
					</form>
				
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
						echo "<form class=\"giochi\" action=\"homepage.php\" method=\"POST\" >";
						for($i=0; $i< sizeof($elements) ; $i++){
							$gioco=$elements->item($i);
							$id=$gioco->getAttribute('id');
							$console=$gioco->getAttribute('console'); //piattaforma su cui è disponibile il gioco
							$nome= $gioco->firstChild;
							$nomevalue= $nome->textContent;
							$immagine= $nome->nextSibling;
							$immaginevalue= $immagine->textContent;
							$tipologia= $immagine->nextSibling;
							$tipologiavalue=$tipologia->getAttribute('value');
							$prezzo=$tipologia->nextSibling;
							$prezzovalue=(double)($prezzo->textContent); //casting necessario
							$data= $prezzo->nextSibling;
							//estraiamo gli attributi della data di uscita
							$giorno= $data->getAttribute('gg');
							$mese= $data->getAttribute('mm');
							$anno= $data->getAttribute('aaaa');
							if(!isset($_POST['viewbutton'])){ //condizione default
								echo"<img src=\"$immaginevalue\" height=\"170px\" width=\"150px\" alt=\"game\" /><nobr><p><strong>$nomevalue</strong></nobr> <br />$prezzovalue<img style=\"padding-left:2%\" src=\"crediti.png\" height=\"15px\" width=\"15px\" alt=\"crediti\" /><br />
									<input type=\"submit\" name=\"id\" value=\"$id\"></p>";
							}
							else{/*varie modalità visualizzazione*/
								if($_POST['prezzo']=="prezzocrescente")
									echo "prezzo";
							}
						}
						echo "</form>";
					?>
					
					<?php
					//in questo blocco php gestiremo l'aggiunta al carrello dei prodotti
					if(isset($_POST['id']) && isset($_SESSION['login'])){ //se siamo loggati e se è stato schiacciato il bottone aggiungi al carrello
						$id= $_POST['id'];
						//cerchiamo il gioco tra gli elementi del documento xml 
						for($i=0; $i<sizeof($elements);$i++){
							$gioco=$elements->item($i);
							$currid= $gioco->getAttribute('id');
							if($currid == $id){
								array_push($_SESSION['carrello'], $id); //aggiungiamo l'elemento al carrello
								echo "<script> alert(\"Elemento aggiunto al carrello\") </script>";
								break;
							}
						}
					}
					else if (isset($_POST['id']) && !isset($_SESSION['login'])){ //se abbiamo usato il bottone senza essere loggati
						echo "<script>alert(\"Azione non permessa login necessario\")</script>";
					}
					
					?>
				</div>
				</a>
		
		<div id="footer">
		</div>
	</body>


</html>