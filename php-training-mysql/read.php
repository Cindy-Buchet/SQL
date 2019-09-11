<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <table>
      <?php

        try
        {
          // On se connecte à MySQL
          $bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8', 'root', 'root');	

          
          $resultat = $bdd->prepare('SELECT * FROM hiking');
          $resultat->execute();
          echo "<tr><th>Supprimer</th><th>Nom</th><th>Difficulté</th><th>Distance</th><th>Duration</th><th>Dénivélé</th></tr>";
          
          while ($donnees = $resultat->fetch())
          {
            echo 
            "<tr><td>
                <a href='delete.php?supp=". $donnees['id'] . "'>" . "X" . "</a>
            </td>".
            
            "<td>".
                "<a href='update.php?numero=".$donnees['id']."'>" . $donnees['name_hiking'] . "</a>".
            "</td><td>" . 
            $donnees['difficulty'] . "</td><td>"  . 
            $donnees['distance'] . "</td><td>"  . 
            $donnees['duration'] . "</td><td>"  . 
            $donnees['height_difference'] . "</td></tr>";
            
          }
          
        }

        catch(Exception $e)
        {
          // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
        }

      ?>

    </table>
  </body>
</html>
