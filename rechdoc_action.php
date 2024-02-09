<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require_once('connexion.php');
$connexion = connect_bd();

$critere = $_POST['critere'];
$valeur = $_POST['valeur'];

// Récupérer l'ID de l'archive depuis le formulaire
$id_archive = $_POST['archive'];

$requete = "SELECT * FROM document WHERE $critere = :valeur AND id_archive = :id_archive";
$stmt = $connexion->prepare($requete);
$stmt->bindParam(':valeur', $valeur);
$stmt->bindParam(':id_archive', $id_archive);
$stmt->execute();

$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Afficher le contenu HTML
?>
<!DOCTYPE html>
<html lang="fr">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Liste des documents</title>
 <link rel="stylesheet" href="style5.css" />
 <link rel="shortcut icon" type="image/png" href="archive.png">
</head>
<style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    a:hover {
      background-color: #45a095;
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

    a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
    
    /* a:hover {
      background-color: #45a049;
    } */
  </style>
<body>
<ul class="menu" id="menu">
    <li><a href="tableaubord.php">Tableau de bord <img src="tb.png" alt="Icône Ajouter" width="25" height="25"></a></li>
    <li><a href="formdoc.php">Ajouter un document <img src="ad.png" alt="Icône Ajouter" width="25" height="25"></a></li>
    <li><a href="logout.php">Déconnexion <img src="dec.png" alt="Icône Ajouter" width="25" height="25"></a></li>
</ul>
<h1>Liste des documents</h1>
<div class="container">
<?php
if (count($documents) > 0) {
    echo "<table class='centre' id='jolie'>
            <tr>
                <td>Id Document</td>
                <td>Nom</td>
                <td>Numéro de document</td>
                <td>Année scolaire</td>
                <td>Auteur</td>
                <td>Le fichier PDF</td>
            </tr>";
    foreach ($documents as $row) {
        echo "<tr>
                <td>".$row['id_document']."</td>
                <td>".$row['nom']."</td>
                <td>".$row['numero_doc']."</td>
                <td>".$row['annee_scolaire']."</td>
                <td>".$row['auteur']."</td>
                <td><a href='doc/".$row['nom'].".pdf' target='_blank'>Voir le PDF</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Aucun document trouvé.";
}

// // Vérifier si l'utilisateur est connecté et a un niveau d'accès
// if (isset($_SESSION["email"]) && isset($_SESSION["niveau_acces"])) {
//     $niveau_acces = $_SESSION["niveau_acces"];

//     // Afficher le lien vers le tableau de bord en fonction du niveau d'accès
//     if ($niveau_acces == 'super') {
//         echo "<br>";
//         echo '<a href="tableaubord.php" target="_self">Aller au tableau de bord du super utilisateur</a>';
//     } elseif ($niveau_acces == 'user') {
//         echo "<br>";
//         echo '<a href="tableuser.php" target="_self">Aller au tableau de bord de l\'utilisateur</a>';
//     }
// } else {
//     echo "Veuillez vous connecter pour accéder au tableau de bord.";
// }
?>
</div>
</body>
</html>
