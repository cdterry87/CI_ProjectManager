<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Support_model extends PROJECTS_Model {
	
	public $table;
	public $table_id;
	
	public function __construct(){
		parent::__construct();
		
		$this->table		= 'support';
		$this->table_id		= 'support_id';
	}
	
	/* --------------------------------------------------------------------------------
	 * Get all records.
	 * -------------------------------------------------------------------------------- */
	public function get_all(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('support_date desc, support_time desc, support_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get all open support.
	 * -------------------------------------------------------------------------------- */
	public function get_all_open(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('support_status','O');
		$this->db->order_by('support_date desc, support_time desc, support_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get all closed support.
	 * -------------------------------------------------------------------------------- */
	public function get_all_closed(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('support_status','C');
		$this->db->order_by('support_date desc, support_time desc, support_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get all archived support.
	 * -------------------------------------------------------------------------------- */
	public function get_all_archived(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('support_status','A');
		$this->db->order_by('support_date desc, support_time desc, support_name');
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
	 * Insert/Update a record.
	 * -------------------------------------------------------------------------------- */
	public function save($id=''){
		//Prepare the data from the screen.
		$data=$this->prepare($this->table);
		
		//Unset fields that should not be updated.
		unset($data[$this->table_id]);
		
		//Setting default values for fields not on the screen.
		$data['support_closed_date']='';
		$data['support_archived_date']='';
		
		if($id==''){
			//Set status to "I" (Incomplete) by default.
			$data['support_status']="O";
			
			//Insert the record into the database.
			$this->db->insert($this->table, $data);
			
			//Return the ID of the record that was inserted.
			$id=$this->db->insert_id();
		}else{
			//Update the record in the database.
			$this->db->where($this->table_id, $id);
			$this->db->update($this->table, $data);
		}
		
		//Set departments.
		$this->set_departments($id);
		
		//Set employees.
		$this->set_employees($id);
		
		return $id;
	}
	
	/* --------------------------------------------------------------------------------
	 * Delete a record.
	 * -------------------------------------------------------------------------------- */
	public function delete($id){
		$this->db->where($this->table_id, $id);
		$this->db->delete($this->table);
	}
	
	/* --------------------------------------------------------------------------------
	 * Get associated departments.
	 * -------------------------------------------------------------------------------- */
	public function get_departments($id){
		$this->db->select('*');
		$this->db->from('departments_support');
		$this->db->where('support_id',$id);
		$this->db->join('departments','departments_support.department_id=departments.department_id');
		$this->db->order_by('department_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Set associated departments.
	 * -------------------------------------------------------------------------------- */
	public function set_departments($id){
		//First, delete the related departments that are already out there.
		$this->db->where('support_id',$id);
		$this->db->delete('departments_support');
		
		//Get data from the department checkbox(es).
		$departments=$this->input->post('department');
		
		//Then insert the new departments for this employee.
		if(!empty($departments) and is_array($departments)){
			foreach($departments as $key=>$val){
				$insert=array();
				if(trim($val)!=""){
					$insert['support_id']=$id;
					$insert['department_id']=$val;
					$this->db->insert('departments_support', $insert);
				}
			}
			return true;
		}
		return false;
	}
	
	/* --------------------------------------------------------------------------------
	 * Get associated employees.
	 * -------------------------------------------------------------------------------- */
	public function get_employees($id){
		$this->db->select('*');
		$this->db->from('employees_support');
		$this->db->where('support_id',$id);
		$this->db->join('employees','employees_support.employee_id=employees.employee_id');
		$this->db->order_by('employee_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Set associated employees.
	 * -------------------------------------------------------------------------------- */
	public function set_employees($id){
		//First, delete the related departments that are already out there.
		$this->db->where('support_id',$id);
		$this->db->delete('employees_support');
		
		//Get data from the department checkbox(es).
		$employees=$this->input->post('employee');
		
		//Then insert the new departments for this employee.
		if(!empty($employees) and is_array($employees)){
			foreach($employees as $key=>$val){
				$insert=array();
				if(trim($val)!=""){
					$insert['support_id']=$id;
					$insert['employee_id']=$val;
					$this->db->insert('employees_support', $insert);
				}
			}
			return true;
		}
		return false;
	}
	
	/* --------------------------------------------------------------------------------
	 * Get associated customer.
	 * -------------------------------------------------------------------------------- */
	public function get_customer($id){
		$this->db->select('*');
		$this->db->from('support');
		$this->db->where('support_id',$id);
		$this->db->join('customers','support.customer_id=customers.customer_id');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Mark support issue as closed.
	 * -------------------------------------------------------------------------------- */
	public function close_issue($id){
		//Set status to "C" (Complete).
		$data['support_status']='C';
		$data['support_closed_date']=date('Ymd');
		
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table,$data);
	}
	
	/* --------------------------------------------------------------------------------
	 * Mark support issue as open.
	 * -------------------------------------------------------------------------------- */
	public function open_issue($id){
		//Set status to "O" (Open).
		$data['support_status']='O';
		$data['support_closed_date']='';
		
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table,$data);
	}
	
	/* --------------------------------------------------------------------------------
	 * Mark support issue as archived.
	 * -------------------------------------------------------------------------------- */
	public function archive_issue($id){
		//Set status to "A" (Archived).
		$data['support_status']='A';
		$data['support_archived_date']=date('Ymd');
		
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table,$data);
	}
	
	/* --------------------------------------------------------------------------------
	 * Restore support issue.  Remove archived status from support issue.
	 * -------------------------------------------------------------------------------- */
	public function restore_issue($id){
		//Set status to "A" (Archived).
		$data['support_status']='O';
		$data['support_archived_date']='';
		
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table,$data);
	}
	
		
	/* --------------------------------------------------------------------------------
	 * Insert file information into the database.
	 * -------------------------------------------------------------------------------- */
	public function upload($id, $upload_data){
		$data=array(
			'support_id'	=> $id,
			'file_name'		=> $upload_data['file_name'],
		);
		
		//Insert the record into the database.
		$this->db->insert('support_files', $data);
	}
	
	/* --------------------------------------------------------------------------------
	 * Get associated files.
	 * -------------------------------------------------------------------------------- */
	public function get_files($id){
		$this->db->select('*');
		$this->db->from('support_files');
		$this->db->where('support_id',$id);
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Delete a file.
	 * -------------------------------------------------------------------------------- */
	public function delete_file($support_id,$file_id){
		$this->db->where('support_id', $support_id);
		$this->db->where('file_id', $file_id);
		$this->db->delete('support_files');
	}
	
}
