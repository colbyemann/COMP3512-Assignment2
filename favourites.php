<?php 
    include("includes/header.inc.php");
    include("includes/session.inc.php");
    include("includes/search.inc.php");
    include("includes/favourites.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Favourites</title>
    </head>
    <body>
        <?php 
            buildMenu();
            buildLogoutMenu();
        ?>
        <main class="container">            
            <div class='box'>
                <?php
                    buildFavouritesPage();
                ?>
            </div>
        </main>
    </body>
</html>