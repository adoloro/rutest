<?php
require_once('crud.php');

Class Permission extends CRUD
{
	//protected $model is inherited
	// protected $user_is_admin is inherited

    function __construct()
    {
		parent::__construct('permission');

    }

    function update()
    {
        $field = $this->input->post('field');
        $value = $this->input->post('value');
        $id    = $this->input->post('id');

        $data = array(
                $field  => $value,
                'id'    => $id);

        return $this->model->update($data);
    }





}