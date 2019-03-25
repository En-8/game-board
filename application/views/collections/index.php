<h2><?=$title?></h2>

<?php print_r($games); // FOR TESTING?>

<?php foreach($games as $game): ?>
    <h3><?= $game['name'] ?></h3>
<?php endforeach ?>