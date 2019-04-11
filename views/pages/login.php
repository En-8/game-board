<?php require_once 'views/templates/header.php'; ?>

<h1>Log In to start managing your board game collection</h1>

<form method="post" action="<?= $baseURL ?>/login"> <!-- TODO: INSERT ACTION PATH HERE -->
    <label for="username">Username: </label>
    <input type="text" name="username"/>
    <label for="username">Password: </label>
    <input type="text" name="password"/>
    <input type="submit" value="Log In" name="submit"/>
</form>


<?php require_once 'views/templates/footer.php'; ?>