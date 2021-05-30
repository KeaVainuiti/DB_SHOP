<?php

    $host = 'localhost' ; // nom de l'hôte 
    $username = 'root' ; //nom de l'admin serveur
    $password = '' ; // mot de passe
    $db_name = 'db_shop'; // nom de la bdd (base de données)

    $connect_bdd = new mysqli ($host , $username , $password, $db_name); //ce connecter à la base de données

    // if ($connect_bdd->connect_error){
    //     echo "échec de la connexion";
    // }
    // else {
    //     echo "connexion réussi";
    // }



    

