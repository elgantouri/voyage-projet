<?php 
$db_host = "localhost";
$db_name = "voyage_agence";
$db_user ="root";
$db_pass ="";

try{
    $connexion = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8",$db_user,$db_pass);
 }catch (PDOException $e){
     echo "<script>alert('error')</script>";
     header('location:error.php');
}




?>