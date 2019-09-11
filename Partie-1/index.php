<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="style.css" rel="stylesheet">
        <title>Partie 1 - Exo</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            .sepa{
                border: 1px solid black;
                margin-bottom: 10px;
                padding: 10px;
            }
        </style>
    </head>
	
	<body>
	<div class="container">
	<h1>Exercice partie 1 SQL</h1>
	<?php
			try
			{
				// On se connecte à MySQL
				$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'root');	

			    // On affiche les clients
				$resultat1 = $bdd->query('SELECT * FROM colyseum.clients');
				
                echo "<h2>Tout les clients:</h2><p>";
				while ($donnees1 = $resultat1->fetch())
				{
					echo $donnees1['lastName'] . " " . $donnees1['firstName'] . ", ";
                }
                echo "</p>";

                // On affiche les types de spectacles
				$resultat2 = $bdd->query('SELECT * FROM colyseum.showTypes');
				
                echo "<h2>Tout les spectacles:</h2><p>";
				while ($donnees2 = $resultat2->fetch())
				{
					echo $donnees2['type'] . ", " ;
                }
                echo "</p>";
				
				// On affiche les 20 premiers clients
				$resultat3 = $bdd->query('SELECT * FROM colyseum.clients LIMIT 0,20');
				
                echo "<h2>Les 20 premiers clients:</h2><p>";
				while ($donnees3 = $resultat3->fetch())
				{
					echo $donnees3['lastName'] . " " . $donnees3['firstName'] . ", ";
                }
                echo "</p>";
                
                // On affiche les clients avec une carte de fidélité
                $resultat4 = $bdd->query('SELECT * FROM colyseum.clients WHERE colyseum.clients.cardNumber != "NULL"');
				
                echo "<h2>Les clients avec carte de fidélité:</h2><p>";
				while ($donnees4 = $resultat4->fetch())
				{
					echo $donnees4['lastName'] . " " . $donnees4['firstName'] . ", ";
                }
                echo "</p>";

                // Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M".
                $resultat5 = $bdd->query('SELECT * FROM colyseum.clients WHERE colyseum.clients.lastName LIKE "M%" ORDER BY colyseum.clients.lastName ASC');
				
                echo "<h2>Les clients donc le nom commence par M:</h2>";
				while ($donnees5 = $resultat5->fetch())
				{
					echo "<p>Nom: " . $donnees5['lastName'] . " / Prénom: " . $donnees5['firstName'] . "</p>";
                }

                // On affiche les spectacles
				$resultat6 = $bdd->query('SELECT * FROM colyseum.shows ORDER BY colyseum.shows.title ASC');
				
                echo "<h2>Tout les spectacles:</h2><p>";
				while ($donnees6 = $resultat6->fetch())
				{
					echo "<p>" . $donnees6['title'] . " par " . $donnees6['performer'] . ", le " . $donnees6['dateShow'] . " à " . $donnees6['startTime'] . "</p>" ;
                }
                echo "</p>";

                // Affichage de tout les clients
                $resultat7 = $bdd->query('SELECT * FROM colyseum.clients');
				
                echo "<h2>Tout les clients:</h2><div class='row'>";
				while ($donnees7 = $resultat7->fetch())
				{
                    echo "<div class='col-4'><div class='sepa'>" . 
                        "<p>Nom: " . $donnees7['lastName'] . " </p>" . 
                        "<p>Prénom: " . $donnees7['firstName'] . " </p>" . 
                        "<p>Date de naissance: " . $donnees7['birthDate'] . " </p>"; 
                        

                    if ($donnees7['card'] == '1'){
                        echo "<p>Carte de fidélité: Oui</p>" .
                        "<p>Numéro de carte: " . $donnees7['cardNumber'] . " </p>";
                    } else {
                        echo "<p>Carte de fidélité: Non</p>";
                    }
                    
                    echo "</div></div>";
                }
                echo "</div>";
            }
            
			catch(Exception $e)
			{
				// En cas d'erreur, on affiche un message et on arrête tout
					die('Erreur : '.$e->getMessage());
			}
		?>
		

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body> 
</html>