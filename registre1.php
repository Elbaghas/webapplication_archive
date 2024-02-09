<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="style6.css" />
    <link rel="shortcut icon" type="image/png" href="archive.png">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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

        .box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
        }

        .box-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .box-title {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .box-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        select, .box-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .box-button {
            width: 100%;
            padding: 10px;
            background-color: #008B8B;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .box-button:hover {
            background-color: #006666;
        }

        .box-register {
            text-align: center;
            margin-top: 20px;
        }

        .box a {
            color: #008B8B;
            text-decoration: none;
        }

        .box a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- <ul class="menu" id="menu">
        <li><a href="tableaubord.php">Tableau de bord <img src="tb.png" alt="Icône Ajouter" width="25" height="25"></a></li>
        <li><a href="logout.php">Déconnexion <img src="dec.png" alt="Icône Ajouter" width="25" height="25"></a></li>
    </ul> -->

    <?php
    require('config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $niveau = mysqli_real_escape_string($conn, $_POST['niveau_acces']);

        $hashed_password = hash('sha256', $password);

        $query = "INSERT INTO `utilisateurs` (nom, email, mot_de_passe, niveau_acces)
                  VALUES (?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $nom, $email, $hashed_password, $niveau);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            echo "<div class='success'>
                  <h3>Utilisateur ajouté avec succès.</h3>
                  </div>";
        } else {
            echo "<div class='error'>
                  <h3>Une erreur s'est produite lors de l'ajout.</h3>
                  </div>";
        }
    }
    ?>

    <form class="box" action="" method="post">
        <!-- <h1 class="box-logo box-title">Application gestion d'archive</h1> -->
        <h1 class="box-title">S'inscrire</h1>
        <input type="text" class="box-input" name="nom" placeholder="Nom Complet" required />
        <input type="text" class="box-input" name="email" placeholder="Email" required />
        <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
        <input type="checkbox" id="showPassword" onclick="togglePassword()">
        <label for="showPassword">Afficher le mot de passe</label>
        <br>
        <label for="niveau_acces">Niveau d'accès:</label>
        <select name="niveau_acces" required>
            <option value="user">Utilisateur</option>
            <!-- <option value="super">Super Utilisateur</option> -->
        </select>
       
        <br>
        <script>
            function togglePassword() {
                var passwordField = document.querySelector(".box-input[type='password']");
                passwordField.type = (passwordField.type === "password") ? "text" : "password";
            }
        </script>
        <input type="submit" name="submit" value="Valider" class="box-button" />
        <!-- <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p> -->
    </form>
</body>
</html>
