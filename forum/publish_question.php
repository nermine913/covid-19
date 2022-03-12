<?php
$page_title = 'Poser une question' ;
include_once '../database.php';
include_once '../utilities.php';
include_once '../session.php';
if (isset($_POST['validate']))

{
   $form_errors = array();

   $required_fields = array('title' , 'description' , 'content');
   $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
    if (empty($form_errors))
    {
        $question_title = htmlspecialchars($_POST['title']);
        $question_description = nl2br(htmlspecialchars($_POST['description']));
        $question_content = nl2br(htmlspecialchars($_POST['content']));
        $question_date = date('d/m/Y');
        $question_id_author = $_SESSION['id'] ;
        $question_email = $_SESSION['email'] ;

        $sqlInsert = $db->prepare('INSERT INTO questions(titre, description , contenu, id_auteur , email_auteur , date_publication) Values(? , ? , ? , ? , ? , ?)');
        $sqlInsert->execute(
            array(
                $question_title, 
                $question_description , 
                $question_content ,  
            $question_id_author , 
            $question_email , 
            $question_date )
        );

        $result = "<p style='padding: 20px; color: green; border: 1px solid gray;'>Votre question a bien été publier sur le site</p>" ;

    }
    else
    {
     if(count($form_errors) == 1){
         $result = "<p style='color: red;'> There was one error in the form </p>";

      }else{
         $result = "<p style='color: red;'> There were" .count($form_errors). " errors in the form </p>";

    }
}
}


?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<link rel="stylesheet" href="../style/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="../style/nav.css">
     <link rel="stylesheet" type="text/css" href="../style/publish.css">
 	<title>Publier une question</title>
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
    <li><a href="publish_question.php" class="active">Publier</a></li>
    <li><a href="my_questions.php" >Mes questions</a></li>
    <a href="../logout.php"><button class="btn">Se déconnecter</button></a>
    
</ul>

</nav>
 <br><br>
 <form class="container" method="post">
   <h1 style="text-align:center;color:#4C0AE0;"> Publier une question</h1>
   <br>
 <?php if(isset($result)) echo $result; ?>
 <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
 <div class="row">
 <div class="col-md-6">
 	<div class="mb-3">
         <br>
 		<label for="exampleInputEmail" class="form-label">Titre de la question</label>
         <br>
 		<input type="text" class="form-control" name="title">
 	</div>
 	<div class="mb-3">
 		<label for="exampleInputEmail" class="form-label">Description de la question</label>
 		<textarea  class="form-control" name="description"></textarea>
 	</div>
 	<div class="mb-3">
 		<label for="exampleInputEmail" class="form-label">Contenu de la question</label>
 		<textarea type="text"  class="form-control" name="content"></textarea> 
 	</div>
 	<br><br>
 	<button type="submit" class="btn" name="validate">Publier la question</button>
 	<br><br><br>
 	<p>Voulez vous retourner à votre profil <a href="profile.php">Retour</a></p>
 	<p>Voir les questions <a href="questions.php">Ici</a></p>
     </div>
     <div class="col-md-6">
               <img src="../image/ask.svg" height="350px" width="600px">  

     </div>




</div>
 </form>
 </body>
 </html>