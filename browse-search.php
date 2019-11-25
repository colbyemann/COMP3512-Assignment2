<?php 
    include("includes/header.inc.php");
    include("includes/session-allow.inc.php");
    include("includes/validate.inc.php");
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
            //session_start();
            if(isset($_SESSION['user_id'])) {
                buildMenu();
                buildLogoutMenu();
            }
            else {
                buildMenu();
                buildLoginMenu();
            }
        ?>
        <main class="container">
            <?php buildSearch(); ?>
            <?php buildPopupMenus(); ?>
        </main>
        <script src="js/pop.js"></script>
    </body>
</html>