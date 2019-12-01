<?php 
    include("includes/header.inc.php");
    include("includes/validate.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Photo</title>
    </head>
    <body>
        <?php
            buildMenu();
            if(isset($_SESSION['logged_in'])) {
                buildLogoutMenu();
            }
            else {
                buildLoginMenu();
            }
        ?>
        <main>
            <div id="singlePhoto"></div>
        </main>
        <script src="js/storage.js"></script>
        <script src="js/single-photo.js"></script>
    </body>
</html>