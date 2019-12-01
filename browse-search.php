<?php 
    include("includes/header.inc.php");
    include("includes/validate.inc.php");
    include("includes/search.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Browse/Search</title>
        <link rel="stylesheet" type="text/css" href="css/searchlayout.css">
        <link rel="stylesheet" type="text/css" href="css/popmenus.css">
    </head>
    <body>
        <?php
            //session_start();
            if(isset($_SESSION['logged_in'])) {
                buildMenu();
                buildLogoutMenu();
            }
            else {
                buildMenu();
                buildLoginMenu();
            }
        ?>
        <main class="container">
            <?php buildSearch(); ?>
            <?php 
                buildPopLogin();
                buildPopSignup();
                filterArea();
                outputPhotos();
            ?>

        </main>
        <script src="js/pop.js"></script>
    </body>
</html>

<?php

function allPhotosStatement ()
{
    $sql = 'SELECT * FROM imagedetails';
    return $sql;
}

function getAllPhotos() 
{
 try {
       $connection = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
        $sql = allPhotosStatement();
        $result = runQuery($connection, $sql, null);
        return $result;

   }
   catch (PDOException $e) {
      die( $e->getMessage() );
   }
}

function outputPhotos()
{
    $photos = getAllPhotos();
    foreach($photos as $p) {
       outputSinglePhoto($p); 
    }
}

function outputSinglePhoto($photo)
{
   echo "<img src='images/square150/". $photo['Path'] . "'>";
   echo "<button type=button>View</button>";
   echo "<button type=button>Add to Favourites</button>";
}

function filterArea()
{
    echo "<select></select>";
    echo "<select></select>";
}


?>