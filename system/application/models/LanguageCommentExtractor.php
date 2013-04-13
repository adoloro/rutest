<?php

class LanguageExtractor
{
    private $comment;

    public function LanguageExtractor($comment)
    {
        $this->comment = $comment;
        $this->replace_newlines();
        $this->remove_excessive_spaces();
        $this->add_a_delimiter_as_end_tag();

    }

    public function extract_comment_in($language)
    {
        $lang_start_pattern = '--' . $language . '--';

        if ($language != '' && $this->is_language_found_in_comment($lang_start_pattern))
        {
            $lang_comment_select_pattern = $lang_start_pattern . '(.+?)\s*--';
            $this->cut_language_from_comment($lang_comment_select_pattern);
        }
        $this->strip_lang_tags();

        return $this->comment;
    }


    private function is_language_found_in_comment($lang_start_pattern)
    {
        return preg_match('/' . $lang_start_pattern . '/i', $this->comment);
    }

    private function cut_language_from_comment($lang_comment_select)
    {
        preg_match('/' . $lang_comment_select . '/i', $this->comment, $matches);
        if (isset($matches[1]))
            $this->comment = trim($matches[1]);
    }

    function strip_lang_tags()
    {
        $this->comment = trim(preg_replace("/\s*--.+?--\s*/", '', &$this->comment));

    }


    private function add_a_delimiter_as_end_tag()
    {
        $this->comment = $this->comment . " --language--";
    }

    private function remove_excessive_spaces()
    {
        $this->comment = preg_replace("/\s+/", ' ', &$this->comment);

    }

    private function replace_newlines()
    {
        $this->comment = preg_replace("/\n+/", ' ', &$this->comment);
    }


}

/****** LanguageCommentExtractor.php ***/