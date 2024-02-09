<?php
session_start();
require_once('connexion.php');
$connexion = connect_bd();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["email"])) {
    // Rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

$queryArchives = "SELECT DISTINCT nom, id_archive FROM archive";
$stmtArchives = $connexion->query($queryArchives);
$archives = $stmtArchives->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Nouveau Document</title>
<link rel="stylesheet" href="style.css" />
<link rel="shortcut icon" type="image/png" href="archive.png">
<style>
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

    /* Ajout de la classe pour les champs obligatoires en rouge */
    
</style>
</head>
<body>
<ul class="menu" id="menu">
    <li><a href="tableaubord.php">Tableau de bord <img src="tb.png" alt="Icône Ajouter" width="25" height="25"></a></li>
    <li><a href="logout.php">Déconnexion <img src="dec.png" alt="Icône Ajouter" width="25" height="25"></a></li>
</ul>
<h1> Ajouter un nouveau document </h1>
<form method="POST" enctype="multipart/form-data" action="newdoc.php"> 
<table align="center">

<tr>
<td align="right"> Numéro de document</td>
<td><input type="text" name="numero_doc" ></td>
</tr>
<tr>
<td align="right"> Nom de document </td>
<td><input type="text" name="nom" class="required-field" required></td>
</tr>
<tr>
<td align="right"> Date de document</td>
<td><input type="date" name="date" class="required-field" required></td>
</tr>

<tr>
  <td align="right">Année Scolaire</td>
  <td>
    <select name="annee_scolaire" required>
      <?php
      $currentYear = date("Y");

      for ($i = 2019; $i <= 2030; $i++) {
        $startYear = $i;
        $endYear = $i + 1;
        $academicYear = "{$startYear}/{$endYear}";

        echo "<option value=\"$academicYear\">$academicYear</option>";
      }
      ?>
    </select>
  </td>
</tr>

<tr>
<td align="right">Auteur:</td>
<td><input type="text" name="auteur" class="required-field" required></td>
</tr>
<tr>
<td align="right">Pdf</td>
<td><input type="file" name="pdf" class="required-field" required></td>
</tr>

<tr>
   <td align="right"> <label>Archive</label></td>
   <td>
   <select name="id_archive" id="id_archive">
    <?php
    foreach ($archives as $archive) {
        echo "<option value='{$archive['id_archive']}'>{$archive['nom']}</option>";
    }
    ?>
</tr>

<tr>
<td></td>
<td align="center"><input class="btn1" type="submit" name="sub" value="Enregistrer"></td>
</tr>
<tr>
<td></td>
<td align="center"><input class="btn3" type="reset" name="rst" value="Annuler"></td>
</tr>
</form>
</table>
</body>
</html>
