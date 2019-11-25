<?php 
    require_once("includes/config.inc.php");
    require_once("includes/db-functions.inc.php");

    include("includes/validate.inc.php");
    include("includes/header.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>About</title>
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
            <div class='box'>
                <h1>Colby Emann</h1>
                <h1>Jakub </h1>
                <h1>Byron Stuike</h1>
                <a href="https://github.com/colbyemann/COMP3512-Assignment2">https://github.com/colbyemann/COMP3512-Assignment2</a>
            </div>
            <?php buildPopupMenus(); ?>
        </main>
        <script src="js/pop.js"></script>
    </body>
</html>