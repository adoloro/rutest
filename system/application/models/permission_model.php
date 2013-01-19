<?php

class Permission_Model extends MY_Model
{

    protected $table_name = "permission";


	// Syncs the permissions for the current user


    function permissions_array($user_id)
    {
		// Get the test permissions for the current user
		$this->db->from($this->table_name);
		$this->db->select("test_id");
		$this->db->where('user_id', $user_id);

		return $this->db->get()->result_array();

    }

	function get_user_permissions($user_id)
	{
		// Get the test permissions for the current user
		$this->db->from($this->table_name);
		$this->db->select("test_id");
		$this->db->where('user_id', $user_id);

		return $this->db->get()->result();
	}


    function delete_user_permissions($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete($this->table_name);

    }


	function get_test_description_permissions($user_id)
	{
		$this->db->select('permission.id, test.title, allowed_to_take_test, allowed_to_see_test_result');
		$this->db->from('permission');
        $this->db->where('user_id', $user_id);
	    $this->db->join('test', 'permission.test_id = test.id');

		return $this->db->get()->result_array();

	}


	function get_tests_without_permissions($user_id)
	{
		// Get the tests which are not yet set permissions for the user

        $user_permissions = $this->assoc_array_to_array( $this->permissions_array($user_id), 'test_id');
        if($this->get_user_permissions($user_id) == array()):
            return  $this->get_all_test_ids_objects();
        else:
            $this->db->select("test.id");
            $this->db->from("test");
            $this->db->where_not_in('test.id',
                                     $user_permissions);
            return  $this->db->get()->result();
         endif;

		//("Tests with no permissions set");
		//print_r($tests_without_permissions);

	}



    function get_all_test()
    {
        $this->db->from("test");
        $this->db->select("id");
        return $this->db->get();

    }



	function get_all_test_ids()
	{

		return $this->assoc_array_to_array ($this->get_all_test()->result_array(), 'id');

	}


    function get_all_test_ids_objects()
    {

        return $this->get_all_test()->result();

    }



	function get_orphan_permissions()
	{

		$this->db->from("permissions");
		$this->db->select('id');
		$this->where_not_in('test_id', $this->get_all_test_ids());

		return $this->db->get()->result();
	}


	function sync($user_id)
	{
        
		foreach ($this->get_tests_without_permissions($user_id) as $test)
			$this->create($user_id, $test->id);


		//print_r($this->get_orphan_permissions());

		//foreach($this->get_orphan_permissions() as $permission)
		//	$this->delete($permission->id);

	}

	function create($user_id, $test_id)
	{

		$new_permission_insert_data = array (

			'user_id' => $user_id,
			'test_id' => $test_id,
			'allowed_to_take_test' => 0,
			'allowed_to_see_test_result' => 0
		);

		$insert = $this->db->insert('permission', $new_permission_insert_data);

		return $insert;

	}




}	


?>