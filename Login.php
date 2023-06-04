
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ss.css">
    
    
    
</head>
<body>


    <div class="box">


    
        <span class="borderline"></span>
        <form method="post" action="frontend.php">
            <h2>Login</h2>
            <div class="inputBox">
                <input type="email" required="required" name="email">
                <span>Email:</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" required="required" name="password">
                <span>Password</span>
                <i></i>
            </div>
            <div class="links">
                <a href="#">Forgot Password</a>
                <a href="#">Signup</a>
            </div>
            <input type="submit" value="Login" name="submit">

        </form>
    </div>
</body> 
</html>
<?php 
include("sglconnection.php");
if(isset($_POST['submit'])&& isset($_POST['email'])&& isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $connection -> prepare("SELECT * FROM login WHERE email =? AND password = ?");
    $statement -> execute([$username,$password]);
    $user = $statement -> fetch(PDO::FETCH_ASSOC);
    
    if($statement -> rowCount()>0){
        session_start();
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;


        if(isset($_POST['check'])){
            setcookie('email',$_SESSION['email'],time()+60);
            setcookie('password',$_SESSION['password'],time()+60);

        }
        setcookie("name",gethostname(),time()+(86400*30));
        header('location:frontend.php');

    }else{
        header('location:error.php');
    }

}
?>