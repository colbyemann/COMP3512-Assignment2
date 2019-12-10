<?php

function buildHomePage()
{
	echo "<div class='indexbox'>
    <h1>Welcome to World Explorer Online</h1>
		<div class='loginbuttons'>
				<input id='login' type='button' onclick='openLoginForm()' value='LOGIN'>
				<input id='join' type='button' onclick='openSignupForm()' value='JOIN'>
		</div><br>
		<div class='searcharea'>
        <h2>Search for a photo of your choice</h2>
        <form method='get' action='browse-search.php?'>
        <input type='text' id='text' name='Title' placeholder='Search Box for Photos'>
        <button class='button' type='submit'> Search Text </button>
        </form>
		</div>
	</div>";
}

?>