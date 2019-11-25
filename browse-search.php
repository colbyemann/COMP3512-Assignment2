<?php 
    require_once("includes/config.inc.php");
    require_once("includes/db-functions.inc.php");

    include("includes/validate.inc.php");
    include("includes/header.inc.php");
    include("includes/search.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Browse/Search</title>
        <link rel="stylesheet" type="text/css" href="css/searchlayout.css">
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
            <?php buildSearch(); ?>
            <?php buildPopupMenus(); ?>
        </main>
        <script src="js/pop.js"></script>
    </body>
</html>