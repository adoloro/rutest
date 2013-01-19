<?php
	
Class Login extends Controller {

	function index()
	{
		$data['main_content'] = 'login_form';
				
		$this->load->view('includes/template', $data);
	}

	function validate_credentials() 
	{
	
		// Functions responsible for database connectivity are in 
		// the user model 
		// So we load a model.		
		$this->load->model('user_model');

		// Then we call a function validate() from that model which 
		// return type is boolean, so it ei
				
		$validated = $this->user_model->validate(); 
		
		
		if($validated != false) 
		{
			// If the username's email and password were successfully validated
			// create a data structure which will hold our ticket/cookie information:
			// username's email and boolean value of whether he's logged in or not
			
			
			
			$cookie = array ( 
				'email' => $this->input->post('email'),
				'is_logged_in' => true,
				'user_id' => $validated[0]->id,
				'admin' => $validated[0]->admin
			);
			
			// And push it into the 
			$this->session->set_userdata($cookie);
			$this->session->set_userdata('tests_to_display', 'all');
			
			redirect('site'); // This is a main protected controller
		}
		else
		{
			$this->index();	// If the user is not validated, 
			// re-display login form (see index method)
		}
		
		
	}
		
}
	
	?>