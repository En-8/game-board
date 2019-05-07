<?php

require_once 'views/templates/header.php';

$userId = $data['userId'];
$gameId = $data['gameId'];
$gameName = $data['gameName'];
$username = $data['username'];

echo $data['error'];
?>
<main>
<section class="play-log">
    <h1><?=$username?>'s <?=$gameName?> Play Log</h1>
<?php
    echo $data['message'];
    if (!empty($data['playLog']))
    {
?>
        <table id="log-table">
            <tr><th class="log-table-date">Date</th><th class="log-table-pt">Play Time</th><th class="log-table-notes">Notes</th></tr>
<?php
            $count = 0;
            $totalPlayTime = 0;
            foreach ($data['playLog'] as $play)
            {
?>
                <tr><td class="log-table-date"><?=$play['date_of_play']?></td><td class="log-table-pt"><?=$play['play_time']?></td><td class="log-table-notes"><?=$play['notes']?></td></tr>
<?php
                $count++;
                $totalPlayTime += $play['play_time'];
            }
?>
            <tr><td colspan="3">You've played <?=$gameName?> <?=$count?> times for a total of <?=$totalPlayTime?> minutes.</td></tr>
        </table>
<?php
    }
    
// Only show the form for logging a play if a user is viewing their own play log.
if ($_SESSION['user_id'] == $userId)
{
?>
<a href="<?=baseURL?>/log/logform/<?=$gameId?>/<?=$gameName?>" class="button">Log a Play</a>
<?php
}
?>


</section>
</main>
<?php require_once 'views/templates/footer.php';?>
