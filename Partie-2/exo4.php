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
	<?php
    /* UPDATE `clients` SET `lastName` = 'Perr' WHERE `clients`.`id` = 22;  */
			try
			{
				// On se connecte à MySQL
				$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'root');	

				if(isset($_POST['submit'])) {
					
					// On récupère les données du formulaire
					
					$req = $bdd->prepare('UPDATE clients SET lastName = :lastName, firstName = :firstName,birthDate = :birthDate,cards = :cards,cardNumber = :cardNumber WHERE clients.id = "22"');

					$req->execute(array(
						":lastName" => $_POST['lastname'],
						":firstName" => $_POST['firstname'],
						":birthDate" => $_POST['birthdate'],
						":cards" => $_POST['cardl'],
						":cardNumber" => $_POST['cardnumber']	
					));
                } 
			   $reponse = $bdd->query('SELECT * FROM clients WHERE id = "22";');
			           
                
			}
			catch(Exception $e)
			{
				// En cas d'erreur, on affiche un message et on arrête tout
					die('Erreur : '.$e->getMessage());
			}
		?>
        
		<h2>Modifier les données de Gabriel</h2>
		<form method="post" action="exo4.php">
			<div class="form-group">
				<label for="FieldName">Nom</label>
				<input name="lastname" type="text" value='<?php 
				$test = $bdd->query('SELECT lastName FROM clients WHERE clients.id = "22";') ; 
				while ($donnees = $test->fetch())
                        {
                            echo $donnees['lastName'];
                        }
				?>' 
				class="form-control" id="FieldName" placeholder="Nom"> 
                    
          
			</div>

			<div class="form-group">
				<label for="FieldFirstname">Prénom</label>
				<input name="firstname" type="text" value='<?php 
				$test = $bdd->query('SELECT firstName FROM clients WHERE clients.id = "22";') ; 
				while ($donnees = $test->fetch())
                        {
                            echo $donnees['firstName'];
                        }
				?>'
				class="form-control" id="FieldFirstname" placeholder="Prénom">
			</div>

			<div class="form-group">
				<label for="FieldBirthdate">Date de naissance</label>
				<input name="birthdate" type="text" value='<?php 
				$test = $bdd->query('SELECT birthDate FROM clients WHERE clients.id = "22";') ; 
				while ($donnees = $test->fetch())
                        {
                            echo $donnees['birthDate'];
                        }
				?>'
				class="form-control" id="FieldBirthdate" placeholder="Date de naissance">
			</div>

            <div class="form-group">
                <label for="FieldCard">Carte de fidélité</label>
                <input type="radio" name="cardl" value="1" <?php 
				$test = $bdd->query('SELECT cards FROM clients WHERE clients.id = "22";') ; 
				while ($donnees = $test->fetch())
                        {
                            if($donnees['cards'] == "1"){
								echo "checked";
							}
                        }
				 ?> /> Oui<br />
				<input type="radio" name="cardl" value="0" <?php 
				while ($donnees = $test->fetch())
                        {
                            if($donnees['cards'] == "1"){
								echo "checked";
							}
                        }
				 ?> /> Non<br />
            </div>

            <div class="form-group">
                <label for="FieldCardNumber">Numéro de carte</label>
                <input name="cardnumber" type="number" value='<?php 
				$test = $bdd->query('SELECT cardNumber FROM clients WHERE clients.id = "22";') ; 
				while ($donnees = $test->fetch())
                        {
                            echo $donnees['cardNumber'];
                        }
				?>'
				class="form-control" id="FieldCardNumber" placeholder="Numéro de carte">
            </div>

			<button name="submit" type="submit" class="btn btn-primary">Envoyer</button>
		</form>
		

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body> 
</html>