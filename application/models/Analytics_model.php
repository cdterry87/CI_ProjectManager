<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics_model extends CI_Model {
	
	public $table;
	public $table_id;
	
	public function __construct(){
		parent::__construct();
	}
    
    /* --------------------------------------------------------------------------------
	 * Get all customers.
	 * -------------------------------------------------------------------------------- */
    public function get_customers(){
        $this->db->select('customer_id, customer_Name');
		$this->db->from('customers');
		$this->db->order_by('customer_name');
		$query=$this->db->get();
		
		return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
	 * Get all support.
	 * -------------------------------------------------------------------------------- */
	public function get_support(){
		$this->db->select('*');
		$this->db->from('support');
		$this->db->order_by('support_date, customer_id');
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	/* --------------------------------------------------------------------------------
	 * Get all support.
	 * -------------------------------------------------------------------------------- */
	public function get_employees_support($support_id){
		$this->db->select('*');
		$this->db->from('employees_support');
		$this->db->where('support_id', $support_id);
		$this->db->order_by('employees_support_id');
		$query=$this->db->get();
		
		return $query->result_array();
	}
    
}
