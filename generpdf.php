<?php
require_once('tcpdf/tcpdf.php');
require_once('connexion.php');
$connexion = connect_bd();

class PDF extends TCPDF
{
    function Header()
    {
        $this->HeaderLogo();
        $this->Ln(30);
        $this->SetFont('dejavusans', 'B', 16);
        $this->Cell(0, 10, 'معطيات الأرشيف الخاصة بثانوية أقــا الاعدادية', 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('dejavusans', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage(), 0, 0, 'C');
    }

    function HeaderLogo()
    {
        $this->Image('LOGOT.png', 75, 05, 150, 24);
    }

    function ChapterTitle($title)
    {
        $this->SetFont('dejavusans', 'B', 12);
        $this->Cell(0, 10, $title, 0, 1, 'L');
        $this->Ln(30);
    }

    function ChapterBody($data)
    {
        $this->SetFont('dejavusans', '', 10);
        $headers = array('السنة', 'صاحب الوثيقة', 'موضوع الوثيقة', 'رقم الوثيقة', 'الرقم التسلسلي', 'الأرشيف');

        // Largeur des colonnes
        $colWidth = array(25, 45, 95, 35, 30, 45);

        // En-têtes de colonnes
        $this->SetFont('dejavusans', 'B', 10);
        for ($i = 0; $i < count($headers); $i++) {
            $this->Cell($colWidth[$i], 10, $headers[$i], 1, 0, 'C');
        }
        $this->Ln(10);

        // Contenu des données
        $this->SetFont('dejavusans', '', 10);
        foreach ($data as $row) {
            for ($i = 0; $i < count($headers); $i++) {
                $cellValue = $row[$i];
                $this->Cell($colWidth[$i], 10, $cellValue, 1, 0, 'C');
            }
            $this->Ln(10);
        }
    }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetTitle('Archive collège AKKA');
$pdf->SetAuthor('Votre nom');
$pdf->AddPage();

$query = "SELECT d.annee_scolaire, d.auteur, d.nom, d.numero_doc, d.id_document, a.nom
FROM document d
JOIN archive a ON d.id_archive = a.id_archive";
$stmt = $connexion->query($query);
$data = $stmt->fetchAll(PDO::FETCH_NUM);

$pdf->ChapterTitle('LC_AKKA');
$pdf->ChapterBody($data);

$pdf->Output('Archive_College_AKKA.pdf', 'D');
?>
