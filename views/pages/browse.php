<?php require_once 'views/templates/header.php';?>

<main class="collections">
    <h1>Explore Collections</h1>

    <?php
    if (!empty($data['collection']))
    {
    
    ?>
    
    
    <table>
        <tr><th>Username</th><th></th></tr>
    <?php
        foreach ($data['collection'] as $collection)
        {
    ?>
            <tr>
                <td><?=$collection['username']?></td>
                <td><a href="<?=baseURL?>/collections/index/<?=$collection['id']?>">View Collection</a></td>
            </tr>
    <?php
        }
    ?>
    </table>
    <?php
    }
    ?>
</main>



<?php require_once 'views/templates/footer.php'; ?>