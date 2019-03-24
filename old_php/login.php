<?php
    require_once 'connectvars.php';
    require_once 'appvars.php';
    require_once 'startsession.php';

    // Clear the error message
    $error_msg = "";

    // If the user isn't logged in, try to log them in
    if (!isset($_SESSION['user_id']))
    {
        if (isset($_POST['submit']))
        {
            // Connect to the database
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die("Error connecting to MySQL server");

            // Grab the user-entered log-in data
            $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
            
            echo $user_username;

            if (!empty($user_username) && !empty($user_password))
            {
                // Check user credentials against database.
                $query = "SELECT id, username FROM users"
                        . " WHERE username = '$user_username' AND password = '$user_password'"; // TODO encrypt password
                $data = mysqli_query($dbc, $query)
                        or die("Error checking credentials against database");

                if (mysqli_num_rows($data) == 1)
                {
                    // The log-in is OK: set the user ID and username session vars (and cookies), and redirect to the home page
                    $row = mysqli_fetch_array($data);
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    setcookie('user_id', $row['id'], time() + THIRTY_DAYS);
                    setcookie('username', $row['username'], time() + THIRTY_DAYS);
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
                    header('Location: ' . $home_url);
                }
                else
                {
                    // The username/password are incorrect so set an error message
                    $error_msg = 'Sorry, you must enter a valid username and password to log in.';
                }
            }
            else
            {
                // The username/password weren't entered so set an error message
                $error_msg = 'Sorry, you must enter your username and password to log in.';
            }
        }
    }
    
    // Display page header and navbar
    $pageTitle = 'Log In';
    require_once 'header.php';

    // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
    if (empty($_SESSION['user_id']))
    {
        echo '<p class="error">' . $error_msg . '</p>';
?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <legend>Log In</legend>
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br />
            <label for="password">Password:</label>
            <input type="password" name="password" />
        </fieldset>
        <input type="submit" value="Log In" name="submit" />
    </form>

<?php
    }
    else
    {
        // Confirm the successful log-in
        echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
    }

    // Display site footer
    // require_once 'footer.php';
?>


