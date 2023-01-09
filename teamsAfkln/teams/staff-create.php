<?php
    #Accès a la page interdit, si on est pas connecté
    session_start();

    /*if(!isset($_SESSION['user']) OR empty($_SESSION['user']))
    {
        header("location: login.php");
    }*/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire Joueur</title>

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
        <link rel="stylesheet" href="../css/formulairePlayer.css">

        <!-- CSS footer --> 
        <link rel="stylesheet" href="../css/my_css.css"/>

      
    </head>
    <body>
        <!-- Navigation-->
        <?php include "../includes/nav.php"?>
        <!-- Header-->
        <header class="bg-afkln-bg2 py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-afkln-orange">
                    <h1 class="display-4 fw-bolder titre-header">Formulaire d'ajout de joueuses/joueurs</h1>
                    <p class="lead fw-normal text-white-50 mb-0"></p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5 formulaire">

                <form method="post" action="create-cible-staff.php" enctype="multipart/form-data">
                <input type="hidden" name="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom :</label>
                        <input type="varchar" class="form-control" id="name" name="name" aria-describedby="productNameHelp" required>
                        <div id="productNameHelp" class="form-text">*Champs obligatoire.</div>
                    </div>

                    <div class="mb-3">
                        <label for="surname" class="form-label">Prénom :</label>
                        <input type="text" class="form-control" id="surname" name="surname" aria-describedby="productDescriptionHelp" required>
                        <div id="productDescriptionHelp" class="form-text">*Champs obligatoire.</div>
                    </div>

                    <div class="mb-3">
                    <label for="photo" class="form-label">Photo*</label>
                    <input type="file" class="form-control" name="staffPhoto" id="staffPhoto" value="<?= $player['staffPhoto'];  ?>" required>
                    <div id="titreHelp" class="form-text">*Champs obligatoire.</div>

                    <div class="mb-3">
                        <label for="staffPosition" class="form-label">position :</label>
                        <input type="varchar" class="form-control" id="position" name="staffPosition" aria-describedby="sellingPriceHelp" required>
                        <div id="sellingPriceHelp" class="form-text">*Champs obligatoire.</div>
                    </div>
                
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>                

            </div>
        </section>
        <!-- Footer-->
        <?php include "../includes/_footer.php"?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../js/scripts.js"></script>
    </body>
</html>
