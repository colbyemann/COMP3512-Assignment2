<?php

function buildHomePage()
{
	echo "<div class='box'>
		<div class='heroimage'>	
			<!-- Image retrieved from https://images.unsplash.com/photo-1573554394544-930a4cf6fc66?ixlib=rb-1.2.1&auto=format&fit=crop&w=752&q=80 -->
			<img src='images/vista.jpg'>
		</div><br>
		<div class='loginbuttons'>
				<input id='login' type='button' onclick='openLoginForm()' value='LOGIN'>
				<input id='join' type='button' onclick='openSignupForm()' value='JOIN'>
		</div><br>
		<div class='searchbar'>
        <form method='get' action='browse-search.php?'>
				<input type='text' id='text' name='Title' placeholder='Search Box for Photos'>
                <button class='button' type='submit'> Search Text </button>
        </form>
		</div>
	</div>";
}

?>