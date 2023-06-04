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
// vérifier que le bouton ajouter a bien été cliqué
if(isset($_POST['name5'])){
    // extraction des informations envoyées dans des variables par la méthode POST
    $nom = $_POST['name1'];
    $telephone = $_POST['name2'];
    $adresse = $_POST['name3'];
    $ville = $_POST['name4'];

    // vérifier que tous les champs ont été remplis
    if(!empty($nom) && !empty($telephone) && !empty($adresse) && !empty($ville)){
        // connexion à la base de données
        include_once "sglconnection.php";
        // requête d'ajout avec PDO
        $stmt = $connection->prepare("INSERT INTO fournisseur (name1, name2, name3) VALUES (:nom, :telephone, :adresse)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':adresse', $adresse);
        if($stmt->execute()){ // si la requête a été effectuée avec succès, on fait une redirection
            header("location: crud.php");
            exit();
        } else { // si non
            $message = "Fournisseur non ajouté";
        }
    } else {
        // si non
        $message = "Veuillez remplir tous les champs !";
    }
}
?>

    <div class="form">
        <a href="crud.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter un employé</h2>
        <p class="erreur_message">
            <?php 
            // si la variable message existe , affichons son contenu
            if(isset($message)){
                echo $message;
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
                    <td>Nom:</td>
                    <td><input class="input" type="text" name="name1"><br><br></td>
                </tr>

                <tr>
                    <td>Téléphone:</td>
                    <td><input class="input" type="text"  name="name2"><br><br></td>
                </tr>

                <tr>
                    <td>Adresse:</td>
                    <td><input class="input" type="text" name="name3" ><br><br></td>
                </tr>

                <tr>
                    <td>Villes:</td><br>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="checkbox" value="1"  name="name4[]">Marakech <br>
                        <input type="checkbox" value="2" name="name4[]">Agadir <br>
                        <input type="checkbox" value="3" name="name4[]">Rabat <br>
                        <input type="checkbox" value="3" name="name4[]">Iben guerir <br>
                        <input type="checkbox" value="4" name="name4[]">Lâayoune 
                        </td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" id="submit"  value="S'inscrire" name="name5"></td>
                </tr>
            </table>
        </form>
    </fieldset>
    </center>
    </div>
</body>
</html>