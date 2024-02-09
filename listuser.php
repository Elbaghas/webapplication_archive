<?php
require_once('connexion.php');
$connexion = connect_bd();
?>
<?php
// Sélectionnez tous les utilisateurs depuis votre table d'utilisateurs
$query = "SELECT * FROM utilisateurs";
$stmt = $connexion->query($query);

// Récupérez les résultats sous forme de tableau associatif
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="archive.png">
    <title>Liste des Utilisateurs</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table.center {
            width: 60%; /* Faire en sorte que le tableau occupe 60% de la largeur disponible */
            margin: 30px auto; /* Centrez horizontalement avec une marge en haut */
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
            background-color:#008B8B;
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
        <li><a href="registre.php">Ajouter un nouvel utilisateur <img src="add-user.png" alt="Icône Ajouter" width="25" height="25"></a></li>
        <li><a href="logout.php">Déconnexion <img src="dec.png" alt="Icône Ajouter" width="25" height="25"></a></li>
    </ul>
    <h1>Liste des Utilisateurs</h1>

    <?php if (count($utilisateurs) > 0): ?>
        <table class="center">
            <tr>
                <th>ID Utilisateur</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Niveau d'accès</th>
                <!-- Ajoutez d'autres colonnes en fonction de votre schéma de base de données -->
            </tr>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?php echo $utilisateur['id']; ?></td>
                    <td><?php echo $utilisateur['nom']; ?></td>
                    <td><?php echo $utilisateur['email']; ?></td>
                    <td><?php echo $utilisateur['niveau_acces']; ?></td>
                    <!-- Ajoutez d'autres cellules en fonction de votre schéma de base de données -->
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>

</body>
</html>
