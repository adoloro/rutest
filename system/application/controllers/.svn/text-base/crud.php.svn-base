<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class CRUD extends Controller 
{
	protected $user_is_admin;
	protected $model_name;
	
	// variable  $model is loaded in the controller



   function __construct($model_name) 
   {
		parent::__construct();
	    
		// Save model name
		$this->model_name = $model_name;		
		$this->load->model(ucwords($model_name) . '_model', 'model');
		
		// Load helper functions
        $this->is_logged_in(); // Check if the there
		$this->user_is_admin = $this->user_is_admin();	
		
		// Load libraries
		$this->load->library('session');
        
    }




    function _prepare_view_data()
    {
        $data['admin'] = $this->user_is_admin();
        $data['model_name'] = $this->model_name;
        $data['fields'] = $this->model->get_field_data();

        return $data;
    }
    


    function manage()
    {   
        $data = $this->_prepare_view_data();
        
        $data['query'] = $this->model->get_all('order');
        $data['main_content'] = 'manage/overview';
        $data['message'] = $this->session->flashdata('message');
				
        $this->load->view('includes/template', $data);
	
    }


    function edit()
    {
        $data = $this->_prepare_view_data();
        
        $id = $this->uri->segment(3);
        $data['query'] = $this->model->get_by_id($id); 
        $data['main_content'] = 'edit/template'; 
        	
        $this->load->view('includes/template', $data);
    }
    

    

	/* Take POST data and set its values into assosiative array for model (and ActiveRecord)
		to process
	 */
	function _prepare_post_data_for_model()
	{
		$data = array();
				
		foreach ($this->model->get_fields() as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}



	function create()
    {
        $this->model->insert( $this->_prepare_post_data_for_model() );

        $this->session->set_flashdata('message', 'A new ' . $this->model_name . ' was added to the database.');

   		$this->manage();
    }
	
    
    function update()
    {
       
  		// This method calls the appropriate model
		// The inherited class will know what model to call
		// The model knows all the information it needs to know to perform operations
		// on the CRUD
		
		// so the method should go like this: 
		// it should call the appropriate model, as stated before
		// and send all the necessary information needed by model to 
		// to complete the transaction
		// in this case it should provide it with pairs of ('id'=> '1', 'name'=> 'Vlad' )
		
     		$this->model->update  ( $this->_prepare_post_data_for_model() );
	
	    	$this->manage();


    }

    

    function delete()
    {
		$this->model->delete( $this->input->post('id'));
		$this->manage();
    }
    



    function is_logged_in() 
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
                
        if(!isset($is_logged_in) || $is_logged_in != true ||  ! $this->user_is_admin()  )
        {   
            redirect('login');
        }
    }
    



    function user_is_admin()
    {
        
        return ($this->session->userdata('admin') == 1) ? true : false;
        
    }
    
    
}