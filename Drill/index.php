<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	
	<body>
	<div class="container">
	<h1>Premier exercice SQL</h1>
	<?php
			try
			{
				// On se connecte à MySQL
				$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');	

				if(isset($_POST['ville']) && isset($_POST['haut']) && isset($_POST['bas'])) {
					
					// On récupère les données du formulaire
					$req = $bdd->prepare('INSERT INTO meteo(ville,haut,bas) VALUES(:ville,:haut,:bas)');
					
					$req->execute(array(
						":ville" => $_POST['ville'],
						":haut" => $_POST['haut'],
						":bas" => $_POST['bas']	
					));
				}
				// On vérifie les checkbox checké
				if(isset($_POST['delete'])){
					foreach($_POST['checkdelete'] as $valeur)
						{
							$sql = $bdd->prepare("DELETE FROM meteo WHERE id='$valeur'");
							$sql->execute();
						}
				}
				
				$resultat = $bdd->query('SELECT * FROM meteo');
				
				// On affiche les données de la table
				echo "<form action='index.php' method='post'><table><tr><th>Supprimer</th><th>Ville</th><th>Haut</th><th>Bas</th></tr>";
				while ($donnees = $resultat->fetch())
				{
					echo "<tr><td><input value='". $donnees['id'] . "' name='checkdelete[]' type='checkbox'></td><td>". $donnees['ville'] . "</td><td>" . $donnees['haut'] . "</td><td>"  . $donnees['bas'] . " </td></tr>";
				}
				echo "</table><input type='submit' class='btn btn-primary' name='delete' value='Supprimer'></form>";

				
		
			}
			catch(Exception $e)
			{
				// En cas d'erreur, on affiche un message et on arrête tout
					die('Erreur : '.$e->getMessage());
			}
		?>
		<h2>Entrer de nouvelles données</h2>
		<form method="post" action="index.php">
			<div class="form-group">
				<label for="ChampVille">Ville</label>
				<input name="ville" type="text" class="form-control" id="ChampVille" placeholder="Ville">
				</div>

			<div class="form-group">
				<label for="ChampHaut">Haut</label>
				<input name="haut" type="text" class="form-control" id="ChampHaut" placeholder="Haut">
			</div>

			<div class="form-group">
				<label for="ChampBas">Bas</label>
				<input name="bas" type="text" class="form-control" id="ChampBas" placeholder="Haut">
			</div>

			<button name="submit" type="submit" class="btn btn-primary">Envoyer</button>
		</form>
		

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body> 
</html>