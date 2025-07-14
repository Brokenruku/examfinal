sql 
    connexion dans config.php
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
        dans les methode passage de l ID du perso vers le prochain page avec les get ID

    headerDedans.php 
        pour l header dans les pages ex : listeObjet.php
        avec petit nav est affiche du profile avec image
    listeObjet.php
        affichage des donnees de table objet 
        join avec image respectif
        avec join de emprunt si y a date de retour si emprunt en cours
        un checkbox qui va ver filtration pour les categorie selectionner
        mettre un petit lien qui accede a la formulaire de nouveau objetajoutObjet.php
    filtration.php
        filtrage par categorie 
        verificqtion avec la tablecategorie par rapport auxobjets
    ajoutObjet.php
        fonction qui prend l id de l user actuel
        liste deroulant pour l ajout de categorie
        insertion dans la table objet des parametre
        insertion dans latable images_objet  l'image selectionner/uploders
        mettre un bouton supprimer pour supprimer les image
        **si y a pas d image on prend un image par defaut   
    supprImagMethode.php
        DELETE l image selection 