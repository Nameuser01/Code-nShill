<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Login - C'nS</title>
	<meta charset="utf-8" />
	<style>
		body{
			background-color: #000011;
			margin: 0px;
			color: #cccccc;
		}
		.erreur{
			color: #ff0000;
			font-size: 20px;
		}
	</style>
</head>
<body>
	<header>
		<h1>Code'nShill</h1>
	</header>
	<?php
	if (htmlspecialchars($_POST["pseudo"]) == "user_pseudo" && htmlspecialchars($_POST["password"]) == "user_pwd"){
		session_start();
		$_SESSION["name"] = $_POST["pseudo"];
		header('Location: http://127.0.0.1/logs.php');
	}
	else{
		$ip_addr = $_SERVER['REMOTE_ADDR'];
		$date_var = date("H:i:s d/m/Y");
		$legal = 1; //0 means you can acces to the site; 1 means the opposite
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=bdd;charset=utf8', '', '');
		}
		catch (Exeption $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
			$req = $bdd->prepare ('INSERT INTO logs (D4TE, IP_ADDR, legal) VALUES (?, ?, ?)');
			$req->execute(array($date_var, $ip_addr, $legal));
		?>
		<p class="erreur">Erreur "401" : Utilisateur non authentifié !</p>
		<script>
			window.alert("Wrong password or username");
			document.location.href="http://127.0.0.1";
		</script>
		<?php
	}
	?>
</body>
</html>
