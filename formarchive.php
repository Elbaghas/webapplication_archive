<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["email"])) {
    // Rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Nouveau Archive</title>
<link rel="stylesheet" href="style3.css" />
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
</style>
</head>
<body>
<!-- <img src="esef.png"> -->
<ul class="menu" id="menu">
    <li><a href="tableaubord.php">Tableau de bord <img src="tb.png" alt="Icône Ajouter" width="25" height="25"></a></li>
    <li><a href="logout.php">Déconnexion <img src="dec.png" alt="Icône Ajouter" width="25" height="25"></a></li>
</ul>
<h1> Ajouter un nouveau archive </h1>
<form method="POST" action="newarchive.php"> 
<table align="center">

<tr>
<td align="right"> Nom</td>
<td><input type="text" name="nom" required></td>
</tr>
<tr>
<td align="right">Date de création:</td>
<td><input type="date" name="date_creation" required></td>
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