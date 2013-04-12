<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('assoc_array_to_array'))
{
	function assoc_array_to_array($assoc_array, $key)
	{
		$stack = array();
			foreach ($assoc_array as $row)
				array_push($stack, $row[$key]);

		return $stack;
	}

}

/*****    new_helper.php   */
    