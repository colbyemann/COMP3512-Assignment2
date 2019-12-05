<?php 
    include("includes/header.inc.php");
    include("includes/validate.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>About</title>
        <link rel="stylesheet" type="text/css" href="css/about.css">
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
        <main class="container">
            <div class='box'>
                <h2>COMP 3512 Assignment 2</h2>
                <h3>Mount Royal University</h3>
                <p>Professor: Randy Connolly</p>
                <p>Fall 2019 Semester</p>
                <br>
                <h3>Collaborators:</h3>
                <p><a href="https://github.com/colbyemann" target="_blank">Colby Emann</a>,
                <a href="https://github.com/bstuike" target="_blank">Byron Stuike</a>, &
                <a href="https://github.com/jwola586" target="_blank">Jakub Wolak</a></p>
                <a href="https://github.com/colbyemann/COMP3512-Assignment2" target="_blank">Assignment Repository</a>
            </div>
            <?php 
                buildPopLogin();
                buildPopSignup();
            ?>
        </main>
        <script src="js/pop.js"></script>
    </body>
</html>