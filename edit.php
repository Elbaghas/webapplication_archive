<!-- <?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION["email"])) {
    // Rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

// Récupérer les informations de l'utilisateur à partir de la session
$id = $_SESSION["id"];
$nom = $_SESSION["nom"];
$email = $_SESSION["email"];
$niveau_acces = $_SESSION["niveau_acces"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
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

        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h1>Mon Compte</h1>

    <table>
        <tr>
            <th>ID</th>
            <td><?php echo $id; ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?php echo $nom; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $email; ?></td>
        </tr>
        <tr>
            <th>Niveau d'accès</th>
            <td><?php echo $niveau_acces; ?></td>
        </tr>
    </table>

</body>
</html> -->
