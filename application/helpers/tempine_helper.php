<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('add_css'))
{
	function add_css($css = NULL)
	{
		if (is_null($css))
		{
			return FALSE;
		}

		if ( ! is_array($css))
		{
			$file_type = (preg_match('/\.css$/i', $css) ? NULL : '.css');
			$url = ( ! preg_match('#^www|^http|^//#', $css)) ? base_url('assets/css/'.$css.$file_type) : $css;
			return '<link rel="stylesheet" href="'.$url.'">'.PHP_EOL;
		}
		else
		{
			$items = array();
			$i = 0;
			$tab = str_repeat("&nbsp;", 4);
			foreach ($css as $item)
			{
				if ($i == count($css) - 1)
				{
					$tab = '';
				}
				$file_type = (preg_match('/\.css$/i', $item) ? NULL : '.css');
				$url = ( ! preg_match('#^www|^http|^//#', $item)) ? base_url('assets/css/'.$item.$file_type) : $item;
				$items[] = '<link rel="stylesheet" href="'.$url.'">'.PHP_EOL.$tab;
				$i++;
			}
			return implode('', $items);
		}
	}
}

if ( ! function_exists('add_js'))
{
	function add_js($js = NULL)
	{
		if (is_null($js))
		{
			return FALSE;
		}

		if ( ! is_array($js))
		{
			$file_type = (preg_match('/\.js$/i', $js) ? NULL : '.js');
			$url = ( ! preg_match('#^www|^http|^//#', $js)) ? base_url('assets/js/'.$js.$file_type) : $js;
			return '<script src="'.$url.'"></script>'.PHP_EOL;
		}
		else
		{
			$items = array();
			$i = 0;
			$tab = str_repeat("&nbsp;", 4);
			foreach ($js as $item)
			{
				if ($i == count($js) - 1)
				{
					$tab = '';
				}
				$file_type = (preg_match('/\.js$/i', $item) ? NULL : '.js');
				$url = ( ! preg_match('#^www|^http|^//#', $item)) ? base_url('assets/js/'.$item.$file_type) : $item;
				$items[] = '<script src="'.$url.'"></script>'.PHP_EOL.$tab;
				$i++;
			}
			return implode('', $items);
		}
	}
}

if ( ! function_exists('add_meta'))
{
	function add_meta($meta = NULL)
	{
		if (is_null($meta))
		{
			return FALSE;
		}

		$items = array();
		$i = 0;
		$tab = str_repeat("&nbsp;", 4);
		foreach ($meta as $key => $value)
		{
			if ($i == count($meta) - 1)
			{
				$tab = '';
			}

			$items[] = '<meta name="'.$key.'" content="'.$value.'">'.PHP_EOL.$tab;
			$i++;
		}
		return implode('', $items);
	}
}
