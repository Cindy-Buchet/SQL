<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
<?php
	// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
	session_start ();

	// On récupère nos variables de session
	if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {

		// On teste pour voir si nos variables ont bien été enregistrées
		
		echo 'Votre login est '.$_SESSION['login'].' et votre mot de passe est '.$_SESSION['pwd'].'.';

		// On affiche un lien pour fermer notre session
		echo '<a href="./logout.php">Déconnection</a>';
	}
	else {
		echo 'Les variables ne sont pas déclarées.';
	}

?>
	<a href="/SQL/php-training-mysql/read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name_hiking">Nom</label>
			<input type="text" name="name_hiking" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="Très facile">Très facile</option>
				<option value="Facile">Facile</option>
				<option value="Moyen">Moyen</option>
				<option value="Difficile">Difficile</option>
				<option value="Très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>

	<?php

		try
		{
		// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8', 'root', 'root');	

		
		$resultat = $bdd->prepare('SELECT * FROM hiking');
		$resultat->execute();
		
		if(isset($_POST['name_hiking']) && isset($_POST['difficulty']) && isset($_POST['duration']) && isset($_POST['distance']) && isset($_POST['height_difference'])) {
					
			// On récupère les données du formulaire
			$req = $bdd->prepare('INSERT INTO hiking(name_hiking,difficulty,duration,distance,height_difference) VALUES(:name,:difficulty,:duration,:distance,:height_difference)');
			
			$req->execute(array(
				":name" => $_POST['name_hiking'],
				":difficulty" => $_POST['difficulty'],
				":duration" => $_POST['duration'],
				":distance" => $_POST['distance'],
				":height_difference" => $_POST['height_difference']
			));

			}
			
			echo "<p class='valider'><img class='gif-valide ' src='https://thumbs.gfycat.com/TatteredValidAiredale-max-1mb.gif' alt='Validation de la randonnée'>La randonnée " . $_POST['name'] . " a bien été ajouté!</p>";
		
		}
		catch(Exception $e)
		{
		// En cas d'erreur, on affiche un message et on arrête tout
			die('Erreur : '.$e->getMessage());
		}

	?>
</body>
</html>
