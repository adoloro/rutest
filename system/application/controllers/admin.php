<?php 
    
Class Admin extends MY_Controller
{
    
    function __construct()
    {
        parent::Controller();
        if (!$this->user_is_admin())
            redirect('/');
        
    }



    function login_as()
    {
        $user_id = $this->uri->segment(3);

        //echo "uri segment 3 is user_id";
        //print_r($user_id);

        if($user_id != '')
        {
            $cookie = array (
				'is_logged_in' => true,
				'user_id' => $this->uri->segment(3),
				'admin' => false
			);

			// And push it into the
			$this->session->set_userdata($cookie);
        }

        redirect('site');

    }
    
}
?>