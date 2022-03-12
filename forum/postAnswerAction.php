<?php
include_once '../database.php';
include_once '../session.php';
include_once 'showPubContent.php';
if (isset($_POST['validate']))
 {
     if(isset($_POST['answer']))
     {
        $user_answer = nl2br(htmlspecialchars($_POST['answer']));
        $InsertAnswer = $db->prepare('INSERT INTO answers (id_auteur, email_auteur, id_question, contenu) VALUES (?, ?, ?, ?)');
        $InsertAnswer->execute(array($_SESSION['id'],$_SESSION['email'] ,$idqst, $user_answer));


        $result = "<p style='padding: 20px;border-radius:10px; color: green;background-color:#e6e6e6b0;text-align:center; border: 1px solid gray;'>Votre réponse a bien été publier sur le site</p>" ;

    }
     
     else{
       $result = "<p style='color: red;border-radius:10px; border: 1px solid gray ;background-color:#e6e6e6b0;text-align:center; padding: 20px; '> There was one error in the form </p>";
     }
}

 ?>