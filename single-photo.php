<?php 
    include("includes/header.inc.php");
    include("includes/validate.inc.php");
    include("includes/single-photo.inc.php");
    include("includes/search.inc.php");
    getArray();
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Photo</title>
        <link rel="stylesheet" type="text/css" href="css/singlephoto.css">
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
        <main>
            <div class="box pictureFrame">
            <div id="picBox">
            
                <?php getImage($_GET['ImageID']); ?>
            
            </div>

            <div id="box2">
            <div id="pictureInfo">
                <?php getInfo($_GET['ImageID']); ?>
            </div>

            <div id ="bigButons">
                <?php
                getButton();
                ?>
            </div>

            <div id="tabBox">
                <input id="picDesc" type="button" value="Description">
                <input id="picDetails" type="button" value="Details">
                <input id="picMap" type="button" value="Map">
            <div id="descBox">
                <?php getDesc($_GET['ImageID']); ?>
            </div>
            <div id="detailBox">
            <div id="detailBoxInside">
                <?php getExif($_GET['ImageID']); ?>
            </div>
                <br>
                <h4>Colors:</h4>
                <div id="colors">
            <section>
                <?php getColors($_GET['ImageID']); ?>
            </section>
            </div>
            </div>
            <div id="mapBox">
                <?php getmap($_GET['ImageID']); ?>
            </div>
            </div>
            </div>
            </div> 
            </div>
            <?php 
                buildPopLogin();
                buildPopSignup();
            ?>
        </main>
        
        <script src="js/photo.js"></script>
        <script src="js/pop.js"></script>
    </body>
</html>