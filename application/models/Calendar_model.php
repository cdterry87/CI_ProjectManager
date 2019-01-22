<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
    }
    
    public function get_project_dates() {
        $this->db->select('*');
        $this->db->from('projects');
        $query=$this->db->get();
        
        $result = $query->result_array();

        $project_dates = [];
        foreach ($result as $row) {
            $end_date = $this->format->calendar_date($row['project_completed_date']);
            if (!$end_date) {
                $end_date = $this->format->calendar_date(date('Ymd'), date('Hi'));
            }

            $project_dates[] = [
                'title' => $row['project_name'],
                'start' => $this->format->calendar_date($row['project_date']),
                'end' => $end_date
            ];
        }

        $project_dates_json = json_encode($project_dates);
        echo $project_dates_json;
        return $project_dates_json;
    }

    public function get_support_dates() {

    }
}