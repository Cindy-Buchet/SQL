<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Ajouter un spectacle</title>
</head>
<body>
<section class="container">
    <h1>Ajouter un spectacle</h1>
        <?php
			try
			{
				// On se connecte à MySQL
				$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'root');	

				if(isset($_POST['submit'])) {
					
					// On récupère les données du formulaire
					$req = $bdd->prepare('INSERT INTO shows (title,performer,dateShow,showTypesId,firstGenresId,secondGenreId,duration,startTime) VALUES(:title,:performer,:dateShow,:showTypesId,:firstGenresId,:secondGenreId,:duration,:startTime)');
					
					$req->execute(array(
                        ":title" => $_POST['InfoTitre'],
						":performer" => $_POST['InfoArtiste'],
                        ":dateShow" => $_POST['InfoDate'],
                        ":showTypesId" => $_POST['InfoType'],
                        ":firstGenresId" => $_POST['InfoGenre1'],
                        ":secondGenreId" => $_POST['InfoGenre2'],
                        ":duration" => $_POST['InfoDuree'],
                        ":startTime" => $_POST['InfoHeure']	
                        
                    ));
                    
    
				}
			}
			catch(Exception $e)
			{
				// En cas d'erreur, on affiche un message et on arrête tout
					die('Erreur : '.$e->getMessage());
			}
		?>

        <form method="post" action="exo3.php">
			<div class="form-group">
				<label>Titre</label>
				<input name="InfoTitre" type="text" class="form-control" placeholder="Titre">
			</div>

			<div class="form-group">
				<label>Artiste</label>
				<input name="InfoArtiste" type="text" class="form-control" placeholder="Artiste">
			</div>

			<div class="form-group">
				<label>Date</label>
				<input name="InfoDate" type="date" class="form-control" placeholder="Date">
			</div>

            <div class="form-group">
                <label>Type de spectacle</label>
                <?php
                    $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'root');	
                    $resultat3 = $bdd->query('SELECT * FROM showTypes');
                    echo "<select class='form-control' name='InfoType' size='1'>";
                        while ($donnees3 = $resultat3->fetch())
                        {
                            echo "<option value='". $donnees3['id'] . "' />" . $donnees3['type'] . "</option>";
                        }
                    echo "</select>";
                ?>
            </div>

            <div class="form-group">
                <label>Genre 1</label>
                <?php
                    $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'root');	
                    $resultat1 = $bdd->query('SELECT * FROM genres');
                    echo "<select class='form-control' name='InfoGenre1' size='1'>";
                        while ($donnees1 = $resultat1->fetch())
                        {
                            echo "<option value='". $donnees1['id'] . "' />" . $donnees1['genre'] . "</option>";
                        }
                    echo "</select>";
                ?>
            
            </div>

            <div class="form-group">
                <label>Genre 2</label>
                <?php
                    $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'root');	
                    $resultat2 = $bdd->query('SELECT * FROM genres');
                    echo "<select class='form-control' name='InfoGenre2' size='1'>";
                        while ($donnees2 = $resultat2->fetch())
                        {
                            echo "<option value='". $donnees2['id'] . "' />" . $donnees2['genre'] . "</option>";
                        }
                    echo "</select>";
                ?>
            </div>

            <div class="form-group">
                <label>Durée</label>
                <input name="InfoDuree" type="text" class="form-control" placeholder="Durée">
            </div>

            <div class="form-group">
                <label>Heure de début</label>
                <input name="InfoHeure" type="text" class="form-control" placeholder="Heure de début">
            </div>

			<button name="submit" type="submit" class="btn btn-primary">Envoyer</button>
		</form>

</section>
</body>
</html>