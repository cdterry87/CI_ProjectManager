<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller 
{
    
    public function __construct(){
        parent::__construct();

        header('Content-type: application/json');

        $this->load->model('Project_model');
    }

    public function get_note($id) {
        echo json_encode($this->Project_model->get_note($id));
    }

}