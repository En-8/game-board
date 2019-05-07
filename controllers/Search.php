<?php

class Search extends Controller
{
    private $bggBaseURI = 'https://www.boardgamegeek.com/xmlapi2/';
    
    public function __construct()
    {
        if (!isset($_SESSION['user_id']))
        {
            header('Location: ' . baseURL . '/login');
        }
        parent::__construct();
        require 'models/BggAPI_model.php';
        $this->model = new BggAPI_model();
        $this->index();
    }
    
    /**
     * This method queries the BGG API for whatever the user types into a search bar 
     * 
     * 
     */
    public function index()
    {
        if (isset($_POST['search']))
        {
            // Get user query from search input field then request data from BGG API
            $data = array('searchResult' => '', 'error' => '');
            
            $userSearch = $_POST['userSearch']; // THIS SHOULD BE PARAMETER OF INDEX FUNCTION
            if ($searchResult = $this->model->search($userSearch))
            {
                $data['searchResult'] = $searchResult;
            }
            else
            {
                $data['error'] = '<p class="error">You search return no results. Please try again with a different search</p>';
            }

            $this->view->render('search', $data);
        }
        else
        {
            $this->view->render('search');
        }
    }
}


?>