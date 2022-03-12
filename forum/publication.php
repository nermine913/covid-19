<?php  
include_once 'postAnswerAction.php';
include_once 'showAllReponse.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="forum.css">
    <link rel="stylesheet" href="../style/nav.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La publication</title>
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
    <li><a href="forum.php" >Assistance médicale</a></li>
    <li><a href="publish_question.php" >Publier</a></li>
    <li><a href="my_questions.php" >Mes questions</a></li>
    <a href="../logout.php"><button class="btn">Logout</button></a>
    
</ul>

</nav>

      
    <div class="container">
    
        <?php 
             if(isset($errorMsg)){echo $errorMsg; }
             if(isset($date_publication)){
                 ?>
                   <br>
		           <h1 style="text-align:center ;color:#e6e6e6;"> Répondre et voir les réponses</h1>
	
                    <br><br><br>
                    <div class="card">
                     
                     
                        <div class="card-header">
                         <?= $titre; ?>
                         </div>
                       
                
                        <div class="card-body">
                        <?= $description; ?>
                        </div>
                        <div class="card-footer">
                          Publié par <?= $email_auteur; ?> le <?= $date_publication; ?>
                          </div> 
                
                    </div>
                    <br><br>

                    <section class="show-answers">
                        <form class="form-group" method="POST">
                            <?php if(isset($result)) echo $result; ?>
                            <div class="mb-3">

                            <label for="floatingTextarea" class="form-label" ><h2 style="color:#e6e6e6;">Répondre ici</h2></label>
                            <textarea name="answer" class="form-control"></textarea>
                            
                            <br>
                            <button type="submit" class="btnn" name="validate">Répondre</button>
                           
                        </div>
                        </form>
                        
                        
                        <br><br>
                        <?php 
                           while ($answer = $getAllAnswersOfThisQuestion->fetch()) {

                            ?>
                              <div class="card">
                                  <div class="card-header">
                                   <?= $answer['email_auteur'] ; ?> <p style="color:#e6e6e6 ; font-size:18px;">a repondu a cette question</p>
                                  </div>
                                  <div class="card-body">
                                      <?= $answer['contenu'] ; ?>
                                  </div>

                              </div>
                            <?php
                           }
                           
                        ?>
                    </section>

                  <?php
             }
          ?>   

          <br><br>
    </div>
    
</body>
</html>