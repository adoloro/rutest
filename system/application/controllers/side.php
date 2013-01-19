<?php 
    
Class Side extends MY_Controller 
{


	function index() 
	{
		// Here we can add additional controls for users that are guests/usual users
		//TODO:Add additional controls
	
		$data['admin'] = $this->user_is_admin();
	    $data['query'] = $this->test->get_all('order');
	    $data['main_content'] = 'site_main';
	    $this->load->view('includes/template', $data);
	}

	
	function decide_card_action($action)
    {   

        $user_has_translation = $this->find_user_translation();
		
   
        if( $user_has_translation && $action == 'test')
            redirect ('site/open'. $this->get_test_and_card_uri() );

        
        if(!$user_has_translation && $action == 'open')
            redirect ('site/test'. $this->get_test_and_card_uri() );
            
        if(!$this->user_is_admin() && $action == 'edit')
            redirect('site/test' . $this->get_test_and_card_uri());
  
    }


   

    
      function test()
    {

                $this->check_testcard_before('test');
                $data = $this->get_testcard_data('test');
                $data['query']            = $this->testcard->get_task($this->get_testcard_id());

                if ($this->user_is_guest())
                {
                        $data['number_testcards'] = 4;
                        $data['main_content'] = "test_guest";

                        if($this->get_card_nr() > 4)
                                redirect('/');
                }

                $this->load->view('includes/template', $data);

    }


    
    
    function open()
    {   
        $this->check_testcard_before('open');
        

        $data = $this->get_testcard_data('open');
		if($this->user_is_guest())
			$data['number_testcards'] = 4;


        $data['demo_translation'] = $this->session->userdata($this->get_testcard_id());
        $data['query']            = $this->testcard->get_answer($this->get_testcard_id(), $this->get_user_id());

        $comment_language = $this->get_comment_language();

        $data['comments']          = $this->get_comment($data['query'], $comment_language);
        $data['comment_languages'] = $this->get_languages($comment_language);
        $data['comment_language']  = $comment_language;
        $data['comment_model']     = & $this->translation;

        
        $this->load->view('includes/template', $data);
    }



    function get_languages($comments_language)
    {
        if($comments_language == 'norwegian')
			return array('russian');
		
		if($comments_language == "russian")
			return array('norwegian');
		else
			return array('norwegian', 'russian');

//        return array_filter($languages, function ($item) use ($comments_language) { return ($item != $comments_language); });

    }

	function get_comment($query, $language)
    {
        $all_comments = array ();

        foreach($query as $row) :
	            $comments = $this->translation->get_comments($row->translation_id);
                foreach($comments as $comment):
                    $all_comments[] = $this->select_language($comment->text, $language);
                endforeach;
	    endforeach;

        return $all_comments;
    }

	
	function strip_lang_tags($text)
    {     
          return trim (preg_replace ( "/\s*--.+?--\s*/" ,  '' ,  $text  ));
          
    }
    
    function select_language($comment, $language)
    {
        $comment = preg_replace ("/\n+/", ' ', $comment);
        $comment = preg_replace ("/\s+/", ' ', $comment);
        $comment = $comment . " --language--"; // Add --delimiter-- as an end tag 
        
        //echo $comment . '<br />'; 
           
        $lang_start_pattern = '--' . $language . '--';
        
        //echo "Look for: " . $lang_start_pattern ."\n<br>";
        
        $lang_comment_select = $lang_start_pattern . '(.+?)\s*--'; 
        
          
        if($language == '') // If language string is empty, do not search, return comment untouched
            return $this->strip_lang_tags($comment);
        else
            if (!preg_match('/'. $lang_start_pattern . '/i' , $comment )) // if such a language wasn't found in the comment,
                return $this->strip_lang_tags($comment);                                         // return the comment
            else
            {    
                preg_match('/' . $lang_comment_select . '/i', $comment, $matches); // otherwise take only the comment in a certain language and return it.
                
              
                
                if(isset($matches[1]))
                    return trim($matches[1]);
                else
                {
                    return $this->strip_lang_tags($comment); 
                }                
                   
            } 
        
    }
    






	function get_comment_language()
    {

        $comment_language = $this->uri->segment(5);

        //var_dump($comment_language);

        // If we get any language in the uri, save it to the cookies
        if($comment_language != '')
        {
            // Save the language we got to the cookies
            $this->session->set_userdata('comment_language', $comment_language);
        }
        // If the the 4th segment is empty,
        else
        {
			$comment_language = $this->session->userdata('comment_language');
            // search the cookies for the comment language
            if($comment_language == '')
            {
                //And set it to Norwegian, if it's empty
                $this->session->set_userdata('comment_language', 'norwegian');
            }
        }


        return $this->session->userdata('comment_language');

    }
	
	
	
	
	
	
	
	
	

    function edit()
    {
        // Check if the the user is allowed to use this page
       $this->check_testcard_before('edit');
       
       
       $this->load->model('translation_model', 'translation', TRUE);
       
       $data                    = $this->get_testcard_data('edit'); 
       $data['query']           = $this->testcard->get_answer($this->get_testcard_id(), $this->get_user_id());
       $data['comment_model']   = & $this->translation;
       $data['testcard_id']     = $this->get_testcard_id();
       $data['edit_error_id']      = $this->input->post('error_id');   
       $this->load->view('includes/template', $data);
    }


}
/*** SIDE.php replacement for site */