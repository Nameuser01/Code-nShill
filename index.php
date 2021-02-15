<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Code'nShill - C'nS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="http://127.0.0.1/main.css" />
	<!-- <META HTTP-EQUIV="Refresh" CONTENT="5" /> -->
	<style>
		#menu{
			display: flex;
			flex-direction: row;
			justify-content: center;
			margin-top: 10%;
		}
		.submit{
			padding: 3px;
		}
		footer{
			margin-top: 20%;
		}
	</style>
</head>
<body>
	<header>
		<h1>Code'nShill</h1>
		<h4>Vous devez vous authentifier pour entrer sur le site</h4>
		<h4>Contactez l'administrateur pour devenir membre</h4>
	</header>
	<section>
		<div id="menu">
			<form action="http://127.0.0.1/login.php" method="post">
				<div>
					<center><label for="pseudo">Enter your name:</label></center>
					<input type="text" name="pseudo" id="pseudo" required><br />
				</div><br />
				<div>
					<center><label for="password">Enter your password:</label></center>
					<input type="password" name="password" id="password" required><br />
				</div>
				<div class="submit">
					<center><input type="submit" value="Enter" name="submit"></center>
				</div>
			</form>
		</div>
	</section>
	<footer>
		<div class="menu_left">
			<div>
				<p>Creator: S</p>
				<p>Creation: 01/28/2021</p>
			</div>
		</div>
		<div class="menu_right"> 
			<div>
				<p>email: vddv</p>
				<p>phone: </p>
			</div>
		</div>
	</footer>
</body>
</html>