<?php
    require_once 'views/templates/header.php';
?>
<main>
    <?=$data['message']?>
<section class="activity-feed">
    <h1>Your Activity Feed</h1>

    <div class="activity-feed-items">
<?php
    foreach ($data['activityStream'] as $activity)
    {
        
        
        // Get data needed for activity card
        $username = $activity['username'];
        $gameId = $activity['source_id'];
        $activityDate = $activity['date'];
        $gameName = $data['gameData'][$gameId]->name[0]['value']->__toString();
        $gameImage = $data['gameData'][$gameId]->thumbnail->__toString();
        
        // Check activity type to generate appropriate message.
        switch ($activity['activity_type']) 
        {
            case 1:
                $message = "$username added $gameName to their collection";
                break;
            case 2:
                $message = "$username removed $gameName from their collection";
                break;
            case 3:
                $message = "$username played $gameName";
                break;
            default:
                $message = "Error retrieving record";
                break;
        }
        
?>
        <article class="activity-card">
            <div class="activity-card-content">
                <div class="thumbnail" style="background-image: url(<?=$gameImage?>)"></div>
                <div class="activity-card-text">
                    <h2><?=$message?></h2>
                    <p class="subheader"><?=$activityDate?></p>
                </div>
            </div>
        </article>


<?php
    }

?>
    </div>
</section>
</main>


<?php
    require_once 'views/templates/footer.php';
?>