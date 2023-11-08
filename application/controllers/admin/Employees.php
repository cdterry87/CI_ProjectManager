<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends PROJECTS_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Employee_model');
	}
	
	public function index(){
		$this->data['page']='admin/employees';
		
		//Get all employees.
		$this->data['employees']=$this->Employee_model->get_all();
		
		$this->load->view('template', $this->data);
	}
	
	public function form($id=''){
		$this->data['page']='admin/employees_form';
		
		$this->data['employee_id']=$id;
		
		//Get all departments.
		$this->load->model('Department_model');
		$this->data['departments']=$this->Department_model->get_all();
		
		//If an id is set, get record in order to populate the screen.
		if($id!=''){
			if(!empty($result=$this->Employee_model->get($id))){
				$this->populate_screen($result);
			}
			
			//And get associated departments.
			if(!empty($result=$this->Employee_model->get_departments($id))){
				$departments=array();
				foreach($result as $row){
					//Mark any departments in the result-set as CHECKED.
					$departments['department['.$row['department_id'].']']='CHECKED';
				}
				
				$this->populate_screen($departments);
			}
		}
		
		$this->load->view('template', $this->data);
	}
	
	public function view($id){
		$this->data['page']='admin/employees_view';
		
		//Get employee information.
		$this->data['employee']=$this->Employee_model->get($id);
		
		//Get employee departments..
		$this->data['departments']=$this->Employee_model->get_departments($id);
		
		//Get employee projects - incomplete.
		$this->data['projects_incomplete']=$this->Employee_model->get_projects_incomplete($id);
		
		//Get department projects - complete.
		$this->data['projects_complete']=$this->Employee_model->get_projects_complete($id);
		
		//Get department support - open.
		$this->data['support_open']=$this->Employee_model->get_support_open($id);
		
		//Get department support - closed.
		$this->data['support_closed']=$this->Employee_model->get_support_closed($id);
		
		$this->load->view('template', $this->data);
	}
	
	public function validate(){
		$pass=$this->get_validations();
		
		$id=$this->input->post('employee_id');
		
		switch($this->action){
			case "save":
				$username=$this->input->post('employee_username');
				
				if($id==""){
					//A new record is being inserted.
					if($this->Employee_model->username_exists($username)){
						$this->set_message('Username already exists!');
						$pass=false;
					}
				}else{
					//A record is being updated.  Make sure the username being updated matches the user ID that is pulled up.
					if($username_id=$this->Employee_model->username_exists($username)){
						if($username_id!=$id){
							$this->set_message('Username already exists!');
							$pass=false;
						}
					}
				}
				break;
		}
		
		return $pass;
	}
	
	public function action(){
		//Retrieve the record's id if it exists in the form.
		$id=$this->input->post('employee_id');
		
		switch($this->action){
			case "save":
				//Validate the form submission.
				if($this->validate()){
					$password=$this->Employee_model->save($id);
					$this->set_message('Employee information saved successfully', 'success');
					
					//If a password was set, display it.
					if($password!=''){
						$this->set_message("Employee's temporary password is: <b>".$password."</b>", 'info');
					}
					
					//Go back to the list screen.
					redirect('admin/employees');
				}
				
				//The validation failed so retrieve POST data and reload the page.
				$this->populate_screen($this->input->post());
				redirect('admin/employees/form/'.$id);
				break;
			case "reset password":
				$password=$this->Employee_model->reset_password($id);
				
				$this->set_message('Employee password reset successfully!', 'success');
				$this->set_message("Employee's new temporary password is: <b>".$password."</b>", 'info');
				
				//Go back to the employee's record.
				redirect('admin/employees/form/'.$id);
				break;
			case "delete":
				$this->Employee_model->delete($id);
				$this->set_message('Employee deleted successfully!', 'danger');
				redirect('admin/employees');
				break;
		}
		
		
	}
	
}
