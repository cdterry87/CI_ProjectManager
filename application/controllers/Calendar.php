<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends PROJECTS_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Calendar_model');
    }

    public function index() {
        $this->data['page']='calendar';
        
        $this->load->view('template', $this->data);
    }

}