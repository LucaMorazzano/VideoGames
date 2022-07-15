<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<style type="text/css">
		
		</style>
		<script type="text/javascript">
			function formvalidator(){
				var usr = document.forms['userform']['username'].value; //assegnamo ad usr il valore di username
				var pwd= document.forms['userform']['password'].value;
				if(usr == null || pwd == null || usr == "" || pwd == ""){
					alert ("Dati mancanti");
					return false;
				}
				return true;
			}
		</script>
	</head>
	
	<body>

		<div id="finestralogin">
			<form name="userform" action="login.php" method="POST" onsubmit="return formvalidator()">
				<p>Username:<input type="text" name="username"></p>
				<p>Password:<input type="password" name="password"></p>
				<p><input type="submit" name="login" value="Login"></p>
			</form>	
		</div>
		
		<?php
			if(isset($_POST['login'])){ //se si è provato ad effettuare il login (dal button)
				$username=$_POST['username'];
				$password=$_POST['password'];
				require_once("connection.php"); //connessione al dbs per controllo esistenza utente
				session_start(); //avviamo la sessione per salvare informazioni in caso di login eseguito
				
				//Effettuiamo controllo esistenza utente nel dbs (caso utente registrato)
				$sql="SELECT * FROM Utente WHERE username='$username' AND password='$password'"; 
				if($result=mysqli_query($connection,$sql)){
					$userInfo= mysqli_fetch_array($result); //contiene tutte le informazioni dell'utente 
					if($userInfo){ //salviamo le informazioni nella sessione corrente
						$_SESSION['username']=$username;
						$_SESSION['password']=$password;
						$_SESSION['saldo']=$userInfo['saldo'];
						$_SESSION['valutazione']=$userInfo['valutazione'];
						$_SESSION['email']=$userInfo['email'];
						$_SESSION['totalespeso']=$userInfo['totalespeso'];
						$_SESSION['login']=true; //aggiorniamo stato login
						$_SESSION['carrello']=array(); //inizializziamo il carrello
						header('Location: home.php');
					}
					else{
						echo"<script> alert(\"Dati errati\") </script>";
					}
				}
				else {
					echo "<script> alert(\"Errore inaspettato\") </script>";
				}
				$connection->close();
			}
		?>
	</body>

</html>