<?php
session_start();
if($_SESSION['name']){
	$idDelete = $_POST['id'];
	$tagReturn = $_POST['tag'];
	$connexion = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	if (!$connexion){
		die("Connexion failed: " . bdd_connect_error());
	}
	$sql = "DELETE FROM ytb_videos WHERE id=$idDelete";
	if($connexion->query($sql) == TRUE){
		echo "Record deleted successfully";
	}
	else{
		echo "Error deleting record: " . $connexion->error;
	}
	?>
	<script>
		document.location.href="http://127.0.0.1/ytb.php?tag=<?php echo $tagReturn ; ?>";
	</script>
	<?php
}
else{
	$ip_addr = $_SERVER['REMOTE_ADDR'];
	$date_var = date("H:i:s d/m/Y");
	$legal = 1;
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	}
	catch (Exeption $e){
		die('Erreur: ' . $e->getMessage());
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