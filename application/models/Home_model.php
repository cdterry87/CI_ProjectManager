<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends PROJECTS_Model
{
    
    /* --------------------------------------------------------------------------------
     * Get all customers.
     * -------------------------------------------------------------------------------- */
    public function get_customers()
    {
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->order_by('customer_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get my (incomplete) projects.
     * -------------------------------------------------------------------------------- */
    public function get_projects_incomplete()
    {
        $departments = $_SESSION['employee_departments'];
        $where='';
        if (!empty($departments)) {
            foreach ($departments as $code => $desc) {
                $where.="department_id='".$code."' OR ";
            }
            $where="(".substr($where, 0, -4).")";
        }
        
        
        $this->db->select('projects.project_id, project_name, project_date, customer_id');
        if (trim($where)=='') {
            $this->db->from('projects');
        } else {
            $this->db->from('projects, departments_projects');
            $this->db->where('projects.project_id=departments_projects.project_id');
            $this->db->where($where);
        }
        $this->db->where('project_type', 'P');
        $this->db->where('project_status', 'I');
        //$this->db->join('employees_projects','employees_projects.project_id=projects.project_id');
        //$this->db->where('employee_id',$this->session->userdata('employee_id'));
        $this->db->order_by('project_date desc, project_name');
        $this->db->group_by('projects.project_id');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get my (complete) projects.
     * -------------------------------------------------------------------------------- */
    public function get_projects_complete()
    {
        $this->db->select('projects.project_id, project_name, project_date');
        $this->db->from('projects');
        $this->db->where('project_type', 'P');
        $this->db->where('project_status', 'C');
        //$this->db->join('employees_projects','employees_projects.project_id=projects.project_id');
        //$this->db->where('employee_id',$this->session->userdata('employee_id'));
        $this->db->order_by('project_date desc, project_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get my (open) support.
     * -------------------------------------------------------------------------------- */
    public function get_support_open()
    {
        $departments = $_SESSION['employee_departments'];
        $where='';
        if (!empty($departments)) {
            foreach ($departments as $code => $desc) {
                $where.="department_id='".$code."' OR ";
            }
            $where="(".substr($where, 0, -4).")";
        }
        
        $this->db->select('support.support_id, support_name, support_date, support_time, customer_id');
        if (trim($where)=='') {
            $this->db->from('support');
        } else {
            $this->db->from('support, departments_support');
            $this->db->where('support.support_id=departments_support.support_id');
            $this->db->where($where);
        }
        $this->db->where('support_status', 'O');
        //$this->db->join('employees_support','employees_support.support_id=support.support_id');
        //$this->db->where('employee_id',$this->session->userdata('employee_id'));
        $this->db->order_by('support_date desc, support_name');
        $this->db->group_by('support.support_id');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get my (closed) support.
     * -------------------------------------------------------------------------------- */
    public function get_support_closed()
    {
        $this->db->select('support.support_id, support_name, support_date, support_time');
        $this->db->from('support');
        $this->db->where('support_status', 'C');
        //$this->db->join('employees_support','employees_support.support_id=support.support_id');
        //$this->db->where('employee_id',$this->session->userdata('employee_id'));
        $this->db->order_by('support_date desc, support_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get recent quotes.
     * -------------------------------------------------------------------------------- */
    public function get_quotes()
    {
        $this->db->select('project_id, project_name, project_date');
        $this->db->from('projects');
        $this->db->where('project_type', 'Q');
        $this->db->where("project_status!='A'");
        $this->db->order_by('project_date desc, project_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get the counts of a specific number of records from the specified table.  Used for stats.
     * -------------------------------------------------------------------------------- */
    public function get_counts($field, $table, $where = array(), $where_specific = "")
    {
        $this->db->select('count(' . $field . ') as count');
        $this->db->from($table);
        if (!empty($where)) {
            foreach ($where as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        if (trim($where_specific) != '') {
            $this->db->where($where_specific);
        }
        return $this->db->get()->row()->count;
    }
}
