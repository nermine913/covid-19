<?php 
include_once 'session.php';
include_once 'utilities.php';
include_once 'database.php' ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style/home.css">
    <title>homepage</title>
</head>
<body>
   
   
  
 
   
  <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <div class="logo">
            <p>DOCTORS</p>
        </div>
        <ul>
            <li><a href="" >Acceuil</a></li>
            <?php if(isset($_SESSION['email']) || isCookieValid($db)):?>
            <li><a href="#about" class="active">Mon profil</a></li>
            <a href="logout.php"><button class="btn">Logout</button></a>
            <?php else: ?> 
            <li><a href="">about</a></li>
            <a href="connecte.php"><button class="btn">Connectez-vous/button></a>
            <a href="inscrit.php"><button class="btn">Inscrivez-vous</button> </a>
            <?php endif ?>
        </ul>
    </nav>
    <?php if(isset($_SESSION['email']) || isCookieValid($db)):?>
        <p>you are logged in as <?php if(isset($_SESSION['email'])) echo $_SESSION['email'] ?> </p><a href="logout.php">logout</a>
        <?php header('location: profile.php') ?>
   <?php else: ?> 
    <p>inscription ?  .....</p><a href="inscrit.php">signup</a>
   <p>login........</p><a href="connecte.php">login</a>
    <?php endif ?>

  </body>
</html>