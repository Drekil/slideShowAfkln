<?php
    #Etape 1 : connexion à la BDD
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=afklndb;charset=utf8", "root", "");
    } catch (Exception $e) {
        die("Erreur : ".$e->getMessage());
    }
    
    #Etape 2 : Réquete de selection
    $reqSelect = $bdd->query("SELECT * FROM player WHERE sex = 'homme'");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Les joueurs</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />

        <!-- cdn pour le slideshow -->
        <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="../css/cssTiny.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
        <link rel="stylesheet" href="../css/slideshow.css">

        <!-- CSS footer --> 
        <link rel="stylesheet" href="../css/my_css.css"/>

    </head>
    <body>
        <?php include "../includes/nav.php"; ?>

        <!-- Header-->
        <header class="bg-afkln-bg2 py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-afkln-orange">
                    <h1 class="display-4 fw-bolder titre-header">Table des joueurs</h1>
                    <p class="lead fw-normal text-white-50 mb-0"></p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <?php
                    if(isset($_GET["feedback"]) && $_GET["feedback"] == 2)
                    {
                ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Merci !</strong> Votre catégorie a bien été modifiée !
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php
                    }
                ?>

                <?php
                    if(isset($_GET['feedback']) && $_GET['feedback'] == 3)
                    {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Merci !</strong> Votre catégorie a bien été supprimée !
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php
                    }
                ?>

                <table class="table table-danger table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Position</th>
                        <th scope="col">Sexe</th>
                        <th scope="col">Numéro de maillot</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($player = $reqSelect->fetch()) { ?>
                        <tr>
                            <th scope="row"><?= $player['id']; ?></th>
                            <td><?= $player['name']; ?></td>
                            <td><?= $player['surname']; ?></td>
                            <td><?= $player['position']; ?></td>
                            <td><?= $player['sex']; ?></td>
                            <td><?= $player['jerseyNumber']; ?></td>
                            <td>
                                <a href="team-edit-men.php?id=<?= $player['id']; ?>" class="btn btn-primary btn-sm">Modifier</a>
                                <a href="team-delete.php?id=<?= $player['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('este-vous sure de vouloir supprimer cette catégorie ?');">Supprimer</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </section>
        <!-- Footer-->
        <?php include "../includes/_footer.php"?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>