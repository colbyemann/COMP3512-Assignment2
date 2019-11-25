<?php 
    include("includes/header.inc.php");
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
            session_start();
            if(!isset($_SESSION['user_id'])) {
                buildMenu_Out();
                exit;
            }
            else {
                buildMenu_In();
            }
        ?>
        <main class="container">
            <?php buildSearch(); ?>
        </main>
    </body>
</html>