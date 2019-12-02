<?php 
    include("includes/header.inc.php");
    include("includes/validate.inc.php");
    include("includes/countryfilter.inc.php");
    include("includes/single-country.inc.php");
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
                <?php

                if(!isset($_GET['ISO']))
                {
                    echo "<h4 id='titleInfo'>Select Country for Information</h4>";
                }
                else
                {
                    getInfo($_GET['ISO']);
                }
                ?>
            </div>

            <div class="box city">
                <h3>City List</h3>
                <section>
                    <ul id="cityList">
                                <?php

                if(!isset($_GET['ISO']))
                {
                    echo "<h4>Select Country for Information</h4>";
                }
                else
                {
                    getCities($_GET['ISO']) ;
                }
                ?>
                        
                    </ul>
                </section>
            </div>

            <div class="box travelphotos">
                <h3>Travel Photos</h3>
                <picture id="photosList">
                
                <?php

                if(!isset($_GET['ISO']))
                {
                echo "<h4>Select Country for Images</h4>";
                }
                else
                {
                getPhotos($_GET['ISO']);
                }
                ?>
                </picture>
            </div>
            <?php 
                buildPopLogin();
                buildPopSignup();
            ?>
        </main>
        <script src="js/storage.js"></script>
        <script src="js/pop.js"></script>
        <script src="js/filter.js"></script>
        
    </body>
</html>