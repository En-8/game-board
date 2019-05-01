<?php require_once 'views/templates/header.php';?>

<form method="post" action="<?= baseURL ?>/search/index">
    <input type="text" name="userSearch"/>
    <input type="submit" value="Search" name="search"/>
</form>

<section class="game-collection">
<?php

    // var_dump($data);
    // print_r($data);
    
    if (isset($data['message']))
    {
        echo $data['message'];
    }

    if (isset($data['searchResult']))
    {
        $searchResult = $data['searchResult'];
        
        foreach ($searchResult as $game)
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
                <a href="<?=baseURL?>/collections/add/<?=$id?>/<?=$name?>">Add To Collection</a>
                <a href="https://boardgamegeek.com/boardgame/<?=$id?>">More info on BGG.com</a>
            </article>

<?php
        }
        
        // TODO set up try/catch to handle if API call doesn't function correctly.
    }
?>

</section>

<?php require_once 'views/templates/footer.php';?>
