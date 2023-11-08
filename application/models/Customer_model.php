<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends PROJECTS_Model {
	
	public $table;
	public $table_id;
	
	public function __construct(){
		parent::__construct();
		
		$this->table		= 'customers';
		$this->table_id		= 'customer_id';
	}
	
	/* --------------------------------------------------------------------------------
	 * Get all records.
	 * -------------------------------------------------------------------------------- */
	public function get_all(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('customer_name');
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
	 * Get a record formatted for dropdowns as a key/value pair.
	 * -------------------------------------------------------------------------------- */
	public function get_dropdown(){
		$dropdown_key		= 'customer_id';
		$dropdown_val		= 'customer_name';
		
		$this->db->select($dropdown_key.','.$dropdown_val);
		$this->db->from($this->table);
		$this->db->order_by($dropdown_val);
		$query=$this->db->get();
		$result=$query->result_array();
		
		$dropdown=array(''=>'');
		if(!empty($result)){
			foreach($result as $row){
				$dropdown[$row[$dropdown_key]]=$row[$dropdown_val];
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
			//Insert the record into the database.
			$this->db->insert($this->table, $data);
			
			//Return the ID of the record that was inserted.
			return $this->db->insert_id();
		}else{
			//Unset fields that should not be updated.
			unset($data[$this->table_id]);
			
			//Update the record in the database.
			$this->db->where($this->table_id, $id);
			$this->db->update($this->table, $data);
		}
	}
	
	/* --------------------------------------------------------------------------------
	 * Delete a record.
	 * -------------------------------------------------------------------------------- */
	public function delete($id){
		$this->db->where($this->table_id, $id);
		$this->db->delete($this->table);
	}
	
	public function get_projects_quotes($id){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->where('customer_id',$id);
		$this->db->where('project_type','Q');
		$this->db->order_by('project_date desc, project_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	public function get_projects_incomplete($id){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->where('customer_id',$id);
		$this->db->where('project_type','P');
		$this->db->where("project_status='I'");
		$this->db->order_by('project_date desc, project_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	public function get_projects_complete($id){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->where('customer_id',$id);
		$this->db->where('project_type','P');
		$this->db->where('project_status','C');
		$this->db->order_by('project_date desc, project_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	public function get_projects_archived($id){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->where('customer_id',$id);
		$this->db->where('project_status','A');
		$this->db->order_by('project_date desc, project_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	public function get_support_open($id){
		$this->db->select('*');
		$this->db->from('support');
		$this->db->where('customer_id',$id);
		$this->db->where("support_status='O'");
		$this->db->order_by('support_date, support_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	public function get_support_closed($id){
		$this->db->select('*');
		$this->db->from('support');
		$this->db->where('customer_id',$id);
		$this->db->where('support_status','C');
		$this->db->order_by('support_date, support_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	public function get_support_archived($id){
		$this->db->select('*');
		$this->db->from('support');
		$this->db->where('customer_id',$id);
		$this->db->where('support_status','A');
		$this->db->order_by('support_date, support_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
}
