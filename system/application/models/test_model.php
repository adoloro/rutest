<?php

class Test_model extends MY_Model
{

    protected $table_name = "test";
    protected $scnd_table;
    protected $table_fk;


    function __construct()
    {
        parent::MY_Model();
        $this->load_db_fields();
        $this->table_name = "test";
        $this->scnd_table = "testlevel";
        $this->table_fk   = "testlevel_id";
    }


    function are_test_results_allowed($user_id, $test_id)
    {

        $this->db->select('id');
        $this->db->from("permission");
        $this->db->where('user_id', $user_id);
        $this->db->where('test_id', $test_id);
        $this->db->where('allowed_to_see_test_result', 1);

        return ($this->db->get()->result() == array());

    }


    function get_allowed_tests_query_string($user_id)
    {
        // get him only the tests he is allowed to take
        return '(  SELECT *
                    FROM test
                    WHERE id
                    IN ( SELECT
                       test_id
                       from permission
                       WHERE allowed_to_take_test = 1 AND user_id = ' . $user_id . ')) as test';

    }


    function _prepare_get_all($from, $order_by = 'test.order')
    {

        $this->db->select($this->table_name . '.id, title, testlevel.order, ' . $this->scnd_table . '.level_name');
        $this->db->from($from);
        $this->db->order_by($order_by);
        $this->db->join($this->scnd_table,
                        $this->table_name . '.' . $this->table_fk . '=' . $this->scnd_table . '.id', 'left');

        return $this->db->get();
    }


    function get_all($user_id)
    {
        return $this->_prepare_get_all($this->get_allowed_tests_query_string($user_id))->result();

    }


    function get_all_tests()
    {
        return $this->_prepare_get_all('test')->result();
    }


    function get_where($field, $value, $user_id)
    {
        $this->get_all_cache($this->get_allowed_tests_query_string($user_id));

        $this->db->where     ($field, $value);

        $result = $this->db->get()->result();
        $this->db->flush_cache();

        return $result;

    }


    function get_for_admin_where($field, $value)
    {
        $this->get_all_cache('test');
        $this->db->where ($field, $value);

        $result = $this->db->get()->result();
        $this->db->flush_cache();

        return $result;
    }


    public function get_all_cache($from)
    {
        $this->db->start_cache();
        $this->_prepare_get_all($from);
        $this->db->stop_cache();
    }




    function get_categories($user_id, $admin)
    {
        $this->db->select($this->table_name . '.id, title, testlevel_id, testlevel.order,' . $this->scnd_table . '.level_name');
        $this->db->from( $admin ? 'test' : $this->get_allowed_tests_query_string($user_id));
        $this->db->group_by($this->scnd_table . '.level_name');
        $this->db->join($this->scnd_table,
                        $this->table_name . '.' . $this->table_fk . '=' . $this->scnd_table . '.id',
                        'left');
        $this->db->order_by('testlevel.order');

        return $this->db->get()->result();
    }


    function get_fields()
    {

        return $this->_prepare_get_all('test')->field_data();

    }


    function get_by_id($id, $order_by = 'id')
    {
        $this->db->order_by($order_by);
        $this->db->where('id', $id);
        $result = $this->db->get($this->table_name)->result();

        return (array)$result[0];
    }


    function validate_test_nr($test_id)
    {
        if ($test_id == "") {
            return false;
        }

        $this->db->where('test_id', $test_id);
        $this->db->from('testcard');
        $query = $this->db->get()->num_rows();

        if ($query == 0) {
            return false;
        }

        return true;

    }


    function get_number_of_testcards($test_id)
    {
        $this->db->select();
        $this->db->where('test_id', $test_id);
        $this->db->from('testcard');

        return $this->db->count_all_results();
    }


    function get_id($name)
    {
        $this->db->select('id');
        $this->db->where('title', $name);
        $this->db->limit(1);

        $query = $this->db->get('test')->result();

        return $query[0]->id;

    }


}

/****** test_model.php ***/