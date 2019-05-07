<?php

class Log extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require 'models/Log_model.php';
        require 'models/BggAPI_model.php';
        require 'models/Activity_model.php';
        require 'models/User_model.php';
        $this->model = new Log_model();
        $this->api = new BggAPI_model();
        $this->activities = new Activity_model();
        $this->user = new User_model();
        
        $this->data = array('username' => '', 'message' => '', 'userId' => '', 'gameId' => '', 'gameName' => '', 'playLog' => '', 'error' => '');
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
            $notes = $_POST['notes'];
            $playData = array('userId' => $userId, 'gameId' => $gameId, 'playTime' => $playTime, 'date' => $date, 'notes' => $notes);

            if ($this->model->logPlay($playData))
            {
                $this->data['message'] = '<p class="success">Play successfully logged! Changes to your play log should be reflected below.</p>';
                $this->activities->logActivity($userId, 3, $gameId);
            }
            else
            {
                $this->data['error'] = '<p class="error">There was an error logging your play. Please try again.</p>';
            }
        }
    }
    
    
    public function view($userId, $gameId, $gameName)
    {
        $this->data['userId'] = $userId;
        $this->data['gameName'] = $gameName;
        $this->data['gameId'] = $gameId;
        $this->data['username'] = $this->user->getUsername($userId);
        
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
                $this->data['message'] = '<p>You haven\'t played this game yet. Go play!</p>';
            }
            else
            {
                $this->data['message'] = '<p>This person hasn\'t played this game yet. Ask them to play with you!</p>';
            }
        }
        
        $this->view->render('playlog', $this->data);
    }
    
    public function logform($gameId, $gameName)
    {
        $this->data['gameId'] = $gameId;
        $this->data['gameName'] = $gameName;
        
        $this->view->render('logForm', $this->data);
    }
}



?>