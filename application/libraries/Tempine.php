<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tempine {

	protected $_ci;
	protected $_config;

	protected $template   = '';
	protected $components = array();
	protected $data       = array();

	protected $title = '';
	protected $css   = array();
	protected $js    = array();

	public function __construct()
	{
		$this->_ci =& get_instance();
	}

	public function page($page, $data = NULL)
	{
		$this->data['title'] = $this->title;
		$this->data['css']   = add_css($this->css);
		$this->data['js']    = add_js($this->js);

		if ( ! is_null($data))
		{
			foreach ($data as $key => $value)
			{
				$this->data[$key] = $value;
			}
		}

		foreach ($this->components as $key => $value)
		{
			if (is_array($value))
			{
				foreach ($value as $key => $component)
				{
					if (method_exists($this->_ci->tempents, $component))
					{
						$result = call_user_func_array(array($this->_ci->tempents, $component), array());

						foreach ($result as $data_key => $data_val)
						{
							if ( ! isset($this->data[$data_key]))
							{
								$this->data[$data_key] = $data_val;
							}
						}
					}

					$this->data[$key] = $this->_ci->load->view($this->_folder('components').$component, $this->data, TRUE).PHP_EOL;
				}
			}
			elseif ( ! is_numeric($key))
			{
				if (method_exists($this->_ci->tempents, $key))
				{
					$result = call_user_func_array(array($this->_ci->tempents, $key), array());

					foreach ($result as $data_key => $data_val)
					{
						if ( ! isset($this->data[$data_key]))
						{
							$this->data[$data_key] = $data_val;
						}
					}
				}

				$this->data[$key] = $this->_ci->load->view($this->_folder('components').$value, $this->data, TRUE).PHP_EOL;
			}
			else
			{
				if (method_exists($this->_ci->tempents, $value))
				{
					$result = call_user_func_array(array($this->_ci->tempents, $value), array());

					foreach ($result as $data_key => $data_val)
					{
						if ( ! isset($this->data[$data_key]))
						{
							$this->data[$data_key] = $data_val;
						}
					}
				}

				$this->data[$value] = $this->_ci->load->view($this->_folder('components').$value, $this->data, TRUE).PHP_EOL;
			}
		}

		$this->data['content'] = $this->_ci->load->view($this->_folder('pages').$page, $this->data, TRUE).PHP_EOL;
		$this->_ci->load->view($this->_folder('templates').$this->template(), $this->data);
	}

	public function template($template = NULL)
	{
		if (empty($template))
		{
			$this->template = $this->_ci->config->item('default_template');
		}
		else
		{
			$this->template = $template;
		}

		return $this->template;
	}

	public function components($components)
	{
		$this->components = array_merge($this->components, (array) $components);
	}

	public function title($title)
	{
		$this->title = $title;
	}

	public function css($css)
	{
		$this->css = array_merge($this->css, (array) $css);
	}

	public function js($js)
	{
		$this->js = array_merge($this->js, (array) $js);
	}

	public function data($variable, $value = NULL)
	{
		if ( ! is_null($value))
		{
			$this->data[$variable] = $value;
		}
		else
		{
			foreach ($variable as $key => $val)
			{
				$this->data[$key] = $val;
			}
		}
	}

	protected function _folder($type = NULL)
	{
		$_folder = $this->_ci->config->item($type.'_folder');
		$folder = str_replace('\\', '/', $_folder.DIRECTORY_SEPARATOR);

		return $folder;
	}

}
