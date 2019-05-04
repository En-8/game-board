<?php

require_once 'views/templates/header.php';

$userId = $data['userId'];
$gameId = $data['gameId'];
$gameName = $data['gameName'];

var_dump($data['playLog']);

// Only show the form for logging a play if a user is viewing their own play log.
if ($_SESSION['user_id'] == $userId)
{
?>
<form method="POST" action="<?=baseURL?>/log/view/<?=$userId?>/<?=$gameId?>/<?=$gameName?>">
    <label for="playTime">Play time (in minutes): </label>
    <input type="text" name="playTime">
    <label for="date">Date played: </label>
    <input type="date" name="date"/>
    <input type="submit" name="submit" value="Log Play"/>
</form>
<?php
}
?>

<section class="play-log">
    <h1>This is where the play log will go</h1>
    <?=$data['message']?>


</section>

<?php require_once 'views/templates/footer.php';?>
