<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	session_start();
?>
<head>
	<title>Nuova recensione</title>
	<?php
	//carichiamo il documento xml che dobbiamo modificare
		$xmlString_recensioni=""; //conterra il contenuto del file xml
		foreach ( file("recensioni.xml") as $node_recensioni ) {
			$xmlString_recensioni .= trim($node_recensioni); //attraverso la funzione trim salviamo il contenuto senza spazi vuoti
		}
		$doc_recensioni=new DomDocument(); //inizializziamo il documento
		$doc_recensioni->loadXML($xmlString_recensioni);
		$root_recensioni = $doc_recensioni->documentElement;
		$recensioni_elements = $root_recensioni->childNodes;	
	?>
</head>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<?php
	/*estraiamo i dati ricevuti via post*/
	if(isset($_POST['bottone_recensione'])){
		require_once('connection.php'); // avviamo connessione dbs per aggiornare valutazione utente
		$username=$_SESSION['username'];
		$testo= $_POST['nuovarecensione'];
		$valutazione=$_POST['nuovavalutazione']; //la valutazione data dall'utente viene salvata nel dbs, maggiore è questo punteggio, maggiori saranno i vantaggi dell'utente syìul sito
		/*aggiungiamo la recensione al documento*/
		//creiamo nuovo nodo
		$nuovo = $doc_recensioni->createElement("recensione");
		$nuovousername = $doc_recensioni->createElement("username",$username);
		$nuovovalutazione = $doc_recensioni->createElement("valutazione",$valutazione);
		$nuovotesto = $doc_recensioni->createElement("testo",$testo);
		//estraiamo ora il primo elemento del doc
		$first=$root_recensioni->firstChild;
		//inseriamo le informazioni al nodo 
		$nuovo->appendChild($nuovousername);
		$nuovo->appendChild($nuovovalutazione);
		$nuovo->appendChild($nuovotesto);
		//inseriamolo in testa in modo che la recensione più recente venga mostrata per prima
		$root_recensioni->insertBefore($nuovo,$first);
		//aggiorniamo il dbs e salviamo modifiche
		$valutazione+=$_SESSION['valutazione'];
		$query="UPDATE Utente SET valutazione='$valutazione' WHERE username='$username' ";
		if(mysqli_query($connection,$query)){
			$doc_recensioni->save("recensioni.xml");//salviamo le modifiche
			header('Location: homepage.php#footer');
		}
		else {echo "<h1>ERRORE INASPETTATO</h1><hr><a href=\"homepage.php#footer\">Riprova</a>";}
	}
	else{ //se non proveniamo da una form
		echo "<h1>FORBIDDEN</h1> <hr>";
	}
	
	
	?>
</html>