<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->tempine->template('default');
		$this->tempine->components(array('head', 'header', 'footer'));
		$this->tempine->title('Default template');
		$this->tempine->page('example');
	}

}
