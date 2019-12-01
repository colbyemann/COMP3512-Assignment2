<?php 
    include("includes/header.inc.php");
    include("includes/validate.inc.php");
    include("includes/countryfilter.inc.php");
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
                <h4 id="titleInfo">Select Country for Information</h4>
                <section id="infoSec">
                    
                </section>
            </div>

            <div class="box map">
                <h3>Map</h3>
                    
            </div>

            <div class="box travelphotos">
                <h3>Travel Photos</h3>
            <picture id="photosList"> </picture></div>
            <?php 
                buildPopLogin();
                buildPopSignup();
            ?>
        </main>
        <script src="js/pop.js"></script>
    </body>
</html>