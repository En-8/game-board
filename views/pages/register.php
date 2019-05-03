<?php require_once 'views/templates/header.php'; ?>

<h1>Register to start managing your board game collection</h1>

<form method="post" action="<?= $baseURL ?>/register">
    <label for="username">Desired Username: </label>
    <input type="text" name="username"/>
    <label for="username">Password: </label>
    <input type="text" name="password"/>
    <label for="username">Confirm Password: </label>
    <input type="text" name="confirmPassword"/>
    <input type="submit" value="Log In" name="submit"/>
</form>


<?php require_once 'views/templates/footer.php'; ?>