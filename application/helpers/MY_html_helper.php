<?php
/* My own extensions to the HTML Helper */

// take input and return it wrapped in a "<div>"
/*
function div_wrap($str)
{
		// wrap a string with a '<div></div>'
		if ($str)
		{
				$result = '<div>' . $str . '</div>';
		}
		else
		{
				$result = '<div></div>';
		}
		return $result;
}
*/

// take input and return it wrapped in a "<div>"
function div_wrap($str = FALSE, $attributes = FALSE)
{
		// build our opening tag
		$div = '<div';
		
		// add any attributes being passed
		if ($attributes)
		{
				foreach ($attributes as $key => $val)
				{
						$div .= ' ' . $key . '="' . $val . '"';
				}
		}
		
		// close the opening tag
		$div .= '>';
		
		// fill the div with the string that was passed
		if ($str)
		{
				$div .= $str;
		}
		
		// close the tag
		$div .= '</div>';
		
		// return the whole thing
		return $div;
}


// wrap a string in am '<li>' tag
function li($str = FALSE, $attributes = FALSE)
{
		// build our opening tag
		$result = '<li';
		
		// add any attributes being passed
		if ($attributes)
		{
				foreach ($attributes as $key => $val)
				{
						$result .= ' ' . $key . '="' . $val . '"';
				}
		}
		
		// close the opening tag
		$result .= '>';
		
		if ($str)
		{
				$result .= $str;
		}
		
		$result .= '</li>';
		
		return $result;
}

function show_thumb($path)
{		
		$path = explode(".", $path);
		// handle a blank or messed up item
		if (array_key_exists('1', $path))
		{
				$thumb = $path['0'] . '_tmb.' . $path['1'];
		}
		else
		{
				$thumb = 'assets/images/no-photo_tmb.jpg';
		}
		return $thumb;
}

function show_mid($path)
{		
		$path = explode(".", $path);
		// handle a blank or messed up item
		if (array_key_exists('1', $path))
		{
				$thumb = $path['0'] . '_mid.' . $path['1'];
		}
		else
		{
				$thumb = 'assets/images/no-photo.jpg';
		}
		return $thumb;
}

/*
use this function to set options as selected 
using a comparison between the database ($data) and
the value of the option ($str)
*/
function select_status($data, $str) 
{
		$result = '';
		if ($data == $str) {
				$result = ' selected="selected"';
		}
		return $result;
}	

/* End of File: MY_html_helper.php */
/* Location: ./application/helpers/MY_html_helper.php */