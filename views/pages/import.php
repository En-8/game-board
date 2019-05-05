<?php
require_once 'views/templates/header.php';

if (isset($_SESSION['user_id']))
{
?>
    <form method="POST" action="<?=baseURL?>/collections/import">
        <label for="username">BoardGameGeek Username: </label>
        <input type="text" name="username"/>
        <input type="submit" name="submit" value="Import Collection"/>
    </form>

<?php
}

?>







<?php require_once 'views/templates/footer.php' ?>