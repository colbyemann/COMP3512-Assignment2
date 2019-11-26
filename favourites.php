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
    </body>
</html>