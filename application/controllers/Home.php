<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends PROJECTS_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Home_model');
        $this->load->model('Customer_model');
    }
    
    public function index()
    {
        $this->data['page']='home';
        
        //Get user's incomplete/complete projects.
        // $this->data['customers']=$this->Home_model->get_customers();
        
        //Get user's incomplete/complete projects.
        $this->data['projects_incomplete']=$this->Home_model->get_projects_incomplete();
        
        //Get user's open/closed support.
        $this->data['support_open']=$this->Home_model->get_support_open();

        //Get user's incomplete/complete projects.
        $this->data['my_projects']=$this->Home_model->get_my_projects();
        
        //Get user's open/closed support.
        $this->data['my_support']=$this->Home_model->get_my_support();

        //Get user's customers
        $this->data['my_customers']=$this->Home_model->get_my_customers();
        
        //Get projects counts
        $this->data['projects_count']=$this->Home_model->get_counts('project_id', 'projects');
        $this->data['projects_incomplete_count']=$this->Home_model->get_counts('project_id', 'projects', ['project_status' => 'I']);
        $this->data['projects_complete_count']=$this->Home_model->get_counts('project_id', 'projects', ['project_status' => 'C']);
        $this->data['projects_archived_count']=$this->Home_model->get_counts('project_id', 'projects', ['project_status' => 'A']);

        // Get support counts
        $this->data['support_count']=$this->Home_model->get_counts('support_id', 'support');
        $this->data['support_open_count']=$this->Home_model->get_counts('support_id', 'support', ['support_status' => 'O']);
        $this->data['support_closed_count']=$this->Home_model->get_counts('support_id', 'support', ['support_status' => 'C']);
        $this->data['support_archived_count']=$this->Home_model->get_counts('support_id', 'support', ['support_status' => 'A']);

        // Get customer counts
        $this->data['customers_count']=$this->Home_model->get_counts('customer_id', 'customers');
        $this->data['customers_live_count']=$this->Home_model->get_counts('customer_id', 'customers', ['customer_status' => 'live']);
        $this->data['customers_prospect_count']=$this->Home_model->get_counts('customer_id', 'customers', ['customer_status' => 'prospect']);
        $this->data['customers_pending_count']=$this->Home_model->get_counts('customer_id', 'customers', ['customer_status' => 'pending']);

        // Get completed counts
        $this->data['completed_projects'] = $this->Home_model->get_counts('project_id', 'projects', ['project_status' => 'C'], "project_completed_date >= '" . date('Ymd', strtotime('-7 days')) . "'");
        $this->data['completed_support'] = $this->Home_model->get_counts('support_id', 'support', ['support_status' => 'C'], "support_closed_date >= '" . date('Ymd', strtotime('-7 days')) . "'");
        $this->data['completed_total'] = intval($this->data['completed_projects']) + intval($this->data['completed_support']);
        
        $this->load->view('template', $this->data);
    }
}
