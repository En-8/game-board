<?php
    require_once 'startsession.php';
    if (isset($_SESSION['user_id']))
    {
        $collectionURL = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/collection.php';
        header('Location: ' . $collectionURL);
    }
    
    require_once 'header.php';

    

?>
<body>
    <header>
        <h1>Game Board</h1>
        <h2>A TableTop Social Network</h2>
    </header>
</body>
</html>