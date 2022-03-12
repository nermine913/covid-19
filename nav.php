<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
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
            <li><a href="edit_profile.php">Modifier profil</a></li>
            
            <li><a href="forum/forum.php" >Assistance médicale</a></li>
            <li><a href="forum/my_questions.php" >Mes questions</a></li>
            <a href="logout.php"><button class="btn">Se déconnecter</button></a>
            <?php else: ?> 
            <li><a href="">about</a></li>
            <a href="connecte.php"><button class="btn">Connectez-vous</button></a>
            <a href="inscrit.php"><button class="btn">Inscrivez-vous</button> </a>
            <?php endif ?>
        </ul>
   
    </nav>
</body>
</html>


 