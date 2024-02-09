<?php

require_once('connexion.php');
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
  }
  // require_once('fonctions.php');
  
function annee_scolaire_actuelle()
{
    $mois = date("m");//Le mois de la date actuelle
    $annee_actuelle = date("Y");//L'année de la date actuelle
    if ($mois >= 9 && $mois <= 12) {
        $annee1 = $annee_actuelle;
        $annee2 = $annee_actuelle + 1;
    } else {
        $annee1 = $annee_actuelle - 1;
        $annee2 = $annee_actuelle;
    }

    $annee_scolaire_actuelle = $annee1 . "/" . $annee2;
    return $annee_scolaire_actuelle;
}

// Fonction pour récupérer le nombre de documents insérés
function getNombreDocuments()
{
    global $pdo;
    $res = $pdo->query("SELECT COUNT(*) as nombre_documents FROM document");
    $resultat = $res->fetch();
    return $resultat['nombre_documents'];
}

// Fonction pour récupérer le nombre d'archives insérées
function getNombreArchives()
{
    global $pdo;
    $res = $pdo->query("SELECT COUNT(*) as nombre_archives FROM archive");
    $resultat = $res->fetch();
    return $resultat['nombre_archives'];
}

$as = annee_scolaire_actuelle();
$nombreDocuments = getNombreDocuments();
$nombreArchives = getNombreArchives();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord</title>
  <link href="https://fonts.googleapis.com/css2?family=Anybody&display=swap" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="archive.png">

  <style>
    body {
      font-family: 'Roboto Slab', sans-serif;
      margin: 0;
      padding: 0;
    }

    #tb {
      color: #354035;
      font-family: 'serif';
      text-align: center;
    }

    /* .dashboard {
      background-image: url('archivee.jpg');
      padding: 20px;
    } */

    h1 {
      text-align: center;
    }

    .widget {
      background-color: #376124;
      padding: 10px;
      margin-bottom: 10px;
    }

    .widget h2 {
      margin-top: 0;
    }

    .widget p {
      margin-bottom: 0;
    }

    .logout-form {
      text-align: left;
      margin-bottom: 20px;
    }

    .logout-form input[type="submit"] {
      display: inline-block;
      padding: 10px 20px;
      background-color: #f44336;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .logout-form input[type="submit"]:hover {
      background-color: #d32f2f;
    }

    ul.menu {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color:#008B8B		;
    }

    ul.menu li {
      float: left;
    }

    ul.menu li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    ul.menu li a:hover {
      background-color: #696969;
    }

    ul.menu li img {
      margin-left: 5px;
      vertical-align: middle;
    }

    button#menu-button {
      display: block;
      margin: 10px;
      padding: 10px;
      cursor: pointer;
    }
    
    .tableau-stat {
        background-color: #f4f4f4;
        padding: 20px;
        margin-top: 20px;
        text-align: center;
    }

    h1.text-primary {
        color: #3498db;
    }

    .row {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .col-md-4 {
        flex: 0 0 30%; /* Ajustez la largeur des colonnes selon vos besoins */
        margin: 10px;
    }

    .stat {
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .document {
        background-color: #27ae60; /* Couleur pour "Nombre de document inséré" */
        color: #fff;
    }

    .archive {
        background-color: #e74c3c; /* Couleur pour "Nombre d'Archive" */
        color: #fff;
    }

    .fa-users {
        font-size: 30px;
        margin-bottom: 10px;
    }

    .effectif {
        font-size: 16px;
    }

    .nbr {
        font-size: 24px;
        font-weight: bold;
        margin-top: 10px;
    }


  </style>
</head>
<body>


<!-- Menu -->
<ul class="menu" id="menu">
    <li><a href="listdoc.php">Documents Insérés <img src="doc.png" alt="Icône Ajouter" width="25" height="25"></a></li>
        <!-- Afficher le menu complet pour le niveau "super" -->
        <!-- <li><a href="listarchive.php">Archives <img src="archiver.png" alt="Icône Ajouter" width="25" height="25"></a></li> -->
        <!-- <li><a href="edit.php">Mon Compte <img src="compte.png" alt="Icône Ajouter" width="25" height="25"></a></li> -->
        <!-- <li><a href="listuser.php">Les utilisateurs <img src="Muser.png" alt="Icône Ajouter" width="25" height="25"></a></li> -->
    <li><a href="logout.php">Déconnexion <img src="dec.png" alt="Icône Ajouter" width="25" height="25"></a></li>
</ul>

<!-- <script>
  document.addEventListener("DOMContentLoaded", function () {
      const menuButton = document.getElementById("menu-button");
      const menu = document.getElementById("menu");

      if (menuButton && menu) {
          menuButton.addEventListener("click", function () {
              menu.classList.toggle("show-menu");
          });

          // Fermer le menu lorsqu'on clique sur un élément du menu
          const menuItems = menu.getElementsByTagName("a");
          for (const item of menuItems) {
              item.addEventListener("click", function () {
                  menu.classList.remove("show-menu");
              });
          }
      }
  });
</script> -->

<h1 id="tb">Bienvenue <?php echo $_SESSION['email']; ?>!</h1>

<div class="container  tableau-stat text-center">
    <h1 class="text-center text-primary">Statistiqus de l'archive pour l'année scolaire <?php echo $as ?></h1>
    <div class="row">

        <!-- ************ Total des inscrits en 1ère année et 2ème année ******************  -->

        <div class="col-md-4">
            <div class="stat stat12">
                <span class="fa fa-users"></span>
                <div class="effectif">
                    Nombre de document insérer
                    <div class="nbr"><?php echo $nombreDocuments ?></div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="stat stat12">
                <span class="fa fa-users"></span>
                <div class="effectif">
                    Nombre d'Archive
                    <div class="nbr"><?php echo $nombreArchives ?></div>
                </div>

            </div>
        </div>
</body>
</html>
