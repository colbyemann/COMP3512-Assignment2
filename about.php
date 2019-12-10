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
            <section class='box'>            
                <h2>Acknowledgements</h2>
                <h3>W3 Schools</h3>
                    <ul><a href="https://www.w3schools.com/php/php_form_validation.asp" target="_blank"><li>Form Validation</li></a></ul>
                <h3>PHP.net</h3>
                    <ul>
                        <a href="https://www.php.net/manual/en/function.preg-replace.php" target="_blank"><li>preg_replace</li></a>
                        <a href="https://www.php.net/manual/en/function.uasort.php" target="_blank"><li>uasort</li></a>
                    </ul>
                <h3>WP-Mix</h3>
                    <ul><a href="https://wp-mix.com/php-search-multidimensional-array/" target="_blank"><li>Search Multi-Dimensional Array</li></a></ul>
                <h3>Hero Image</h3>
                    <ul><a href="https://www.pexels.com/photo/photo-of-curve-road-near-grass-and-trees-3026093/" target="_blank">
                    <li><em>Curve Road Near Grass and Trees</em></a> by <a href="https://www.pexels.com/@rickyrecap" target="_blank">Ricardo Esquivel</li></a></ul>
                </section>
            <?php 
                buildPopLogin();
                buildPopSignup();
            ?>
        </main>
        <script src="js/pop.js"></script>
    </body>
</html>