<?php

    #Vérifier que la donnée obligatoire est saisie avec isset()
    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        #Protéger les données reçues
        $id = htmlentities($_GET['id']);

        #Etape 1 : connexion à la BDD
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=afklndb;charset=utf8", "root", "");
        } catch (Exception $e) {
            die("Erreur : ".$e->getMessage());
        }
        
        #Etape 2 : requête d'insertion
        $reqInsert = $bdd->prepare("DELETE FROM player WHERE id = :id");
        $reqInsert->execute([
            "id" => $id
        ]);

        #Etape 3 : 
        //echo "Bravo ! la catégorie a bien été ajoutée";
        header("location: teams/table-team.php?feedback=3");
        
    }
    else
    {
        echo "Attention le champs 'titre' est obligatoire";
    }