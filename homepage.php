<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	session_start();
?>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	
	<head>
		<title>Home</title>
		<style>
			@import url("stile1.css");
		</style>
		<script>
		var i=0;
		//VARIABILI PER FILTRO CATALOGO
		var conta_prodotti=0;
		var conta_ordinamento=0;
		var conta_tipologia=0;
		var conta_piattaforma=0;
		//funzioni per filtro catalogo 
			function filtro_prodotti(prod){
				if(prod.checked){
					conta_prodotti++;
					if(conta_prodotti>1){
						alert("Operazione non consentita è possibile esprimere un'unica preferenza per ogni categoria");
						prod.checked=false;
						conta_prodotti--;
					}
				}
				else{
					if(conta_prodotti>0){
						conta_prodotti--;
						prod.checked=false;
					}
				}
			}
			function filtro_ordinamento(prod){
				if(prod.checked){
					conta_ordinamento++;
					if(conta_ordinamento>1){
						alert("Operazione non consentita è possibile esprimere un'unica preferenza per ogni categoria");
						prod.checked=false;
						conta_ordinamento--;
					}
				}
				else{
					if(conta_ordinamento>0){
						conta_ordinamento--;
						prod.checked=false;
					}
				}
			}
			function filtro_tipologia(prod){
				if(prod.checked){
					conta_tipologia++;
					if(conta_tipologia>1){
						alert("Operazione non consentita è possibile esprimere un'unica preferenza per ogni categoria");
						prod.checked=false;
						conta_tipologia--;
					}
				}
				else{
					if(conta_tipologia>0){
						conta_tipologia--;
						prod.checked=false;
					}
				}
			}
			function filtro_piattaforma(prod){
				if(prod.checked){
					conta_piattaforma++;
					if(conta_piattaforma>1){
						alert("Operazione non consentita è possibile esprimere un'unica preferenza per ogni categoria");
						prod.checked=false;
						conta_piattaforma--;
					}
				}
				else{
					if(conta_piattaforma>0){
						conta_piattaforma--;
						prod.checked=false;
					}
				}
			}
			//Slideshow
			function slideshow(){
				var img =["Slideshow/img1.jpg","Slideshow/img2.jpg","Slideshow/img3.jpg","Slideshow/img4.jpg"];
				
				document.slider.src=img[i]; /*l'elemento slider del dom avrà src l'elemento dell'array*/
				if(i<img.length-1)
					i++;
				else
					i=0;
				setTimeout(slideshow,3000);
			}
			//Validatori form
			function formrecensioni(boleano){ // se la recensione è vuota evitiamo di inviare la form al server
					var textarea= document.forms['form_recensioni']['nuovarecensione'].value;
					if(textarea == ""){
						alert("Scrivere la recensione prima di inviarla");
						return false;
					}
					else return true;
			}
			//funzione per bottone carrello
			function responsivebutton(button){
				button.value="ok";
				return;
			}
			window.onload=slideshow; /*metodo classe window del bom*/
		</script>
		<!-- ESTRAZIONE ELEMENTI ROOT DAI VARI DOCUMENTI XML -->
		<?php
		/*estraiamo informazioni dai file xml con metodo dom*/
		//VIDEOGIOCHI.XML
						$xmlString_videogiochi=""; //conterra il contenuto del file xml
						foreach ( file("videogiochi.xml") as $node_videogiochi ) {
							$xmlString_videogiochi .= trim($node_videogiochi); //attraverso la funzione trim salviamo il contenuto senza spazi vuoti
						}
						$doc_videogiochi=new DomDocument(); //inizializziamo il documento
						//estraiamo i videogiochi e salviamo le informazioni nelle variabili
						$doc_videogiochi->loadXML($xmlString_videogiochi);
						$root_videogiochi = $doc_videogiochi->documentElement;
						$videogiochi_elements = $root_videogiochi->childNodes;	
		//RECENSIONI.XML
						$xmlString_recensioni=""; //conterra il contenuto del file xml
						foreach ( file("recensioni.xml") as $node_recensioni ) {
							$xmlString_recensioni .= trim($node_recensioni); //attraverso la funzione trim salviamo il contenuto senza spazi vuoti
						}
						$doc_recensioni=new DomDocument(); //inizializziamo il documento
						//estraiamo i videogiochi e salviamo le informazioni nelle variabili
						$doc_recensioni->loadXML($xmlString_recensioni);
						$root_recensioni = $doc_recensioni->documentElement;
						$recensioni_elements = $root_recensioni->childNodes;	
		//PIATTAFORME.XML
					$xmlString_piattaforme=""; //conterra il contenuto del file xml
						foreach ( file("piattaforme.xml") as $node_piattaforme ) {
							$xmlString_piattaforme .= trim($node_piattaforme); //attraverso la funzione trim salviamo il contenuto senza spazi vuoti
						}
						$doc_piattaforme=new DomDocument(); //inizializziamo il documento
						//estraiamo i videogiochi e salviamo le informazioni nelle variabili
						$doc_piattaforme->loadXML($xmlString_piattaforme);
						$root_piattaforme = $doc_piattaforme->documentElement;
						$piattaforme_elements = $root_piattaforme->childNodes;		
		?>
	</head>
	
	<body>
		<div id="header"> <!-- Sezione che contiene il menu di navigazione del sito -->
			<a style="padding-left:2%" href="homepage.php"><img src="logo.png" height="35px" width="300px" alt="logo" /></a>
			<ul class="navbar">
				<nobr>
				<?php
				if(isset($_SESSION['login'])){
					require_once("connection.php");
					echo "<li><a href=\"account.php\">ACCOUNT</a></li>";
					echo "<li><a href=\"crediti.php\">CREDITI</a></li>";
					echo "<li><a href=\"carrello.php\">CARRELLO</a></li>";
				}
				?>
				<li><a href="faq.php">FAQ</a></li>
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
		
		<div class="main">
			<div id="left"> <!-- Sezione che contiene un menu per modificare la visualizzazione del catalogo -->
			<form action="homepage.php" method="POST" class="filtra">
				<h3>FILTRA PER</h3><hr>
				<p class="filtri_prodotti">
					<input type="checkbox" name="videogiochi" onclick="filtro_prodotti(this)">
					<label for="videogiochi">Videogiochi</label><br />
					<input type="checkbox" name="console" onclick="filtro_prodotti(this)">
					<label for="console">Console</label><br />
				</p>
				<p class="filtri_ordinamento">
					<span style="color:red;"><strong>Ordinamento:</strong></span><br />
						<input type="checkbox" name="prezzo" onclick="filtro_ordinamento(this)">
						<label for="prezzo">Prezzo</label><br />
						<input type="checkbox" name="alfabeto" onclick="filtro_ordinamento(this)">
						<label for="alfabeto">Ordine alfabetico</label><br />
						<input type="checkbox" id="data" onclick="filtro_ordinamento(this)">
						<label for="data">Anno di uscita</label><br />
				</p>
				<p class="filtri_tipologia">
					<span style="color:red;"><strong>Tipologia:</strong></span><br />
						<input type="checkbox" name="action" onclick="filtro_tipologia(this)">
						<label for="action">Action</label><br />
						<input type="checkbox" name="adventure" onclick="filtro_tipologia(this)">
						<label for="adventure">Adventure</label><br />
						<input type="checkbox" name="sport" onclick="filtro_tipologia(this)">
						<label for="sport">Sport</label><br />
						<input type="checkbox" name="arcade" onclick="filtro_tipologia(this)">
						<label for="arcade">Arcade</label><br />
						<input type="checkbox" name="fps" onclick="filtro_tipologia(this)">
						<label for="fps">Fps</label><br />
						<input type="checkbox" name="fantasy" onclick="filtro_tipologia(this)">
						<label for="fantasy">Fantasy</label><br />
				</p>
				<p class="filtri_piattaforma">
				<span style="color:red;"><strong>Piattaforma:</strong></span><br />
					<input type="checkbox" name="PlayStation" onclick="filtro_piattaforma(this)">
					<label for="PlayStation">PlayStation</label><br />
					<input type="checkbox" name="Xbox" onclick="filtro_piattaforma(this)">
					<label for="Xbox">Xbox</label><br />
					<input type="checkbox" name="Nintendo" onclick="filtro_piattaforma(this)">
					<label for="Nintendo">Nintendo</label><br />
				</p>
				<input class="bottone_carrello" type="submit" name="bottone_filtri" value="Filtra" >
			</form>
			</div>
		
		
			<div id="center"> <!-- Sezione che contiene il catalogo dei prodotti -->
				<?php
					$contatore_table=0; //contatore per modalità stampa a schermo catalogo
						//stampiamo a schermo i videogiochi estraendo le informazioni necessarie
						echo "<form name=\"catalogo\" class=\"catalogo\" action=\"homepage.php\" method=\"POST\" >";
						echo "<table border=\"0px\" cellspacing=\"30px\" ><tr>";
						for($i=0; $i< sizeof($videogiochi_elements) ; $i++){
							///////////ESTRAZIONE VIDEOGIOCHI//////////////////
							$gioco=$videogiochi_elements->item($i);
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
							if(!isset($_POST['bottone_filtri'])){ //visualizzazione default
							//FAREMO STAMPA ATTRAVERSO UNA TABELLA 2X2 CON CONTROLLO SU UN CONTATORE
								if($contatore_table<4){
									echo"<td><img src=\"$immaginevalue\" height=\"170px\" width=\"150px\" alt=\"game\" /><nobr><p><strong>$nomevalue</strong><a href=\"infogiochi.php\" title=\"vedi informazioni\"><img style=\"padding-left:2%\" src=\"info.png\" height=\"15px\" width=\"15px\" alt=\"info\" title=\"vedi informazioni\" /></a></nobr> <br />$prezzovalue<img style=\"padding-left:2%\" src=\"crediti.png\" height=\"15px\" width=\"15px\" alt=\"crediti\" /><br />
										<input class=\"bottone_carrello\" type=\"submit\" name=\"bottone\" value=\"Aggiungi al carrello\" onclick=\"responsivebutton(this)\"></p></td>";
									$contatore_table++;
								}
								else{
									echo "</tr><tr><td><img src=\"$immaginevalue\" height=\"170px\" width=\"150px\" alt=\"game\" /><nobr><p><strong>$nomevalue</strong><a href=\"infogiochi.php\" title=\"vedi informazioni\"><img style=\"padding-left:2%\" src=\"info.png\" height=\"15px\" width=\"15px\" alt=\"info\"/></a></nobr> <br />$prezzovalue<img style=\"padding-left:2%\" src=\"crediti.png\" height=\"15px\" width=\"15px\" alt=\"crediti\" /><br />
										<input class=\"bottone_carrello\" type=\"submit\" name=\"bottone\" value=\"Aggiungi al carrello\" onclick=\"responsivebutton(this)\"></p></td>";
									$contatore_table=1;
								}
							}
							else{ //vari casi per visualizzazione catalogo
								echo "mod stampa";
							}
						}
						echo "</tr></table>"
				?>
			</div>
		
			<div id="right"> <!-- Sezione che contiene lo slideshow di alcune immagini (funzione prettamente estetica) -->
				<form action= "offerte.php" method="POST" > <!-- rimanderà l'utente in una pagina contente tutti i prodotti in offerta -->
					<img name="slider" height="720px" width="300px" alt="slideshow" />
					<input type="submit" name="bottoneofferte" class="bottoneofferte" value="Scopri le nostre offerte" >
				</form>
			</div>
		
		</div>
		
		<!-- FOOTER SECTION -->
		<h3 class="footer_title">DICONO DI NOI</h3>
		<div id="footer"> <!-- Sezione che contiene le recensioni dei clienti ( dicono di noi ... ) oltre che contatti e informazioni sulla sede -->
		<?php
		if(isset($_SESSION['login'])){ //possiamo scrivere una recensione solo se siamo loggati
			echo'
			<form name="form_recensioni" class="form_recensioni" action="recensione.php" method="POST" onsubmit="return formrecensioni()" >
				<h4>La tua opinione &egrave importante, proprio per questo abbiamo riservato un area testuale per te al fine di conoscerla: </h4>
				<img src="stella.png" height="10px" width="10px" alt="not found" /><select name="nuovavalutazione">
					<option value="5">5</option>
					<option value="4">4</option>
					<option value="3">3</option>
					<option value="2">2</option>
					<option value="1">1</option>
				</select><br />
				<textarea name="nuovarecensione"></textarea><br />
				<input type="submit" name="bottone_recensione" value="invia">
			</form>';
		}
		?>
			<div class="boxrecensioni">
			<?php
			/*stampiamo le recensioni estraendo le info dal doc xml*/
			$conta_stelle=0;
			for($i=0; $i< sizeof($recensioni_elements); $i++){
				$recensione=$recensioni_elements->item($i);
				$rec_username=$recensione->firstChild;
				$rec_username_value=$rec_username->textContent;
				$rec_valutazione=$rec_username->nextSibling;
				$rec_valutazione_value=(int)($rec_valutazione->textContent);
				$rec_testo= $recensione->lastChild;
				$rec_testo_value=$rec_testo->textContent;
				echo "<p class=\"recensione\"><nobr>";
				while($conta_stelle<$rec_valutazione_value){//stampiamo la valutazione sotto forma di immagini iterate
					echo"<img src=\"stella.png\" height=\"20px\" width=\"20px\" alt=\"not found\" />";
					$conta_stelle++;
				}
				echo "</nobr>";
				echo "<br /><strong>$rec_testo_value</strong><br /><span style=\"font-family:Courier; font-size:12px\">Recensione di $rec_username_value</span></p>"; 
				$conta_stelle=0;//reinizializziamo il contatore
			}
			if(isset($_POST['bottone'])){
				echo $_POST['bottone'];
			}
			
			?>
			</div>
		</div>
	
	</body>
	



</html>