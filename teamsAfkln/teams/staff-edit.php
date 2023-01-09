<?php

if(isset($_GET['id']))
{
    #Etape 1 : connexion à la BDD
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=afklndb;charset=utf8", "root", "");
    } catch (Exception $e) {
        die("Erreur : ".$e->getMessage());
    }

    $reqSelect = $bdd->prepare("SELECT * FROM staffteam WHERE id = :id");
    $reqSelect->execute([
        "id" => $_GET['id']
    ]);

    $staff = $reqSelect->fetch();
}
else
{
    header("location: teams/table-team.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Team masculine</title>

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

        <link rel="stylesheet" href="../css/formulairePlayer.css">

        
    </head>
    <body>
        <!-- Navigation-->
        <?php include_once "../includes/nav.php"; ?>

        <!-- Header-->
        <header class="bg-afkln-bg2 py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-afkln-orange">
                    <h1 class="display-4 fw-bolder titre-header">Editer une/un joueuse/joueur</h1>
                    <p class="lead fw-normal text-white-50 mb-0"></p>
                </div>
            </div>
        </header>
        <!-- Product section-->
        <section class="py-5 formulaire">
            <div class="container px-4 px-lg-5 my-5">
            <form method="post" action="staff-cible-edit.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom*</label>
                    <input type="texte" class="form-control" id="name" name="name" aria-describedby="titreHelp" value="<?= $staff['name'];  ?>" required>
                    <div id="titreHelp" class="form-text">*Champs obligatoire.</div>
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Prénom*</label>
                    <input type="texte" class="form-control" id="surname" name="surname" aria-describedby="titreHelp" value="<?= $staff['surname'];  ?>" required>
                    <div id="titreHelp" class="form-text">*Champs obligatoire.</div>
                </div>
                <div class="mb-3">
                    <label for="staffPosition" class="form-label">position :</label>
                    <input type="varchar" class="form-control" id="staffPosition" name="staffPosition" aria-describedby="sellingPriceHelp" value="<?= $staff['staffPosition'];  ?>" required>
                    <div id="sellingPriceHelp" class="form-text">*Champs obligatoire.</div>
                </div>
                <?php
                    if(isset($_GET["feedback"]) && $_GET["feedback"] == 1)
                    {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Merci !</strong> Les informations ont biens été mises à jour.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    }
                ?>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo*</label>
                    <input type="file" class="form-control" name="staffPhoto" id="staffPhoto" value="<?= $player['staffPhoto'];  ?>" required>
                    <div id="titreHelp" class="form-text">*Champs obligatoire.</div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
            </div>
        </section>

        <!-- Footer-->
        <?php include "../includes/_footer.php"?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>