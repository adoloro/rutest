<?php
Class Unittest extends Controller
{

    function __construct()
    {
        parent::Controller();
        $this->load->library('unit_test');
        $this->load->model('Comment_model', 'comment');


    }

    public function index()
    {

        $this->load->model('Comment_model', 'comment');

        $comment = "--russian--\nHello, this is a russian text\n--norwegian--\n Hello, this is norwegian";
        $expected = "Hello, this is a russian text";
        $result = $this->comment->select_language($comment, 'russian');

        //print_r($expected);
        //echo "<br />";
        //echo "But the result was:";
        //print_r($result);
        // echo strlen($result) .'<br />' . strlen($expected) . "\n";
        //echo $result .'<br />' . $expected;


        $this->unit->run($expected, $result, 'Selection of the 1st language');


        $expected = "Hello, this is norwegian";
        $result = $this->comment->select_language($comment, 'norwegian');

        $this->unit->run($expected, $result, "Selection of the second language");


        $comment = "--Russian--\nHello, this is a russian text\n--Norwegian--\n Hello, this is norwegian";

        $this->unit->run
        ("Hello, this is norwegian", $this->comment->select_language($comment, 'norwegian'), "Selection of the second language with different mixed capitals");


        $comment = "--Russian--\nHello, this is a russian text\n--Norwegian--\n Hello, this is norwegian      \n\n\n\n--some";
        $result = $this->comment->select_language($comment, 'norwegian');
        $this->unit->run('Hello, this is norwegian', $result, 'Should select even sloppy lines');


        $comment = "--jewish--\nJewish text\n--some--\n";
        $comment = "--jewish-- Jewish text --some-- ";
        $result = $this->comment->select_language($comment, 'russian');
        $expected = "Jewish text";

        $this->unit->run($expected, $result, "Remove language special fields from the comment");


        $result = $this->comment->strip_lang_tags("--norwegian--\nlove");
        $expected = "love";
        $this->unit->run($result, $expected, 'Lang pair strip test');


        $comment = "--norwegian--\nEn ordrett
       
       \n--russian--\n
           ? ?????? ??-??????";


        $expected = "En ordrett";

        $result = $this->comment->select_language($comment, 'norwegian');

        $this->unit->run($expected, $result, "Handle multiple line breaks");


        $comment = "--norwegian--\nEn ordrett
       
       \n--russian--\n
         
       ? ?????? ??-??????";

        $result = $this->comment->select_language($comment, 'russian');
        $expected = "? ?????? ??-??????";

        $this->unit->run($expected, $result, "Handle multiple line breaks in Russian");








        //@ Get all the comment languages except for the default (assumed to be Norwegian in this case)
        $expected =  array('russian');
        $expected = array_pop($expected);
        $some_array = (array) $this->comment->get_languages('norwegian');
        $result = array_pop($some_array);

        $this->unit->run($expected, $result, "Get all the other comment languages except for the default");


        echo $this->unit->report();


    }
}

?>