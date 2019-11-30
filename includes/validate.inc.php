<?php 

    session_start();
    $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);

    if (isset($_POST['login'])) {
        $username = $_POST['email'];
        $password = $_POST['password'];
        $sql = $connection->prepare("SELECT UserID, UserName, Password FROM userslogin WHERE UserName=:email");
        $sql->bindParam("email", $username, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    
        if (!$result) {
            echo '<p class="error">Email or password is wrong!</p>';
        } else {
            if (password_verify($password, $result['Password'])) {
                $_SESSION['logged_in'] = true;
                header('Location: profile.php');
            } else {
                echo '<p class="error">Email or password is wrong!</p>';
            }
        }
    }
    
    if (isset($_POST['signup'])) {
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $username = $_POST['email'];
        $password = $_POST['password'];
        $digest = password_hash($password, PASSWORD_BCRYPT);

        $sql = $connection->prepare("SELECT UserName FROM userslogin WHERE UserName=:email");
        $sql->bindParam("email", $username, PDO::PARAM_STR);
        $sql->execute();
     
        if ($sql->rowCount() > 0) {
            echo '<p class="error">The email address is already registered!</p>';
        }
     
        if ($sql->rowCount() == 0) {
            $statement = $connection->prepare("INSERT INTO users(FirstName,LastName,City,Country,Email) VALUES (:fname,:lname,:city,:country,:email)");
            $statement->bindParam("fname", $firstname, PDO::PARAM_STR);
            $statement->bindParam("lname", $lastname, PDO::PARAM_STR);
            $statement->bindParam("city", $city, PDO::PARAM_STR);
            $statement->bindParam("country", $country, PDO::PARAM_STR);
            $statement->bindParam("email", $username, PDO::PARAM_STR);
            $insert = $statement->execute();

            $sql = $connection->prepare("INSERT INTO userslogin(UserName,Password) VALUES (:email,:digest)");
            $sql->bindParam("email", $username, PDO::PARAM_STR);
            $sql->bindParam("digest", $digest, PDO::PARAM_STR);
            $result = $sql->execute();
     
            if ($result) {
                $_SESSION['logged_in'] = true;
                header('Location: profile.php');
            } else {
                echo '<p class="error">Something went wrong!</p>';
            }
        }
    }

    function buildPopLogin() {
        echo "<div class='popup' id='login-box'>
            <form method='post' action='' class='form-box'>
                <h2>Login</h2>
        
                <label for='email'><b>Email</b></label>
                <input type='text' autocomplete='username' placeholder='Enter Email' name='email' required>
        
                <label for='password'><b>Password</b></label>
                <input type='password' autocomplete='current-password' placeholder='Enter Password' name='password' required>
        
                <button type='submit' name='login' value='login' class='btn'>Login</button>
                <button type='button' class='btn cancel' onclick='closeForm()'>Cancel</button>
            </form>
        </div>";
    };

    function buildPopSignup() {
        echo "<div class='popup' id='signup-box'>
            <form method='post' action='' class='form-box'>
                <h2>Sign up</h2>

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
                <input type='password'  autocomplete='new-passwordd' placeholder='Enter password' name='password' required>
                
                <label for='password-confirm'><b>Confirm Password</b></label>
                <input type='password' autocomplete='new-password' placeholder='Confirm password' name='psw-confirm' required>

                <button type='submit' name='signup' value='signup' class='btn'>Sign Up</button>
                <button type='button' class='btn cancel' onclick='closeForm()'>Cancel</button>
            </form>
        </div>";
    };

?>