<?php
require_once('crud.php');

Class Group extends CRUD
{
	//protected $model is inherited
	// protected $user_is_admin is inherited
	
    function __construct() 
    {
		parent::__construct('group');
		
    }
 
    
    
	// Overwrite manage from CRUD
   function manage()
    {   
        $data = $this->_prepare_view_data();

        $data['query'] = $this->model->get_all('name');


        $data['main_content'] = 'manage/overview';

        $this->load->view('includes/template', $data);

    }




}    

