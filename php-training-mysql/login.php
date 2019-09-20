<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
  <?php
    // On définit un login et un mot de passe de base pour tester notre exemple. Cependant, vous pouvez très bien interroger votre base de données afin de savoir si le visiteur qui se connecte est bien membre de votre site
    $login = $_POST['login'];
    $pwd = $_POST['pwd'];
    include('index.htm');

    // On se connecte à la DB
    $bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8', 'root', 'root');	


    // on vérifie si nos champs sont complets

    if (isset($_POST['login']) && isset($_POST['pwd'])) {
      
      $req = $bdd->prepare('SELECT id FROM user WHERE username = :username AND pass = :pass');
      
      $req->execute(array(
        'username' => $login,
        'pass' => $pwd));
      $resultat = $req->fetch();

      if (!$resultat) {
        // Mauvais mdp ou pseudo
        echo 'Mauvais identifiant ou mot de passe !';
      }
      else {
    		// dans ce cas, tout est ok, on peut démarrer notre session

    		// on la démarre :)
    		session_start ();
    		// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
    		$_SESSION['login'] = $_POST['login'];
    		$_SESSION['pwd'] = $_POST['pwd'];
        echo 'Vous êtes connecté !';

        
    		// on redirige notre visiteur vers une autre page
    		header ('location: read.php');
      }

    
    }
    else {
    	echo 'Les variables du formulaire ne sont pas déclarées.';
    }
    ?>
  </body>
</html>