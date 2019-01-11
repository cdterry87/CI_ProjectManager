<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Systems extends PROJECTS_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('System_model');
	}
	
	public function index(){
		$this->data['page']='admin/systems/systems';
		
		//Get all departments.
		$this->data['systems']=$this->System_model->get_all();
		
		$this->load->view('template', $this->data);
	}
	
	public function form($id=''){
		$this->data['system_id']=$id;
		
		$this->data['page']='admin/systems/systems_form';
		
		//If an id is set, get record in order to populate the screen.
		if($id!=''){
			if(!empty($result=$this->System_model->get($id))){
				$this->populate_screen($result);
			}
		}
		
		$this->load->view('template', $this->data);
	}
	
	public function view($id){
		$this->data['page']='admin/systems/systems_view';
		
		//Get system information.
		$this->data['system']=$this->System_model->get($id);
		
		$this->load->view('template', $this->data);
	}
	
	public function validate(){
		$pass=$this->get_validations();
		
		return $pass;
	}
	
	public function action(){
		//Retrieve the record's id if it exists in the form.
		$id=$this->input->post('system_id');
		
		switch($this->action){
			case "save":
				//Validate the form submission.
				if($this->validate()){
					$this->System_model->save($id);
					$this->set_message('System information saved successfully', 'success');
					redirect('admin/systems');
				}
				
				//The validation failed so retrieve POST data and reload the page.
				$this->populate_screen($this->input->post());
				redirect('admin/systems/form/'.$id);
				break;
			case "delete":
				$this->System_model->delete($id);
				$this->set_message('System deleted successfully!', 'danger');
				redirect('admin/systems');
				break;
		}
		
	}
	
}
