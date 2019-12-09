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
               
                buildPopLogin();
                buildPopSignup();
            ?>

<div class='box filter'>
        <h3>Photo Filter</h3>
        <br>
        <h4>Text Search</h4>
        <form method="get" action="<?=$_SERVER['REQUEST_URI']?>">
                <input type='text' id='text' name='Title' placeholder="Search Box for Photos"><br>
                <button class="button" type="submit"> Search Text </button>
            </form>
        <br>
        <h4>Filter Country</h4>
            <form method="get" action="<?=$_SERVER['REQUEST_URI']?>">
                <button class="button" type="submit"> Filter </button>   
                <?php populateCountryList(); ?>
            </form>
            <br>
        <?php if(isset($_GET['ISO'])){
            echo "<h4>Filter City</h4>";
            echo "<form method=get action='".$_SERVER['REQUEST_URI'] . "'> ";
            echo "<button class=button type=submit> Filter </button> ";
            populateCityList($_GET['ISO']);
            echo " </form>";

        } ?>
       

    </div>

    <div class='box search'>
        <h3>Browse/Search</h3>
        <?php
                if($_SERVER["REQUEST_METHOD"] == "GET") {
                    if (isset($_GET['ISO'])) {
                        outputCountryPhotos($_GET['ISO']);
            ?>
                   
            <?php
                    }
                    else if (isset($_GET['CityCode'])) {
                    outputCityPhotos($_GET['CityCode']);
                    }
                    else if (isset($_GET['Title'])) {
                        if(! empty($_GET['Title'])) {
                            filterTitle($_GET['Title']);
                        }
                    }
                    else {outputPhotos();}
            }
            else if ($_POST['action'] = "filterTitle") {
                filterTitle();
            }
            if(isset($_GET['Add'])) {addSessionElement();}
            ?>
    </div>

            
            

            
        </main>
        <script src="js/pop.js"></script>
    </body>
</html>