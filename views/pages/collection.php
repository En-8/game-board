<?php require_once 'views/templates/header.php';?>

<a class="button" href="<?= baseURL ?>/search">Add a game</a>

<?=$data['message']?>

<section class="game-collection">
<?php
    if (isset($data['collection']))
    {
        foreach ($data['collection'] as $game)
        {
?>
            <article class="game-card">
                <img />
                <p class="game-title"><?= $game['game_id'] ?></p>
            </article>
<?php
        }
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
