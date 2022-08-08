<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

if (!function_exists('check_user_access')) {
	function check_user_access($access_list, $access, $separator = ";;")
	{
		$user_access = explode($separator, $access_list);
		return in_array($access, $user_access);
	}
}

if(!function_exists('format_date')){
	function format_date($start, $end)
	{
		$start_date = ($start != NULL && $start != '') ? date_format(new DateTime($start), 'd F Y') : NULL;
		$end_date = ($end != NULL && $end != '') ? date_format(new DateTime($end), 'd F Y') : NULL;

		return $start_date != $end_date ? $start_date . ' - ' . $end_date : $start_date;
	}
}

if ( ! function_exists('get_data'))
{
    function get_data($table, $where='id', $id, $return)
    {
		$res = DB::table($table)->where($where, $id)->first();
		return $res->{$return};
    }
}

if ( ! function_exists('get_between'))
{
    function get_between($text, $start, $end) {
		$pos_start = strpos($text, $start);
		$pos_end = strpos($text, $end);
		$len_start = strlen($start);
		$len_end = strlen($end);
		if ($pos_start != false && $pos_end != false)
			return substr($text, ($pos_start+$len_start), ($pos_end-$pos_start-$len_start));
		else
			return '';
	}
}

if ( ! function_exists('get_between_from'))
{
    function get_between_from($text, $start, $end) {
		$pos_start = strpos($text, $start);
		$pos_end = strpos($text, $end);
		$len_start = strlen($start);
		$len_end = strlen($end);
		if ($pos_start != false && $pos_end != false)
			return substr($text, ($pos_start), ($pos_end-$pos_start));
		else
			return '';
	}
}

if ( ! function_exists('get_between_from_to'))
{
	function get_between_from_to($text, $start, $end) {
		$pos_start = strpos($text, $start);
		$pos_end = strpos($text, $end);
		$len_start = strlen($start);
		$len_end = strlen($end);
		if ($pos_start != false && $pos_end != false)
			return substr($text, ($pos_start), ($pos_end-$pos_start+$len_end));
		else
			return '';
	}
}

if ( ! function_exists('get_between_to'))
{
	function get_between_to($text, $start, $end) {
		$pos_start = strpos($text, $start);
		$pos_end = strpos($text, $end);
		$len_start = strlen($start);
		$len_end = strlen($end);
		if ($pos_start != false && $pos_end != false)
			return substr($text, ($pos_start+$len_start), ($pos_end-$pos_start+$len_end-$len_start));
		else
			return '';
	}
}

if ( ! function_exists('followLocation'))
{
    function followLocation($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$html = curl_exec($ch);
		curl_close($ch);
		
		$location = "";
		if (preg_match('~Location: (.*)~i', $html, $match)) {
			$location = trim($match[1]);
		}
		return $location;
	}
}
