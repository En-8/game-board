<?php require_once 'views/templates/header.php';?>
<main>
    <form id="search" method="post" action="<?= baseURL ?>/search/index">
        <h1>Search for a game to add</h1>
        <input type="text" name="userSearch"/>
        <input class="button" type="submit" value="Search" name="search"/>
    </form>
<div class="game-collection">
<section class="game-collection-content">
<?php

    // var_dump($data);
    // print_r($data);
    
    if (isset($data['error']))
    {
        echo $data['error'];
    }

    if (!empty($data['searchResult']))
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
</div>
</main>

<?php require_once 'views/templates/footer.php';?>
