<?php
    require_once 'header.php';
    
    // Check user credentials
    if (!isset($_SESSION['user_id']))
    {
        // redirect to the homepage
    }
    
    
    // generate a self-posting form for adding a game to a collection.
    // check if the game they are trying to add already exists in the games table
        // if not, add it to the games table, getting the info from BGG using search function of API
    // Add the user_id and game_id to the collections table.
    // Confirm successful addition or show error on failed addition.
        // If successful, provide links to "Add another" or "View collection"
        // if failed, display error and regenerate form.
        
    
    
?>