<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Populate extends CI_Controller {

	/* --------------------------------------------------------------------------------
	 * Process data to be populated on the screen.
	 * Then clear populate data.
	 * -------------------------------------------------------------------------------- */
	public function index(){
		echo $this->session->userdata('projects_populate');
		
		$this->session->unset_userdata('projects_populate');
	}
	
}