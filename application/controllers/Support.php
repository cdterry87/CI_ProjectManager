<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends PROJECTS_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Support_model');
	}
	
	public function index(){
		$this->data['page']='support/support_open';
		
		//Get all open support.
		$this->data['support']=$this->Support_model->get_all_open();
		
		//Get customers dropdown.
		$this->load->model('Customer_model');
		$this->data['customers']=$this->Customer_model->get_dropdown();
		
		$this->load->view('template', $this->data);
	}
	
	public function all(){
		$this->data['page']='support/support';
		
		//Get all support.
		$this->data['support']=$this->Support_model->get_all();
		
		//Get customers dropdown.
		$this->load->model('Customer_model');
		$this->data['customers']=$this->Customer_model->get_dropdown();
		
		$this->load->view('template', $this->data);
	}
	
	public function closed(){
		$this->data['page']='support/support_closed';
		
		//Get all closed support.
		$this->data['support']=$this->Support_model->get_all_closed();
		
		//Get customers dropdown.
		$this->load->model('Customer_model');
		$this->data['customers']=$this->Customer_model->get_dropdown();
		
		$this->load->view('template', $this->data);
	}
	
	public function archive(){
		$this->data['page']='support/support_archive';
		
		//Get all archived support.
		$this->data['support']=$this->Support_model->get_all_archived();
		
		//Get customers dropdown.
		$this->load->model('Customer_model');
		$this->data['customers']=$this->Customer_model->get_dropdown();
		
		$this->load->view('template', $this->data);
	}
	
	public function form($id=''){
		$this->data['page']='support/support_form';
		
		//Get customers dropdown.
		$this->load->model('Customer_model'); 
		$this->data['customers']=$this->Customer_model->get_dropdown();
		
		//Get departments.
		$this->load->model('Department_model');
		$this->data['departments']=$this->Department_model->get_all();
		
		//Get employees.
		$this->load->model('Employee_model');
		$this->data['employees']=$this->Employee_model->get_all();
		
		//If an id is set, get record in order to populate the screen.
		if($id!=''){
			if(!empty($result=$this->Support_model->get($id))){
				$this->populate_screen($result);
			}
			
			//And get associated departments.
			if(!empty($result=$this->Support_model->get_departments($id))){
				$departments=array();
				foreach($result as $row){
					//Mark any departments in the result-set as CHECKED.
					$departments['department['.$row['department_id'].']']='CHECKED';
				}
				
				$this->populate_screen($departments);
			}
			
			//And get associated employees.
			if(!empty($result=$this->Support_model->get_employees($id))){
				$employees=array();
				foreach($result as $row){
					//Mark any departments in the result-set as CHECKED.
					$employees['employee['.$row['employee_id'].']']='CHECKED';
				}
				
				$this->populate_screen($employees);
			}
			
		}
		
		$this->load->view('template', $this->data);
	}
	
	public function view($id){
		$this->data['page']='support/support_view';
		
		//Get support information.
		$this->data['support']=$this->Support_model->get($id);
		
		$this->data['support_status']=$this->data['support']['support_status'];
		switch($this->data['support_status']){
			case "C":
				$this->set_message('This support issue was CLOSED on '.$this->format->date($this->data['support']['support_closed_date']).'!','success'); 
				break;
			case "A":
				$this->set_message('This support issue was ARCHIVED on '.$this->format->date($this->data['support']['support_archived_date']).'!','warning');
				break;
			case "O":
			default:
				$this->set_message('This support issue is OPEN.','danger'); 
				break;
		}
		
		//Get support departments.
		$this->data['departments']=$this->Support_model->get_departments($id);
		
		//Get support employees.
		$this->data['employees']=$this->Support_model->get_employees($id);
		
		//Get support customer.
		$this->data['customer']=$this->Support_model->get_customer($id);
		
		//Get support files.
		$this->data['files']=$this->Support_model->get_files($id);
		
		$this->load->view('template', $this->data);
	}
	
	public function validate(){
		$pass=$this->get_validations();
		
		return $pass;
	}
	
	public function action(){
		//Retrieve the record's id if it exists in the form.
		$id=$this->input->post('support_id');
		
		switch($this->action){
			case "save":
				//Validate the form submission.
				if($this->validate()){
					$this->Support_model->save($id);
					$this->set_message('Support issue saved successfully', 'success');
					
					if($id!=''){
						redirect('support/view/'.$id);
					}else{
						redirect('support');
					}
				}
				
				//The validation failed so retrieve POST data and reload the page.
				$this->populate_screen($this->input->post());
				redirect('support/form/'.$id);
				break;
			case "close issue":
				$this->Support_model->close_issue($id);
				$this->set_message('This support issue is now closed!', 'success');
				redirect('support/view/'.$id);
				break;
			case "open issue":
				$this->Support_model->open_issue($id);
				$this->set_message('This support issue is now open!', 'success');
				redirect('support/view/'.$id);
				break;
			case "archive issue":
				$this->Support_model->archive_issue($id);
				$this->set_message('This support issue is now archived!', 'success');
				redirect('support/view/'.$id);
				break;
			case "restore issue":
				$this->Support_model->restore_issue($id);
				$this->set_message('This support issue has been restored!', 'success');
				redirect('support/view/'.$id);
				break;
			case "add file":
				//Upload the file to the server.
				if($upload_data=$this->upload($id)){
					//Save the file info in the database.
					$this->Support_model->upload($id, $upload_data);
				}
				redirect('support/view/'.$id);
				break;
		}
	}
	
	public function delete_file($support_id,$file_id){
		$this->Support_model->delete_file($support_id,$file_id);
		$this->set_message('File has been removed!', 'danger');
		redirect('support/view/'.$support_id);
	}
	
	public function analytics(){
		$this->data['page']='support/analytics';
		
		$this->load->model('Analytics_model');
		
		//Get all open support.
		$this->data['customers']=$this->Analytics_model->get_customers();
		$this->data['support']=$this->Analytics_model->get_support();
		
		$this->load->view('template', $this->data);
	}
	
}
