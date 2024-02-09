<?php
// ...
function annee_scolaire_actuelle()
{
    $mois = date("m");//Le mois de la date actuelle
    $annee_actuelle = date("Y");//L'année de la date actuelle
    if ($mois >= 9 && $mois <= 12) {
        $annee1 = $annee_actuelle;
        $annee2 = $annee_actuelle + 1;
    } else {
        $annee1 = $annee_actuelle - 1;
        $annee2 = $annee_actuelle;
    }

    $annee_scolaire_actuelle = $annee1 . "/" . $annee2;
    return $annee_scolaire_actuelle;
}

// Fonction pour récupérer le nombre de documents insérés
function getNombreDocuments()
{
    global $pdo;
    $res = $pdo->query("SELECT COUNT(*) as nombre_documents FROM document");
    $resultat = $res->fetch();
    return $resultat['nombre_documents'];
}

// Fonction pour récupérer le nombre d'archives insérées
function getNombreArchives()
{
    global $pdo;
    $res = $pdo->query("SELECT COUNT(*) as nombre_archives FROM archive");
    $resultat = $res->fetch();
    return $resultat['nombre_archives'];
}

// Exemple d'utilisation
$nombreDocuments = getNombreDocuments();
$nombreArchives = getNombreArchives();

echo "Nombre de documents insérés : " . $nombreDocuments . "<br>";
echo "Nombre d'archives insérées : " . $nombreArchives;
?>

