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
				<input type='text' id='text' placeholder='Search Box for Photos'>
		</div>
	</div>";
};

function buildPopupMenus() {
    echo "<div class='popup' id='login-box'>
        <form autocomplete='on' action='login.php' class='form-box'>
            <h1>Login</h1>
    
            <label for='email'><b>Email</b></label>
            <input type='text' placeholder='Enter Email' name='email' required>
    
            <label for='psw'><b>Password</b></label>
            <input type='password' placeholder='Enter Password' name='psw' required>
    
            <button type='submit' class='btn'>Login</button>
            <button type='button' class='btn cancel' onclick='closeForm()'>Cancel</button>
        </form>
    </div>
    
    <div class='popup' id='signup-box'>
        <form autocomplete='on' action='signup.php' class='form-box'>
            <h1>Sign up</h1>

            <label for='fname'><b>First Name</b></label>
            <input type='text' placeholder='Enter first name' name='fname' required>

            <label for='lname'><b>Last Name</b></label>
            <input type='text' placeholder='Enter last name' name='lname' required>

            <label for='city'><b>City</b></label>
            <input type='text' placeholder='Enter city' name='city' required>

            <label for='country'><b>Country</b></label>
            <input type='text' placeholder='Enter country' name='country' required>

            <label for='email'><b>Email</b></label>
            <input type='text' placeholder='Enter email' name='email' required>

            <label for='psw'><b>Password</b></label>
            <input type='password' placeholder='Enter password' name='psw' required>
            
            <label for='psw-confirm'><b>Confirm Password</b></label>
            <input type='password' placeholder='Confirm password' name='psw-confirm' required>

            <button type='submit' class='btn'>Sign Up</button>
            <button type='button' class='btn cancel' onclick='closeForm()'>Cancel</button>
        </form>
    </div>";
};

?>