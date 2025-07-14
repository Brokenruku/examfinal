<?php
    function verfInfo($mysqli, $email, $mdp){
        $querry = "SELECT * 
        FROM membre 
        WHERE email = '$email' 
        AND
        mdp = '$mdp'";

    
    }
?>