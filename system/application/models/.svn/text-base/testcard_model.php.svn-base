<?php

class Testcard_model extends Model
{
	
	function get_id ($test_id, $testcard_nr) 
	{
		// Choose the testcard to show

		$this->db->select('id');
		$this->db->where('test_id', $test_id);
		$this->db->where('testcard_nr', $testcard_nr);
		$this->db->from('testcard');
		$query = $this->db->get();

		if($query->num_rows() == 0)
			return false;
		
		$query = $query->result();
		$testcard_id = $query[0]->id;
		
		return $testcard_id; 
	}
	


	function get_task($testcard_id) 
	{
		
		$this->db->select();
		$this->db->where('testcard_id', $testcard_id);
		$this->db->where('type_id', 1);  // Only the original
		$this->db->join('type', 'translation.type_id = type.id');
		$this->db->from('translation');
		$this->db->order_by('type_id');
		return $this->db->get()->result();
		
	}
    
    function get_card_nr($testcard_id)
    {
        $this->db->select();
        $this->db->where('id', $testcard_id);
        $this->db->from('testcard');
        $result = $this->db->get()->result();
        
        return $result[0]->testcard_nr;
        
    }




	function check_user_translation($testcard_id, $user_id)
	{
		$this->db->select('id');
		$this->db->where('user_id', $user_id);
		$this->db->where('testcard_id', $testcard_id);
		$this->db->from('translation');
		
		$query = $this->db->get();
		
		if( $query->num_rows() == 1) 
		{
			return true;
		}
		
		return false;
	
	}
    
    function check_translations($testcard_id) 
    {
        $this->db->where('testcard_id', $testcard_id);
        $query = $this->db->get('translation');
        
        if($query->num_rows() > 0)
        {
            return true;
        }
        
        return false;
    }    
    
	function update_error($id, $data)
	{
		
		$this->db->where('id', $id);
		
		return $this->db->update('error', $data); 

	}
    
	
	function add_user_translation($testcard_id, $user_id)
	{
	
		$new_user_translation_insert_data = array (
					
			'user_id' => $user_id,
			'type_id' => '4',
			'testcard_id' => $testcard_id,
			'text' => $this->input->post('text')
				
			);
		
		$insert = $this->db->insert('translation', $new_user_translation_insert_data);
		
		return $insert;
	
	}
	
	
	
	function get_answer($testcard_id, $user_id = 0 )
	{
		$this->db->select('translation.id as translation_id, text, type.id as id, type.order as type_order, type, user_id, real_name');
		$this->db->where('testcard_id', $testcard_id);
		$this->db->join('type', 'translation.type_id = type.id');
        
        $users = array ($user_id, '0', NULL);
        $this->db->where_in('user_id', $users);
          
        $this->db->from('translation');
		$this->db->order_by('type_order');
		return $this->db->get()->result();
	}
	
	
    function add($test_id, $testcard_nr)
    {
   	    $new_testcard = array (
					
			'test_id' => $test_id,
			'testcard_nr' => $testcard_nr
							
			);
		
		$insert = $this->db->insert('testcard', $new_testcard);
		
		return $insert;
        
    }
    
    
    function delete($testcard_id) 
    {
      
        $this->db->where('id', $testcard_id);

        return $this->db->delete('testcard');
    }
    
    
    
}


?>