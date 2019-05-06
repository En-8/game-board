<?php

require_once 'views/templates/header.php';
$userId = $data['userId'];


if ($_SESSION['user_id'] == $userId)
{
?>
<a class="button" href="<?= baseURL ?>/search">Add a game</a>
<a class="button" href="<?= baseURL ?>/collections/import">Import BoardGameGeek collection</a>
<?php
}
elseif ($data['following'])
{
?>
<span class="button">Following</span>
<?php
}
else
{
?>
<a class="button" href="<?= baseURL ?>/collections/follow/<?=$userId?>">Follow this collection</a> 
<?php
}
?>
<?=$data['message']?>

<section class="game-collection">
<?php
    if (!empty($data['collection']))
    {
        $collection = $data['collection'];
        
        foreach ($collection as $game)
        {
            $id = $game->attributes()->id->__toString();
            $name = $game->name[0]['value']->__toString();
            $yearPublished = $game->yearpublished->attributes()->__toString();
            $thumbnail = $game->thumbnail->__toString();
?>
            <article class="game-card">
                <div class="card-image" style="background-image: url(<?=$thumbnail?>)"></div>
                <p><?= $name ?></p>
                <p><?= $yearPublished ?></p>
<?php
                if ($_SESSION['user_id'] == $userId)
                {
                    $user
?>
                    <a href="<?=baseURL?>/collections/remove/<?=$id?>/<?=$name?>">Remove From Collection</a>
<?php
                }
?>
                <a href="<?=baseURL?>/log/view/<?=$userId?>/<?=$id?>/<?=$name?>">View Log</a>
                <a href="https://boardgamegeek.com/boardgame/<?=$id?>">More info on BGG.com</a>
            </article>

<?php
        }
        
        // TODO set up try/catch to handle if API call doesn't function correctly.
    }
?>

</section>

<?php require_once 'views/templates/footer.php';?>
