<?php 
    include("includes/header.inc.php");
    include("includes/countryfilter.inc.php");
?>
<!DOCTYPE html>
<html>
<?php buildHead(); ?>
<title>Cities</title>  
<link rel="stylesheet" href="css/citieslayout.css">  
</head>
<body>
<?php buildMenu(); ?>

<main class="container">

<?php buildCountryFilter(); ?>

  <div class="box info">
      <h3>Information</h3>
      <h4 id="titleInfo">Select Country for Information</h4>
      <section id="infoSec">
          
      </section>  
  </div>

    <div class="box map">
        <h3>Map</h3>
            
    </div>

    <div class="box travelphotos">
        <h3>Travel Photos</h3> 
    <picture id="photosList"> </picture></div>
</main>
</body>
</html>