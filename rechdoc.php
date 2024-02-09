<?php
require_once('connexion.php');
$connexion = connect_bd();
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["email"])) {
    // Rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

// Supposons que vous avez une variable $niveau_acces qui contient le niveau d'accès de l'utilisateur
//  $niveau_acces = "super";

// if ($niveau_acces == "super") {
//     // Rediriger vers tableau de bord pour super administrateur
//     header("Location: tableaubord.php");
//     exit(); // Assurez-vous de terminer le script après la redirection
// } else {
//     // Rediriger vers tableau utilisateur pour les autres utilisateurs
//     header("Location: tableuser.php");
//     exit(); // Assurez-vous de terminer le script après la redirection
// }

$queryArchives = "SELECT DISTINCT nom, id_archive FROM archive";
$stmtArchives = $connexion->query($queryArchives);
$archives = $stmtArchives->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Recherche document</title>
 <link rel="stylesheet" href="style6.css" />
 <link rel="shortcut icon" type="image/png" href="archive.png">
 <style>
     a:hover {
      background-color: #45a095;
    }
    body{
        margin: 0;
      padding: 0;
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
 </style>
</head>
<body>
<ul class="menu" id="menu">
    <li><a href="tableaubord.php">Tableau de bord <img src="tb.png" alt="Icône Ajouter" width="25" height="25"></a></li>
    <li><a href="formdoc.php">Ajouter un document <img src="ad.png" alt="Icône Ajouter" width="25" height="25"></a></li>
    <li><a href="logout.php">Déconnexion <img src="dec.png" alt="Icône Ajouter" width="25" height="25"></a></li>
</ul>
 <form action="rechdoc_action.php" method="POST">
 <fieldset>
 <legend>Rechercher un Document</legend>
 <h4>Veuillez remplir les champs suivat</h4>
 <table>
    <tr>
   <td> <label>Choisir l'archive</label></td>
   <td>
   <select name="archive" id="archive">
    <?php
    foreach ($archives as $archive) {
        echo "<option value='{$archive['id_archive']}'>{$archive['nom']}</option>";
    }
    ?>
</select>
 <td><label for="critere">Critère:</label></td>
 <td>
 <select name="critere"  id="" >
 <option value="id_document">N° de série de document</option>
 <option value="numero_doc">Numéro de document</option>
 <option value="auteur">Auteur</option>
 <option value="annee_scolaire">Année scolaire</option>
 <option value="nom">Nom</option>
 <!-- <option value="id_archive">Numéro d'archive</option> -->

 </select>
 </td>
 </tr>
 <tr>
 <td><label for="valeur">Valeur</label></td>
 <td><input type="text" name="valeur" required></td>
 </tr>
 <tr>
 <td>
 <input type="submit" value="Recherche">
 </td>
 <td>
 <input type="reset" value="Annuler">
 </td>
 </tr>
 </table>
 </fieldset>
 </form>
</body>
</html>