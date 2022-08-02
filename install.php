<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>intall.php</title>
	</head>
	
	<body>
		<?php
			$connection= new mysqli("localhost","root","");
			$dbname="Videogiochi";
			$userTable="Utente";
			$gestoreTable="Gestore";
			$adminTable="Admin";
			if(mysqli_errno($connection)){
				echo"<h2 style=\"color:red\">Errore connessione</h2>";
			}
			/*ELIMINIAMO IL DBS SE GIA' CREATO*/
			$query= "DROP DATABASE if exists $dbname";
			$dropresult=mysqli_query($connection,$query);
			/*CREAZIONE DBS*/

			$query= "CREATE DATABASE if not exists $dbname";
			if(mysqli_query($connection,$query) && $dropresult){
				echo "<h1>DBS creato</h1>";
			}	
			else {
				echo "<h1 style=\"color:red\">errore creazione DBS</h1>";
			}
			$connection->close();
			
			////CREAZIONE TABELLE
			require_once("connection.php");
			
			//TABELLA UTENTE
			$sql="CREATE TABLE if not exists $userTable (
				nome VARCHAR (20) NOT NULL,
				cognome VARCHAR (20) NOT NULL,
				username VARCHAR(20) NOT NULL,
				email VARCHAR(40) NOT NULL,
				password VARCHAR(20) NOT NULL,
				totalespeso DOUBLE NOT NULL,
				saldo DOUBLE NOT NULL,
				valutazione INTEGER,
				ban INTEGER)";
			echo $sql;
			if(mysqli_query($connection,$sql)){
					echo "<h2 style=\"color:green\">tabella utente creata</h2>";
			}	
			else {
				echo "<h2 style=\"color:red\">errore creazione tabella utente</h2>";
			}
			//TABELLA GESTORE
			$sql="CREATE TABLE if not exists $gestoreTable (
					username VARCHAR(20) NOT NULL,
					password VARCHAR(20) NOT NULL)";
			echo $sql;
			if(mysqli_query($connection,$sql)){
						echo "<h2 style=\"color:green\">tabella Gestore creata</h2>";
			}	
			else {
				echo "<h2 style=\"color:red\">errore creazione tabella Gestore</h2>";
			}
			
			//TABELLA ADMIN
			$sql="CREATE TABLE if not exists $adminTable (
					username VARCHAR(20) NOT NULL,
					password VARCHAR(20) NOT NULL)";
			echo $sql;
			if(mysqli_query($connection,$sql)){
						echo "<h2 style=\"color:green\">tabella Admin creata</h2>";
			}	
			else {
				echo "<h2 style=\"color:red\">errore creazione tabella Admin</h2>";
			}
			
			///POPOLAMENTO TABELLE
			$sql=array();
			$i=0;
			$sql[0]="INSERT INTO $userTable (nome,cognome,username, password, email, totalespeso, saldo, valutazione,ban) VALUES (\"Luca\",\"Morazzano\",\"luca\",\"luca\",\"luca@gmail.com\",\"0\",\"0\",\"0\",\"0\")";
			$sql[1]="INSERT INTO $userTable (nome,cognome,username, password, email, totalespeso, saldo, valutazione,ban) VALUES (\"Andrea\",\"Fionda\",\"andrea\",\"andrea\",\"andrea@gmail.com\",\"0\",\"0\",\"0\",\"1\")";
			$sql[2]="INSERT INTO $userTable (nome,cognome,username, password, email, totalespeso, saldo, valutazione,ban) VALUES (\"Marco\",\"Temperini\",\"prof\",\"prof\",\"prof@gmail.com\",\"0\",\"0\",\"0\",\"0\")";
			$sql[3]="INSERT INTO $gestoreTable(username, password) VALUES (\"manager\",\"manager\")";
			$sql[4]="INSERT INTO $adminTable(username, password) VALUES (\"admin\",\"admin\")";
			while($i<sizeof($sql)){
				echo "$sql[$i] \n <br />";
				if(mysqli_query($connection,$sql[$i])){
					echo "<h2 style=\"color:green\">popolamento riuscito</h2>";
				}	
				else {
					echo "<h2 style=\"color:red\">errore popolamento</h2>";
				}
				$i+=1;
			}
			$connection->close();	
		?>
	
	</body>
	
	
</html>