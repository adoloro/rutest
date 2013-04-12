<?php

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


    
    
    function strip_lang_tags($text)
    {     
          return trim (preg_replace ( "/\s*--.+?--\s*/" ,  '' ,  $text  ));
          
    }
    
    function select_language($comment, $language)
    {
        $comment = preg_replace ("/\n+/", ' ', $comment);
        $comment = preg_replace ("/\s+/", ' ', $comment);
        $comment = $comment . " --language--"; // Add --delimiter-- as an end tag 
        

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
                // otherwise take only the comment in a certain language and return it.
                preg_match('/' . $lang_comment_select . '/i', $comment, $matches);

                
                if(isset($matches[1]))
                    return trim($matches[1]);
                else
                {
                    return $this->strip_lang_tags($comment); 
                }                
                   
            } 
        
    }
    

			
}

/****** type_model.php ***/