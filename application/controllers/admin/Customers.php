<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends PROJECTS_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Customer_model');
	}
	
	public function index(){
		$this->data['page']='admin/customers';
		
		//Get all employees.
		$this->data['customers']=$this->Customer_model->get_all();
		
		$this->load->view('template', $this->data);
	}
	
	public function form($id=''){
		$this->data['page']='admin/customers_form';
		
		$this->data['customer_id']=$id;
		
		//If an id is set, get record in order to populate the screen.
		if($id!=''){
			if(!empty($result=$this->Customer_model->get($id))){
				$this->populate_screen($result);
			}
		}
		
		$this->load->view('template', $this->data);
	}
	
		
	public function view($id){
		$this->data['page']='admin/customers_view';
		
		//Get department information.
		$this->data['customer']=$this->Customer_model->get($id);
		
		//Get department projects - quotes.
		$this->data['projects_quotes']=$this->Customer_model->get_projects_quotes($id);
		
		//Get department projects - incomplete.
		$this->data['projects_incomplete']=$this->Customer_model->get_projects_incomplete($id);
		
		//Get department projects - complete.
		$this->data['projects_complete']=$this->Customer_model->get_projects_complete($id);
		
		//Get department projects - archive.
		$this->data['projects_archived']=$this->Customer_model->get_projects_archived($id);
		
		//Get department support - open.
		$this->data['support_open']=$this->Customer_model->get_support_open($id);
		
		//Get department support - closed.
		$this->data['support_closed']=$this->Customer_model->get_support_closed($id);
		
		//Get department support - archive.
		$this->data['support_archived']=$this->Customer_model->get_support_archived($id);
		
		$this->load->view('template', $this->data);
	}
	
	public function validate(){
		$pass=$this->get_validations();
		
		return $pass;
	}
	
	public function action(){
		//Retrieve the record's id if it exists in the form.
		$id=$this->input->post('customer_id');
		
		switch($this->action){
			case "save":
				//Validate the form submission.
				if($this->validate()){
					$this->Customer_model->save($id);
					$this->set_message('Customer information saved successfully', 'success');
					redirect('admin/customers');
				}
				
				//The validation failed so retrieve POST data and reload the page.
				$this->populate_screen($this->input->post());
				redirect('admin/customers/form/'.$id);
				break;
			case "delete":
				$this->Customer_model->delete($id);
				$this->set_message('Customer deleted successfully!', 'danger');
				redirect('admin/customers');
				break;
		}
		
	}
	
}
