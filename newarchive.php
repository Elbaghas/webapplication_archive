<?php
require_once('connexion.php');
$connexion = connect_bd();
// if (!isset($_SESSION["email"])) {
//   // Rediriger vers la page de connexion
//   header("Location: login.php");
//   exit();
// }
$nom = $_POST['nom'];
$date_creation = $_POST['date_creation'];
$query = "INSERT INTO archive (id_archive, nom, date_creation)
          VALUES (:id_archive, :nom, :date_creation)";
$stmt = $connexion->prepare($query);
$stmt->bindParam(':id_archive', $id_archive);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':date_creation', $date_creation);
if ($stmt->execute()) {
    $id_archive = $connexion->lastInsertId();
    echo "L'archive a été insérée avec succès. Sous le numéro :<br>" . $id_archive;
    echo "<br>Veuillez renseigner votre Document ID";
} else {
    echo "Une erreur s'est produite lors de l'insertion de l'archive.";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Insertion d'une archive</title>
  <link rel="shortcut icon" type="image/png" href="archive.png">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
    
    a:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
<br>
<a href="tableaubord.php" target="_self">Aller au tableau de bord</a>
</body>
</html>
