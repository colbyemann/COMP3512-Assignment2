<?php
    require_once("includes/config.inc.php");
    require_once("includes/db-functions.inc.php");

function buildHead()
{
	echo "<head>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='author' content='Colby, Jakub, & Byron'>
		<meta name='description' content='COMP 3512 Assignment #2: Multi-Page App'>

		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,800' rel='stylesheet'>    
		<link rel='stylesheet' type='text/css' href='css/styles.css'>
		<link rel='icon' type='image/x-icon' href='images/airplane.ico'>
		
		";
};

function buildMenu()
{
	echo "<header class=header>
		<!-- Image retrieved from www.freeiconspng.com/downloadimg/2517 -->
		<img class=logo src='images/airplane.png' alt='Airplane' style='width:40px;height:40px;'>
		<a href='#' class='logo'>Assignment 2</a>
		<input class='menu-btn' type='checkbox' id='menu-btn'/>
		<label class='menu-icon' for='menu-btn'><span class='navicon'></span></label>
		<ul class='menu'>
			<li><a href='profile.php'>Home</a></li>
			<li><a href='about.php'>About</a></li>
			<li><a href='browse-search.php'>Search</a></li>
			<li><a href='single-country.php'>Countries</a></li>
			<li><a href='single-city.php'>Cities</a></li>
		";
};

function buildLogoutMenu()
{
	echo "	<li><a href='favourites.php'>Favs</a></li>
			<li><a href='logout.php'>Logout</a></li>
		</ul>
	</header>";
};

function buildLoginMenu()
{
	echo "	<li><a href='favourites.php'>Favs</a></li>
			<li onclick='openLoginForm()'><a href=#>Login</a></li>
			<li onclick='openSignupForm()'><a href=#>Signup</a></li>
		</ul>
	</header>";
};

?>