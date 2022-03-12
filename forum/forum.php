<?php 

  require('showAllQstAction.php');
  require('showPubContent.php');
  include_once 'postAnswerAction.php';
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../style/nav.css">
    <link rel="stylesheet" href="forum.css">
    <title>Q&R</title>
</head>
<body>
<nav>

<input type="checkbox" id="check">
<label for="check" class="checkbtn">
    <i class="fas fa-bars"></i>
</label>
<div class="logo">
<a href="../home.php"> <img src="../image/logo.png" width="200px"></a>
</div>
<ul>
    
    <li><a href="../profile.php" >Mon profil</a></li>
    <li><a href="../edit_profile.php">Modifier profil</a></li>
    <li><a href="forum.php" class="active" >Assistance médicale</a></li>
    <li><a href="publish_question.php" >Publier</a></li>
    <li><a href="my_questions.php" >Mes questions</a></li>
    <a href="../logout.php"><button class="btn">Logout</button></a>
    
</ul>

</nav>
   <br><br>
   <div class="container">
   <form action="" method="GET">
            <div class="form-group row">
                <div class="col-8">
                    <input type="search" name="search" class="form-control1">
                </div>
                <div class="col-4">
                    <button class="btnt" type="submit">Rechercher</button>
                </div>
            </div>
        </form>
   </div>
    
    <br><br>
    <div class="back">
    <div class="container">
        <?php
              while($question = $getAllQst->fetch()){
                  ?>
                  <div class="card">
                     
                           <a href="publication.php?id=<?= $question['id'];?>">
                           <div class="card-header">
                               <?= $question['titre']; ?>
                               </div>

                               
                            </a>   
                      
                      <div class="card-body">
                        <?= $question['description']; ?>
                      </div>
                      <div class="card-footer">
                          Publié par <?= $question['email_auteur']; ?> le <?= $question['date_publication']; ?>
                      </div> <br>
                      <a href="publication.php?id=<?= $question['id'];?>"><button class="btnn">Répondre et voir les réponses</button></a>
                      
                  </div>
                  
                       
                        <hr> 
                  <br>
                  
                  <?php
              }
        
        ?>
       
        </div>
    </div>
    
</body>
</html>