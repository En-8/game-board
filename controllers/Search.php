<?php

class Search extends Controller
{
    private $bggBaseURI = 'https://www.boardgamegeek.com/xmlapi2/';
    
    public function __construct()
    {
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
            $userSearch = $_POST['userSearch']; // THIS SHOULD BE PARAMETER OF INDEX FUNCTION
            $searchResult = $this->model->search($userSearch);
            
            $data = array('searchResult' => $searchResult);
            $this->view->render('search', $data);
        }
        else
        {
            $this->view->render('search');
        }
    }
}


?>