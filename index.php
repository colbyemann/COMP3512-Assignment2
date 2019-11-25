<?php
include("includes/header.inc.php");
include("includes/validate.inc.php");
include("includes/home.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Login / Sign Up</title>
        <link rel="stylesheet" type="text/css" href="css/homelayout.css">
        <link rel="stylesheet" type="text/css" href="css/popmenus.css">
    </head>
    <body>
        <?php 
            buildMenu();
            buildLoginMenu();
        ?>
        <main class="container">
            <?php 
                buildHomePage();
                buildPopupMenus();
            ?>
        </main>
        <script src="js/pop.js"></script>
    </body>
</html>