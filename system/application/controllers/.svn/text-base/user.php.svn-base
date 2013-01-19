<?php
require_once('crud.php');

Class User extends CRUD 
{
	//protected $model is inherited
	// protected $user_is_admin is inherited
	
    function __construct() 
    {
		parent::__construct('user');		
		$this->load->model('permission_model', 'permission');
        $this->load->model('group_model', 'group');
		
    }

 	function sync_permissions()
	{
        $user_id = $this->uri->segment(3);
		$this->permission->sync($user_id);
		$this->edit($user_id);
	}


    function remove_permissions()
    {
        $user_id = $this->uri->segment(3);
        $this->permission->delete_user_permissions($user_id);
        $this->edit($user_id);
    }


    function set_user_group()
    {
        $group_id = $this->uri->segment(3);

        $group_id = (($group_id) == '') ? '999' : $group_id;

        $this->session->set_userdata('group_id', $group_id);

        redirect('user/manage');
    }




    function manage()
    {   
        $data = $this->_prepare_view_data();
        $current_group = $this->session->userdata('group_id');
        $data['current_group'] = $current_group;


        if($current_group == 999)
            $data['query'] = $this->model->get_all('group_id');
        else
            $data['query'] = $this->model->get_where('group_id', $current_group);


        $data['javascript_file'] = "show_form.js";

        $data['groups']       = $this->group->get_all('id');
        $data['main_content'] = 'manage/user_overview';
        $this->load->view('includes/template', $data);
	
    }


    function create()
    {
        $this->model->create( $this->_prepare_post_data_for_model() );

   		$this->manage();
    }


	function edit()
    {
        $data                    = $this->_prepare_edit_data();
        $user_id                 = $this->uri->segment(3);
        $data['user_id']         = $user_id;
        $data['query_perm']      = $this->permission->get_test_description_permissions($user_id);
        $data['query']           = $this->model->get_by_id($user_id);
        $data['main_content']    = 'edit/user_template';
        $data['javascript_file'] = 'checkbox.js';
        $this->load->view('includes/template', $data);
    }
	

    function _prepare_edit_data()
	{
        $data = $this->_prepare_view_data();
		$data['select_options'] = $this->group->get_dropdown_select('id', 'name', 'name');

		return $data;
	}


}    

