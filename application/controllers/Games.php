<?php
    class Games extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('game_model');
        }
        
        public function index()
        {
            $data['games'] = $this->game_model->getGames();
            $data['title'] = 'Game Collection';
            
            $this->load->view('templates/header', $data);
            $this->load->view('games/index', $data);
            $this->load->view('templates/footer', $data);
        }
        
        public function view($slug = NULL)
        {
            $this->game_model->getGames($slug);
        }
    }
?>