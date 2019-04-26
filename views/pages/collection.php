<?php require_once 'views/templates/header.php';?>

<a class="button" href="<?= baseURL ?>/search">Add a game</a>

<section class="game-collection">
<?php
    foreach ($data as $game)
    {
?>
        <article class="game-card">
            <img />
            <p class="game-title"><?= $game['name'] ?></p>
        </article>
<?php
    }
?>
</section>

<?php require_once 'views/templates/footer.php';?>
