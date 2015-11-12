<?php
/**
 * a simple debug helper to speed things along
 * 
 */

function dd($item)
{
		echo '<pre>';
		print_r($item);
		echo '</pre>';
		exit;
}

function dv($item)
{
		echo '<pre>';
		var_dump($item);
		echo '</pre>';
		exit; 
}