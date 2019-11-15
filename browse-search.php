<?php 
    include("includes/header.inc.php");
    include("includes/search.inc.php");
?>
<!DOCTYPE html>
<html>
<?php buildHead(); ?>
<title>Browse/Search</title> 
<link rel="stylesheet" href="css/searchlayout.css">   
</head>
<body>
<?php buildMenu(); ?>
<main class="container">
    <?php buildSearch(); ?>
</main>
</body>
</html>