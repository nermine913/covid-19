<?php
function check_empty_fields($required_fields_array)
 {
	 // on initialise un tableau dans lequel on aura les erreurs de form
    $form_errors = array();

     // la validation de formulaire
 
      foreach ($required_fields_array as $name_of_field) 
         {
        
        if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL)
         {
                
                $form_errors[] = $name_of_field;
        }
        }
        return $form_errors;
}
function show_errors($form_errors_array)
{
	$errors = "<ul style='color: res;'>";
	 //afficher les erreurs 
        foreach ($form_errors_array as $error) 
        {
          $errors .="<li style='color:red;'>$error</li>";
        }
        $errors .= "</ul></p>";
    return $errors;
}
function check_min_length($fieled_to_check_length)
{
	$form_errors = array ();
    foreach ($fieled_to_check_length as $name_of_field => $minimum_length_required)
    {
    	if (strlen(trim($_POST[$name_of_field])) < $minimum_length_required) 
    	   {
    		  $form_errors[] = $name_of_field. "is too short, must be ($minimum_length_required) characters long";
    	   }
    }
    return $form_errors;
}
function check_email($data)
{
	// pour collecter les messages d'erreurs
	$form_errors = array();
	$key = 'email';

	//voir si l'eamil existe dans le tableau de données

	if(array_key_exists($key, $data))
	{

		//vérifier si l'email a une valeur
		if ($_POST[$key] != null ) 
		{
			$key = filter_var($key, FILTER_SANITIZE_EMAIL);

			if (filter_var($_POST[$key], FILTER_SANITIZE_EMAIL) == false) 
			{
				$form_errors[] = $key . "is not a valid email address";
			}
		}
	}
	return $form_errors;
}
function flashMessage($message, $passOrFail = "Fail") {
	if(passOrFail === "Pass")
	{
        $data ="<p style='padding: 20px; border: 1px solid gray; color:green;'>{$message}</p>";
	}
	else
	{
       $data = "<p style='padding: 20px; color: red; border: 1px solid gray;'>{$message}</p>";
	}
	return $data;
}
function guard(){

	$isValid = true ;
	$inactive = 60 * 2; //:2mins

	$fingerprint = md5($_SERVER['REMOTE_ADDR']. $_SERVER['HTTP_USER_AGENT']);

	if((isset($_SESSION['fingerprint'])&&$_SESSION['fingerprint'] != $fingerprint)){
		$isValid = false;
		signout();

	}
	else if (isset($_SESSION['last_active'])&&(time()-$_SESSION['last_active'])>$inactive&&$_SESSION['email']){
		$isValid = false;
		signout();
	}
	else
	{
		$_SESSION['last_active'] = time();
	}

	return $isValid;
}

function rememberMe($user_id){
	$encryptCookieData = base64_encode("UaQteh5i4y3dntstemYODEC{$user_id}");
	//cookie set to expire in about 30 days
	setcookie("rememberUserCookie", $encryptCookieData, time()+60*60*24*100 , "/");


}

function isCookieValid($db){
	$isValid = false;

	if(isset($_COOKIE['rememberUserCookie'])){
		$decryptCookieData = base64_decode($_COOKIE['rememberUserCookie']);
		$user_id = explode("UaQteh5i4y3dntstemYODEC" , $decryptCookieData);
		$userID = $user_id[1];

		$sqlQuery = "SELECT * FROM users WHERE id = :id";
		$statement = $db->prepare($sqlQuery);
		$statement->execute(array(':id' => $userID));

		if($row = $statement->fetch()){
			$id = $row['id'];
			$username = $row['username'];

			$_SESSION['id'] = $id;
			$_SESSION['username'] = $username;
			$isValid = true ;
		}else{
			$isValid = false;
			$this->signout();
		}
		
	}
	return $isValid;
}

function signout(){
	unset($_SESSION['username']);
	unset($_SESSION['id']);

	if(isset($_COOKIE['rememberUserCookie'])){
		unset($_COOKIE['rememberUserCookie']);
		setcookie('rememberUserCookie' , null , -1,'/');
	}
	session_destroy();
	session_regenerate_id(true);
	header("location: index.php");
}
function isValidImage($file){
	$form_errors =array();

	$part = explode(".",$file);

	$extension = end($part);

	switch(strtolower($extension)){
		case 'jpg':
		case 'gif':
		case 'bmp':
		case 'png':

		return $form_errors;
	}
	$form_errors[] = $extension . "* is not a valid image extension";
	return $form_errors;
}

function uploadAvatar($username){
	$isImageMoved = false;

	if($_FILES['avatar']['tmp_name']){
		$temp_file = $_FILES['avatar']['tmp_name'];
		$ds = DIRECTORY_SEPARATOR;
		$avatar_name = $username.".jpg";

		$path = "uploads".$ds.$avatar_name;

		if(move_uploaded_file($temp_file,$path)){
			$isImageMoved = true;
		}
	}
	return $isImageMoved;
}

?>
 