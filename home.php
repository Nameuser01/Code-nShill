<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Home - C'nS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="http://192.168.0.50/main.css" />
	<style>
	@media (min-width: 1980px){
		nav{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			border-bottom: 1px solid #cccccc;
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
			width:49%;
		}
		.contright{
			/*border:1px solid #cccccc;*/
			padding:10px;
			width: 24%;
		}
		nav h4{
			border-bottom: 1px solid #cccccc;
			border-left: 1px solid #cccccc;
			padding-left:5px;
		}
		.useful_links{
			border:1px solid #cccccc;
			text-decoration: none;
			background-color: #0f0f3f;
			padding: 10px;
			color: #cccccc;
		}
		.useful_links:hover{
			background-color: #0f0fbf;
			text-decoration: none;
		}
		/*.medias{
			display: flex;
			flex-direction: column;
			margin-bottom: 25px;
		}
		.medias_twitch{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			word-break: wrap;
		}
		#medias_input{
			border: 1px solid #0f0f3f;
			padding-right: 10px;
			padding-left: 10px;
			padding-top: 3px;
			padding-bottom: 3px;
		}*/
	}
	@media (max-width: 100px){

	}
	</style>
</head>
<body>
<?php
if($_SESSION["name"]){
?>
	<header>
		<div class="top_infos">
			<div><h1>Code'nShill - Home</h1></div>
			<div class="user_infos">
				<div><?php echo $_SESSION["name"];?></div>
				<div><a href="session_destroy.php">Logout</a></div>
			</div>
		</div>
		<div class="menu">
			<div><a href="http://192.168.0.50/home.php">Refresh</a></div>
			<div><a href="http://192.168.0.50/note.php?page=1">note</a></div>
			<div><a href="cpp.php">cpp</a></div>
			<div><a href="music.php">music</a></div>
			<div><a href="http://192.168.0.50/ytb.php?tag=toute">Youtube</a></div>
			<div><a href="contact.php">Contact</a></div>
			<div><a href="orientation.php">Orientation</a></div>
			<div><a href="administration.php">Administration</a></div>
		</div>
	</header>
	<nav>
		<div class="contleft">
			<div><h4>Useful links:</h4></div>
			<div><h3>Twitch:</h3></div>
			<a class="useful_links" href="https://www.twitch.tv/" target="_blank"></a>
			<a class="useful_links" href="https://www.twitch.tv/" target="_blank"></a>
			<a class="useful_links" href="https://www.twitch.tv/" target="_blank"></a>
			<a class="useful_links" href="https://www.twitch.tv/" target="_blank"></a>
			<br />
			<div><h3 style="margin-top: 30px;">Twitch redif:</h3></div>
			<a style="margin-bottom: 40px;" href="https://www.twitch.tv/vide" target="_blank">H</a><br />
			<a style="margin: 20px;" href="https://www.twitch.tv/v" target="_blank"></a><br />
			<a style="margin: 20px;" href="https://www.twitch.tv/" target="_blank"></a><br />
		</div>
		<div class="contcenter">
			<h4>Main content:</h4>
			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
			}
			catch(Exeption $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
			$reponse = $bdd->query('SELECT * FROM music_playlist ORDER BY ID DESC');
			$compteur = 0;
			while ($donnees = $reponse->fetch())
			{
				$compteur++;
			}
			// echo "DEBEUG PHP: Il y a en tout: " . $compteur . " vidéos dans la base de donnée";?><br /><?php
			$random_number = rand(1, $compteur);
			// echo "DEBEUG PHP 2: Le nombre random est " . $random_number ;
			$final_result = $bdd->query("SELECT * FROM music_playlist");
			$step_cursor = 	1;
			while ($donnees = $final_result->fetch())
			{
				if($step_cursor == $random_number){
				?>
				<iframe width="1000" height="720" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($donnees['lien_video']) ; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				<?php
				break;
				}
				else{
					//Do nothing
				}
				$step_cursor++;
			}
			$reponse->closeCursor();
			?>
		</div>
		<div class="contright">
			<h4>Actualités:</h4>
			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
			}
			catch(Exeption $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
			$reponse = $bdd->query('SELECT * FROM note ORDER BY ID DESC LIMIT 0, 5');
			while ($donnees = $reponse->fetch())
			{
				?>
				<p>At <strong><?php echo htmlspecialchars($donnees['date']) . " Admin"; ?></strong> says: <?php echo htmlspecialchars($donnees['commentaire']); ?></p>
				<?php
			}
			$reponse->closeCursor();
		?>
		</div>
	</nav>
	<footer>
		<div class="menu_left">
			<div>
				<p>Creator: </p>
				<p>Creation: 01/28/21</p>
			</div>
		</div>
		<div class="menu_right">
			<div>
				<p>email: </p>
				<p>phone: +33 </p>
			</div>
		</div>
	</footer>
<?php
}
else{
	$ip_addr = $_SERVER['REMOTE_ADDR'];
		$date_var = date("H:i:s d/m/Y");
		$legal = 1; //0 means you can acces to the site; 1 means the opposite, ip will be send to blacklist
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
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
		document.location.href="http://192.168.0.50";
	</script>
<?php
}
?>
</body>
</html>
