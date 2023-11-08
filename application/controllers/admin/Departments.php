<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends PROJECTS_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Department_model');
	}
	
	public function index(){
		$this->data['page']='admin/departments';
		
		//Get all departments.
		$this->data['departments']=$this->Department_model->get_all();
		
		$this->load->view('template', $this->data);
	}
	
	public function form($id=''){
		$this->data['department_id']=$id;
		
		$this->data['page']='admin/departments_form';
		
		//If an id is set, get record in order to populate the screen.
		if($id!=''){
			if(!empty($result=$this->Department_model->get($id))){
				$this->populate_screen($result);
			}
		}
		
		$this->load->view('template', $this->data);
	}
	
	public function view($id){
		$this->data['page']='admin/departments_view';
		
		//Get department information.
		$this->data['department']=$this->Department_model->get($id);
		
		//Get department employees.
		$this->data['employees']=$this->Department_model->get_employees($id);
		
		//Get department projects - quotes.
		$this->data['projects_quotes']=$this->Department_model->get_projects_quotes($id);
		
		//Get department projects - incomplete.
		$this->data['projects_incomplete']=$this->Department_model->get_projects_incomplete($id);
		
		//Get department projects - complete.
		$this->data['projects_complete']=$this->Department_model->get_projects_complete($id);
		
		//Get department projects - archive.
		$this->data['projects_archived']=$this->Department_model->get_projects_archived($id);
		
		//Get department support - open.
		$this->data['support_open']=$this->Department_model->get_support_open($id);
		
		//Get department support - closed.
		$this->data['support_closed']=$this->Department_model->get_support_closed($id);
		
		//Get department support - archive.
		$this->data['support_archived']=$this->Department_model->get_support_archived($id);
		
		$this->load->view('template', $this->data);
	}
	
	public function validate(){
		$pass=$this->get_validations();
		
		return $pass;
	}
	
	public function action(){
		//Retrieve the record's id if it exists in the form.
		$id=$this->input->post('department_id');
		
		switch($this->action){
			case "save":
				//Validate the form submission.
				if($this->validate()){
					$this->Department_model->save($id);
					$this->set_message('Department information saved successfully', 'success');
					redirect('admin/departments');
				}
				
				//The validation failed so retrieve POST data and reload the page.
				$this->populate_screen($this->input->post());
				redirect('admin/departments/form/'.$id);
				break;
			case "delete":
				$this->Department_model->delete($id);
				$this->set_message('Department deleted successfully!', 'danger');
				redirect('admin/departments');
				break;
		}
		
	}
	
}
