<?php 
    include("includes/header.inc.php");
    include("includes/session-redirect.inc.php");
    include("includes/profile.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Home</title>
    </head>
    <body>
        <?php 
            buildMenu_Out();
            buildProfilePage();
        ?>
    </body>
</html>