<?php 
    include("includes/header.inc.php");
    include("includes/session.inc.php");
    include("includes/search.inc.php");
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
                foreach($_SESSION['favPhoto'] as $f) {
                    echo "<a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=". $f['ImageID'] . "'><img src='images/square150/" . $f['Path'] . "'></a>";
                }
                ?>
            </div>
        </main>
    </body>
</html>