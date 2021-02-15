<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Note - C'nS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="http://127.0.0.1/main.css" />
	<style>
		section{
			margin-top: 50px;
			display: flex;
			flex-direction: column;
			justify-content: space-around;
			margin: 0 auto;
			width: 1280px;
			margin-top: 50px;
		}
		section h4{
			border-bottom: 1px solid #cccccc;
			border-left: 1px solid #cccccc;
			padding-left:5px;
		}
		.liens_pagination{
			display: flex;
			flex-direction: row;
		}
	</style>
</head>
<body>
<?php
if($_SESSION["name"]){
	$bit = 0;
?>
	<header>
		<div class="top_infos">
			<div><h1>Code'nShill - Note</h1></div>
			<div class="user_infos">
				<div><?php echo $_SESSION["name"];?></div>
				<div><a href="session_destroy.php">Logout</a></div>
			</div>
		</div>
		<div class="menu">
			<div><a href="home.php">Home</a></div>
			<div class="note_param"><a href="http://127.0.0.1/note.php?page=1">refresh</a></div>
			<div><a href="cpp.php">cpp</a></div>
			<div><a href="http://127.0.0.1/music.php" target="_blank">Music</a></div>
			<div><a href="contact.php">Contact</a></div>
			<div><a href="orientation.php">Orientation</a></div>
			<div><a href="administration.php">Administration</a></div>
		</div>
	</header>
	<section>
		<div>
			<h4>All my notes:</h4>
			<?php
				try
				{
					$bdd = new PDO('mysql:host=localhost;dbname=myi;charset=utf8', '', '');
				}
				catch(Exeption $e)
				{
					die('Erreur : ' . $e->getMessage());
				}
				$result = $bdd->query('SELECT COUNT(*) as nbr_comments FROM note');
				$data = $result->fetch();
				$nbr_comments = htmlspecialchars($data['nbr_comments']);
				$result->closeCursor();
				// Nombre de pages à créer
				$query_max_id = $bdd->query("SELECT MAX(id) AS max_id FROM note");
				$data_for_id = $query_max_id->fetch();
				$max_id = $data_for_id['max_id'];
				$query_max_id->closeCursor();
				$nbr_pages = intdiv($max_id, 10);
				$nbr_pages++;
				$i = 1;
				$max_id_comment = intdiv($max_id, 10); //tant que max_id < 100 ca fonctionne
				$max_id_comment = ++$max_id_comment * 10;
				$max_borne = ($max_id_comment - ($_GET['page'] - 1) * 10);
				$min_borne = $max_borne - 10;
				$reponse = $bdd->query("SELECT * FROM note WHERE ID <= $max_borne AND ID >= $min_borne ORDER BY ID DESC");
				$step_stop = 1;
				while ($donnees = $reponse->fetch())
				{
					$bit++;
					if($bit % 2 == 1){
						?>
							<div class="forum_impair"><p style="background-color: #0f0f3f; padding:10px">At <strong><?php echo htmlspecialchars($donnees['date']); ?>, Admin</strong> says:<br /><?php echo htmlspecialchars($donnees['commentaire']); ?></p></div>
						<?php
					}
					else{
						?>
							<div class="forum_pair"><p style="padding:10px">At <strong><?php echo htmlspecialchars($donnees['date']); ?>, Admin</strong> says:<br /><?php echo htmlspecialchars($donnees['commentaire']); ?></p></div>
						<?php
					}
					?>
					<!-- Formulaire de suppression de données -->
					<form method="post" action="http://127.0.0.1/delete_note.php">
						<input type="hidden" name="id" value="<?php echo htmlspecialchars($donnees['id']) ; ?>">
						<input type="submit" name="delCom" value="remove this comment">
					</form>
					<?php 
				}
				echo "<br />Nombre de commentaires: " . $nbr_comments;
				echo "<br /><br />Page: ";
				while ($i <= $nbr_pages){
					?><a href="http://127.0.0.1/note.php?page=<?php echo $i ; ?>"> <?php echo $i ; ?> </a><?php
					$i++;
				}
				$reponse->closeCursor();
			?>
		</div>
		<!-- post section -->
		<div class="post_section">
			<h4></h4>
			<form method="post" action="http://127.0.0.1/note_post.php">
				<div>
					<label for="commentaire" style="font-size: 20px">Commentaire</label><br />
					<textarea id="commentaire" name="commentaire" cols="100" rows="5"></textarea>
				</div>
				<div>
					<input type="submit" value="Envoyer" name="bouton" style="padding: 6px">
				</div>
			</form>
		</div>
		<p>Si vous avez des problèmes d'affichage sur le forum, c'est qu'il est nécessaire de faire une mise à jour des ID. Il est intéressant de faire cette mise à jour si vous supprimez beaucoup de commentaires. Ce n'est pas nécessaire, mais c'est plus pratique en ce qui concerne l'affichage d'un nombre correct de commentaires</p>
		<a href="http://127.0.0.1/note_refresh.php">Mettre à jour les id dans la base de donnée</a>
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
				<p>email: v</p>
				<p>phone: v</p>
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
			$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', '', '');
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