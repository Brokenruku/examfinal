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

    function insertObjet($mysqli, $id_membre, $nom_objet, $id_categorie){
        $query = "
            INSERT INTO objet (id_membre, nom_objet, id_categorie) VALUES
            ('$id_membre', '$nom_objet', '$id_categorie')";

        $result = mysqli_query($mysqli, $query);
        return $result;
    }

    function insertImageObjet($mysqli, $id_objet, $nom_image){
        $query = "
            INSERT INTO images_objet (id_objet, nom_image) VALUES
            ('$id_objet', '$nom_image')";

        $result = mysqli_query($mysqli, $query);
        return $result;
    }
    function getIDObjet($mysqli, $id_membre, $nom_objet, $id_categorie) {
        $query = "SELECT id_objet 
                FROM objet 
                WHERE id_membre = ? 
                AND nom_objet = ? 
                AND id_categorie = ? 
                LIMIT 1";

        $stmt = mysqli_prepare($mysqli, $query);
        mysqli_stmt_bind_param($stmt, "isi", $id_membre, $nom_objet, $id_categorie);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row['id_objet'];
        }
        return false;
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

    function afficherFiche($mysqli, $objectId) {

        $query = "SELECT 
                o.nom_objet AS nomObjet,
                co.nom_categorie AS categorie,
                imo.nom_image AS imagee,
                IFNULL(CONCAT(e.id_membre), 'pas de membre emprunt') AS empruntMembre,
                IFNULL(CONCAT(e.date_emprunt), 'pas de date emprunt') AS date_emprunt,
                IFNULL(CONCAT(e.date_retour), 'pas de date retour') AS date_retour,
                IFNULL(CONCAT(m.nom), 'pas de ppt') AS proprietaire,
                GROUP_CONCAT(DISTINCT imo2.nom_image) AS autres_images,
                GROUP_CONCAT(DISTINCT CONCAT(e2.date_emprunt, ' - ', e2.id_membre)) AS historique_emprunts
            FROM objet o
            JOIN categorie_objet co ON o.id_categorie = co.id_categorie
            JOIN images_objet imo ON o.id_objet = imo.id_objet
            LEFT JOIN emprunt e ON o.id_objet = e.id_objet
            LEFT JOIN membre m ON o.id_membre = m.id_membre
            LEFT JOIN images_objet imo2 ON o.id_objet = imo2.id_objet AND imo2.nom_image != imo.nom_image
            LEFT JOIN emprunt e2 ON o.id_objet = e2.id_objet
            WHERE o.id_objet = '$objectId'
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

    function getCategorie($mysqli) {
        $query = "SELECT * FROM categorie_objet";
        $categories = [];

        $result = mysqli_query($mysqli, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row['nom_categorie']; 
        }

        return $categories;
    }


?>