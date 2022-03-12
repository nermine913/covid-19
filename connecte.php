<?php
include_once 'database.php';
include_once 'session.php';
include_once 'utilities.php';

if(isset($_POST['loginBtn'])){
   $form_errors = array();

   $required_fields = array('email' , 'password');
   $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
   if(empty($form_errors)){
            $email = $_POST['email'];
            $password = $_POST['password'];

            isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = "";

            $sqlQuery = "SELECT * FROM users WHERE email = :email";
            $statement = $db->prepare($sqlQuery);
            $statement->execute(array(':email' => $email));
            
            while($row = $statement-> fetch()){
               $id = $row['id'];
               $hashed_password = $row['password'];
               $email = $row['email'];
                
               if(password_verify($password, $hashed_password)){
                  $_SESSION['id'] = $id;
                  $_SESSION['email'] = $email;

                  if($remember === "yes"){
                     rememberMe($id);
                  }
                  header("location: index.php");
               }else{
                  $result = "<p style='padding: 20px; color: red; border: 1px solid gray;'> Invalid username or password</p>";
               }

            }
   }else{
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
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="connecte.css">
   
	<title>Connectez-vous</title>
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
            <li><a href="home.php" class="active">Acceuil</a></li>
            <li><a href="home.php">A propos</a></li>
            <li><a href="home.php">Comment</a></li>
            
            <a href="connecte.php"><button class="btn">Connectez-vous</button></a>
            <a href="inscrit.php"><button class="btn">Inscrivez-vous</button> </a>
            
        </ul>
</nav>
<div>
 <form method="post">  
   <div class="globe">
   	<h1>Se connecter</h1> 
   	
<?php if(isset($result)) echo $result; ?>
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
 
   	<br>
  <div class="form-row page">
  	    <div class="row">
  		    <div class="form-group">
               <label for="email" style="float:left; color:#1A0F54;">Email</label>
               <input type="text" class="form-control input"  id="email" placeholder="Email" name="email">
            </div>
        </div> 
       <br>

  		    <div class="form-group ">
              <label for="mdp" style="float:left; color:#1A0F54;">Mot de passe</label>
               <input type="password" class="form-control input" id ="mdp" placeholder="Mot de passe" name="password">
            </div>
       <br>
        <div class="checkbox">
           <label>
              <input name="remember" value="yes" type="checkbox">Remember me
           </label>   
        </div>
        <br>
       <input type="submit" name="loginBtn" class="btn" value="Se connecter">
      <br><br>
       <p><a href="forgot_password.php">Mot de passe oublié</a></p>
       <p><a href="home.php">Retour</a></p>
       <br>
  </div>
</div>
</div>
</form>
</div>
</body>
</html>