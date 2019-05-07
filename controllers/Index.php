<?php

class Index extends Controller
{
    private $data = array('activityStream' => '', 'gameData' => '', 'message' => '');
    
    public function __construct()
    {
        if (!isset($_SESSION['user_id']))
        {
            header('Location: ' . baseURL . '/login');
        }
        parent::__construct();
        require_once 'models/Activity_model.php';
        require_once 'models/BggAPI_model.php';
        $this->model = new Activity_model();
        $this->api = new BggAPI_model();
        $this->data['activityStream'] = $this->model->getActivityStream($_SESSION['user_id']);
        $this->data['gameData'] = $this->getGameData($this->data['activityStream']);
        
        //var_dump($this->data['gameData']);
        
        $this->view->render('index', $this->data);
        
        
        ////
        //  Use this if you decide you want the user to be immediatedly prompted to login on site landing.
        //
        /*if (isset($_SESSION['user_id']))
        {
            $this->view->render('index');
        }
        else
        {
            $this->view->render('login');
        }*/
    }
    
    private function getGameData($activityStream)
    {
        $gamesById = array();
        
        foreach($activityStream as $activity)
        {
            if (!in_array($activity['source_id'], $gamesById))
            {
                $gamesById[] = $activity['source_id'];
            }
        }
        
        // get actual game data from BGG API.
        if (!empty($gamesById))
        {
            $gameData = $this->api->getThings($gamesById);
            return $gameData;
        }
        else
        {
            return false;
        }
    }
}
?>