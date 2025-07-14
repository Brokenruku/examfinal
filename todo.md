*****
lancement via index.php
*****

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
        recherche 
            un checkbox qui va ver filtration pour les categorie selectionner
            un input de recherche avec le nom de l objet 
            un liste deroulant qui charge les categorie (une seul value de retout)
        
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
    listeMembre.php
        pour afficher tout les membre avvec table membre 
    ficheMembre.php
        les info de base en relation avec le memebre
        list de tout les chose qu il a empreint 
        ajouter un bouton retour pour check si l objet est en bon ou mauvais etat
            redirection ver retourObjet.php
            creation d un nouveau table pour stocker ce nv donne
    retourObjet.php 
        pour traitrer entre OK ou pas
    statsObjets.php
        affiche les nombre des objet OK 
        affiche les nimbre des objet pas OK