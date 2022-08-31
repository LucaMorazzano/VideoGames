<?xml version="1.0" encoding="UTF-8"?>
<?php 
	session_start();
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Aggiungere al carrello</title>
	</head>
	
	<body>
		<?php
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
	
	</body>
	
</html>