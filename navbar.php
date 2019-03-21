<nav class="navbar">
    <a class="logo" href="index.php">Logo Placeholder</a>
    <div class="utilities">
        <?php
        require_once 'startsession.php';
        
        if (!isset($_SESSION['user_id']))
        { ?>
            <a href="login.php" class="utility-button login">Log In</a>
            <a href="signup.php" class="utility-button signup">Sign Up</a>
        <?php
        }
        else
        {
        ?>
            <a href="logout.php" class="utility-button">Log Out</a>
        <?php
        }
        ?>
    </div>
</nav>