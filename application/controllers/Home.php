<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends PROJECTS_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Home_model');
	}
	
	public function index(){
		$this->data['page']='home';
		
		//Get user's incomplete/complete projects.
		$this->data['customers']=$this->Home_model->get_customers();
		
		//Get user's incomplete/complete projects.
		$this->data['projects_incomplete']=$this->Home_model->get_projects_incomplete();
		//$this->data['projects_complete']=$this->Home_model->get_projects_complete();
		
		//Get user's open/closed support.
		$this->data['support_open']=$this->Home_model->get_support_open();
		//$this->data['support_closed']=$this->Home_model->get_support_closed();
		
		//Get user's most recent quotes.
		$this->data['quotes']=$this->Home_model->get_quotes();
		
		$this->load->view('template', $this->data);
	}
	
}
