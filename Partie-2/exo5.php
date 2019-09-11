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
    
			try
			{
				// On se connecte à MySQL
				$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'root');	
				
				if(isset($_POST['title']) && isset($_POST['performer']) && isset($_POST['dateShow']) && isset($_POST['showTypesId']) && isset($_POST['firstGenresId']) && isset($_POST['secondGenreId']) && isset($_POST['duration']) && isset($_POST['startTime'])) {
					
					// On récupère les données du formulaire
					
					$req = $bdd->prepare('UPDATE shows SET title = :title, performer = :performer, dateShow = :dateShow, showTypesId = :showTypesId, firstGenresId = :firstGenresId, secondGenreId = :secondGenreId, duration = :duration, startTime = :startTime WHERE shows.id = "22"');

					$req->execute(array(
						":title" => $_POST['title'],
						":performer" => $_POST['performer'],
						":dateShow" => $_POST['dateShow'],
						":showTypesId" => $_POST['showTypesId'],
						":firstGenresId" => $_POST['firstGenresId'],
						":secondGenreId" => $_POST['secondGenreId'],
						":duration" => $_POST['duration'],
						":startTime" => $_POST['startTime']
					));
                } 
			           
                
			}
			catch(PDOException $e)
			{
				// En cas d'erreur, on affiche un message et on arrête tout
					die('Erreur : '.$e->getMessage());
			}
		?>
        
		<h2>Modifier les données d'un spectacle</h2>
		<form method="post" action="exo5.php">
			<div class="form-group">
				<label>Nom</label>
				<input name="title" type="text" value='<?php 
				$test = $bdd->query('SELECT * FROM shows WHERE shows.id = "1";') ; 
				while ($donnees = $test->fetch())
                        {
                            echo $donnees['title'];
                        }
				?>' 
				class="form-control" placeholder="Titre"> 
                    
          
			</div>

			<div class="form-group">
				<label>Artiste</label>
				<input name="performer" type="text" value='<?php 
				$test = $bdd->query('SELECT * FROM shows WHERE shows.id = "1";') ; 
				while ($donnees = $test->fetch())
                        {
                            echo $donnees['performer'];
                        }
				?>'
				class="form-control" placeholder="Artiste">
			</div>

			<div class="form-group">
				<label>Date</label>
				<input name="dateShow" type="date" value='<?php 
				$test = $bdd->query('SELECT * FROM shows WHERE shows.id = "1";') ; 
				while ($donnees = $test->fetch())
                        {
                            echo $donnees['dateShow'];
                        }
				?>'
				class="form-control" placeholder="Date">
			</div>

            <div class="form-group">
                <label>Type</label>
                <select name="showTypesId">
				<?php 
					$test = $bdd->query('SELECT * FROM shows WHERE shows.id = "1";') ; 
					while ($donnees = $test->fetch())
					{
						$numero = $donnees['showTypesId'];
					}
						

					$resultat = $bdd->query("SELECT * FROM showTypes");
					while ($donnees = $resultat->fetch())
					{
						echo "<option value='" . $donnees['id'] . "' ";
						if($donnees['id'] == $numero){
							echo "selected";
						}
						echo ">" . $donnees['type'] . "</option>";		
					} 
				
				?>
				</select>
            </div>

            <div class="form-group">
                <label>Genre 1</label>
                <select name="firstGenresId">
				<?php 
					$test = $bdd->query('SELECT * FROM shows WHERE shows.id = "1";') ; 
					while ($donnees1 = $test->fetch())
					{
						$numero1 = $donnees1['firstGenresId'];
					}
						

					$resultat1 = $bdd->query("SELECT * FROM genres");
					while ($donnees1 = $resultat1->fetch())
					{
						echo "<option value='" . $donnees1['id'] . "' ";
						if($donnees1['id'] == $numero1){
							echo "selected";
						}
						echo ">" . $donnees1['genre'] . "</option>";		
					} 
				
				?>
				</select>
            </div>

			<div class="form-group">
				<label>Genre 2</label>
                <select name="secondGenreId">
				<?php 
					$test = $bdd->query('SELECT * FROM shows WHERE shows.id = "1";') ; 
					while ($donnees2 = $test->fetch())
					{
						$numero2 = $donnees2['secondGenreId'];
					}
						

					$resultat2 = $bdd->query("SELECT * FROM genres");
					while ($donnees2 = $resultat2->fetch())
					{
						echo "<option value='" . $donnees2['id'] . "' ";
						if($donnees2['id'] == $numero2){
							echo "selected";
						}
						echo ">" . $donnees2['genre'] . "</option>";		
					} 
				
				?>
				</select>
			</div>

			<div class="form-group">
				<label>Durée</label>
				<input name="duration" type="time" value='<?php 
				$test = $bdd->query('SELECT * FROM shows WHERE shows.id = "1";') ; 
				while ($donnees = $test->fetch())
						{
							echo $donnees['duration'];
						}
				?>'
				class="form-control" placeholder="Durée">
			</div>

			<div class="form-group">
				<label>Heure de début</label>
				<input name="startTime" type="time" value='<?php 
				$test = $bdd->query('SELECT * FROM shows WHERE shows.id = "1";') ; 
				while ($donnees = $test->fetch())
						{
							echo $donnees['startTime'];
						}
				?>'
				class="form-control" placeholder="Heure de début">
			</div>

			<button name="submit" type="submit" class="btn btn-primary">Envoyer</button>
		</form>
		

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body> 
</html>