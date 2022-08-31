<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Registrazione</title>
		<style type="text/css">
			body{
				background-color:#1e1e1e;
			}
			#finestraregistrazione{
				display:flex;
				flex-direction:column;
				border: solid black;
				margin-left:auto;
				margin-right:auto;
				margin-top:10%;
				width:50%;
				height:100%;
				background-color:#1e1e1e;
				border-radius: 20px 20px 20px 20px;
				border:solid #a61022;
			}
			#finestraregistrazione form{
				margin-left:auto;
				margin-right:auto;
				padding-bottom:5%;
			}
			#finestraregistrazione form p{
				color:white;
				font-family:Courier;
				font-size:20px;
				padding-right:2%;
				text-align:center;
			}
			#finestraregistrazione input{
				background-color:white;
				text-align:center;
			}
			#finestraregistrazione .bottone{
				margin-left:30%;
				background-color: #a61022;
				color: white;
				font-size: 15px;
				font-family:Arial;
				padding: 5px 5px;
				border: none;
				border-radius: 5px;
				opacity:85%;
			}
			#finestraregistrazione .bottone:hover{
				opacity:100%;
			}
			#finestraregistrazione a{
				margin-left:auto;
				margin-right:auto;
				border-bottom:solid red 5px;
				border-radius:20px 20px 20px 20px;
				padding:5% 5% 2% 5%;
			}
		</style>
		
		<script>
			function formvalidator(){
				var nome =document.forms['regform']['nome'].value;
				var cognome =document.forms['regform']['cognome'].value;
				var email =document.forms['regform']['e-mail'].value;
				var username =document.forms['regform']['username'].value;
				var password =document.forms['regform']['password'].value;
				if(nome=="" || cognome=="" || email=="" || username=="" || password=="" || nome==null || cognome==null || email==null || username==null || password==null ){
					alert("Inserire tutti i parametri richiesti");
					return false;
				}
				if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))//controllo espressioni regolari indirizzo email
					return true;
				else{
					alert("indirizzo e-mail non valido");
					document.forms['regform']['e-mail'].style.borderColor="red"; //il bordo diventa rosso
					return false;
				}
				return true;
			}
			
			function recharge(n){
				//carichiamo i valori dalla sessione salvata in precedenza
				var nome= '<?php echo $_SESSION['nome'] ?>';
				var cognome='<?php echo $_SESSION['cognome'] ?>';
				var username='<?php echo $_SESSION['username'] ?>';
				var password='<?php echo $_SESSION['password'] ?>';
				var email='<?php echo $_SESSION['email'] ?>';
				if(n==4){ // caso username
					document.forms['regform']['username'].style.borderColor="red";
					document.forms['regform']['e-mail'].value=email;
				}
			}
		</script>
	</head>
	
	<body>
	<div id="finestraregistrazione">
		<a href="homepage.php"><img class="logo" src="logo.png" width="300px" height="35px" alt="logo" /></a>
		<form name="regform" action="registrazione.php" method="POST" onsubmit="return formvalidator()">
			<p>Nome<br /><input type="text" name="nome" ></p>
			<p>Cognome<br /><input type="text" name="cognome" ></p>
			<p>E-Mail<br /><input type="text" name="e-mail"></p>
			<p>Username<br /><input type="text" name="username" ></p>
			<p>Password<br /><input type="password" name="password"></p>
			<hr>
			<input class="bottone" type="submit" name="bottone" value="registrati">
		</form>
		<?php
			require_once("connection.php");
			//controlliamo nel dbs se username o l'indirizzo email sono già nel dbs
			if(isset($_POST['bottone'])){
				$nome=$_POST['nome'];
				$cognome=$_POST['cognome'];
				$email=$_POST['e-mail'];
				$username=$_POST['username'];
				$password=$_POST['password'];
				//salviamo nella sessione per riproporre i dati corretti in caso di dati già presenti nel dbs
				$_SESSION['nome']=$nome;
				$_SESSION['cognome']=$cognome;
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;
				$_SESSION['email']=$email;
				//definiamo le query di controllo
				$query1= "SELECT * FROM Utente WHERE username='$username'";
				$query2= "SELECT * FROM Utente WHERE email='$email'";
				//$result=queryresult($query1,$query2); //chiamata funzione 
				$result1=mysqli_query($connection,$query1); //restituisce un oggetto sql
				$result2=mysqli_query($connection,$query2);
				//estraiamo info dagli oggetti restituiti
				$resusrn=mysqli_fetch_array($result1); 
				$resemail=mysqli_fetch_array($result2);
				//definiamo le varie casistiche
				if(!$resusrn && !$resemail){ //#CASE 1: username ed email inseriti non  presenti nel dbs si procede con registrazione
					$query="INSERT INTO Utente (nome,cognome,username,password,email,totalespeso,saldo,valutazione,ban) VALUES (\"$nome\",\"$cognome\",\"$username\",\"$password\",\"$email\",\"0\",\"0\",\"0\",\"0\")";
					if(mysqli_query($connection, $query)){
						echo "<script> alert (\"Registrazione riuscita\") </script>";
						header ('Location: login.php');
					}
					else{
						echo "<script> alert(\"Errore inaspettato\")</script>";
					}
				}
				if($resusrn && $resemail){ //#CASE 2: username ed email presenti entrambi nel dbs 
					echo "<script> alert(\"E-mail ed Username già presenti nel sistema\")</script>";
				}
				if($resemail && !$resusrn){ //#CASE 3: email già presente nel dbs
					echo "<script> alert(\"L'indirizzo e-mail inserito risulta già presente nel sistema\");recharge(3);</script>";
				}
				if(!$resemail && $resusrn){ //#CASE 4: username già presente nel dbs
					echo "<script> alert(\"L'username inserito risulta già presente nel sistema\");recharge(4);</script>";
				}
			}
		?>
	</div>
	</body>
	
	
	
</html>