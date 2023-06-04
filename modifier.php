<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    //connexion à la base de données
    include_once "sglconnection.php";
    
    //on récupère l'id dans le lien
    $id = $_GET['idAgence'];
    
    //requête pour afficher les infos d'un employé
    $stmt = $connexion->query("SELECT agence.idAgence, agence.nomAgence, agence.adresse, agence.prixVoyage, GROUP_CONCAT(voyage.nomVoyage SEPARATOR ',') as voyage
    FROM agence
    LEFT JOIN association ON agence.idAgence = association.idAgence
    LEFT JOIN voyage ON association.idVoyage = voyage.idVoyage
    GROUP BY agence.idAgence");
    
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //vérifier que le bouton ajouter a bien été cliqué
    if(isset($_POST['name5'])){
        //extraction des informations envoyées dans des variables par la méthode POST
        $nomAgence = $_POST['name1'];
        $adresse  = $_POST['name2'];
        $prixVoyage = $_POST['name3'];
        
        //vérifier que tous les champs ont été remplis
        if(!empty($nomAgence) && !empty($adresse) && !empty($prixVoyage)){
            //requête de modification
            $stmt = $connexion->prepare("UPDATE agence SET nomAgence ='$nomAgence', adresse ='$adresse', prixVoyage ='$prixVoyage' WHERE idAgence ='$id'");
            $stmt->bindParam(1, $nomAgence);
            $stmt->bindParam(2, $adresse);
            $stmt->bindParam(3, $prixVoyage);
            $stmt->bindParam(4, $id);
            $stmt->execute();

            $stmt = $connexion->prepare("DELETE FROM association WHERE idAgence = ?");
            $stmt->bindParam(1, $id);
            $stmt->execute();

            if (isset($_POST['name4'])) {
                $voyage = $_POST['name4'];
            
                foreach ($voyage as $voyage) {
                    $stmt = $connexion->prepare("INSERT INTO association (idAgence, idVoyage) VALUES (?, ?)");
                    $stmt->bindParam(1, $id);
                    $stmt->bindParam(2, $voyage);
                    $stmt->execute();
                }
            }
            





            if($stmt->rowCount() > 0){//si la requête a modifié une ligne avec succès, on fait une redirection
                header("location: crud.php");
                exit();
            }else {//si non
                $message = "fournesseur non modifié";
            }
        }else {
            //si non
            $message = "Veuillez remplir tous les champs !";
        }
    }
?>

    <div class="form">
        <a href="crud.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier l'employé : <?=$row['nomAgence']?> </h2>
        <p class="erreur_message">
           <?php 
              if(isset($message)){
                  echo $message ;
              }
           ?>
        </p>




        <center>
    <fieldset><br>
        <form action="" method="POST">
            <h2>Inscrivez-vous!</h2>
            <hr>
            <table>
                <tr>
                    <td>Nom Agence:</td>
                    <td><input class="input" type="text" name="name1" value=<?php echo $row['nomAgence'];?>><br><br></td>
                </tr>

                <tr>
                    <td>Adresse:</td>
                    <td><input class="input" type="text"  name="name2" value=<?php echo $row['adresse'];?>><br><br></td>
                </tr>

                <tr>
                    <td>Prix Voyage:</td>
                    <td><input class="input" type="text" name="name3" value=<?php echo $row['prixVoyage'];?>><br><br></td>
                </tr>

                <tr>
                    <td>Voyage:</td><br>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <?php  $checked=explode(",",$row['voyage']);?>

                        <input type="checkbox" value="1"  name="name4[]" <?php echo(in_array(1,$checked))?"checked":""; ?>>Natinale<br>
                        <input type="checkbox" value="2" name="name4[]" <?php echo(in_array(2,$checked))?"checked":""; ?>>International <br>
                        <input type="checkbox" value="3" name="name4[]" <?php echo(in_array(3,$checked))?"checked":""; ?>>Comping 
                        
                        </td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" id="submit"  value="Envoyer" name="name5"></td>
                </tr>
            </table>
        </form>
    </fieldset>
    </center>
</body>
</html>