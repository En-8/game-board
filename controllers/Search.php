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
            
            // $searchResultXMLObject = simplexml_load_string($searchResult); NO LONGER NEEDED; SEARCH RESULT COMES BACK AS A SIMPLE XML OBJECT
            //print_r($searchResultXML);
            
            $this->view->render('search', $searchResult);
        }
        else
        {
            $this->view->render('search');
        }
    }
}


?>