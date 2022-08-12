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
				var nome =document.forms['userform']['nome'].value;
				var cognome =document.forms['userform']['cognome'].value;
				var e-mail =document.forms['userform']['e-mail'].value;
				var username =document.forms['userform']['username'].value;
				var password =document.forms['userform']['password'].value;
				if(nome=="" || cognome=="" || e-mail=="" || username=="" || password=="" || nome==null || cognome==null || e-mail==null || username==null || password==null ){
					alert("Inserire tutti i parametri richiesti");
					return false;
				}
				return true;
			}
		</script>
	</head>
	
	<body>
	<div id="finestraregistrazione">
		<a href="homepage.php"><img class="logo" src="logo.png" width="300px" height="35px" alt="logo" /></a>
		<form name="userform" action="login.php" method="POST" onsubmit="return formvalidator()">
			<p>Nome<br /><input type="text" name="nome" ></p>
			<p>Cognome<br /><input type="text" name="cognome" ></p>
			<p>E-Mail<br /><input type="text" name="e-mail"></p>
			<p>Username<br /><input type="text" name="username" ></p>
			<p>Password<br /><input type="password" name="password"></p>
			<hr>
			<input class="bottone" type="submit" name="bottone" value="registrati" >
		</form>
		<?php
			require_once("connection.php");
			//controlliamo nel dbs se username o l'indirizzo email sono già nel dbs
		?>
	</div>
	</body>
	
	
	
</html>