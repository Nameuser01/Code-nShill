<?php
session_start();
if($_SESSION['name']){
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=i;charset=utf8', '', '');
	}
	catch (Exeption $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
		$req = $bdd->prepare ('INSERT INTO note ( date, commentaire) VALUES (?, ?)');
		$date_var = date("H:i:s d/m/Y");
		$req->execute(array($date_var, $_POST['commentaire']));
		header('Location: http://127.0.0.1/note.php?page=1');
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
		window.alert("Vous n'êtes pas authentifié !");
		document.location.href="http://127.0.0.1";
	</script>
	<?php
}
?>