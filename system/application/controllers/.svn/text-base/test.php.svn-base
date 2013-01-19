<?php
require_once('crud.php');

Class Test extends CRUD 
{
	//protected $model is inherited
	// protected $user_is_admin is inherited
	
    function __construct() 
    {
		parent::__construct('test');		
		$this->load->model('testlevel_model', 'testlevel');
		
		
    }

	function _prepare_view_data()
    {
        $data['admin'] = $this->user_is_admin();
        $data['model_name'] = $this->model_name;
        $data['fields'] = $this->model->get_fields();

        return $data;
    }


    function manage()
    {
        $data = $this->_prepare_view_data();
        $data['query'] = $this->model->get_all_tests();
        $data['main_content'] = 'manage/overview';
        $this->load->view('includes/template', $data);

    }

	function _prepare_edit_data()
	{
		$data = $this->_prepare_view_data();
		$data['fields'] = $this->model->get_field_data();
		$data['select_options'] = $this->testlevel->get_dropdown_select('id', 'level_name', 'order');
        
		return $data;
	}
    


	// @Override CRUD
	function _prepare_post_data_for_model()
	{
		$data = array();
		
		$query = $this->db->query('SELECT * FROM test'); 

		foreach ($query->list_fields() as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		
		return $data;
	}


	// @Override CRUD 
	function edit()
    {
		$data = $this->_prepare_edit_data();
        $id = $this->uri->segment(3);
        $data['query'] = $this->model->get_by_id($id); 
        $data['main_content'] = 'edit/test_template'; 
        	
        $this->load->view('includes/template', $data);
    }



 
	function create()
    {	
        $order_number = $this->input->post('order');
		$test_name    = $this->input->post('title');

		$biggest_order =  $this->model->get_biggest_value_in_field('order') + 1 ;
		
		$data = array (
			'title' => $test_name,
			'order' => (($order_number == '') ? $biggest_order : $order_number)
			
		);
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
		//$this->form_validataion->set_rules('order', 'order', 'trim');
        
        if($this->form_validation->run() == false)
        {
			redirect('test/manage');
        }
        else
        { 
           if ( $this->model->insert($data) )
			{
				$test_id = $this->model->get_id($test_name); // Find out the id of the newly created test
				
				$this->load->model('Testcard_model', 'testcard');
				$this->testcard->add($test_id, 1); // Each test should have at least 1 testcard
			}
			
        }
 
        $this->manage();
        
    }



	
}    

