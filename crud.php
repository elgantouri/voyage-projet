

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Employés</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
    
        <a href="frontend.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
        
        <table>
    <tr id="items">
        <th>Nom Agence</th>
        <th>Adresse</th>
        <th>Prix Voyage</th>
        <th>Voyage</th>
        <th>Modifier</th>
        <th>Supprimer</th>
        <th>télécharger mon pdf</th>
        <th>les statistiques</th>
        
    </tr>
    <?php
    // inclure la page de connexion
    include_once "sglconnection.php";

    try {
        // requête pour afficher la liste des fournisseurs avec les données de la table ville
        $stmt = $connexion->query("SELECT agence.idAgence, agence.nomAgence, agence.adresse, agence.prixVoyage, GROUP_CONCAT(voyage.nomVoyage SEPARATOR ',') as voyage
            FROM agence
            LEFT JOIN association ON agence.idAgence = association.idAgence
            LEFT JOIN voyage ON association.idVoyage = voyage.idVoyage
            GROUP BY agence.idAgence");


        if ($stmt !== false) {
            if ($stmt->rowCount() == 0) {
                // s'il n'existe pas de fournisseur dans la base de données, afficher ce message :
                echo "Il n'y a pas encore de fournesseur ajouté !";
            } else {
                // sinon, afficher la liste de tous les fournisseurs
                while ($table = $stmt->fetchAll(PDO::FETCH_ASSOC)) {

                    foreach ($table as $row) {
                        echo '<tr>';
                        echo '<td>'.$row['nomAgence'].'</td>';
                        echo '<td>'.$row['adresse'].'</td>';
                        echo '<td>'.$row['prixVoyage'].'</td>';
                        echo '<td>'.$row['voyage'].'</td>';
                        echo  "<td><a href='modifier.php?idAgence={$row["idAgence"]}'><img src='images/pen.png'></a></td>";
                        echo  "<td><a href='supprimer.php?idAgence={$row["idAgence"]}'><img src='images/trash.png'></a></td>";
                        echo  "<td><a href='pdf.php?idAgence={$row["idAgence"]}'><img src='images/pdf.png'></a></td>";
                        echo  "<td><a href='nn2.php?idAgence={$row["idAgence"]}'><img src='trend.png'></a></td>";
                        echo   '</tr>';
                    }

                    ?>
                    
                    <?php
                }
            }
        } else {
            $errorInfo = $connexion->errorInfo();
            echo "Erreur lors de l'exécution de la requête : " . $errorInfo[2];
        }
    } catch (PDOException $e) {
        echo "Erreur PDO : " . $e->getMessage();
    }
    ?>
</table>



   
   
   
    </div>
</body>
</html>