<?php require_once 'views/templates/header.php';?>

<a class="button" href="<?= baseURL ?>/search">Add a game</a>

<?=$data['message']?>

<section class="game-collection">
<?php
    if (isset($data['message']))
    {
        echo $data['message'];
    }

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
                <a href="<?=baseURL?>/collections/remove/<?=$id?>/<?=$name?>">Remove From Collection</a>
                <a href="https://boardgamegeek.com/boardgame/<?=$id?>">More info on BGG.com</a>
            </article>

<?php
        }
        
        // TODO set up try/catch to handle if API call doesn't function correctly.
    }
    else
    {
?>
    <p>Your collection is empty! Add games to get started managing your collection.</p>
<?php
    }
?>
</section>

<?php require_once 'views/templates/footer.php';?>
