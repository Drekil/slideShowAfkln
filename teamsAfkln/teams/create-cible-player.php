<?php

    #Vérifier que la donnée obligatoire est saisie avec isset()
    if(isset($_POST['name']) && !empty($_POST['name']))
    {
        #Protéger les données reçues
        $playerName = htmlentities($_POST['name']);
        $playerSurname = htmlentities($_POST['surname']);
        $jerseyNumber = htmlentities($_POST['jerseyNumber']);
        $sex = htmlentities($_POST['sex']);
        $position = htmlentities($_POST['position']);

        #Etape 1 : connexion à la BDD
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=afklndb;charset=utf8", "root", "");
        } catch (Exception $e) {
            die("Erreur : ".$e->getMessage());
        }
        
        #Etape 2 : requête d'insertion
        $reqInsert = $bdd->prepare("INSERT INTO player (name, surname, jerseyNumber, sex, position) VALUES ( :name, :surname, :jerseyNumber, :sex, :position)");
        $reqInsert->execute([
            
            "name" => $playerName,
            "surname" => $playerSurname,
            "jerseyNumber" => $jerseyNumber,
            "sex" => $sex,
            "position" => $position,
            
        ]);

        if(isset($_FILES['playerPhoto']) && $_FILES['playerPhoto']['error'] == 0) //UPLOAD_ERR_OK
        {
            #2/ Vérification de la taille du fichier
            if($_FILES['playerPhoto']['size'] <= 10000000)
            {
                #3/ Vérification de l'extension du fichier
                $infofile = pathinfo($_FILES['playerPhoto']['name']);
                $extension = $infofile['extension'];

                #in_array : retourne TRUE si la valeur de $extension est contenu dans le tableau (2ème paramétre)
                if(in_array($extension, ['jpg', 'jpeg', 'gif', 'png']))
                {
                    $source = $_FILES['playerPhoto']['tmp_name'];
                    $destination = "uploads/".$_FILES['playerPhoto']['name'];

                    #Requête de mise a jour de la colonne 'photo' pour ajouter le nom de la photo en BDD
                    $reqUpdate = $bdd->prepare("UPDATE player SET playerPhoto = :playerPhoto WHERE id = :id");
                    $reqUpdate->execute([
                        "playerPhoto" => $_FILES['playerPhoto']['name'],
                        "id" => $bdd->lastInsertId() #lastInsertId() est une méthode PDO qui renvoie le dernier Id enregistré.
                    ]);
                    
                    #Valide l'upload du fichier sur votre serveur
                    move_uploaded_file($source, $destination);
                }
                else
                {
                    //echo "Erreur : format de fichier non autorisé ! (jpg, gif, png)";
                    header("location: table-team-men.php?error=2");
                }

            }
            else
            {
                //echo "Erreur: le fichier est trop volumineux (> 1Mo)";
                header("location: table-team-men.php?error=1");
            }
        }

        #Etape 3 : 
        //echo "Bravo ! la catégorie a bien été ajoutée";
        header("location: manTeam.php?feedback=1");
        
    }
    else
    {
        echo "Attention le champs 'titre' est obligatoire";
    }