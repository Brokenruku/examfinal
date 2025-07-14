sql 
    table 
        membre (id_membre, nom , date de naissance, genre, émail, ville, mdp, image_profil)
        categorie_objet (id_categorie, nom_categorie )
        objet (id_objet , nom_objet , id_categorie, id_membre)
        images_objet(id_image, id_objet, nom_image)
        emprunt(id_emprunt, id_objet, id_membre, date_emprunt, date_retour)

    insertion 
        4  membres
        4 catégories ( esthétique, bricolage, mécanique , cuisine )
        10 objets par membre à répartir sur les catégories
        10 emprunts

    login.php
        creation de nouveau perso 
        pas nouveau perso 
            verifiation email + mdp dans le loginMethod.php par le table membre
            fonction verfInfo poir verifier email+mdp
        nvProfile.php
            nouveau perso
                insertion des donnes dans membre 
                fonction insertMembre recuperation par poste dans method des infos
                upload d image de profile

        

