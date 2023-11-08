<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends PROJECTS_Model {
	
	/* --------------------------------------------------------------------------------
	 * Get all customers.
	 * -------------------------------------------------------------------------------- */
	public function get_customers(){
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->order_by('customer_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get my (incomplete) projects.
	 * -------------------------------------------------------------------------------- */
	public function get_projects_incomplete(){
		$this->db->select('projects.project_id, project_name, project_date');
		$this->db->from('projects');
		$this->db->where('project_type','P');
		$this->db->where('project_status','I');
		//$this->db->join('employees_projects','employees_projects.project_id=projects.project_id');
		//$this->db->where('employee_id',$this->session->userdata('employee_id'));
		$this->db->order_by('project_date desc, project_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get my (complete) projects.
	 * -------------------------------------------------------------------------------- */
	public function get_projects_complete(){
		$this->db->select('projects.project_id, project_name, project_date');
		$this->db->from('projects');
		$this->db->where('project_type','P');
		$this->db->where('project_status','C');
		//$this->db->join('employees_projects','employees_projects.project_id=projects.project_id');
		//$this->db->where('employee_id',$this->session->userdata('employee_id'));
		$this->db->order_by('project_date desc, project_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get my (open) support.
	 * -------------------------------------------------------------------------------- */
	public function get_support_open(){
		$this->db->select('support.support_id, support_name, support_date, support_time');
		$this->db->from('support');
		$this->db->where('support_status','O');
		//$this->db->join('employees_support','employees_support.support_id=support.support_id');
		//$this->db->where('employee_id',$this->session->userdata('employee_id'));
		$this->db->order_by('support_date desc, support_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get my (closed) support.
	 * -------------------------------------------------------------------------------- */
	public function get_support_closed(){
		$this->db->select('support.support_id, support_name, support_date, support_time');
		$this->db->from('support');
		$this->db->where('support_status','C');
		//$this->db->join('employees_support','employees_support.support_id=support.support_id');
		//$this->db->where('employee_id',$this->session->userdata('employee_id'));
		$this->db->order_by('support_date desc, support_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get recent quotes.
	 * -------------------------------------------------------------------------------- */
	public function get_quotes(){
		$this->db->select('project_id, project_name, project_date');
		$this->db->from('projects');
		$this->db->where('project_type','Q');
		$this->db->where("project_status!='A'");
		$this->db->order_by('project_date desc, project_name');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
}