<?php require_once 'views/templates/header.php'; ?>

<main class="collections">
<h1>Your Followed Collections</h1>

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
            <td><a href="<?=baseURL?>/collections/index/<?=$collection['user_id']?>">View Collection</a></td>
        </tr>
<?php
    }


?>
</table>

<?php
}
else
{
?>

<p>You're not following any collections yet!</p>

<?php
}
?>
</main>


<?php require_once 'views/templates/footer.php'; ?>