<?php

require('../database.php');

//recupérer les qsts par défauts sans recherche
$getAllQst = $db->query('SELECT id, id_auteur,titre, description ,contenu, email_auteur ,date_publication FROM questions ORDER BY id DESC');
$getAllQst1 = $db->query('SELECT id, id_auteur,titre, description ,contenu, email_auteur ,date_publication FROM questions ORDER BY id DESC');

//vérifier si une recherche a été rentrée par l'utilisateur
if(isset($_GET['search']) AND !empty($_GET['search'])){
   
    //la recherche
    $usersSearch= $_GET['search'];
    
    //récupérer toutes les qsts qui correspondent à la recherche en fct du titre
    $getAllQst = $db->query('SELECT id, id_auteur,titre, description,contenu , email_auteur ,date_publication FROM questions where titre like "%'.$usersSearch.'%" ORDER BY id DESC ');
    $getAllQst1 = $db->query('SELECT id, id_auteur,titre, description,contenu , email_auteur ,date_publication FROM questions where description like "%'.$usersSearch.'%" ORDER BY id DESC ');
    
}
