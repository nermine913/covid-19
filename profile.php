<?php 

 include_once 'parse_profile.php';
include_once 'session.php';

 ?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/profile.css">
	<title>Mon profil</title>
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
		
            
            <li><a href="profile.php" class="active">Mon profil</a></li>
			<li><a href="edit_profile.php">Modifier profil</a></li>
            
            <li><a href="forum/forum.php" >Assistance médicale</a></li>
			<li><a href="forum/publish_question.php">Publier</a></li>
            <li><a href="forum/my_questions.php" >Mes questions</a></li>
            <a href="logout.php"><button class="btn">Se déconnecter</button></a>
		
            
        </ul>
</nav>

<div class="container">

<div>

	
	<?php if(!isset($_SESSION['email'])): ?>
	<p class="lead">Vous n'etes plus connectez <a href="home.php">Revenir à la page d'acceuil</a><a href="inscrit.php"> Inscrivez-vous </a></p>
    <?php else: ?>
		<br>
		<h1 style="text-align:center ;color:#4C0AE0;"> Profil</h1>
	  <div class="row">
	  
		<div class="col-md-4"  >
			    <br><br><br>
				<img src="<?php if(isset($profile_picture)) echo $profile_picture ; ?>" class="img img-rounded" width="250px" style="border-radius:50%;border-color: #1A0F54; margin-right:0;">
				<br><br><br>
	            <a href="forum/publish_question.php"><button type="submit" class ="btn btn-primary btn-lg rounded-pill bouton " style="background-color: #ED3A46;">Publier une question</button></a>

		</div>
		<div class="col-md-4"  style="text-align:left; margin-top:80px;margin-left:0;">
			<h1 style="color:#ED3A46">Demander ou donner d'assistance!</h1>
			<h4>Ici vous serai en contact avec plusieurs médecins de plusieurs spécialités sentez libre de poser vos questions et de répondre aussi.</h4>
		</div>
    	<div class="col-md-4" style="background-color:#e6e6e6; border-radius:25px;">
			
    		<table class="table table-condensed"  >
    			<tr><th>Nom:</th><td><?php if (isset($nom))echo $nom; ?> </td></tr>
    			<tr><th>Prénom:</th><td><?php if (isset($prenom))echo $prenom; ?> </td></tr>
    			<tr><th>Email:</th><td><?php if (isset($email))echo $email; ?> </td></tr>
    			<tr><th>CN:</th><td><?php if (isset($cn))echo $cn; ?> </td></tr>
    			<tr><th>Adresse:</th><td><?php if (isset($adress))echo $adress; ?> </td></tr>
    		    <tr><th>Diplome:</th><td><?php if (isset($diplome))echo $diplome; ?> </td></tr>
    		    <tr><th>Spécialité:</th><td><?php if (isset($sp))echo $sp; ?> </td></tr>
    			<tr><th>Hopital:</th><td><?php if (isset($hopital))echo $hopital; ?> </td></tr>
    			<tr><th>Date d'inscrit:</th><td><?php if (isset($join_date))echo $join_date; ?> </td></tr>
    			<tr><th></th><td><a class="pull-right" href="edit_profile.php" style="cursor: pointer;">
    				<span class="glyphicon glyphicon-edit"></span>Changer photo de profil</a> </td></tr>
    		</table>
	   </div>
	   </div>
       <?php endif ?>

</div>
</div>
<div class="custom-shape-divider-bottom-1629665599">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg>
</div>

</body>
</html>