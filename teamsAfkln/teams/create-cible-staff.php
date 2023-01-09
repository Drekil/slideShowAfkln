<?php

    #Vérifier que la donnée obligatoire est saisie avec isset()
    if(isset($_POST['name']) && !empty($_POST['name']))
    {
        #Protéger les données reçues
        $staffName = htmlentities($_POST['name']);
        $staffSurname = htmlentities($_POST['surname']);
        $staffPhoto = htmlentities($_POST['staffPhoto']);
        $staffPosition = htmlentities($_POST['staffPosition']);

        #Etape 1 : connexion à la BDD
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=afklndb;charset=utf8", "root", "");
        } catch (Exception $e) {
            die("Erreur : ".$e->getMessage());
        }
        
        #Etape 2 : requête d'insertion
        $reqInsert = $bdd->prepare("INSERT INTO staffteam (name, surname, staffPhoto, staffPosition) VALUES ( :name, :surname, :staffPhoto, :staffPosition)");
        $reqInsert->execute([
            
            "name" => $staffName,
            "surname" => $staffSurname,
            "staffPhoto" => $staffPhoto,
            "staffPosition" => $staffPosition
            
        ]);

        if(isset($_FILES['staffPhoto']) && $_FILES['staffPhoto']['error'] == 0) //UPLOAD_ERR_OK
        {
            #2/ Vérification de la taille du fichier
            if($_FILES['staffPhoto']['size'] <= 10000000)
            {
                #3/ Vérification de l'extension du fichier
                $infofile = pathinfo($_FILES['staffPhoto']['name']);
                $extension = $infofile['extension'];

                #in_array : retourne TRUE si la valeur de $extension est contenu dans le tableau (2ème paramétre)
                if(in_array($extension, ['jpg', 'jpeg', 'gif', 'png']))
                {
                    $source = $_FILES['staffPhoto']['tmp_name'];
                    $destination = "uploads/".$_FILES['staffPhoto']['name'];

                    #Requête de mise a jour de la colonne 'photo' pour ajouter le nom de la photo en BDD
                    $reqUpdate = $bdd->prepare("UPDATE staffteam SET staffPhoto = :staffPhoto WHERE id = :id");
                    $reqUpdate->execute([
                        "staffPhoto" => $_FILES['staffPhoto']['name'],
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
        header("location: staffTeam.php?feedback=1");
        
    }
    else
    {
        echo "Attention le champs 'titre' est obligatoire";
    }