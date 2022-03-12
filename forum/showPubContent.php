<?php

require('../database.php');

if(isset($_GET['id']) and !empty($_GET['id'])){

    $idqst= $_GET['id'];
    $checkqstExists = $db->prepare('SELECT * FROM questions WHERE id = ?' );
    $checkqstExists->execute(array($idqst));

    if($checkqstExists->rowCount() > 0){

        $qstInfo = $checkqstExists->fetch();
        
        $titre = $qstInfo['titre'];
        $description = $qstInfo['description'];
        $contenu = $qstInfo['contenu'];
        $id_auteur = $qstInfo['id_auteur'];
        $email_auteur = $qstInfo['email_auteur'];
        $date_publication = $qstInfo['date_publication'];
       


    }else{
        $errorMsg = "Aucune question n'a été trouvée";
    }
}else{
    $errorMsg = "Aucune question n'a été trouvée";
}