<?php
session_start();
if($_SESSION['name']){
	//refresh des id de la base de donnée
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=;charset=utf8', '', '');
	}
	catch(Exeption $e){
		die('Erreur : ' . $e->getMessage());
	}
	$req_com = $bdd->query('SELECT COUNT(*) AS nbr_coms from note_bis');
	$data = $req_com->fetch();
	$nbr_coms = htmlspecialchars($data['nbr_coms']);
	$req_com->closeCursor();
	//requête de reagencement des IDs
	$new_id = 1;
	while($nbr_coms != $new_id){
		$req = $bdd->prepare('UPDATE note_bis SET id = :new_id');
		$req->execute(array('new_id' => $new_id));
		$new_id++;
	}
	$req->closeCursor();
	?>
	<script>
		document.location.href="http://127.0.0.1/note.php?page=1";
	</script>
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
	document.location.href="http://1127.0.0.1";
</script>
<?php
}
?>