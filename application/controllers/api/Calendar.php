<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller 
{
    
    public function __construct(){
        parent::__construct();

        header('Content-type: application/json');

        $this->load->model('Calendar_model');
    }

    public function complete_project_dates() {
        $project_dates = $this->Calendar_model->get_complete_project_dates();
    }

    public function incomplete_project_dates() {
        $project_dates = $this->Calendar_model->get_incomplete_project_dates();
    }

    public function closed_support_dates() {
        $support_dates = $this->Calendar_model->get_closed_support_dates();
    }

    public function open_support_dates() {
        $support_dates = $this->Calendar_model->get_open_support_dates();
    }

}