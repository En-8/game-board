<?php
    // TODO extract 'generateHotList()'
    
    $hotListRequest = "https://www.boardgamegeek.com/xmlapi2/hot?type=boardgame";
    
    // Request hot list data from boardgamegeek.com
    // Returns XML as a String upon execution
    $cHandler = curl_init($hotListRequest);
    curl_setopt($cHandler, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cHandler, CURLOPT_HEADER, 0);
    $dataString = curl_exec($cHandler);
    
    // Generate SimpleXMLElement Object from String
    $dataXML = simplexml_load_string($dataString)
            or die("Error Loading XML");
            
?>

    <section class="hot-list flex-container">
    
<?php
    // TODO generate cards for each game on the list
    // Parse XML, Display name of every game on the hot list
    foreach ($dataXML->children() as $game)
    {
?>
        <!-- Generate game card with css and html -->
        <article class="game-card" style="background-image:url(<?=$game->thumbnail['value']?>)">
        </article>
<?php
    }
?>

    </section>
