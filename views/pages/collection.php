<?php

require_once 'views/templates/header.php';
$userId = $data['userId'];
$username = $data['username'];

?>
<main>
<div class="collection-btn-group">
<?php
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
<a class="button" href="<?= baseURL ?>/collections/follow/<?=$userId?>">Follow this collection</a> <!-- need to make sure a user cannot be followed multiple times. -->
<?php
}
?>
</div>

<section class="game-collection">
<?php
if ($_SESSION['user_id'] == $userId)
{
    echo "<h1>Your Collection</h1>";
}
else
{
    echo "<h1>$username's Collection</h1>";
}
?>
<?=$data['message']?>
<div class="game-collection-content">
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
                <p class="game-name"><?= $name ?></p>
                <p class="year-published"><?= $yearPublished ?></p>
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
</div>
</section>
</main>

<?php require_once 'views/templates/footer.php';?>
