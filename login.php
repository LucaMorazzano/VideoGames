<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Login</title>
		<style type="text/css">
		body{
			background-color:#1e1e1e;
		}
		#finestralogin{
			display:flex;
			flex-direction:column;
			margin-left:auto;
			margin-right:auto;
			margin-top:10%;
			background-color:#1e1e1e;
			border-radius: 20px 20px 20px 20px;
			border:solid #a61022;
			width:50%;
			height:100%;
		}
		#finestralogin img{
			margin-left:auto;
			margin-right:auto;
			border-bottom:solid red 5px;
			border-radius:20px 20px 20px 20px;
			padding:5% 5% 2% 5%;
		}
		#finestralogin form{
			margin-left:auto;
			margin-right:auto;
			padding-bottom:5%;
		}
		#finestralogin form p{
			color:white;
			font-family:Courier;
			font-size:20px;
			padding-right:2%;
			text-align:center;
		}
		#finestralogin input{
			background-color:white;
			text-align:center;
		}
		#finestralogin .bottone{
			display:inline;
			background-color: #a61022;
			color: white;
			font-size: 15px;
			font-family:Arial;
			padding: 5px 5px;
			border: none;
			border-radius: 5px;
			opacity:85%;
		}
		#finestralogin .bottone:hover{
			opacity:100%;
		}
		#finestralogin .bottone2{
			display:inline;
			background-color: #009900;
			color: white;
			font-size: 15px;
			font-family:Arial;
			padding: 5px 5px;
			border: none;
			border-radius: 5px;
			opacity:95%;
		}
		#finestralogin .bottone2:hover{
			opacity:100%;
		}
		
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
	<?php 
		require_once("connection.php"); //connessione al dbs per controllo esistenza utente
		session_start(); //avviamo la sessione per salvare informazioni in caso di login eseguito
	?>
		<div id="finestralogin">
		<img class="logo" src="logo.png" width="300px" height="35px" alt="logo" />
			<form name="userform" action="login.php" method="POST" onsubmit="return formvalidator()">
				<p>Username<input type="text" name="username"></p>
				<p>Password<input type="password" name="password"></p>
				<p><input class="bottone" type="submit" name="login" value="Login"></p>
				<hr>
				<p><input class="bottone2" type="submit" name="registrati" value="Crea un nuovo account"></p>
			</form>	
		</div>
		
		<?php
			if(isset($_POST['login'])){ //se si è provato ad effettuare il login (dal button)
				$username=$_POST['username'];
				$password=$_POST['password'];
				//Effettuiamo controllo esistenza utente nel dbs (caso utente registrato)
				$sql="SELECT * FROM Utente WHERE username='$username' AND password='$password'"; 
				if($result=mysqli_query($connection,$sql)){
					$userInfo= mysqli_fetch_array($result); //contiene tutte le informazioni dell'utente 
					if($userInfo && $userInfo['ban']==0){ //salviamo le informazioni nella sessione corrente
						$_SESSION['username']=$username;
						$_SESSION['password']=$password;
						$_SESSION['saldo']=$userInfo['saldo'];
						$_SESSION['valutazione']=$userInfo['valutazione'];
						$_SESSION['email']=$userInfo['email'];
						$_SESSION['totalespeso']=$userInfo['totalespeso'];
						$_SESSION['login']=true; //aggiorniamo stato login
						$_SESSION['carrello']=array(); //inizializziamo il carrello
						header('Location: homepage.php');
					}
					else if($userInfo && $userInfo['ban']==1){
						echo "<script> alert (\"Account bannato contattare l'admin per essere riammesso\");</script>";
					}
					else if(!$userInfo){
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