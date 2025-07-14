<?php
    function verfInfo($mysqli, $email, $mdp){
        $querry = "SELECT * 
        FROM membre 
        WHERE email = '$email' 
        AND
        mdp = '$mdp'";

        $result = mysqli_query($mysqli, $querry);
        return $result;
    }

    function insertMembre($mysqli, $nom, $date_naissance, $genre, $email, $ville, $mdp, $image_profil ){
        
        $query = "
            INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
            ('$nom', '$date_naissance', '$genre', '$email', '$ville', '$mdp', '$image_profil')";

        $result = mysqli_query($mysqli, $query);
        return $result;
    }
?>