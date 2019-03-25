<?php
    class Collections extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            
            $this->load->model('collection_model');
        }
        
        public function index($user_id = NULL)
        {
            if ($user_id === NULL)
            {
                show_404(); // Display a more informative error. Maybe redirect to login/signup.
            }
            
            $data['title'] = 'Your Game Collection';
            $data['games'] = $this->collection_model->get_user_collection($user_id);
            
            $this->load->view('templates/header', $data);
            $this->load->view('collections/index', $data);
            $this->load->view('templates/footer', $data);
        }
    }
?>