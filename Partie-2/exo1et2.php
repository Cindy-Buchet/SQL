<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            label{
                display: block;
            }
            .choix{
                display: grid;
                grid-template-columns: 25px 300px;
                width: 100%;
                float: left;
            }

            .choix input{
                grid-column: 1;
            }
            .choix label{
                grid-column: 2;
            }
        </style>
    </head>
	
	<body>
	<div class="container">
	<h1>Premier exercice SQL</h1>
	<?php
			try
			{
				// On se connecte à MySQL
				$bdd = new PDO('mysql:host=localhost;dbname=exercice;charset=utf8', 'root', 'root');	

				if(isset($_POST['submit'])) {
					
					// On récupère les données du formulaire
					
					$req = $bdd->prepare('INSERT INTO clients(lastname,firstname,birthdate,cardl,cardnumber) VALUES(:lastname,:firstname,:birthdate,:cardl,:cardnumber)');
					/*
					if ($_POST['cardl'] == "1"){
						$cardnum = $_POST['cardnumber'];
					} else if ($_POST['cardl'] == "0"){
						$cardnum = "NULL";
					} "
					*/
					if ($_POST['cardl'] == ""){
						$cardnum = NULL;
					} else {
						$cardnum = $_POST['cardl'];
					}
					$req->execute(array(
						":lastname" => $_POST['lastname'],
						":firstname" => $_POST['firstname'],
						":birthdate" => $_POST['birthdate'],
						":cardl" => $_POST['cardl'],
						":cardnumber" => $cardnum
					));
				}
				
				$resultat = $bdd->query('SELECT * FROM clients');
				
				// On affiche les données de la table
				while ($donnees = $resultat->fetch())
				{
                    echo "<p>". $donnees['firstname'] . " " . $donnees['lastname'] . " née le "  . $donnees['birthdate'];
                    
                    if ($donnees['cardl'] == '1'){
                        echo " et possédant une carte de fidélité avec le numéro " . $donnees['cardnumber'] . " </p>";
                    } else {
                        echo " et ne possédant pas de carte de fidélité</p>";
                    }
				}
		
			}
			catch(Exception $e)
			{
				// En cas d'erreur, on affiche un message et on arrête tout
					die('Erreur : '.$e->getMessage());
			}
		?>
		<h2>Entrer de nouvelles données</h2>
		<form method="post" action="exo1et2.php">
			<div class="form-group">
				<label for="FieldName">Nom</label>
				<input name="lastname" type="text" class="form-control" id="FieldName" placeholder="Nom">
			</div>

			<div class="form-group">
				<label for="FieldFirstname">Prénom</label>
				<input name="firstname" type="text" class="form-control" id="FieldFirstname" placeholder="Prénom">
			</div>

			<div class="form-group">
				<label for="FieldBirthdate">Date de naissance</label>
				<input name="birthdate" type="text" class="form-control" id="FieldBirthdate" placeholder="Date de naissance">
			</div>

            <div class="form-group">
                <label for="FieldCard">Carte de fidélité</label>
                <input type="radio" name="cardl" value="1" /> Oui<br />
				<input type="radio" name="cardl" value="0" /> Non<br />
            </div>

            <div class="form-group">
                <label for="FieldCardNumber">Numéro de carte</label>
                <input name="cardnumber" type="number" class="form-control" id="FieldCardNumber" placeholder="Numéro de carte">
            </div>

			<button name="submit" type="submit" class="btn btn-primary">Envoyer</button>
		</form>
		

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body> 
</html>