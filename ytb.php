<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Youtube - C'nS</title>
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
		.contright{
			position: -webkit-sticky;
			position: sticky;
		}
	</style>
</head>
<body>
<?php
if($_SESSION["name"]){
$tag_page = $_GET['tag'];
?>
	<header>
		<div class="top_infos">
			<div><h1>Code'nShill - Youtube</h1></div>
			<div class="user_infos">
				<div><?php echo $_SESSION["name"];?></div>
				<div><a href="session_destroy.php">Logout</a></div>
			</div>
		</div>
		<div class="menu">
			<div><a href="home.php">Home</a></div>
			<div><a href="http://127.0.0.1/note.php?page=1">note</a></div>
			<div><a href="cpp.php">cpp</a></div>
			<div><a href="music.php">Music</a></div>
			<div><a href="http://127.0.0.1/ytb.php?tag=<?php echo $tag_page ; ?>">Refresh</a></div>
			<div><a href="contact.php">Contact</a></div>
			<div><a href="orientation.php">Orientation</a></div>
			<div><a href="administration.php">Administration</a></div>
		</div>
	</header>
	<section>
		<!-- <div class="contleft">
			<h4>Trying to find a utility for this space:</h4>
			<p>foo</p>
		</div> -->
		</div>
		<div class="contcent">
			<h4>Vidéos:</h4>
			<?php
				try
				{
					$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
				}
				catch(Exeption $e)
				{
					die('Erreur : ' . $e->getMessage());
				}
				if(!$_GET['tag']){
					$reponse = $bdd->query('SELECT * FROM ytb_videos ORDER BY id DESC');
				}
				elseif($_GET['tag'] == "toute"){
					$reponse = $bdd->query('SELECT * FROM ytb_videos ORDER BY id DESC');
				}
				else{
					$reponse = $bdd->query('SELECT * FROM ytb_videos WHERE tag="'.$_GET['tag'].'" ORDER BY id DESC');
				}
				while ($donnees = $reponse->fetch())
				{
					?>
					<iframe width="700" height="500" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($donnees['url']) ; ?>" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
					<form action="http://127.0.0.1/del_ytb_video.php" method="post">
						<center>
							<input name="id" value="<?php echo htmlspecialchars($donnees['id']) ; ?>" type="hidden">
							<input name="tag" value="<?php echo $tag_page ; ?>" type="hidden">
							<input type="submit" id="suppression" name="suppression" value="Remove" style="padding-top:10px; padding-bottom: 10px; padding-right: 40px; padding-left: 40px;">
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
			<!-- <div style="position: fixed;"> -->
			<h4>Management vidéos:</h4>
			<h5>Ajout de vidéos</h5>
				<form method="POST" action="add_ytb_video.php">
				<div>
					<label for="name_video">Titre:</label><br />
					<input name="nom" id="nom" type="text" size="30" style="margin-top: 5px; margin-bottom: 10px; padding-top: 5px; padding-top: 5px;"/>
				</div>
				<div>
					<label for="url_video">URL*:</label><br />
					<input name="url" id="url" type="text" size="30" maxlength="11" required style="margin-top: 5px; margin-bottom: 10px; padding-top: 5px; padding-top: 5px;"/>
				</div>
				<div>
					<label for="tag">tag*:</label><br />
					<select name="tag" id="tag" style="padding-right:40px; padding-left: 40px; padding-top: 5px; padding-bottom: 5px; margin-bottom: 10px; margin-top: 5px;">
						<option value="toute">Toutes</option>
						<option value="divertissement">Divertissement</option>
						<option value="gaming">Gaming</option>
						<option value="thread">Thread</option>
						<option value="documentaire">Documentaire</option>
						<option value="informatique">Informatique</option>

						<option value="autre">Autre</option>
					</select>
				</div>
				<div>
					<input type="hidden" name="tag_page" value="<?php echo $tag_page ; ?>" />
					<center><input type="submit" value="Envoyer" style="padding-right: 40px; padding-left:40px; padding-top:10px; padding-bottom: 10px;"/></center>
				</div>
				</form>
			<h5 style="margin-top: 50px;">Selection du tag</h5>
			<form method="GET" action="ytb.php">
				<label for="tag">Choose Tag:</label>
				<br />
				<center>
				<select name="tag" id="tag" style="padding-right: 40px; padding-left: 40px; padding-top: 5px; padding-bottom: 5px; margin-bottom: 10px; margin-top: 5px;">
					<option value="toute">Toutes</option>
					<option value="divertissement">Divertissement</option>
					<option value="gaming">Gaming</option>
					<option value="thread">Thread</option>
					<option value="documentaire">Documentaire</option>
					<option value="informatique">Informatique</option>

					<option value="autre">Autre</option>
				</select>
				<br />
				<input type="submit" value="Apply" style="padding-right: 40px; padding-left: 40px; padding-top: 10px; padding-bottom: 10px; background-color: #cccccc;"></center>
			</form>
			<!-- </div> -->
		</div>
	</section>
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
				<p>phone: +33</p>
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
		window.alert("Vous n'avez pas le droit d'être sur cette page !");
		document.location.href="http://127.0.0.1";
	</script>
<?php
}
?>
</body>
</html>