<?php 
    include("includes/header.inc.php");
    include("includes/profile.inc.php");
    include("includes/session.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Home</title>
    </head>
    <body>
        <?php 
            buildMenu_In();
            buildProfilePage();
        ?>
    </body>
</html>