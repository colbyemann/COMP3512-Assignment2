<?php

function buildHead()
{
echo "<head>
   <meta charset=utf-8/>  
    <meta name=viewport content=width=device-width> 

    <link href=https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,800 rel=stylesheet>    
    <link rel=stylesheet href=css/styles.css>
    
";
};

function buildMenu()
{
    echo "<header class=header>
    <a href='' class=logo>Assignment 2</a>
    <input class=menu-btn type=checkbox id=menu-btn />
    <label class=menu-icon for=menu-btn><span class=navicon></span></label>
    <ul class=menu>
      <li><a href=index.php>Home</a></li>
      <li><a href=about.php>About</a></li>
      <li><a href=browse-search.php>Search</a></li>
      <li><a href=countries.php>Countries</a></li>
      <li><a href=cities.php>Cities</a></li>
      <li><a href=upload.php>Upload</a></li>
      <li><a href=favorites.php>Favs</a></li>
      <li><a href=upload.php>Login/Logout</a></li>
      <li><a href=signup.php>Sign up</a></li>
    </ul>
  </header>";
};
