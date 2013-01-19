<?php

Class MY_Controller extends Controller
{

    function __construct()
    {
        parent::Controller();

        $this->is_logged_in();
		$this->load->library('session');
        $this->load->scaffolding('translation');
        $this->load->model('Test_model', 'test');
        $this->load->model('Testcard_model', 'testcard');
        $this->load->model('translation_model', 'translation' );
    }



	function logout()
	{

		$this->session->sess_destroy();
        redirect('/');

	}

    function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');

        if(!isset($is_logged_in) || $is_logged_in != true)
        {
            redirect('login');
        }
    }


    function get_test_nr()
    {
        return $this->uri->segment(3) ; // The third segment of URI holds a test
                                        // number
    }


    function get_card_nr()
    {
        // This is a testcard_id number in a current test.
        // If the testcard number is invalid, display the first testcard

        return $this->uri->segment(4) == "" ? 1 : $this->uri->segment(4);
    }



    function get_testcard_id()
    {
        return $this->testcard->get_id (    $this->get_test_nr(),
                                            $this->get_card_nr()    );
    }



    function check_test_nr()
    {
        if ( !$this->test->validate_test_nr($this->get_test_nr()) )
        {
            redirect('');  // If the test number is invalid, re-display the choice of texts.
        }

    }


    function get_test_and_card_uri()
    {
        return '/' . $this->get_test_nr() . '/' . $this->get_card_nr();
    }



    function get_user_id()
    {
        return $this->session->userdata('user_id');
    }



    function get_number_testcards()
    {
        return $this->test->get_number_of_testcards($this->get_test_nr());
    }


    function get_current_testcard_nr($testcard_id)
    {
        return $this->testcard->get_card_nr($testcard_id);
    }


    function find_user_translation()
	{
		if($this->user_is_guest())
			return $this->session->userdata($this->get_testcard_id());
		
        return $this->testcard->check_user_translation($this->get_testcard_id(), $this->get_user_id());
    }



    function check_testcard_id()
    {
        if($this->get_testcard_id())
            return true;
        else
            redirect('');
    }


    function decide_card_action($action)
    {
        $user_has_translation = ($this->find_user_translation() == 1
        || $this->session->userdata($this->get_testcard_id()) != '' ) ? true : false;

        $test_results_allowed =  $this->test->are_test_results_allowed($this->get_user_id(),
                                              $this->get_test_nr());


        $test_results_allowed = ($test_results_allowed == array() ) ? true : false;


        if($user_has_translation && $test_results_allowed && ($action == 'hold'  || $action == 'test'))
                    redirect('site/open' .$this->get_test_and_card_uri() );


        if($user_has_translation && !$test_results_allowed && $action != 'hold')
                    redirect('site/hold' .$this->get_test_and_card_uri() );


        if(!$this->user_is_admin() && $action == 'edit')
            redirect('site/test' . $this->get_test_and_card_uri());


        if(!$user_has_translation && $action != 'test')
           redirect('site/test' . $this->get_test_and_card_uri());


    }




    function check_testcard_before($action)
    {
        $this->check_test_nr();  // Check if the number of the test is valid

        //TODO: Make check for whether this text is avalaible




        if(!$this->user_is_admin()) // Only not admins should have their versions checked
            $this->decide_card_action($action);

        $this->check_testcard_id(); // Check if the testcard is in the database
    }




    function get_testcard_data ($navigate_to)
    {
        $data['admin']            = $this->user_is_admin();
		$data['guest']			  = $this->user_is_guest();
        $data['number_testcards'] = $this->get_number_testcards();
        $data['current_test']     = $this->get_test_nr();
        $data['current_testcard'] = $this->get_current_testcard_nr($this->get_testcard_id());
        $data['testcard_id']      = $this->get_testcard_id();
        $data['test_and_card_uri']= $this->get_test_and_card_uri();
        $data['navigate_to']      = $navigate_to;
        $data['javascript_file']  = 'test.js';
        $data['main_content']     = $navigate_to . 'card';

        return $data;
    }





    function edit_translation()
    {

       $translation_id = $this->input->post('translation_id');

		if($translation_id == '') {
		    $translation_id = $this->input->post('id');
        }

        if($translation_id == '')
		{
			$translation_id = $this->session->userdata('translation_id');

		}

	   $comment_edit_id = $this->input->post('comment_edit_id');

       $this->load->model('translation_model', 'translation', TRUE);

       $data['query']            = $this->translation->get_translation($translation_id);
       $data['comments']         = $this->translation->get_comments($translation_id);
       $data['test_and_card_uri']= $this->get_test_and_card_uri();
	   $data['comment_edit_id']  = $comment_edit_id;
       $data['translation_id']   = $translation_id;
       $data['main_content']     = 'edit_translation';
       $this->load->view('includes/template', $data);


    }



    function delete()
    {
        // Check if the command was sent from the edit page
        $database = $this->input->post('database');
        $id       = $this->input->post('id');
        $return_to= $this->input->post('return_to');
        $translation_id = $this->input->post('translation_id');

        if(isset($translation_id))
        {
            $this->session->set_userdata('translation_id', $translation_id );
        }


        if(isset($id))
        {
           $this->db->delete($database, array('id' => $id));
        }

        if($return_to == '')
            $return_to = 'site/edit';


        redirect($return_to . $this->get_test_and_card_uri());
    }


    function add()
    {
        // Read the data send from the form
        $database    = $this->input->post('database');
        $testcard_id = $this->input->post('id');


        // If the data from the form is not empty
        if($database != false && $testcard_id != false)
        {
            $data['database']     = $database;
            $data['testcard_id']  = $testcard_id;
            $data['types']        = $this->translation->get_translation_types();
            $data['query']        = $this->testcard->get_answer($this->get_testcard_id());
            $data['main_content'] = 'add_' . $database ;
            $data['test_and_card_uri']= $this->get_test_and_card_uri();
            $this->load->view('includes/template', $data);
        }
        else
            redirect('site/edit'. $this->get_test_and_card_uri());


    }

	function add_comment()
	{

		$translation_id = $this->input->post('translation_id');

		$data = array
				(
		           'translation_id' => $translation_id ,
		           'text' 			=> $this->input->post('comment_text')
		        );


		$this->db->insert('comment', $data);



		$this->session->set_userdata('translation_id', $translation_id );

		redirect('site/edit_translation' . $this->get_test_and_card_uri());
	}




	function add_error()
	{
		$testcard_id = $this->input->post('testcard_id');

		$data = array
				(
		           'testcard_id' => $testcard_id ,
		           'text' 			=> $this->input->post('error_text')
		        );


		$this->db->insert('error', $data);

		redirect('site/edit' . $this->get_test_and_card_uri());

	}


    function update_translation()
    {

        $data = array ( 'text' => $this->input->post('text'));

        $this->translation->update($this->input->post('translation_id'), $data);

        redirect('site/edit' . $this->get_test_and_card_uri() );
    }


	function update_comments()
	{
		$translation_id = $this->input->post('translation_id');
		$comment_text   = $this->input->post('comment_text');


		$this->session->set_userdata('translation_id', $translation_id  );

		$data = array ('text' => $comment_text );

		$this->translation->update_comment($this->input->post('comment_id'), $data);

		redirect('site/edit_translation' . $this->get_test_and_card_uri());

	}


	function update_errors()
	{
		$error_id 	= $this->input->post('error_id');
		$error_text = $this->input->post('error_text');
		
		$data = array ('text' => $error_text);

		$this->testcard->update_error($error_id, $data);

		redirect('site/edit' . $this->get_test_and_card_uri());


	}



    function save_answer()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('text', '"User translation"', 'trim|required|min_length[10]');


        if($this->form_validation->run() == FALSE)
        {
            $this->test();
        }
        else
        {
            if($this->testcard->add_user_translation( $this->get_testcard_id(),
                                                      $this->get_user_id()  ))
            {
                redirect('site/open' . $this->get_test_and_card_uri() );
            }

            else
            {
                $this->test();
            }

        }

    }


	function save_temp_answer()
	{
		// We need a testcard id
		$testcard_id =	$this->input->post('testcard_id');
		$answer 	 =  $this->input->post('text');

		// We bind text to a textcard_id
		if($testcard_id != '')
		{
			if($answer == '')
				$answer = 'empty';

			$this->session->set_userdata($testcard_id, $answer);
		}
		else
			$this->index();
			
		// But if the testcard was provided 
			redirect('site/open' .$this->get_test_and_card_uri());
	}



    function save_translation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('text', 'Text', 'trim|required|min_length[10]');

        if($this->form_validation->run() == false)
        {
            $this->add();
        }
        else
        {
            if($this->translation->add())
            {
                redirect('site/edit' . $this->get_test_and_card_uri());
            }
            else
            {
                $this->add();
            }
        }
    }


    function add_testcard()
    {
        $new_testcard_nr = $this->get_card_nr() + 1;

        $this->testcard->add($this->get_test_nr(), $new_testcard_nr);

        redirect('site/edit' . '/' . $this->get_test_nr() . '/' . $new_testcard_nr );

    }




    function testcard_has_translations()
    {
        return $this->testcard->check_translations($this->get_testcard_id());
    }



    function delete_testcard()
    {
		$test_nr = $this->get_test_nr();
		$previous_card_nr =  $this->get_card_nr() - 1;

        if(!$this->testcard_has_translations())
        {
            $this->testcard->delete($this->get_testcard_id());

            redirect('site/edit' . '/' . 	$test_nr . '/' . 	$previous_card_nr );
        }
    }



}

