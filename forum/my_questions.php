<?php
session_start();
include_once '../database.php';





$getAllMyQuestions = $db->prepare('SELECT id, titre, description, contenu FROM questions WHERE id_auteur = ? ORDER BY id DESC');
$getAllMyQuestions->execute(array($_SESSION['id'])) ;


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../style/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../style/nav.css">
  <link rel="stylesheet" type="text/css" href="mes_questions.css">
	<title>Mes questions</title>
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
    <li><a href="publish_question.php">Publier</a></li>
    <li><a href="my_questions.php" class="active">Mes questions</a></li>
    <a href="../logout.php"><button class="btn">Logout</button></a>
    
</ul>

</nav>
	<br><br>
<div class="container">
      <h1 style="text-align:center;color:#e6e6e6;"> Mes questions</h1>
      <br><br>
<?php
    
    while ($question = $getAllMyQuestions->fetch()) 
    {
    	?>
    	<div class="card">
            <h5 class="card-header">
            	<?php echo $question['titre'] ; ?>
            </h5>
            <div class="card-body">
            	<h5 class="card-title"><?php echo $question['description']; ?> </h5>
               <p class="card-text"><?php echo $question['contenu']; ?></p>

               
           </div>
      </div>
      

    	<?php
    }

 ?>
 </div>
</body>
</html>