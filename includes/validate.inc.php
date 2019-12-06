<?php 

    session_start();
    $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
    $today = date('Y-m-d h:i:sa');
    $state = 1;

    if (isset($_POST['login'])) {
        // Remove illegal characters from inputed email address
        $username = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $sql = $connection->prepare("SELECT UserID, UserName, Password FROM userslogin WHERE UserName=:email");
        $sql->bindValue("email", $username, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    
        if (!$result) {
            echo '<p class="error">Email or password is wrong!</p>';
        } else {
            if (password_verify($password, $result['Password'])) {
                $_SESSION['logged_in'] = true;
                header('Location: profile.php');
            } else {
                echo '<p class="popup error">Email or password is incorrect!</p>';
            }
        }
    }
    
    if (isset($_POST['signup'])) {
        $firstname = sanitize($_POST['fname']);
        $lastname = sanitize($_POST['lname']);
        $city = sanitize($_POST['city']);
        $country = sanitize($_POST['country']);
        $username = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];

        // Validate e-mail
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $sql = $connection->prepare("SELECT UserName FROM userslogin WHERE UserName=:email");
            $sql->bindValue("email", $username, PDO::PARAM_STR);
            $sql->execute();
        
            if ($sql->rowCount() > 0) {
                echo '<p class="popup error">That email address is already registered!</p>';
            }

            $digest = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            if($_POST["password"] === $_POST["confirm"]) {
                if ($sql->rowCount() == 0) {
                    $statement = $connection->prepare("INSERT INTO users(FirstName,LastName,City,Country,Email) VALUES (:fname,:lname,:city,:country,:email)");
                    $statement->bindValue("fname", $firstname, PDO::PARAM_STR);
                    $statement->bindValue("lname", $lastname, PDO::PARAM_STR);
                    $statement->bindValue("city", $city, PDO::PARAM_STR);
                    $statement->bindValue("country", $country, PDO::PARAM_STR);
                    $statement->bindValue("email", $username, PDO::PARAM_STR);
                    $insert = $statement->execute();

                    $sql = $connection->prepare("INSERT INTO userslogin(UserName,Password,State,DateJoined) VALUES (:email,:digest,'$state','$today')");
                    $sql->bindValue("email", $username, PDO::PARAM_STR);
                    $sql->bindValue("digest", $digest, PDO::PARAM_STR);
                    $result = $sql->execute();
            
                    if ($result) {
                        $_SESSION['logged_in'] = true;
                        header('Location: profile.php');
                    } else {
                        echo '<p class="popup error">I&lsaquo;m sorry, something went wrong!</p>';
                    }
                }
            }
            else {
                echo '<p class="popup error">Passwords do not match!</p>';
            }
        }
        else {
            echo '<p class="popup error">That email address is not valid!</p>';
        }
    }

    //https://www.w3schools.com/php/php_form_validation.asp
    function sanitize($received) {
        $received = trim($received);
        $received = stripslashes($received);
        $received = htmlspecialchars($received);
        //https://www.php.net/manual/en/function.preg-replace.php
        $received = preg_replace("/[^a-zA-Z]/", "", $received);
        $received = filter_var($received, FILTER_SANITIZE_SPECIAL_CHARS);
        return $received;
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
    }

    function buildPopSignup() {
        echo "<div class='popup' id='signup-box'>
            <form method='post' action='' class='form-box'>
                <h2>Sign up</h2>

                <label for='fname'><b>First Name</b></label>
                <input type='text' placeholder='Enter first name' name='fname' pattern='[a-zA-Z]{1,}' required>

                <label for='lname'><b>Last Name</b></label>
                <input type='text' placeholder='Enter last name' name='lname' pattern='[a-zA-Z]{1,}' required>

                <label for='city'><b>City</b></label>
                <input type='text' placeholder='Enter city' name='city' pattern='[a-zA-Z]{1,}' required>

                <label for='country'><b>Country</b></label>
                <input type='text' placeholder='Enter country' name='country' pattern='[a-zA-Z]{1,}' required>

                <label for='email'><b>Email</b></label>
                <input type='text' autocomplete='username' placeholder='Enter email' name='email' required>

                <label for='pswd'><b>Password</b></label>
                <input type='password' autocomplete='new-passwordd' placeholder='Enter password' name='password' required>
                
                <label for='pswd-confirm'><b>Confirm Password</b></label>
                <input type='password' autocomplete='new-password' placeholder='Confirm password' name='confirm' required>

                <button type='submit' name='signup' value='signup' class='btn'>Sign Up</button>
                <button type='button' class='btn cancel' onclick='closeForm()'>Cancel</button>
            </form>
        </div>";
    }

?>