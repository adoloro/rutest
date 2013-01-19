<?php
require_once('crud.php');

Class Util extends Controller 
{

    function __construct() 
    {
        parent::Controller();
        $this->is_logged_in();
		$this->load->library('session');
        $this->load->scaffolding('translation');
        $this->load->model('Test_model', 'test');
		$this->load->model('Testcard_model', 'testcard');
    }
    
    
    

    
    
    function is_logged_in() 
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        
        if(!isset($is_logged_in) || $is_logged_in != true)
        {   
            redirect('login');
        }
    }
}


?>