<?php require_once 'views/templates/header.php'; ?>

<main>
    <form method="POST" action="<?=baseURL?>/login">
        <fieldset>
            <legend><h1>Log In to start managing your board game collection</h1></legend>
            <label for="username">Username: </label>
            <input type="text" name="username"/>
            <label for="username">Password: </label>
            <input type="password" name="password"/>
            <input class="button" type="submit" value="Log In" name="submit"/>
        </fieldset>
</form>
</main>

<?php require_once 'views/templates/footer.php'; ?>