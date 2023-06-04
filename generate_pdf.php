<?php
//inclure la bibliothèque pour générer le PDF;
require('fpdf.php');

// Vérifier si le paramètre idAgence est présent dans l'URL
if (isset($_GET['idAgence'])){
    $idAgence = $_GET['idAgence'];

    // récupérer les informations de l'agence en fonction de l'idAgence
    // utiliser les données pour générer le contenu du PDF
    // Exemple :
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Informations de l\'agence');

    // ...

    // Définir le nom du fichier PDF à télécharger
    $filename = 'informations_agence.pdf';

    // Générer le contenu du PDF
    // Utilisez les méthodes de la bibliothèque FPDF pour générer le contenu du PDF
    // Exemple :
    $pdf->Cell(40, 10, 'Nom Agence: ' . $row['nomAgence']);
    $pdf->Cell(40, 10, 'Adresse: ' . $row['adresse']);
    $pdf->Cell(40, 10, 'Prix Voyage: ' . $row['prixVoyage']);
    $pdf->Cell(40, 10, 'Nom Voyage: ' . $rowVoyage['nomVoyage']);
    // ...
     
    // Envoyer les en-têtes HTTP pour forcer le téléchargement du fichier
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="'. $filename .'"');

    // Générer le fichier PDF et le télécharger
    $pdf->Output('F', $filename);
    exit();
} else {
    echo "Paramètre idAgence manquant dans l'URL.";

}
?>
