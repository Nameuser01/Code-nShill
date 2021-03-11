<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Music - C'nS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="http://127.0.0.1/main.css" />
	<style>
		section{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			width: auto;
		}
		section h4{
			border-left: 1px solid #ccc;
			border-bottom: 1px solid #ccc;
			padding-left: 10px;
		}
		.contcent{

		}
	</style>
</head>
<body>
<?php
if($_SESSION["name"]){
?>
	<header>
		<div class="top_infos">
			<div><h1>Code'nShill - Music</h1></div>
			<div class="user_infos">
				<div><?php echo $_SESSION["name"];?></div>
				<div><a href="session_destroy.php">Logout</a></div>
			</div>
		</div>
		<div class="menu">
			<div><a href="home.php">Home</a></div>
			<div><a href="http://127.0.0.1/note.php?page=1">note</a></div>
			<div><a href="cpp.php">cpp</a></div>
			<div><a href="music.php">Refresh</a></div>
			<div><a href="contact.php">Contact</a></div>
			<div><a href="orientation.php">Orientation</a></div>
			<div><a href="administration.php">Administration</a></div>
		</div>
	</header>
	<section>
		<div class="contleft">
			<h4>Playlists Spotify:</h4>
			<iframe src="https://open.spotify.com/embed/playlist/g" width="320" height="360" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
		</div>
		</div>
		<div class="contcent">
			<h4>Vidéos:</h4>
			<?php
				try
				{
					$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', '', '');
				}
				catch(Exeption $e)
				{
					die('Erreur : ' . $e->getMessage());
				}
				$reponse = $bdd->query('SELECT * FROM music_playlist ORDER BY ID DESC');
				while ($donnees = $reponse->fetch())
				{
					?>
					<iframe width="720" height="540" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($donnees['lien_video']) ; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><!--lien_video is an 11 characters long string (the last characters of a YTB video link) -->
					<form action="http://127.0.0.1/delete_video.php" method="post">
						<center>
							<input name="id" value="<?php echo htmlspecialchars($donnees['id']) ; ?>" type="hidden">
							<input type="submit" id="suppression" name="suppression" value="Remove">
						</center>
					</form>
					<br />
					<br />
					<?php
				}
				$reponse->closeCursor();
			?>
		</div>
		<div class="contright">
			<h4>Ajout vidéos YouTube:</h4>
			<form method="POST" action="add_video.php">
				<div>
					<label for="name_video">Titre:</label><br />
					<input name="name_video" id="name_video" type="text" size="30" required/>
				</div>
				<div>
					<label for="url_video">URL:</label><br />
					<input name="url_video" id="url_video" type="text" size="30" maxlength="11" required/>
				</div>
				<div>
					<center><input type="submit" value="Envoyer" /></center>
				</div>
			</form>
		</div>
	</section>
	<footer>
		<div class="menu_left">
			<div>
				<p>Creator: sf</p>
				<p>Creation: 01/28/20021</p>
			</div>
		</div>
		<div class="menu_right"> 
			<div>
				<p>email: q</p>
				<p>phone: q</p>
			</div>
		</div>
	</footer>
<?php
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
	<script>
		window.alert("Vous n'avez pas le droit d'être sur cette page !");
		document.location.href="http://127.0.0.1";
	</script>
<?php
}
?>
</body>
</html>
