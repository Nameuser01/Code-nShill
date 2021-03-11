<?php
session_start();
if($_SESSION['name']){
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	}
	catch(Exeption $e){
		die('Erreur : ' . $e->getMessage());
	}
	$req_com = $bdd->query('SELECT COUNT(*) AS nbr_coms from note_bis');
	$data = $req_com->fetch();
	$nbr_coms = htmlspecialchars($data['nbr_coms']);
	$req_com->closeCursor();
	//requête de reagencement des IDs
	$req = $bdd->query('SELECT secondaryID FROM note_bis');
	$donnees = $bdd->prepare('UPDATE note_bis SET secondaryID = ? WHERE secondaryID = ?');
	
	$row = $req->fetch();
		for ($new_id = 1; $new_id < 7; $new_id++)
		{
			$donnees->execute(array($new_id, $row['secondaryID']));
		}
	$req->closeCursor();
	?>
	<a href="http://192.168.0.50/note.php?page=1">Retour vers la page note (debeug)</a>
	<!-- <script>
		document.location.href="http://192.168.0.50/note.php?page=1";
	</script> -->
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
	document.location.href="http://192.168.0.50";
</script>
<?php
}
?>
