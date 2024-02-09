<?php
require_once('connexion.php');
$connexion = connect_bd();

session_start();

if (isset($_POST['sub'])) {
    $numero_doc = $_POST['numero_doc'];
    $nom = $_POST['nom'];
    $date = $_POST['date'];
    $annee_scolaire = $_POST['annee_scolaire'];
    $auteur = $_POST['auteur'];
    $id_archive = $_POST['id_archive'];  // Assurez-vous que le nom du champ correspond à celui du formulaire

    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $dossier = 'doc/';
        $temp_name = $_FILES['pdf']['tmp_name'];
        if (!is_uploaded_file($temp_name)) {
            exit("Fichier introuvable");
        }
        if ($_FILES['pdf']['size'] >= 7000000) {
            exit("Erreur, le fichier est volumineux");
        }
        $infosfichier = pathinfo($_FILES['pdf']['name']);
        $extension_upload = $infosfichier['extension'];

        $extension_upload = strtolower($extension_upload);
        $extension_autorisees = array('pdf');
        if (!in_array($extension_upload, $extension_autorisees)) {
            exit("Veuillez insérer un fichier PDF. Merci !");
        }
        $nom_pdf = $nom . "." . $extension_upload;
        if (!move_uploaded_file($temp_name, $dossier . $nom_pdf)) {
            exit("Problème de téléchargement du fichier");
        }
        $ph_name = $nom_pdf;
    }

    $requete = "INSERT INTO document (numero_doc, nom, date, annee_scolaire, auteur, id_archive)
            VALUES (:numero_doc, :nom, :date, :annee_scolaire, :auteur, :id_archive)";
    $stmt = $connexion->prepare($requete);
    $stmt->bindParam(':numero_doc', $numero_doc);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':annee_scolaire', $annee_scolaire);
    $stmt->bindParam(':auteur', $auteur);
    $stmt->bindParam(':id_archive', $id_archive);

    if ($stmt->execute()) {
        $id_doc = $connexion->lastInsertId();
        echo "Le document a été inséré avec succès. Sous le numéro : " . $id_doc;
        echo "<br>Veuillez renseigner votre Document ID";
    } else {
        echo "Une erreur s'est produite lors de l'insertion du document.";
    }
}

// Reste de votre code...
?>
<!DOCTYPE html>
<html>
<head>
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
