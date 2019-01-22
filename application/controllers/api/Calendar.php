<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Calendar_model');
    }

    public function index() {
        $project_dates = $this->Calendar_model->get_project_dates();
        $support_dates = $this->Calendar_model->get_support_dates();

        $calendar_dates = array_merge($project_dates, $support_dates);
    }

    public function project_dates() {
        header('Content-type: application/json');
        $project_dates = $this->Calendar_model->get_project_dates();
    }

    public function support_dates() {

    }

}