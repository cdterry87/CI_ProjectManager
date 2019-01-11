<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends PROJECTS_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Employee_model');
	}
	
	public function index(){
		$this->settings();
	}
	
	public function settings(){
		$this->data['page']='user/settings';
		
		$id=$this->session->userdata('employee_id');
		
		//Get employee information.
		if(!empty($result=$this->Employee_model->get($id))){
			$this->populate_screen($result);
		}
		
		$this->load->view('template', $this->data);
	}
	
	public function password(){
		$this->data['page']='user/password';
		
		$this->load->view('template', $this->data);
	}
	
	public function validate(){
		//Get form validations.
		$pass=$this->get_validations();
		
		//Form specific validations.
		switch($this->action){
			case "update settings":
				$id=$this->session->userdata('employee_id');
				$username=$this->input->post('employee_username');
				
				if($username_id=$this->Employee_model->username_exists($username)){
					if($username_id!=$id){
						$this->set_message('Username already exists!');
						$pass=false;
					}
				}
				
				break;
			case "update password":
				if($this->input->post('employee_password')!=$this->input->post('employee_password_confirm')){
					$this->set_message('Passwords must match!');
					$pass=false;
				}
				break;
		}
		
		return $pass;
	}
	
	public function action(){
		switch($this->action){
			case "update settings":
				if($this->validate()){
					$this->Employee_model->change_settings();
					$this->set_message('Your settings have been changed successfully!', 'success');
				}
				
				//Reload the page.
				redirect('user/settings');
				break;
			case "update password":
				if($this->validate()){
					$this->Employee_model->change_password();
					$this->set_message('Your password has been changed successfully!', 'success');
				}
				
				//Reload the page.
				redirect('user/password');
				break;
		}
	}
	
}