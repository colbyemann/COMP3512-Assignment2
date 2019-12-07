<?php 
    include("includes/header.inc.php");
    include("includes/session.inc.php");
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
                foreach($_SESSION['favPhoto'] as $p) {
                    echo "<img src='images/square150/" . $p . "'>";
                }
                ?>
            </div>
        </main>
    </body>
</html>