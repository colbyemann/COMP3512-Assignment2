<?php 
    include("includes/header.inc.php");
    include("includes/validate.inc.php");
    include("includes/search.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Browse/Search</title>
        <link rel="stylesheet" type="text/css" href="css/searchlayout.css">
    </head>
    <body>
        <?php
            //session_start();
            if(isset($_SESSION['logged_in'])) {
                buildMenu();
                buildLogoutMenu();
            }
            else {
                buildMenu();
                buildLoginMenu();
            }
        ?>
        <main class="container">
            <?php 
                buildSearch(); 
                buildPopLogin();
                buildPopSignup();
            ?>
                
            
                <form method="get" action="<?=$_SERVER['REQUEST_URI']?>">
                    <input type='text' id='text' value=''><br>
                <button class="button" type="submit"> Filter </button>   
                    
                <?php
                    populateCountryList();
                ?>
                </form>
            <?php
            
            
            
            
            
            
            if($_SERVER["REQUEST_METHOD"] == "GET") {
               if (isset($_GET['ISO'])) {
                   outputCountryPhotos($_GET['ISO']);
            ?>
                <form method="get" action="<?=$_SERVER['REQUEST_URI']?>">
                    <button class="button" type="submit"> Filter </button>   
                    <?php
                    populateCityList($_GET['ISO']);
                    ?>
                </form>
                    
            <?php
               }
                else if (isset($_GET['CityCode'])) {
                   outputCityPhotos($_GET['CityCode']);
                }
                else {
                    outputPhotos();
                }
            }
            else if ($_POST['action'] = "filterTitle")
            {
                filterTitle();
            }
            ?>
            
            
            
            
            
            
            
        </main>
        <script src="js/pop.js"></script>
    </body>
</html>