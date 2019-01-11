<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends PROJECTS_Model {
	
	public $table;
	public $table_id;
	
	public function __construct(){
		parent::__construct();
		
		$this->table		= 'employees';
		$this->table_id		= 'employee_id';
	}
	
	/* --------------------------------------------------------------------------------
	 * Check to see if an admin exists in the database.  Returns number of admins.
	 * -------------------------------------------------------------------------------- */
	public function admin_exists(){
		$this->db->select('employee_id');
		$this->db->from($this->table);
		$this->db->where('employee_admin','CHECKED');
		$query=$this->db->get();
		
		return $this->db->count_all_results();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get all records.
	 * -------------------------------------------------------------------------------- */
	public function get_all(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('employee_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get a record.
	 * -------------------------------------------------------------------------------- */
	public function get($id){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($this->table_id,$id);
		$query=$this->db->get();
		
		return $query->row_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get a record by employee id.
	 * -------------------------------------------------------------------------------- */
	public function get_by_employee_id($employee_id){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($this->table_id,$employee_id);
		$query=$this->db->get();
		
		return $query->row_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get login information based on the username.
	 * -------------------------------------------------------------------------------- */
	public function get_login($username){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('employee_username',$username);
		$query=$this->db->get();
		
		return $query->row_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get a record formatted for dropdowns as a key/value pair.
	 * -------------------------------------------------------------------------------- */
	public function get_dropdown(){
		$dropdown_key		= 'employee_id';
		$dropdown_val		= 'employee_name';
		
		$this->db->select($dropdown_key.','.$dropdown_val);
		$this->db->from($this->table);
		$this->db->order_by($dropdown_val);
		$query=$this->db->get();
		$result=$query->result_array();
		
		$dropdown=array(''=>'');
		if(!empty($result)){
			foreach($result as $row){
				$dropdown[$row[$dropdown_key]]=$row['employee_name'];
			}
		}
		return $dropdown;
	}
	
	/* --------------------------------------------------------------------------------
	 * Insert/Update a record.
	 * -------------------------------------------------------------------------------- */
	public function save($id=''){
		//Prepare the data from the screen.
		$data=$this->prepare($this->table);
		
		if($id==''){
			//Generate a random password for the new user.
			$password=$this->password_generate();
			$data['employee_password']=$this->password_encrypt($password);
			
			//Insert the record into the database.
			$this->db->insert($this->table, $data);
			
			//Get the id of the record that was inserted.
			$id=$this->db->insert_id();
		}else{
			//Unset fields that should not be updated.
			unset($data[$this->table_id]);
			
			//Update the record in the database.
			$this->db->where($this->table_id, $id);
			$this->db->update($this->table, $data);
		}
		
		//Set departments.
		$this->set_departments($id);
		
		//Return password if one was generated.
		if(isset($password) and $password!=''){
			return $password;
		}
	}
	
	/* --------------------------------------------------------------------------------
	 * Delete a record.
	 * -------------------------------------------------------------------------------- */
	public function delete($id){
		$this->db->where($this->table_id, $id);
		$this->db->delete($this->table);
	}
	
	/* --------------------------------------------------------------------------------
	 * Generate a random password.
	 * -------------------------------------------------------------------------------- */
	public function password_generate(){
		$password="";
		
		//Valid array of characters for lowercase and uppercase letters, numbers, and symbols.
		$valid_characters=array(
			'abcdefghkmnpqrstuvwxyz',		//lowercase
			'ABCDEFGHJKLMNPQRSTUVWXYZ',		//uppercase
			'23456789',						//numbers
			'!@#$%?&'						//symbols
		);
		
		//Generate a 8-digit password based on a randomly selected character from the valid characters array.
		for($i=0;$i<8;$i++){
			//Make sure to use each of the valid character indexes at least once, then randomly select the remaining characters.
			if($i<=3){
				$valid_index=$i;
			}else{
				$valid_index=rand(0,1);
			}
			
			//Grab a random character from the selected index, and append it to the password string.
			$password.=$valid_characters[$valid_index][rand(0,strlen($valid_characters[$valid_index])-1)];
		}
		
		return str_shuffle($password);
	}
	
	/* --------------------------------------------------------------------------------
	 * Encrypt a password using BCRYPT.  Encrypted passwords will always be 60 chars.
	 * -------------------------------------------------------------------------------- */
	public function password_encrypt($password){
		return password_hash($password, PASSWORD_BCRYPT);
	}
	
	/* --------------------------------------------------------------------------------
	 * Reset password.
	 * -------------------------------------------------------------------------------- */
	public function reset_password($id){
		$password=$this->password_generate();
		$data['employee_password']=$this->password_encrypt($password);
		
		//Update the record with the new password.
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $data);
		
		//Return generated password.
		return $password;
	}
	
	/* --------------------------------------------------------------------------------
	 * Change password.
	 * -------------------------------------------------------------------------------- */
	public function change_password(){
		$id=$this->session->userdata('employee_id');
		
		$password=$this->input->post('employee_password');
		$data['employee_password']=$this->password_encrypt($password);
		
		//Update the record with the new password.
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $data);
		
		return true;
	}
	
	/* --------------------------------------------------------------------------------
	 * Change settings.
	 * -------------------------------------------------------------------------------- */
	public function change_settings(){
		$id=$this->session->userdata('employee_id');
		
		//Prepare the data from the screen.
		$data=$this->prepare($this->table);
		
		//Unset fields that should not be updated.
		unset($data[$this->table_id]);
		
		//Update the record in the database.
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $data);
	}
	
	/* --------------------------------------------------------------------------------
	 * Check to see if username already exists.
	 * -------------------------------------------------------------------------------- */
	public function username_exists($username){
		$this->db->select('employee_id');
		$this->db->from($this->table);
		$this->db->where('employee_username',$username);
		$query=$this->db->get();
		
		$result=$query->row_array();
		if(!empty($result)){
			return $result['employee_id'];
		}
		return false;
	}
	
	/* --------------------------------------------------------------------------------
	 * Get associated departments.
	 * -------------------------------------------------------------------------------- */
	public function get_departments($id){
		$this->db->select('*');
		$this->db->from('departments_employees');
		$this->db->where('employee_id',$id);
		$this->db->join('departments','departments_employees.department_id=departments.department_id');
		$this->db->order_by('department_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Set associated departments.
	 * -------------------------------------------------------------------------------- */
	public function set_departments($id){
		//First, delete the related departments that are already out there.
		$this->db->where('employee_id',$id);
		$this->db->delete('departments_employees');
		
		//Get data from the department checkbox(es).
		$departments=$this->input->post('department');
		
		//Then insert the new departments for this employee.
		if(!empty($departments) and is_array($departments)){
			foreach($departments as $key=>$val){
				$insert=array();
				if(trim($val)!=""){
					$insert['employee_id']=$id;
					$insert['department_id']=$val;
					$this->db->insert('departments_employees', $insert);
				}
			}
			return true;
		}
		return false;
	}
	
	public function get_projects_incomplete($id){
		$this->db->select('*');
		$this->db->from('employees_projects');
		$this->db->where('employee_id',$id);
		$this->db->where("project_type","P");
		$this->db->where("project_status","I");
		$this->db->join('projects','employees_projects.project_id=projects.project_id');
		$this->db->order_by('project_date desc, project_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	public function get_projects_complete($id){
		$this->db->select('*');
		$this->db->from('employees_projects');
		$this->db->where('employee_id',$id);
		$this->db->where("project_type","P");
		$this->db->where("project_status","C");
		$this->db->join('projects','employees_projects.project_id=projects.project_id');
		$this->db->order_by('project_date desc, project_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	public function get_support_open($id){
		$this->db->select('*');
		$this->db->from('employees_support');
		$this->db->where('employee_id',$id);
		$this->db->where("support_status='O'");
		$this->db->join('support','employees_support.support_id=support.support_id');
		$this->db->order_by('support_date, support_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	public function get_support_closed($id){
		$this->db->select('*');
		$this->db->from('employees_support');
		$this->db->where('employee_id',$id);
		$this->db->where('support_status','C');
		$this->db->join('support','employees_support.support_id=support.support_id');
		$this->db->order_by('support_date, support_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
}
