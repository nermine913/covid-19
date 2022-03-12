<?php  
include_once 'database.php';
include_once 'utilities.php';
include_once 'session.php';

if((isset($_SESSION['id']) || isset($_GET['user_identity'])) && !isset($_POST['updateProfileBtn'])){

	if (isset($_GET['user_identity'])) {
		$url_encoded_id = $_GET['user_identity'] ;
		$decode_id = base64_decode ($url_encoded_id);
		$user_id_array = explode("encodeuserid", $decode_id) ;
		$id = $user_id_array [1] ;
		}
	else{
	$id = $_SESSION['id'] ; } 

	$sqlQuery = "SELECT * FROM users WHERE id = :id" ;
	$statement = $db->prepare($sqlQuery);
	$statement->execute(array(':id' => $id)) ;


	while ($rs = $statement->fetch()) {
		$email = $rs['email'] ;
		$nom = $rs['nom'] ;
		$prenom = $rs['prenom'] ;
		$cn = $rs['cn'] ;
		$adress = $rs['adress'] ;
		$hopital = $rs['hopital'] ;
		$diplome = $rs['diplome'] ;
		$sp = $rs['sp'] ;
		$join_date = strftime("%b %d, %Y", strtotime($rs["join_date"]));

	}
	$user_pic = "uploads/".$nom.".jpg";
	$default = "uploads/default.jpg";

	if(file_exists($user_pic)){
		$profile_picture = $user_pic;
	}else{
		$profile_picture = $default;
	}

	$encode_id = base64_encode("encodeuserid{$id}");
}
else if (isset($_POST['updateProfileBtn'])) {

	$form_errors = array() ;

	$required_fields = array('email', 'nom','prenom', 'cn','adress', 'diplome', 'hopital', 'sp') ;

	$form_errors = array_merge($form_errors, check_empty_fields($required_fields));
    
    $fields_to_check_length = array('nom' => 3, 'prenom' =>3, 'email' => 10 , 'cn' => 8 );

    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    $form_errors = array_merge($form_errors, check_email($_POST));

	isset($_FILES['avatar']['name']) ? $avatar = $_FILES['avatar']['name'] : $avatar = null;

	if ($avatar != null){
		$form_errors = array_merge($form_errors, isValidImage($avatar));
	}

    $email = $_POST['email'] ;
    $nom = $_POST['nom'] ;
    $prenom = $_POST['prenom'] ;
    $cn = $_POST['cn'] ;
    $adress = $_POST['adress'] ;
    $diplome = $_POST['diplome'] ;
    $hopital = $_POST['hopital'] ;
    $sp = $_POST['sp'] ;
    $hidden_id = $_POST['hidden_id'];

    if (empty($form_errors)){

    	try {

    		$sqlUpdate = "UPDATE users SET email =:email, nom =:nom, prenom =:prenom, cn =:cn, adress =:adress, diplome =:diplome, hopital =:hopital, sp =:sp WHERE id =:id";

    		$statement = $db->prepare($sqlUpdate) ;

    		$statement-> execute(array(':email' => $email , ':nom' => $nom , ':prenom' => $prenom, 'cn' => $cn , ':adress' => $adress , ':diplome' => $diplome , ':hopital' => $hopital , ':sp' => $sp, ':id'=>$hidden_id));

    		if ($statement->rowCount() == 1 || uploadAvatar($nom)) {
				$result ="<p style='padding: 20px; color: green; border: 1px solid gray;'>Profile Update Successfully</p>"; 
    		   
    			
				 }
    		else {
				 $result ="<p style='padding: 20px; color: red; border: 1px solid red;background-color:#f7cac9;border-radius:25px ;'>You have not made any changes</p>";
				
			}

    		
    	} catch (PDOException $ex) {
    		$result ="<p style='padding: 20px; color: red; border: 1px solid red;background-color:#f7cac9;border-radius:25px ;'>An error occurred in : " .$ex->getMessage() ."</p>"; 
    	}
    }
    
   else {
   	if(count($form_errors) == 1){
         $result = "<p style='padding: 20px; color: red; border: 1px solid red;background-color:#f7cac9;border-radius:25px ;'>There was one error in the form <br></p>";

      }else{
         $result = "<p style='padding: 20px; color: red; border: 1px solid red;background-color:#f7cac9;border-radius:25px ;'>There were" .count($form_errors). " errors in the form </p>";

      }
   }




} 
?>