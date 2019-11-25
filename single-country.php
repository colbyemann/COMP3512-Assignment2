<?php 
    require_once("includes/config.inc.php");
    require_once("includes/db-functions.inc.php");

    include("includes/validate.inc.php");
    include("includes/header.inc.php");
    include("includes/countryfilter.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Countries</title>
        <link rel="stylesheet" type="text/css" href="css/countrieslayout.css">
        <link rel="stylesheet" type="text/css" href="css/popmenus.css">
    </head>
    <body>
        <?php
            if(!isset($_SESSION['user_id'])) {
                buildMenu_Out();
            }
            else {
                buildMenu_In();
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

            <div class="box city">
                <h3>City List</h3>
                <section>
                    <ul id="cityList">Select Country</ul>
                </section>
            </div>

            <div class="box travelphotos">
                <h3>Travel Photos</h3>
                <picture id="photosList"></picture>
            </div>
            <?php buildPopupMenus(); ?>
        </main>
        <script src="js/pop.js"></script>
    </body>
</html>