<?php
Class MY_Model extends Model {
 
 
    protected $table_name; // Will be redeclared in child's class
    protected $db_fields;
    
    
	function MY_Model() 
    {
		parent::Model();
        
	}



    function assoc_array_to_array($assoc_array, $key)
	{

		$stack = array();

			foreach ($assoc_array as $row)
				array_push($stack, $row[$key]);


		return $stack;

	}

    
    function load_db_fields()
    {
		$this->db_fields =  $this->db->list_fields( $this->table_name ); 
		
    }


    
    function get_table_name()
    {
        return $this->table_name;
    }
    
    
    
    function get_dropdown_select($id_column, $value_column, $order_by)
	{
		$this->db->select( $id_column . ', ' . $value_column); //change this to the two main values you want to use
		$this->db->from($this->table_name);
        $this->db->order_by($order_by);

		$query = $this->db->get();
		foreach($query->result_array() as $row){
		        $data[$row[$id_column]] = $row[ $value_column ];
		}

		return $data;

	}



    
    function get_all($order_by = 'id')
    {
        $this->db->order_by($order_by);
        
        return $this->db->get($this->table_name)->result();
    }



	function get_where($field, $value )
	{
		
		return $this->db->getwhere($this->table_name, array($field => $value))->result();
	}
    



    function get_field_data()
    {
		return  $this->db->field_data($this->table_name);

    }
    

	function get_fields()
	{
		return $this->db->list_fields($this->table_name);	
	}


    
    function get_by_id($id, $order_by = 'id')
    {
        $this->db->order_by($order_by);
        $this->db->where('id', $id);
        $result = $this->db->get($this->table_name)->result();
        
        return (array) $result[0];
    }
    
    
    
	function insert($data) 
    {
		//do insert data into database
		$insert = $this->db->insert($this->table_name, $data);
		
		return $insert;
    }
        
 	function get_biggest_value_in_field ( $field )
	{
		if ($this->db->field_exists ($field, $this->table_name))
		{
			$big_value = 0;
			$this->db->select($field);
			$results = $this->db->get($this->table_name)->result();

				foreach($results as $item)
				{
					$item = (array) $item;
					$item = $item[$field]; 
					if ($item > $big_value)
						$big_value = $item;
				}
				
			return $big_value;
		}
		
	}

 
 
	function update($data) 
    {
        //do update data into database
        //$data = array(
        //               'title' => $title,
        //               'name' => $name,
        //               'date' => $date
        //            );

        
         $this->db->where('id', $data['id']);
         $this->db->update($this->table_name, $data); 
        
        // Produces:
        // UPDATE mytable 
        // SET title = '{$title}', name = '{$name}', date = '{$date}'
        // WHERE id = $id
		
	}
 
	function delete($id) 
    {
         if ($this->get_number_of_testcards($id) < 1)
         {
            $this->db->where('id', $id);
            return $this->db->delete( $this->table_name );
         }
  	
    
    }
        
        
    function count_by_id ($id) 
    {
        $this->db->where('id', $id);
		$this->db->from ( self::table_name );

	    
        return $this->db->count_all_results();
    }
    
    
    
    
}

?>