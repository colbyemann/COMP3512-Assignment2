<?php 

function buildPopupMenus() {
    session_start();
    $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);

    if (isset($_POST['login'])) {
        $username = $_POST['email'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT UserID, UserName, Password FROM userslogin WHERE UserName=:email");
        $query->bindParam("email", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        if (!$result) {
            echo '<p class="error">Email or password is wrong!</p>';
        } else {
            if (password_verify($password, $result['Password'])) {
                $_SESSION['user_id'] = $result['UserID'];
                header('Location: profile.php');
            } else {
                echo '<p class="error">Email or password is wrong!</p>';
            }
        }
    }
    
    if (isset($_POST['signup'])) {
 
        $username = $_POST['email'];
        $password = $_POST['password'];
        $digest = password_hash($password, PASSWORD_BCRYPT);
     
        $query = $connection->prepare("SELECT UserName FROM userslogin WHERE UserName=:email");
        $query->bindParam("email", $username, PDO::PARAM_STR);
        $query->execute();
     
        if ($query->rowCount() > 0) {
            echo '<p class="error">The email address is already registered!</p>';
        }
     
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO userslogin(UserName,Password) VALUES (:email,:digest)");
            $query->bindParam("email", $username, PDO::PARAM_STR);
            $query->bindParam("digest", $digest, PDO::PARAM_STR);
            $result = $query->execute();
     
            if ($result) {
                $_SESSION['user_id'] = $result['UserID'];
                header('Location: profile.php');
            } else {
                echo '<p class="error">Something went wrong!</p>';
            }
        }
    }

    echo "<div class='popup' id='login-box'>
        <form method='post' action='' class='form-box'>
            <h1>Login</h1>
    
            <label for='email'><b>Email</b></label>
            <input type='text' autocomplete='username' placeholder='Enter Email' name='email' required>
    
            <label for='password'><b>Password</b></label>
            <input type='password' autocomplete='current-password' placeholder='Enter Password' name='password' required>
    
            <button type='submit' name='login' value='login' class='btn'>Login</button>
            <button type='button' class='btn cancel' onclick='closeForm()'>Cancel</button>
        </form>
    </div>
    
    <div class='popup' id='signup-box'>
        <form action='' class='form-box'>
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
            <input type='text' autocomplete='username' placeholder='Enter email' name='email' required>

            <label for='psw'><b>Password</b></label>
            <input type='password'  autocomplete='new-passwordd' placeholder='Enter password' name='psw' required>
            
            <label for='psw-confirm'><b>Confirm Password</b></label>
            <input type='password' autocomplete='new-password' placeholder='Confirm password' name='psw-confirm' required>

            <button type='submit' name='signup' value='signup' class='btn'>Sign Up</button>
            <button type='button' class='btn cancel' onclick='closeForm()'>Cancel</button>
        </form>
    </div>";
};

?>