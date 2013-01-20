<?php 
    
Class Site extends MY_Controller 
{


	function index() 
	{
		$data['admin'] = $this->user_is_admin();
		$data['query'] = $this->_get_tests_to_display();
	    $data['main_content'] = 'site_main';
		$data['test_levels']  = $this->test->get_categories($this->get_user_id(), $this->user_is_admin());
        $data['current_test_level'] = $this->session->userdata('tests_to_display');
	    $this->load->view('includes/template', $data);
	}
	
	
	function test_level()
	{
		if(!$this->session->userdata('tests_to_display') || $this->uri->segment(3) == '')
        {
			$this->session->set_userdata('tests_to_display', 'all');
        }
		else
		{
			if($this->uri->segment(3))
				$this->session->set_userdata('tests_to_display', $this->uri->segment(3));
		}	
		
		redirect('/');
	}
	
	
	
	function _get_tests_to_display()
	{
		$test_level = $this->session->userdata('tests_to_display');
        $user_id    = $this->get_user_id();
        $admin      = $this->user_is_admin();


		if($test_level == 'all')
		{
            if($admin)
                $query = $this->test->get_all_tests();
            else
			    $query = $this->test->get_all($user_id);
		}

		else 
		{
			if($admin)
                $query = $this->test->get_for_admin_where('testlevel_id', $test_level);
            else
                $query = $this->test->get_where('testlevel_id', $test_level, $user_id);
		}
		
		return $query;
		
	}


   

    
    function test()
    {

          $this->check_testcard_before('test');
          $data            = $this->get_testcard_data('test');
          $data['query']   = $this->testcard->get_task($this->get_testcard_id());

          if ($this->user_is_guest())
          {
               $data['number_testcards'] = 4;
               $data['main_content'] = "test_guest";

               if($this->get_card_nr() > 4)
                                redirect('/');
          }

          $this->load->view('includes/template', $data);

    }



    function hold()
    {

        $this->check_testcard_before('hold');
        $data            = $this->get_testcard_data('hold');
        $data['query']   = $this->testcard->get_answer($this->get_testcard_id(), $this->get_user_id());

        if ($this->user_is_guest())
        {
             $data['number_testcards'] = 4;
             $data['main_content'] = "hold_guest";

             if($this->get_card_nr() > 4)
                              redirect('/');

             $data['demo_translation'] = $this->session->userdata($this->get_testcard_id());

             $this->load->view('includes/template', $data);

        }

        else
        {
            $this->load->view('includes/template', $data);
        }

    }

    
    function open()
    {   
        $this->check_testcard_before('open');
        $this->load->model('Comment_model', 'comment');
        $this->load->model('user_model', 'user' );

        $data = $this->get_testcard_data('open');
		if($this->user_is_guest())
			$data['number_testcards'] = 4;


        $data['demo_translation'] = $this->session->userdata($this->get_testcard_id());
        $data['query']            = $this->testcard->get_answer($this->get_testcard_id(), $this->get_user_id());
        $data['user'] = $this->user->get_by_id($this->get_user_id());

        $comment_language = $this->comment->get_comment_language();

        $data['comments']          = $this->comment->get($data['query'], $comment_language);
        $data['comment_languages'] = $this->comment->get_languages($comment_language);
        $data['comment_language']  = $comment_language;
        $data['comment_model']     = & $this->translation;

        if($this->user_is_admin())
        {
            $data['main_content'] = 'reviewcard';
            $user_we_review = $this->session->userdata('user_we_review');
            if($user_we_review != '')
            {
                $data['query']  = $this->testcard->get_answer($this->get_testcard_id(), $user_we_review);
                $data['user'] = $this->user->get_by_id($user_we_review);
            }

        }
        
        $this->load->view('includes/template', $data);
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



    function view_all_translations_for_user()
    {
        if(!$this->user_is_admin())
            redirect('/');

        $user_id = $this->uri->segment(5);
        $test_id = $this->uri->segment(3);

        if($user_id != '' && $test_id != '')
        {
            $this->load->model('user_model', 'user');
            $data['test_and_card_uri'] = $this->get_test_and_card_uri();
            $data['query'] = $this->translation->get_user_translations ($test_id, $user_id);
            $data['original'] = $this->translation->get_original($test_id);
            
            $data['user']  = $this->user->get_by_id($user_id);
            $test = $this->test->get_for_admin_where('test.id', $test_id);
            $data['test_name'] = $test[0]->title;
            $data['main_content'] = 'translations_by_user';
            $this->load->view('includes/template', $data);

        }
        else 
            redirect('site/users_that_took_test' . $this->get_test_and_card_uri());

    }

    function view_all_translations_by_type()
        {
            if(!$this->user_is_admin())
                redirect('/');

            $type_id = $this->uri->segment(5);
            $test_id = $this->uri->segment(3);

            if($type_id != '' && $test_id != '')
            {
                $this->load->model('type_model', 'type');
                $data['test_and_card_uri'] = $this->get_test_and_card_uri();
                $data['query'] = $this->translation->get_translations($test_id, "type_id", $type_id);
                $data['original'] = $this->translation->get_original($test_id);

                $data['user']  = $this->type->get_by_id($type_id);
                $test = $this->test->get_for_admin_where('test.id', $test_id);
                $data['test_name'] = $test[0]->title;
                $data['main_content'] = 'translations_by_type';
                $this->load->view('includes/template', $data);

            }
            else
                redirect('site/users_that_took_test' . $this->get_test_and_card_uri());

    }




    function users_that_took_test()
    {
        // Check if the user is admin, if not, fuck off
        if(!$this->user_is_admin())
            redirect('/');


        // Get the current test and testcard number
        // it should be added to the URI
        $data['test_and_card_uri'] = $this->get_test_and_card_uri();

        // Get the information about the users who took this test
        // from the model, probably filtered, information from the post data or URI
                
        $data['query'] = $this->translation->get_users($this->get_testcard_id());

        // Get native translators in this test
        $data['native_translators'] = $this->translation->get_native_translators_in_testcard($this->get_testcard_id());

        // Display the data, load new view

        $data['main_content'] = 'users_that_took_test';
        $this->load->view('includes/template', $data);


    }






    function set_user_we_review()
    {

        $user_id = $this->uri->segment('5');
        
        $this->session->set_userdata("user_we_review", $user_id);

        redirect('site/open' . $this->get_test_and_card_uri() );

    }



}