<?php require_once 'views/templates/header.php';?>

<?php
    foreach ($data as $game)
    {
?>
        <section class="game-card">
            <img />
            <p class="game-title"><?= $game['name'] ?></p>
        </section>
<?php
    }
?>

<?php require_once 'views/templates/footer.php';?>
