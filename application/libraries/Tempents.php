<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tempents {

	protected $_ci;

	public function __construct()
	{
		$this->_ci =& get_instance();
	}
}
