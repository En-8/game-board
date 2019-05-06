<?php require_once 'views/templates/header.php'; ?>

<h1>Your Followed Collections</h1>

<?php
if (!empty($data['collection']))
{

?>

<table>
    <tr><th colspan="2">Username</th></tr></tr>
<?php
    foreach ($data['collection'] as $collection)
    {
?>
        <tr><td><?=$collection['username']?></td><td><a href="<?=baseURL?>/collections/index/<?=$collection['user_id']?>">View Collection</a></td></tr>
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












<?php require_once 'views/templates/footer.php'; ?>