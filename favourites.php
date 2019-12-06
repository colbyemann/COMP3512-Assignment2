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
                $array = array();
                $photos = getAllPhotos();

                foreach($photos as $p) {
                    //array_push($stack, $c['CountryName']);
                    $array[] = $p['Title'];
                }

                $pattern = "/^J/";
                $matches = preg_grep($pattern, $array);
                 
                // Loop through matches array and display matched names
                foreach($matches as $match){
                    echo $match . "<br>";
                }
                ?>
            </div>
        </main>
    </body>
</html>