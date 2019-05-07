<?php
    require_once 'views/templates/header.php';
    $userId = $_SESSION['user_id'];
    $gameId = $data['gameId'];
    $gameName = $data['gameName'];
    
?>

<main>
    <form method="POST" action="<?=baseURL?>/log/view/<?=$userId?>/<?=$gameId?>/<?=$gameName?>">
        <fieldset>
            <legend><h1>Log a play for <?=$gameName?></h1></legend>
            <label for="playTime">Play time (in minutes): </label>
            <input type="text" name="playTime">
            <label for="date">Date played: </label>
            <input type="date" name="date"/>
            <label for="notes">Notes:</label>
            <textarea name="notes"></textarea>
            <input type="submit" name="submit" value="Log Play"/>
        </fieldset>
</form>
</main>


<?php require_once 'views/templates/footer.php'; ?>