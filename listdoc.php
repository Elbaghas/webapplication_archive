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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des documents</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" type="image/png" href="archive.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table.center {
            width: 60%;
            margin: 30px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 6px;
        }

        th {
            background-color: #008B8B;
            color: white;
            font-weight: bold;
        }

        table.center th {
            font-weight: bold;
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
            background-color: #008B8B;
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

        h1 {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <ul class="menu" id="menu">
        <li><a href="tableaubord.php">Tableau de bord <img src="tb.png" alt="Icône Ajouter" width="25" height="25"></a></li>
        <li><a href="generpdf.php">Importer le contenu de la base de donnée <img src="pdf1.png" alt="Icône Ajouter" width="25" height="25"></a></li>
        <li><a href="formdoc.php">Ajouter un document <img src="ad.png" alt="Icône Ajouter" width="25" height="25"></a></li>
        <li><a href="rechdoc.php">Rechercher un document <img src="chercher.png" alt="Icône Ajouter" width="25" height="25"></a></li>
        <li><a href="logout.php">Déconnexion <img src="dec.png" alt="Icône Ajouter" width="25" height="25"></a></li>
    </ul>
    <h1>Liste des documents</h1>
    <div class="container">
        <?php
        require_once('connexion.php');
        $connexion = connect_bd();
        $sql = "SELECT * FROM document";
        if (!$connexion->query($sql)) {
            echo "Pb d'accès à la table document";
        } else {
        ?>

        <table class="center" id="jolie">
            <tr>
                <td>ID Document</td>
                <td>Numéro de document</td>
                <td>Date de document</td>
                <td>Auteur</td>
                <td>Fichier PDF</td>
            </tr>
            <?php
            foreach ($connexion->query($sql) as $row) {
                echo "<tr>";
                echo "<td>".$row['id_document']."</td>";
                echo "<td>".$row['numero_doc']."</td>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['auteur']."</td>";
                echo "<td><a href='doc/".$row['nom'].".pdf' target='_blank'>Voir le PDF</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <?php } ?>
    </div>
    <br>
    <!-- <a href="tableaubord.php" target="_self">Aller au tableau de bord</a> -->
</body>
</html>
