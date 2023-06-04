<?php
// inclure la page de connexion
include_once "sglconnection.php";

// Inclure la bibliothèque Dompdf
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Vérifier si le paramètre idAgence est présent dans l'URL
if (isset($_GET['idAgence'])) {
    $idAgence = $_GET['idAgence'];

    try {
        // Requête pour récupérer les informations de l'utilisateur en fonction de l'idAgence
        $stmt = $connexion->prepare("SELECT * FROM agence WHERE idAgence = :idAgence");
        $stmt->bindParam(':idAgence', $idAgence);
        $stmt->execute();

        // Vérifier si une ligne a été retournée
        if ($stmt->rowCount() > 0) {
            // Récupérer les données de l'utilisateur
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Créer une instance de Dompdf
            $dompdf = new Dompdf();

            // Générer le contenu HTML du PDF
            $html = '<h1 style="text-align:center;">Informations de l\'utilisateur</h1>';
            $html .= '<p style="text-align:center;">Nom Agence: ' . $row['nomAgence'] . '</p>';
            $html .= '<p style="text-align:center;">Adresse: ' . $row['adresse'] . '</p>';
            $html .= '<p style="text-align:center;">Prix Voyage: ' . $row['prixVoyage'] .'</p>';

            // Charger le contenu HTML dans Dompdf
            $dompdf->loadHtml($html);

            // Rendre le document PDF
            $dompdf->render();

            // Définir le nom du fichier PDF à télécharger
            $filename = 'informations_agence.pdf';

            // Envoyer les en-têtes HTTP pour forcer le téléchargement du fichier
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            // Envoyer le contenu du PDF généré au navigateur
            $dompdf->stream($filename);
        } else {
            echo "Aucune information trouvée pour cet utilisateur.";
        }
    } catch (PDOException $e) {
        echo "Erreur PDO : " . $e->getMessage();
    }
} else {
    echo "Paramètre idAgence manquant dans l'URL.";
}
?>
