<?php 
require_once('header.php')
?>




<?php
include('sglconnection.php');

if (isset($_POST['name5'])) {
    $nomAgence = $_POST['name1'];
    $adresse = $_POST['name2'];
    $prixVoyage = $_POST['name3'];
    

    $stmt = $connexion->prepare("INSERT INTO agence (nomAgence, adresse, prixVoyage) VALUES (:nomAgence, :adresse, :prixVoyage)");
    $stmt->bindParam(':nomAgence', $nomAgence);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':prixVoyage', $prixVoyage);
    $stmt->execute();
    $idAgence = $connexion->lastInsertId();



        $voyage = $_POST['name4'];
        foreach ($voyage as $value){
            $stmt = $connexion->prepare("INSERT INTO association (idAgence, idVoyage) VALUES (:idAgence, :idVoyage)");
            $stmt->bindParam(':idAgence', $idAgence);
            $stmt->bindParam(':idVoyage', $value);
            $stmt->execute();
        }
    // Redirect to a success page or perform any other actions
    header("Location: crud.php");
    exit();
 }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylefront.css">
    <title>Document</title>
</head>
<body>



    <center>
    <fieldset><br>
        <form action= <?php echo ($_SERVER["PHP_SELF"])?> method="POST">
            <h2>Inscrivez-vous!</h2>
            <hr>
            <table>
                <tr>
                    <td>Nom Agence:</td>
                    <td><input class="input" type="text" name="name1"><br><br></td>
                </tr>

                <tr>
                    <td>Adresse:</td>
                    <td><input class="input" type="text"  name="name2"><br><br></td>
                </tr>

                <tr>
                    <td>Prix voyage:</td>
                    <td><input class="input" type="text" name="name3" ><br><br></td>
                </tr>

                <tr>
                    <td>Voyage:</td><br>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="checkbox" value="1"  name="name4[]" >National <br><br>
                        <input type="checkbox" value="2" name="name4[]">International <br><br>
                        <input type="checkbox" value="3" name="name4[]">Comping <br><br>
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


