<?php 
    include("includes/header.inc.php");
    include("includes/session.inc.php");
    include("includes/profile.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="css/profilelayout.css">
    </head>
    <body>
        <?php 
            buildMenu();
            buildLogoutMenu();
            buildProfilePage();
        ?>
    </body>
</html>