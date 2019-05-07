<?php require_once 'views/templates/header.php'; ?>



<main>
    <form method="post" action="<?= $baseURL ?>/register">
        <fieldset>
            <legend><h1>Register to start managing your board game collection</h1></legend>
            <label for="username">Desired Username: </label>
            <input type="text" name="username"/>
            <label for="username">Password: </label>
            <input type="password" name="password"/>
            <label for="username">Confirm Password: </label>
            <input type="password" name="confirmPassword"/>
            <input class="button" type="submit" value="Register" name="submit"/>
        </fieldset>
    </form>
</main>


<?php require_once 'views/templates/footer.php'; ?>