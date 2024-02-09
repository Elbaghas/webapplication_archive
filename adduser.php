<?php
require_once('connexion.php');
$connexion = connect_bd();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hasher le mot de passe
    $niveau_acces = $_POST['niveau_acces'];

    // Préparer et exécuter la requête SQL d'insertion
    $requete = "INSERT INTO utilisateurs (nom, email, mot_de_passe, niveau_acces) VALUES (:nom, :email, :mot_de_passe, :niveau_acces)";
    $stmt = $connexion->prepare($requete);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->bindParam(':niveau_acces', $niveau_acces);

    if ($stmt->execute()) {
        echo "Utilisateur ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 50%;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #008B8B;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #006666;
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

        /* Ajoutez des styles supplémentaires selon vos besoins */
    </style>
</head>
<body>
<ul class="menu" id="menu">
        <li><a href="tableaubord.php">Tableau de bord <img src="tb.png" alt="Icône Ajouter" width="25" height="25"></a></li>
        <li><a href="logout.php">Déconnexion <img src="dec.png" alt="Icône Ajouter" width="25" height="25"></a></li>
    </ul>
    <h1>Ajouter un Utilisateur</h1>

    <form method="post" action="">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            <input type="checkbox" id="showPassword" onclick="togglePassword()">
            <label for="showPassword">Afficher le mot de passe</label>
        </div>

        <div>
            <label for="niveau_acces">Niveau d'accès :</label>
            <select id="niveau_acces" name="niveau_acces">
                <option value="super">Admin</option>
                <option value="user">Utilisateur</option>
            </select>
        </div>

        <div>
            <input type="submit" value="Ajouter" name="sub">
        </div>
    </form>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("mot_de_passe");
            var toggleCheckbox = document.getElementById("showPassword");

            if (toggleCheckbox.checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>
