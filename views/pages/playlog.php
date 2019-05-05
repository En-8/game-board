<?php

require_once 'views/templates/header.php';

$userId = $data['userId'];
$gameId = $data['gameId'];
$gameName = $data['gameName'];

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
    <h1>Username's <?=$gameName?> Play Log</h1>
<?php
    echo $data['message'];
    if (!empty($data['playLog']))
    {
?>
        <table>
            <tr><th>Date</th><th>Play Time</th><th>Notes</th></tr>
<?php
            $count = 0;
            foreach ($data['playLog'] as $play)
            {
?>
                <tr><td><?=$play['date_of_play']?></td><td><?=$play['play_time']?></td><td><?=$play['notes']?></td></tr>
<?php
                $count++;
            }
?>
            <tr><td colspan="3">You've played <?=$gameName?> <?=$count?> times.</td></tr>
        </table>
<?php
    }
?>


</section>

<?php require_once 'views/templates/footer.php';?>
