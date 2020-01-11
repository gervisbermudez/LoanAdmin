<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!function_exists('fnAddScript')) {
	/**
	 * Generate a script link with the base url based on the filepath
	 * @param  [type] $strFilePath [description]
	 * @return [type]              [description]
	 */
	function fnAddScript($strFilePath, $attr = array())
	{
		if (strpos($strFilePath, 'http') === false) {
			$strFilePath = base_url($strFilePath);
		}
		$linkattr = '';
		foreach ($attr as $key => $value) {
			$linkattr .= $key . '="' . $value . '" ';
		}
		return '<script src="' . $strFilePath . '" ' . $linkattr . '></script>';
	}
}
if (!function_exists('print_r_this')) {
	function print_r_this($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}

if (!function_exists('format')) {
	function format($number, $decimals = 2, $dec_point = '.' , $thousands_sep = ',', $current_sign = '$')
	{
		return number_format($number, $decimals, $dec_point, $thousands_sep).' '.$current_sign;
	}
}

if (!function_exists('time_elapsed_string')) {
	function time_to_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}