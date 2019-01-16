<?php defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends PROJECTS_Model
{
    
    /* --------------------------------------------------------------------------------
     * Get all customers.
     * -------------------------------------------------------------------------------- */

    public function get_my_departments_where()
    {
        $departments = $_SESSION['employee_departments'];

        $where='';
        if (!empty($departments)) {
            foreach ($departments as $code => $desc) {
                $where.="department_id='".$code."' OR ";
            }
            $where="(".substr($where, 0, -4).")";

            return $where;
        }

        return false;
    }

    public function get_customers()
    {
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where('customer_status', 'live');
        $this->db->order_by('customer_name');
        $query=$this->db->get();

        return $query->result_array();
    }

    public function get_customers_open_projects($customer_id)
    {
        $where = $this->get_my_departments_where();

        $this->db->distinct();
        $this->db->select('project_name, project_date');
        if (trim($where)=='') {
            $this->db->from('projects');
        } else {
            $this->db->from('projects, departments_projects');
            $this->db->where('projects.project_id=departments_projects.project_id');
            $this->db->where($where);
        }
        $this->db->where('customer_id', $customer_id);
        $this->db->where('project_status', 'I');
        $this->db->order_by('project_date');
        $query=$this->db->get();

        return $query->result_array();
    }

    public function get_customers_open_support($customer_id)
    {
        $where = $this->get_my_departments_where();

        $this->db->select('support_name, support_date, support_time');
        if (trim($where)=='') {
            $this->db->from('support');
        } else {
            $this->db->from('support, departments_support');
            $this->db->where('support.support_id=departments_support.support_id');
            $this->db->where($where);
        }
        $this->db->where('customer_id', $customer_id);
        $this->db->where('support_status', 'O');
        $this->db->order_by('support_date, support_time');
        $query=$this->db->get();

        return $query->result_array();
    }

    public function open_projects_support()
    {
        $customers = $this->get_customers();

        $data = [];
        
        if (!empty($customers)) {
            foreach ($customers as $key => $customer) {
                $data[$customer['customer_name']] = array(
                    'projects' => $this->get_customers_open_projects($customer['customer_id']),
                    'support' => $this->get_customers_open_support($customer['customer_id']),
                );
            }
        }

        $report = '<h1>Open Projects/Support</h1>';
        
        foreach ($data as $key => $val) {
            $report .= "<h2>".$key."</h2>";
            
            if (!empty($val['projects']) or !empty($val['support'])) {
                foreach ($val as $type => $items) {
                    if (!empty($items)) {
                        $report .= "<ul>";
                        $report .= "<li class='headers'><h3>".ucfirst($type)."</h3></li>";
    
                        if (!empty($items)) {
                            $report .= "<ul>";
    
                            foreach ($items as $key3 => $item) {
                                if ($type == 'projects') {
                                    $report .= "<li>".$this->format->date($item['project_date'])." - ".$item['project_name']."</li>";
                                }
                                if ($type == 'support') {
                                    $report .= "<li>".$this->format->date($item['support_date'])." - ".$item['support_name']."</li>";
                                }
                            }
    
                            $report .= "</ul>";
                        }
        
                        $report .= "</ul>";
                    }
                }
            } else {
                $report .= "<ul><li>No open projects/support for this site.</li></ul>";
            }
        }
        
        return $report;
    }
}
