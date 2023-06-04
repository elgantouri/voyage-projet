<!-- <?php 
require_once('header.php')
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        

*{
    margin: 0;
    padding: 0;
    font-family: sans-serif;
}

.hero{
    position: relative;
    width: 100%;
    
    background: #eff4fd;
    position: relative;
}

nav{
    display: flex;
    width: 84%;
    margin: auto;
    padding: 20px 0;
    align-items: center;
    justify-content: space-between;
}

.logo{
    width: 100px;
    cursor: pointer;
}

nav ul li {
    display: inline-block;
    list-style: none;
    margin: 10px 20px;
}

nav ul li a{
    text-decoration: none;
    color: #000;
    font-weight: bold;
}

nav ul li a:hover{
    color: red;
}
    </style>
</head>
<body>
<div class="hero">
        <nav>
            <img src="images\FDrjETzVkAAGv_3-fococlipping-standard.png" class="logo">
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">PORTFOLIO</a></li>
                <li><a href="#">SERVICES</a></li>
                <li><a href="Login.php">Login</a></li>
            </ul>
        </nav>

</div>
</body>
</html>