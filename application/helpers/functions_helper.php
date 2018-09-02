<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('fnAddScript'))
{
	/**
	 * Generate a script link with the base url based on the filepath
	 * @param  [type] $strFilePath [description]
	 * @return [type]              [description]
	 */
	function fnAddScript($strFilePath)
	{
		return '<script src="'.base_url($strFilePath).'"></script>';
	}
}