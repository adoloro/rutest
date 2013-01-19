<?php

class User_Model extends MY_Model
{
  
    protected $table_name = "user";
    

  	function _find() 
	{
		// Compare the post variables 'email' and 'password' with the database
		//  information  contained in the 'user' database. 
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', sha1($this->input->post('password')));
		$query = $this->db->get('user');
		
		return $query; 
	}
    

	
	//User methods
	function validate() 
	{
		$query = $this->_find();
			
		if($query->num_rows == 1) 
		{
			return $query->result();
		}
		
		return false;	
	}
	
	function create() 
	{
		
		$new_user_insert_data = array (
		
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'password' => sha1($this->input->post('password')),
			'admin' => $this->input->post('admin')		
		);
		
		$insert = $this->db->insert('user', $new_user_insert_data);
		
		return $insert;
		
	}


    function password_has_changed($user_id, $password)
    {

        $this->db->select('password');
        $this->db->from($this->table_name);
        $this->db->where('id', $user_id);

        $query = $this->db->get();
        $row = $query->row();

        return ($row->password != $password );


    }
	
	function update()
	{

        $password = $this->input->post('password');
        $user_id = $this->input->post('id');

		$data = array (
         
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'admin' => $this->input->post('admin'),
            'group_id' => $this->input->post('group_id')
		);

        if($this->password_has_changed($user_id, $password))
            $data['password'] = sha1($password);
		
		
		$this->db->where('id', $this->input->post('id'));
		$this->db->update($this->table_name, $data); 
	}
	
}	


?>