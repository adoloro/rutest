<?php
require_once('LanguageCommentExtractor.php');
class Comment_model extends Model 
{
    
       
	function __construct() 
	{
		parent::Model();
	}


    function get_languages($comments_language)
    {

		if($comments_language == 'norwegian')
			return array('russian');
		
		if($comments_language == "russian")
			return array('norwegian');
		else
			return array('norwegian', 'russian');

    }


	function get_comment_language()
    {

        $comment_language = $this->uri->segment(5);

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


    function get($query, $language)
    {
        $all_comments = array ();
        $this->load->model('Comment_model', 'comment');

        foreach($query as $row) :
	            $comments = $this->translation->get_comments($row->translation_id);
                foreach($comments as $comment):
                    $all_comments[] = $this->comment->select_language($comment->text, $language);
                endforeach;
	    endforeach;

        return $all_comments;
    }
    
    function select_language($comment, $language)
    {
        $languageExtractor = new LanguageExtractor($comment);
        return $languageExtractor->extract_comment_in($language);
    }
}

/****** type_model.php ***/