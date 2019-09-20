<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Ajouter</h1>

	<?php
	// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
	session_start ();

	// On récupère nos variables de session
	if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {

		// On teste pour voir si nos variables ont bien été enregistrées
		echo '<html>';
		echo '<head>';
		echo '<title>Page de notre section membre</title>';
		echo '</head>';

		echo '<body>';
		echo 'Votre login est '.$_SESSION['login'].' et votre mot de passe est '.$_SESSION['pwd'].'.';
		echo '<br />';

		// On affiche un lien pour fermer notre session
		echo '<a href="./logout.php">Déconnection</a>';
	}
	else {
		echo 'Les variables ne sont pas déclarées.';
	}

	try
	{
		// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8', 'root', 'root');	

	
	$test = $_GET['numero'];
	
	

	$resultat = $bdd->prepare("SELECT * FROM hiking WHERE id = '$test' ");
	$resultat->execute();

	
	   while ($donnees = $resultat->fetch())
	  {
		$nom = $donnees['name_hiking'];
		$difficulte = $donnees['difficulty'];
		$distance = $donnees['distance'];
		echo "<h2>Modifier les données de la randonnée:</br> " . $donnees['name_hiking'] . "</h2>";
		$duree = $donnees['duration'];
		$denivele = $donnees['height_difference'];
		
	  } 

	  	
	 // Changer les données

	 if(isset($_POST['submit'])) {
					
		// On récupère les données du formulaire
		$test = $_GET['numero'];
		$req = $bdd->prepare("UPDATE hiking SET name_hiking=:name_hiking, difficulty=:difficulty, distance=:distance, duration=:duration, height_difference=:height_difference WHERE id=:id");

		
		if($req->execute(array(
			":id" => $test,
			":name_hiking" => $_POST['name_hiking'],
			":difficulty" => $_POST['difficulty'],
			":distance" => $_POST['distance'],
			":duration" => $_POST['duration'],
			":height_difference" => $_POST['height_difference']
		))){
			echo "Success";
		}else{
			echo "Failed : ".var_dump($req->errorInfo());
		}
	  }  
			
	}
	

	catch(Exception $e)
	{
	  // En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}
	?>
	
	<form action="update.php?numero=<?php echo $test ?>" method="post">
		<div>
			<label for="name_hiking">Name</label>
			<input type="text" name="name_hiking" value=' <?php 
				echo $nom;
			?>'>
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="Très facile" <?php
					if($difficulte == "Très facile"){
						echo "selected";
					}
				?> >Très facile</option>
				<option value="Facile" <?php
					if($difficulte == "Facile"){
						echo "selected";
					}
				?>>Facile</option>
				<option value="Moyen" <?php
					if($difficulte == "Moyen"){
						echo "selected";
					}
				?>>Moyen</option>
				<option value="Difficile" <?php
					if($difficulte == "Difficile"){
						echo "selected";
					}
				?>>Difficile</option>
				<option value="Très difficile" <?php
					if($difficulte == "Très difficile"){
						echo "selected";
					}
				?>>Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="number" name="distance" value= <?php 
				echo $distance;
			?>>
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="<?php 
				echo date('h:i', strtotime($duree));
			?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="number" name="height_difference" value=<?php echo $denivele;?>>
		</div>
		<button type="submit" name="submit">Envoyer</button>
	</form>
	
</body>
</html>
