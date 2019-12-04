<?php 
    include("includes/header.inc.php");
    include("includes/validate.inc.php");
    include("includes/single-photo.inc.php");
    getArray();
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Photo</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/singlephoto.css">
        <link rel="stylesheet" type="text/css" href="css/popmenus.css">
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
            
<div class="box pictureFrame">
  <div id="picBox">
  <div id="bigImage">
      <?php getImage($_GET['ImageID']); ?>
    

  </div>
  
  </div>

  <div id="box2">
  <div id="pictureInfo">
  <?php getInfo($_GET['ImageID']); ?>
  </div>

  <div id ="bigButons">
    <input id="favs" type="button" value="Add to Favourites">
  </div>
  
  <div id="tabBox">
  <input id="picDesc" type="button" value="Description">
  <input id="picDetails" type="button" value="Details">
  <input id="picMap" type="button" value="Map">
      <div id="descBox">
          <?php getDesc($_GET['ImageID']); ?>

      </div>
      <div id="detailBox">
          <div id="detailBoxInside">
          
          <?php  getExif($_GET['ImageID']);?>
          
          </div>
          <br>
          <h4>Colors:</h4>
          <div id="colors">
            <section> </section>
          </div>
      </div>
      <div id="mapBox">
      <?php  getmap($_GET['ImageID']);?>
      </div>
    </div>

  </div>
</div> 

  </div>
        </main>
        <script src="js/storage.js"></script>
        <script src="js/photo.js"></script>
    </body>
</html>