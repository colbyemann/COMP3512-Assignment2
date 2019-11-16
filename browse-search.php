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
        <?php buildMenu(); ?>
        <main class="container">
            <?php buildSearch(); ?>
        </main>
    </body>
</html>