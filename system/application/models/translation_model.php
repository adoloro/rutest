<?php

class Translation_model extends MY_Model
{


    function get_comments($translation_id)
    {
        $this->db->where('translation_id', $translation_id);
		//$this->db->where('lang_id', $language);
        $this->db->from ('comment');
        $this->db->order_by('id');
        
        
        return $this->db->get()->result();
        
    }	
    

    function get_users_with_translations_in_testcard($testcard_id)
    {
        $this->db->from('translation');
        $this->db->select('user_id');
        $this->db->distinct();
        $this->db->where('testcard_id', $testcard_id);

        $user_translation_id = 4;
        $this->db->where('type_id', $user_translation_id);

        return $this->assoc_array_to_array( $this->db->get()->result_array(), 'user_id');

    }

    function get_native_translators_in_testcard($testcard_id)
    {
        $user_translation_id = 4;
        $original_translation_type = 1;
        $this->db->from('translation');
        $this->db->select('type_id');
        $this->db->where('testcard_id', $testcard_id);
        $this->db->where('type_id  !=', $user_translation_id);
        $this->db->where('type_id  !=', $original_translation_type);

        $this->db->distinct();

        $native_translators = $this->assoc_array_to_array( $this->db->get()->result_array(), 'type_id');

        $this->db->from('type');
        $this->db->select('id, type, real_name');
        $this->db->where_in('id', $native_translators);

        return $this->db->get()->result();
    }


    function get_translations($test_id, $permission_id_type, $id)
    {
        return  
            $this->db->query(
            "SELECT testcard_nr, translation.`text` FROM
                (SELECT *
                    FROM translation
                    WHERE
                    ". $permission_id_type .  " = " . $id . " AND
                    testcard_id
                    IN (
                        SELECT id
                        FROM testcard
                        WHERE test_id = " . $test_id .  "
                        ORDER BY testcard_nr)) AS translation

            INNER JOIN testcard ON
            translation.testcard_id = testcard.id
            ORDER BY testcard_nr;")->result();
    }






    function get_user_translations($test_id,  $user_id)
    {
        return $this->get_translations($test_id, "user_id", $user_id);
    }

    function get_original($test_id)
    {
        $original_type = 1;

        return $this->get_translations($test_id, "type_id", $original_type);
    }

    function get_professional($test_id)
    {
        $professional_translation_type = 2;
        return $this->get_translations($test_id, "type_id", $professional_translation_type);
    }




    function get_users($testcard_id)
    {
        $users = $this->get_users_with_translations_in_testcard($testcard_id);
        if(empty($users))
            show_error('No users took this test');
        else {
            $this->db->from('user');
            $this->db->select('id, last_name, first_name');
            $this->db->where_in('id', $users);

        return $this->db->get()->result();
        }
    }


    
    function update($translation_id, $data)
    {   
                    
        $this->db->where('id', $translation_id);
        return $this->db->update('translation', $data); 
    }



	function update_comment($id, $data)
	{
		
		$this->db->where('id', $id);
		
		return $this->db->update('comment', $data); 
	
	}
    
    
    
    
    function get_translation($translation_id) 
    {
        
        $this->db->from('translation');
       
        $this->db->select('translation.id as translation_id, text, type.id as id, type, real_name');
		$this->db->where('translation.id', $translation_id);
		$this->db->join('type', 'translation.type_id = type.id');
       
             
        return $this->db->get()->result();
    }
    
    
	
    function get_errors( $testcard_id)
    {
        $this->db->where('testcard_id', $testcard_id);
        $this->db->from('error');
        
        return $this->db->get()->result();
    }
   
   
   	function add()
	{
		$new_translation_insert_data = array (
					
			'user_id' => '0',
			'type_id' => $this->input->post('type_id'),
			'testcard_id' => $this->input->post('testcard_id'),
			'text' => $this->input->post('text')
				
			);
		
		$insert = $this->db->insert('translation', $new_translation_insert_data);
		
		return $insert;
	
	}

   
   
   
   function has_comments($translation_id)
   {
        $this->db->where('translation_id', $translation_id);
        $this->db->from('comment');
        
        return ($this->db->get()->num_rows == 0) ? false : true;
   }
   
   
   function get_translation_types()
   {
        return $this->db->get('type')->result();
   }
   

   
}

?>