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

    function afficherObjet($mysqli){

        $query = "SELECT 
                o.nom_objet AS nomObjet,
                co.nom_categorie AS categorie,
                imo.nom_image AS imagee,
                IFNULL(CONCAT(e.id_membre), 'pas de membreemprunt') AS empruntMembre,
                IFNULL(CONCAT(e.date_emprunt), 'pas de date emprunt') AS date_emprunt,
                IFNULL(CONCAT(e.date_retour), 'pas de dater retour') AS date_retour,
                IFNULL(CONCAT(m.nom), 'pas de ppt') AS proprietaire
            FROM objet o
            JOIN categorie_objet co ON o.id_categorie = co.id_categorie
            JOIN images_objet imo ON o.id_objet = imo.id_objet
            LEFT JOIN emprunt e ON o.id_objet = e.id_objet
            LEFT JOIN membre m ON o.id_membre = m.id_membre
            GROUP BY o.nom_objet, co.nom_categorie, imo.nom_image, e.id_membre, e.date_emprunt, e.date_retour, m.nom
            ORDER BY o.id_objet ASC;";

        $result = mysqli_query($mysqli, $query);

        return $result;
    }

    function filtrationObject($mysqli, $catg){

        $condition = '';
        if (!empty($catg)) {
            $catIds = array_map('intval', $catg); 
            $condition = "WHERE co.id_categorie IN (" . implode(',', $catIds) . ")";
        }

        $query = "SELECT 
                o.id_objet,
                o.nom_objet AS nomObjet,
                co.nom_categorie AS categorie,
                imo.nom_image AS imagee,
                IFNULL(CONCAT(e.id_membre), 'pas de membreemprunt') AS empruntMembre,
                IFNULL(CONCAT(e.date_emprunt), 'pas de date emprunt') AS date_emprunt,
                IFNULL(CONCAT(e.date_retour), 'pas de dater retour') AS date_retour,
                IFNULL(CONCAT(m.nom), 'pas de ppt') AS proprietaire
            FROM objet o
            JOIN categorie_objet co ON o.id_categorie = co.id_categorie
            JOIN images_objet imo ON o.id_objet = imo.id_objet
            LEFT JOIN emprunt e ON o.id_objet = e.id_objet
            LEFT JOIN membre m ON o.id_membre = m.id_membre
            $condition
            GROUP BY o.id_objet, o.nom_objet, co.nom_categorie, imo.nom_image, e.id_membre, e.date_emprunt, e.date_retour, m.nom
            ORDER BY o.id_objet ASC";

        return mysqli_query($mysqli, $query);
    }
    function getIDemail($mysqli, $email, $mdp){
        $querry = "SELECT id_membre 
        FROM membre 
        WHERE email = '$email' 
        AND
        mdp = '$mdp' 
        LIMIT 1";

        $row = mysqli_query($mysqli, $querry);
        if($row = mysqli_fetch_assoc($row)){
            return $row['id_membre'];
        }
    }
?>