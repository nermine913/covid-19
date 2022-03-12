<?php 
  include_once 'database.php';
   include_once 'utilities.php';


  //mail validation la solution de form
  if (isset($_POST['signup8tn']))
  {
     // on initialise un tableau dans lequel on aura les erreurs de form
    $form_errors = array();

     // la validation de formulaire
    $required_fields = array ('nom', 'prenom', 'hopital', 'adress', 'cn', 'diplome', 'email', 'passe', 'sp');

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    $fields_to_check_length = array('cn' => 8);

    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));


    $form_errors = array_merge($form_errors, check_email($_POST));


  //vérifier si le tableau des erreurs est vide 
  if (empty($form_errors)) {


   $email = $_POST['email'];
   $nom = $_POST['nom'];
   $prenom = $_POST['prenom'];
   $password = $_POST['passe'];
   $cn = $_POST['cn'];
   $adress = $_POST['adress'];
   $sp = $_POST['sp'];
   $diplome = $_POST['diplome'];
   $hopital = $_POST['hopital'];

   $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
   try {
        $sqlInsert = "INSERT INTO users (nom, prenom, hopital, adress, cn, diplome, email, password, sp, join_date)
        VALUES (:nom, :prenom, :hopital, :adress, :cn, :diplome, :email, :password, :sp, now())" ;

       $statement = $db->prepare($sqlInsert);
       $statement->execute(array(':nom' =>$nom, ':prenom' =>$prenom , ':hopital' => $hopital , ':adress' => $adress, ':cn' => $cn, ':diplome' => $diplome, ':sp' => $sp, ':email' => $email, ':password' => $hashed_password));


       if($statement->rowCount() == 1)
       {
              
             $result ="<p style='padding: 20px; border: 1px solid green;background-color:#b5e7a0 ;border-radius:25px ; color:green;'>Registration Successful</p>";
       }
  }

 catch (PDOException $ex){

   $result ="<p style='padding: 20px; border: 1px solid red;background-color:#f7cac9;border-radius:25px ;  color:red;'>an error occured: ".$ex->getMessage()."</p>";

   } }
   else
   {
     if(count($form_errors) == 1)
     {
        $result = $data ="<p style='padding: 20px; border: 1px solid red;background-color:#f7cac9;border-radius:25px ; color:red;'>there was 1 error in the form<br>";

        $result .= "<ul style='color: res;'>";
        //afficher les erreurs 
        foreach ($form_errors as $error) 
        {
          $result .="<li>($error)</li>";
        }
        $result .= "</ul></p>";
     }
     else 
     {
        $result=$data ="<p style='padding: 20px; border: 1px solid red;background-color:#f7cac9;border-radius:25px ; color:red;'>There were " .count($form_errors). " erros in the form <br>";
        $result .="<ul style='color: red;'>";
         foreach ($form_errors as $error) 
         {
          $result .= "<li>($error)</li>";
         }
          $result .= "</ul></p>";
     }
   }}
  ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="inscrit.css">
  <link rel="stylesheet" type="text/css" href="style/nav.css">
	<meta charset="utf-8">
	<title>Inscription</title>
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
            <li><a href="#home" class="active">Acceuil</a></li>
            <li><a href="#about">A propos</a></li>
            <li><a href="#how">Comment</a></li>
            
            <a href="connecte.php"><button class="btn">Connectez-vous</button></a>
            <a href="inscrit.php"><button class="btn">Inscrivez-vous</button> </a>
            
        </ul>
    </nav>
	<form method="post" action="" class="formulaire">
  <br>
		<h1 style="text-align:center ;color:#4C0AE0;">Inscription</h1>
<div class="container">
   
   <br>
	 <h6>Veuillez s'il vous plait remplir ce formulaire soigneusement!</h6>
   <?php if(isset($result)) echo $result; ?>
   
	 <br>
  <div class="form-row">
  	    <div class="row">  
  		    <div class="form-group col-md-6">
               <label for="nom">Nom</label>
               <input type="text" class="form-control" id="nom" placeholder="nom" value="" name="nom">
            </div>
            <div class="form-group col-md-6">
                <label for="pren">Prénom</label>
                <input type="text" class="form-control" id="pren"  placeholder="Prénom" value="" name="prenom">
           </div>
       </div>
       <br><br>
       <div class="row">
          <div class="form-group col-md-6">
               <label for="inputEmail">Email</label>
               <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="" name="email">
           </div>
           <div class="form-group col-md-6">
               <label for="inputPassword4">Mot de passe</label>
               <input type="password" class="form-control" id="inputPassword4" placeholder="Mot de passe" value="" name="passe">
           </div>
       </div>
  </div>
  <br><br>
  <div class="row">
      <div class="form-group col-md-6">
          <label for="inputAddress">Adresse</label>
          <input type="text" class="form-control" id="inputAddress" placeholder="Exp: 1234 Main St" value="" name="adress">
      </div>
 
      <div class="form-group col-md-6">
          <label for="inputCN">CN</label>
          <input type="text" class="form-control" id="inputCN" placeholder="CN" value="" name="cn">
      </div>
  </div>
  <br><br>
  <div class="form-row">
  	   <div class="row">
           <div class="form-group col-md-4">
             <label for="inputdip">Diplome</label>
             <input type="text" class="form-control" id="inputdip" value="" placeholder="Diplome" name="diplome">
           </div>
 
           <div class="form-group col-md-4">
             <label for="spé">spécialité</label>
             <input type="text" class="form-control" id="spé"  placeholder="Spécialité" value=""  name="sp">
          </div>
          <div class="form-group col-md-4">
             <label for="inputhop">hopital</label>
            <input type="text" class="form-control" id="inputhop" placeholder="Hopital" value="" name="hopital">
          </div>
     </div>
 </div>
 <br> <br>

  <button type="submit" class="bouton" name="signup8tn">S'inscrire</button>
  
  </div>
</form>

</body>
</html>