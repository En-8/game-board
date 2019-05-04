<?php

class Log extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require 'models/Log_model.php';
        require 'models/BggAPI_model.php';
        $this->model = new Log_model();
        $this->api = new BggAPI_model();
        
        $this->data = array('message' => '', 'userId' => '', 'gameId' => '', 'gameName' => '', 'playLog' => '');
    }
    
     /**
     * This function renders the play log page for the specified game by default.
     * If it receives data from a form, it logs a play for the specified game.
     * 
     * 
     */
    private function logPlay($gameId)
    {
        $userId = $_SESSION['user_id'];
        
        if (isset($_POST['submit']))
        {
            $playTime = $_POST['playTime'];
            $date = $_POST['date'];
            $playData = array('userId' => $userId, 'gameId' => $gameId, 'playTime' => $playTime, 'date' => $date);
            if ($this->model->logPlay($playData))
            {
                $this->data['message'] = 'Play successfully logged! Changes to your play log should be reflected below.';
            }
            else
            {
                $this->data['message'] = 'There was an error logging your play. Please try again.';
            }
        }
    }
    
    
    public function view($userId, $gameId, $gameName = '')
    {
        $this->data['userId'] = $userId;
        $this->data['gameName'] = $gameName;
        $this->data['gameId'] = $gameId;
        
        if (isset($_POST['submit']))
        {
            $this->logPlay($gameId);
        }
        
        // Fetch the user's log for specified game
        if ($playLog = $this->model->fetchPlayLog($userId, $gameId))
        {
            $this->data['playLog'] = $playLog;
        }
        else
        {
            if ($_SESSION['user_id'] == $userId)
            {
                $this->data['message'] = 'You haven\'t played this game yet. Go play!';
            }
            else
            {
                $this->data['message'] = 'This person hasn\'t played this game yet. Ask them to play with you!';
            }
        }
        
        $this->view->render('playlog', $this->data);
    }
}



?>