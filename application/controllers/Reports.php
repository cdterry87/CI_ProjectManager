<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends PROJECTS_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Report_model');
	}
	
	public function index(){
		$this->data['page']='reports/list';
		
		$this->load->view('template', $this->data);
    }
    
    public function open_projects_support() {
        $this->data['report_title']="Open Projects/Support";
        $this->data['data']=$this->Report_model->open_projects_support();
		
		$this->load->view('reports/template', $this->data);
    }
	
}
