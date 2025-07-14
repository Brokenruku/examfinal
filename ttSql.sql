CREATE DATABASE emprunter; 

CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    genre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    ville VARCHAR(100) NOT NULL,
    mdp VARCHAR(255) NOT NULL,  
    image_profil VARCHAR(255)  
);

CREATE TABLE categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100) NOT NULL,
    id_categorie INT NOT NULL,
    id_membre INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

CREATE TABLE images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    nom_image VARCHAR(255) NOT NULL,  
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE
);

CREATE TABLE emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    id_membre INT NOT NULL, 
    date_emprunt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_retour DATETIME,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

SELECT * 
FROM membre 
WHERE email = '$email' 
AND
mdp = '$mdp';

SELECT 
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
            GROUP BY o.nom_objet, co.nom_categorie, co.id_categorie, imo.nom_image, e.id_membre, e.date_emprunt, e.date_retour, m.nom
            ORDER BY o.id_objet ASC;
            
SELECT 
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
            ORDER BY o.id_objet ASC;