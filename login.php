<?php
// Apro la sessione
session_start();
?>
<!DOCTYPE html>
	<html>
		<head>
    	<meta charset='UTF-8'>
    </head>
		<body>
		<?php
			//Recupero username e password dal form
			$username = $_POST["usr"];
			$password = $_POST["psw"];

			//Salvo i dati
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;

			header('Location: index.php');
			exit;
		?>
    </body>
    </html>
