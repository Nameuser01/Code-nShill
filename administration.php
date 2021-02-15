<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title style="color: red">Admin - C'nS</title>
	<link rel="stylesheet" href="http://127.0.0.1/main.css" />
	<meta charset="utf-8" />
	<style>
		nav{
			display:flex;
			flex-direction: row;
			justify-content: space-around;
			border-bottom:1px solid #ccc;
		}
		.contleft{
			/*border: 1px solid #ccc;*/
			padding: 10px;
			width: 24%;
		}
		.contcenter{
			padding-top: 10px;
			padding-bottom: 10px;
			padding-right: 30px;
			padding-left: 30px;
			width: 49%;
		}
		.contright{
			/*border:1px solid #cccccc;*/
			padding:10px;
			flex-wrap: wrap;
			width: 24%;
		}
		nav h4{
			border-bottom: 1px solid #cccccc;
			border-left: 1px solid #cccccc;
			padding-left:5px;
		}
	</style>
</head>
<body>
<?php
if($_SESSION["name"]){
?>
	<header>
		<div class="top_infos">
			<div><h1>Code'nShill - Administration</h1></div>
			<div class="user_infos">
				<div><?php echo $_SESSION["name"];?></div>
				<div><a href="session_destroy.php">Logout</a></div>
			</div>
		</div>
		<div class="menu">
			<div><a href="home.php">Home</a></div>
			<div><a href="note.php">note</a></div>
			<div><a href="cpp.php">cpp</a></div>
			<div><a href="music.php" target="_blank">music</a></div>
			<div><a href="contact.php">Contact</a></div>
			<div><a href="orientation.php">Orientation</a></div>
			<div><a href="administration.php">Refresh</a></div>
		</div>
	</header>
	<nav>
		<div class="contleft">
			<h4>:</h4>
		</div>
		<div class="contcenter">
			<h4>Main content:</h4>

		</div>
		<div class="contright">
			<h4>Logs:</h4>
			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=YourBDD;charset=utf8', '', '');
			}
			catch(Exeption $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
			$reponse = $bdd->query('SELECT * FROM logs ORDER BY ID DESC');
			while ($donnees = $reponse->fetch())
			{
				if ($donnees['legal'] == false){
					?>
					<p><strong><?php echo $donnees['IP_ADDR'] ; ?></strong> logged in at <strong><?php echo $donnees['D4TE'] ; ?></strong></p>
					<?php
				}
				else{
					?>
					<p><strong><?php echo $donnees['IP_ADDR'] ; ?></strong> tried to enter illegally at <strong><?php echo $donnees['D4TE'] ; ?></strong></p>
					<?php
				}
			}
			$reponse->closeCursor();
		?>
		</div>
	</nav>
	<footer>
		<div class="menu_left">
			<div>
				<p>Creator: someone</p>
				<p>Creation: 01/28/2021</p>
			</div>
		</div>
		<div class="menu_right">
			<div>
				<p>email: antoine.rimbault@hotmail.com</p>
				<p>phone: +</p>
			</div>
		</div>
	</footer>
<?php
}
else{
	$ip_addr = $_SERVER['REMOTE_ADDR'];
	$date_var = date("H:i:s d/m/Y");
	$legal = 1; //0 means you can acces to the site otherwise u'r kicked 
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=yourDB;charset=utf8', '', '');
	}
	catch (Exeption $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
		$req = $bdd->prepare ('INSERT INTO logs (D4TE, IP_ADDR, legal) VALUES (?, ?, ?)');
		$req->execute(array($date_var, $ip_addr, $legal));
	?>
	<script>
		window.alert("Vous n'êtes pas authentifié !");
		document.location.href="http://127.0.0.1";
	</script>
<?php
}
?>
</body>
</html>