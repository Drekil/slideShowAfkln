<?php 
//connexion a la base de donner et verrification que la connexion et etablie 


//premet de pouvoir utiliser les fonction etablie dans commande.php
require("commande.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Team féminine</title>

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
        <!-- Navigation-->
        <?php include "../includes/nav.php"?>
        <!-- Header-->
        <header class="bg-afkln-bg2 py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-afkln-orange">
                    <h1 class="display-4 fw-bolder titre-header">L'équipe féminine</h1>
                    <p class="lead fw-normal text-white-50 mb-0"></p>
                </div>
            </div>
        </header>
        <!-- Section slider-->
        <section id="slider">
            <div class="container-slider">
                <div class="subcontainer">
                    <div class="slider-wrapper">
                        <div class="controller">
                            <div class="slider-title">
                                <h2>Nos joueuses</h2>
                            </div>
                            <div id="controls">
                                <button class="previous"><i class="fas fa-angle-left"></i></button>
                                <button class="next"><i class="fas fa-angle-right"></i></button>
                            </div>
                        </div>
                        <div class="my-slider">
                            <?php 
                                require("connexionDataBase.php");
                                $stmt = $access->query('SELECT * FROM player WHERE sex="femme" ORDER BY id ASC');
                                $i = 1;
                                foreach ($stmt as $row) : 
                            ?>
                            <div>
                                <div <?php if ($i>=1) echo 'class="slide"';
                                ?>>
                                    <div>
                                        <a href="#">
                                            <img class="slide-img" src="../teams/uploads/<?= $row['playerPhoto'] ?>" alt=""/>
                                        </a>
                                    </div>
                                    <div>
                                        <a class="description" href="#">
                                            <h3><?= $row['name']." ".$row['surname'] ?></h3>
                                            <p><?= $row['position'] ?></p>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                $i++;
                                ?>
                            </div>
                            <?php
                            endforeach;
                            ?>                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <?php include "../includes/_footer.php"?>
        <script src="../js/scriptSlideShow.js"></script>
    </body>
</html>