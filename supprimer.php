<?php

include("sglconnection.php");

if(isset($_GET['idAgence'])){

    $id_Agence=$_GET['idAgence'];
    $sql="DELETE FROM association WHERE idAgence=$id_Agence";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    $sql="DELETE FROM agence WHERE idAgence=$id_Agence";
    $statement = $connexion->prepare($sql);
    $statement->execute();
    if($stmt && $statement){
        header('Location:crud.php');
    }else{
        echo'<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">';
        echo "La connexion à la base de données a échoué : " . $e->getMessage(); 
        echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo'</div>';
    }
}

?>





