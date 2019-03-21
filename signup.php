<?php
    require_once 'appvars.php';
    require_once 'connectvars.php';
    
    $pageTitle = 'Sign Up';
    require_once 'header.php';
    require_once 'navbar.php';

    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die("Error connecting to MySQL server");

    if (isset($_POST['submit'])) {
        // Grab the profile data from the POST
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
        $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));

        if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
            // Make sure someone isn't already registered using this username
            $query = "SELECT * FROM users WHERE username = '$username'";
            $data = mysqli_query($dbc, $query)
                    or die("Error querying database");
            if (mysqli_num_rows($data) == 0) {
                // The username is unique, so insert the data into the database
                $query = "INSERT INTO users (username, password) VALUES ('$username', '$password1')";
                mysqli_query($dbc, $query)
                        or die("Error querying database");

                // Confirm success with the user
                echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>';

                mysqli_close($dbc);
                exit();
            }
            else {
                // An account already exists for this username, so display an error message
                echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
                $username = "";
            }
        }
        else {
            echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
        }
    }

    mysqli_close($dbc);
?>

    <p>Please enter your username and desired password to sign up to GameBoard.</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <legend>Registration Info</legend>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
            <label for="password1">Password:</label>
            <input type="password" id="password1" name="password1" /><br />
            <label for="password2">Confirm Password:</label>
            <input type="password" id="password2" name="password2" /><br />
        </fieldset>
        <input type="submit" value="Sign Up" name="submit" />
    </form>

<?php
    //require_once 'footer.php';
?>
