<?php 
include_once '../database.php';
include_once '../session.php';

$getAllAnswersOfThisQuestion = $db->prepare('SELECT id_auteur, email_auteur, id_question, contenu FROM answers WHERE id_question = ? ');
$getAllAnswersOfThisQuestion->execute(array($idqst)) ;
?>