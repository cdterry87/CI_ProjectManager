<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_model extends CI_Model {
	
	public function __construct(){
        parent::__construct();
        
        $this->load->model('Customer_model');
    }
    
    public function get_complete_project_dates() {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('project_status', 'C');
        $query=$this->db->get();
        
        $result = $query->result_array();

        $dates = [];
        foreach ($result as $row) {
            $end_date = $this->format->calendar_date($row['project_completed_date']);
            if (!$end_date) {
                $end_date = $this->format->calendar_date(date('Ymd'));
            }

            $dates[] = [
                'title' => $row['project_name'] . ' (for ' . $this->Customer_model->get_customer_name($row['customer_id']) . ')',
                'start' => $this->format->calendar_date($row['project_date']),
                'end' => $end_date,
                'url' => 'projects/view/' . $row['project_id']
            ];
        }

        $dates_json = json_encode($dates);
        echo $dates_json;
        return $dates_json;
    }

    public function get_incomplete_project_dates() {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where("project_status != 'C'");
        $query=$this->db->get();
        
        $result = $query->result_array();

        $dates = [];
        foreach ($result as $row) {
            $end_date = $this->format->calendar_date($row['project_completed_date']);
            if (!$end_date) {
                $end_date = $this->format->calendar_date(date('Ymd'));
            }

            $dates[] = [
                'title' => $row['project_name'] . ' (for ' . $this->Customer_model->get_customer_name($row['customer_id']) . ')',
                'start' => $this->format->calendar_date($row['project_date']),
                'end' => $end_date,
                'url' => 'projects/view/' . $row['project_id']
            ];
        }

        $dates_json = json_encode($dates);
        echo $dates_json;
        return $dates_json;
    }

    public function get_open_support_dates() {
        $this->db->select('*');
        $this->db->from('support');
        $this->db->where("support_status != 'C'");
        $query=$this->db->get();
        
        $result = $query->result_array();

        $dates = [];
        foreach ($result as $row) {
            $end_date = $this->format->calendar_date($row['support_complete_date']);
            if (!$end_date) {
                $end_date = $this->format->calendar_date(date('Ymd'));
            }

            $dates[] = [
                'title' => $row['support_name'] . ' (for ' . $this->Customer_model->get_customer_name($row['customer_id']) . ')',
                'start' => $this->format->calendar_date($row['support_date']),
                'end' => $end_date,
                'url' => 'support/view/' . $row['support_id']
            ];
        }

        $dates_json = json_encode($dates);
        echo $dates_json;
        return $dates_json;
    }

    public function get_closed_support_dates() {
        $this->db->select('*');
        $this->db->from('support');
        $this->db->where('support_status', 'C');
        $query=$this->db->get();
        
        $result = $query->result_array();

        $dates = [];
        foreach ($result as $row) {
            $end_date = $this->format->calendar_date($row['support_complete_date']);
            if (!$end_date) {
                $end_date = $this->format->calendar_date(date('Ymd'));
            }

            $dates[] = [
                'title' => $row['support_name'] . ' (for ' . $this->Customer_model->get_customer_name($row['customer_id']) . ')',
                'start' => $this->format->calendar_date($row['support_date']),
                'end' => $end_date,
                'url' => 'support/view/' . $row['support_id']
            ];
        }

        $dates_json = json_encode($dates);
        echo $dates_json;
        return $dates_json;
    }

}