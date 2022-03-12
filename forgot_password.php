<?php
 include_once 'database.php';
 include_once 'utilities.php';


 if(isset($_POST['passwordResetBtn']))
 {
     // on initialise un tableau dans lequel on aura les erreurs de form
    $form_errors = array();

     // la validation de formulaire
    $required_fields = array ('email', 'new_password' , 'confirm_password');

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    $fields_to_check_length = array('new_password' => 6, 'confirm_password' => 6);

    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));


    $form_errors = array_merge($form_errors, check_email($_POST));

    if (empty($form_errors)) 
    {
      $email = $_POST['email'];
      $password1 = $_POST['new_password'];
      $password2 = $_POST['confirm_password'];


       //vérifions que le nouveau mdp et le même
      if ($password1 != $password2) 
      {
          $result = "<p style='padding: 20px; border: 1px solid gray; color:red;'>New password and confirm password does not match</p>";
      }
      else 
      {
        try{

            $sqlQuery = "SELECT email FROM users WHERE email = :email";
            $statement = $db->prepare($sqlQuery);
            $statement->execute(array(':email' => $email )); 
            if($statement->rowCount() == 1)
            {
                $hashed_password = password_hash($password1, PASSWORD_DEFAULT) ;
                $sqlQuery = "UPDATE users SET password =:password WHERE email=:email" ;
                $statement = $db->prepare($sqlQuery);
                $statement->execute( array(':password' => $hashed_password, ':email' => $email )); 
                $result = "<p style='padding: 20px; color: green; border: 1px solid gray;'>Password Reset </p>";

            }
            else
            {
                $result = "<p style='padding: 20px; color: red; border: 1px solid gray;'>The email adress provided does not exist in our database, please try again</p>";
            }
        }catch(PDOException $ex)
        {
           $result = "<p style='padding: 20px; color: red; border: 1px solid gray;'>An error occurred".$ex->getMessage() ."</p>"; 
        }
      }

     }
     else {
        if(count($form_errors) == 1){
         $result = "<p style='padding: 20px; color: red; border: 1px solid gray;'>There was one error in the form </p>";

      }else{
         $result = "<p style='padding: 20px; color: red; border: 1px solid gray;'>There were" .count($form_errors). " errors in the form</p>";

      }
     }

 }

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="connecte.css">
    <link rel="stylesheet" type="text/css" href="style/nav.css">
	<title>mot de passe oublié</title>
</head>
<body>
<nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <div class="logo">
       <a href="home.php"> <img src="image/logo.png" width="200px"></a>
        </div>
        <ul>
            <li><a href="home.php" >Acceuil</a></li>
            <li><a href="home.php">A propos</a></li>
            <li><a href="home.php">Comment</a></li>
            <a href="connecte.php"><button class="btn">Connectez-vous</button></a>
            <a href="inscrit.php"><button class="btn">Inscrivez-vous</button> </a>
            
        </ul>
    </nav>
   <div class="globe">
   	<h1>Réinitialiser</h1> 
   	<br>
     <?php if(isset($result)) echo $result; ?>
    <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
   	<br><br>
      
  <form method="post" action="">
  <div class="form-row page">
  	    <div class="row">
  		    <div class="form-group">
               <input type="text" class="form-control input" placeholder="Email" name="email">
            </div>
        </div> 
       <br>

  		    <div class="form-group ">
               <input type="password" class="form-control input" placeholder="Nouveau mot de passe" name="new_password">
            </div>
       <br>
        <div class="form-group ">
               <input type="password" class="form-control input" placeholder="Confirmer mot de passe" name="confirm_password">
            </div>
       <br><br>

       <button type="submit" class ="btn btn-primary btn-lg rounded-pill bouton" name="passwordResetBtn">Réinitialiser</button>
       <p><a href="connecte.php">Retour</a></p>
       <br><br>
  </div>
  </form>
</div>
</div>
</body>
</html>