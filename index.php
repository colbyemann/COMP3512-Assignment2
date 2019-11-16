<?php 
    include("includes/header.inc.php");
    include("includes/home.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>COMP 3512 Assign2</title>
        <link rel="stylesheet" type="text/css" href="css/homelayout.css">
    </head>
    <body>
        <?php buildMenu(); ?>
        <main class="container">
            <?php buildHomePage(); ?>
        </main>
    </body>
</html>