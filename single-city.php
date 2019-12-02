<?php 
    include("includes/header.inc.php");
    include("includes/validate.inc.php");
    include("includes/countryfilter.inc.php");
    include("includes/single-city.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Cities</title>
        <link rel="stylesheet" type="text/css" href="css/citieslayout.css">
        <link rel="stylesheet" type="text/css" href="css/popmenus.css">
    </head>
    <body>
        <?php
            buildMenu();
            if(isset($_SESSION['logged_in'])) {
                buildLogoutMenu();
            }
            else {
                buildLoginMenu();
            }
        ?>

        <main class="container">

            <?php buildCountryFilter(); ?>

            <div class="box info">
                <h3>Information</h3>
                
                <section id="infoSec">
                    <?php

                if(!isset($_GET['citycode']))
                {
                    echo "<h4 id='titleInfo'>Select Country for Information</h4>";
                }
                else
                {
                    getInfo($_GET['citycode']);
                }
                ?>
                    
                </section>
            </div>

            <div class="box map">
                <h3>Map</h3>
                    <?php buildMap(); ?>
            </div>

            <div class="box travelphotos">
                <h3>Travel Photos</h3>
            <picture id="photosList"> 
                <?php getPhotos($_GET['citycode']) ?>
            </picture></div>
            <?php 
                buildPopLogin();
                buildPopSignup();
            ?>
        </main>
        <script src="js/pop.js"></script>
        <script src="js/filter.js"></script>
    </body>
</html>