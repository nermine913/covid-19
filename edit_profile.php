<?php
$page_title = "User Authentication - Edit Profile";
include_once 'database.php';
include_once 'session.php';
include_once 'utilities.php';
include_once 'parse_profile.php';

 ?>
 <!DOCTYPE html>
 <html>
 <head>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/edit_profile.css">
 	<meta charset="utf-8">
 	<title>Modifier Profil</title>
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
    <li><a href="profile.php" >Mon profil</a></li>
    <li><a href="edit_profile.php" class="active">Modifier profil</a></li>
    <li><a href="forum/forum.php"  >Assistance médicale</a></li>
    <li><a href="forum/publish_question.php" >Publier</a></li>
    <li><a href="forum/my_questions.php" >Mes questions</a></li>
    <a href="logout.php"><button class="btn">Se déconnecter</button></a>
    
</ul>
    </nav>
	<br>
	<div class="container">
    <div class="row">
 	<div class="col-md-6">
 		<h2>Edit Profile</h2><hr>
 		<div>
 			<?php if(isset($result)) echo $result; ?>
 			<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
 		</div>
 		<div class="clearfix"></div>


 		<?php if (!isset($_SESSION['email'])): ?>
 			<p class="lead">You are not authorized to view this page <a href="connecte.php">Se connecter</a Not yet a member><a href="inscrit.php">S'inscrire</a></p>
 		<?php else: ?>
 			<form method="post" action="" enctype="multipart/form-data">
 				<div class="form-group">
 					<label for="emailField">Email</label>
 					<input type="text" name="email" class="form-control" id="emailField" value="<?php if (isset($email)) echo $email ; ?>">
 				</div>

 			   <div class="form-group">
 					<label for="nomField">Nom</label>
 					<input type="text" name="nom" class="form-control" id="nomField" value="<?php if (isset($nom)) echo $nom ; ?>">
 				</div>


 				<div class="form-group">
 					<label for="prenomField">Prénom</label>
 					<input type="text" name="prenom" class="form-control" id="prenomField" value="<?php if (isset($prenom)) echo $prenom ; ?>">
 				</div>
 		 		<div class="form-group">
 					<label for="cnField">CN</label>
 					<input type="text" name="cn" class="form-control" id="cnField" value="<?php if (isset($cn)) echo $cn ; ?>">
 				</div>
 				<div class="form-group">
 					<label for="adresseField">Adresse</label>
 					<input type="text" name="adress" class="form-control" id="adresseField" value="<?php if (isset($adress)) echo $adress ; ?>">
 				</div>
 				<div class="form-group">
 					<label for="diplomeField">Diplome</label>
 					<input type="text" name="diplome" class="form-control" id="diplomeField" value="<?php if (isset($diplome)) echo $diplome ; ?>">
 				</div>
 				<div class="form-group">
 					<label for="hopitalField">Hopital</label>
 					<input type="text" name="hopital" class="form-control" id="hopitalField" value="<?php if (isset($hopital)) echo $hopital ; ?>">
 				</div>
 				<div class="form-group">
 					<label for="specialteField">Spécialité</label>
 					<input type="text" name="sp" class="form-control" id="specialteField" value="<?php if (isset($sp)) echo $sp; ?>">
 				</div>
				 <br><br>
				 <div class="form-group">
 					<label for="fileField">Changer photo de profil</label>
 					<input type="file" name="avatar"  id="fileField">
 				</div>
 				<input type="hidden" name="hidden_id" value="<?php if(isset($id)) echo $id ; ?>"><br><br>
 				<button type="submit" class ="btn btn-primary btn-lg rounded-pill bouton" name="updateProfileBtn">UPDATE</button>
 			</form>
        <?php endif ?>
		<a href="profile.php">BACK</a>
		 </div>
	 <div class="col-md-6">
		 <br>
	 <img src="image/edit.svg" height="600px" width="500px">
	 </div>
	 
	 </div>
 </div>
 </body>
 </html>