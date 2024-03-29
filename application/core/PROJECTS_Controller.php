<?php defined('BASEPATH') or exit('No direct script access allowed');

class PROJECTS_Controller extends CI_Controller
{
    
    public $data;
    public $action;
    public $message;
    public $current_system, $current_page, $current_subpage, $current_title;
    
    public function __construct()
    {
        parent::__construct();

        //Set the user's current URI.
        $this->current_uri      = $this->uri->uri_string();
        
        //If user id is not set, the user is not logged in so redirect to login screen.
        if (trim($this->session->userdata('employee_id'))=='') {
            //Set the attempted URI before redirecting to login.  Upon successful login, the user will be redirected to this page.
            $this->session->set_userdata('current_uri', $this->current_uri);
            
            redirect('employee/login');
        }

        //Set the current system and page the user is on.
        $this->current_system   = strtolower($this->uri->segment(1));
        $this->current_page     = strtolower($this->uri->segment(2));
        $this->current_subpage  = strtolower($this->uri->segment(3));
        $this->current_title    = ucwords(str_replace('_', ' ', $this->current_page));

        //If user attempts to access admin pages without admin priveleges, redirect to home page.
        if ($this->current_system == "admin") {
            if ($this->session->userdata('employee_admin') != 'CHECKED') {
                redirect($this->config->item('home'));
            }
        }
        
        //If user attempts to access support pages as sales, redirect to home page.
        if ($this->current_system == "support") {
            if ($this->session->userdata('employee_sales') == 'CHECKED') {
                redirect($this->config->item('home'));
            }
        }
        
        //Set user's departments.
        $this->load->model('Employee_model');
        $employee_departments=array();
        $departments=$this->Employee_model->get_departments($_SESSION['employee_id']);
        if (!empty($departments)) {
            foreach ($departments as $row) {
                $employee_departments[$row['department_id']]=$row['department_name'];
            }
        }
        $_SESSION['employee_departments']=$employee_departments;

        //Define theme colors
        $this->theme_colors = [
            'primary',
            'link',
            'info',
            'warning',
            'danger',
            'success',
            'dark',
            'light'
        ];
        
        //Determine the action of a form submission.
        $this->action=strtolower($this->input->post('action'));
    }
    
    /* --------------------------------------------------------------------------------
     * Populate the screen with a result set.
     * -------------------------------------------------------------------------------- */
    public function populate_screen($data)
    {
        $populate=array();

        if (!empty($data) and is_array($data)) {
            foreach ($data as $key => $val) {
                //Unparse certain fields.
                if ($val!='') {
                    //Unparse dates.
                    if (strpos($key, '_date')!==false or $key=='date') {
                        $populate[$key.'_yr']   = substr($val, 0, 4);
                        $populate[$key.'_mo']   = substr($val, 4, 2);
                        $populate[$key.'_day']  = substr($val, 6, 2);
                    }
                    
                    //Unparse times.
                    if (strpos($key, '_time')!==false or $key=='time') {
                        $populate[$key.'_hr']   = substr($val, 0, 2);
                        $populate[$key.'_mn']   = substr($val, 2, 2);
                    }
                    
                    //Unparse phones.
                    if (strpos($key, '_phone')!==false or $key=="phone") {
                        $populate[$key.'_1']    = substr($val, 0, 3);
                        $populate[$key.'_2']    = substr($val, 3, 3);
                        $populate[$key.'_3']    = substr($val, 6, 4);
                    }
                    
                    //Unparse SSN.
                    if ($key=="ssn") {
                        $populate[$key.'_1']    = substr($val, 0, 3);
                        $populate[$key.'_2']    = substr($val, 3, 2);
                        $populate[$key.'_3']    = substr($val, 5, 4);
                    }
                }
                
                //Set the data to be populated.
                $populate[$key]=$val;
            }
        }
        
        //Get the existing populate data if it exists so it can be merged with the new populate data.
        $existing=$this->session->userdata('projects_populate');
        if (trim($existing)!='') {
            //Populate data already exists.  Merge with the new populate data.
            $populate_json=json_encode(array_merge(json_decode($existing, true), $populate));
        } else {
            //Convert populate data to JSON.  There is NO existing populate data.
            $populate_json=json_encode($populate);
        }
        
        //Save populate data to session for use on page reloads.
        $this->session->set_userdata('projects_populate', $populate_json);
    }
    
    /* --------------------------------------------------------------------------------
     * Set a message to be displayed on the screen.
     * -------------------------------------------------------------------------------- */
    public function set_message($message, $class = 'danger')
    {
        //If messages already exist, make sure they are retained on page reload.
        if ($this->session->userdata('projects_messages')!='') {
            $this->message=$this->session->userdata('projects_messages');
        }
        
        $this->message[$class][]=$message;
        
        $this->session->set_userdata('projects_messages', $this->message);
    }
    
    /* --------------------------------------------------------------------------------
     * Get validations for the current form submission.
     * -------------------------------------------------------------------------------- */
    public function get_validations()
    {
        $pass=true;
        $validations=json_decode($this->session->userdata('projects_validations'), true);
        
        if (!empty($validations)) {
            foreach ($validations as $type => $validation) {
                if (!empty($validation)) {
                    foreach ($validation as $fieldname => $info) {
                        if (trim($info['label'])!="") {
                            $field_name_format=$info['label'];
                        } else {
                            //Format the fieldname
                            $field_name_format=ucwords(str_replace('_', ' ', $fieldname));
                        }
                         
                        //Determine the type of validation, and validate accordingly.
                        switch ($type) {
                            //This field is required.  If the value is blank, set an error message.
                            case "required":
                                if (trim($info['value'])=='') {
                                    $this->set_message($field_name_format.' is required.');
                                    $pass=false;
                                }
                                break;
                        }
                    }
                }
            }
        }
        
        return $pass;
    }
    
    /* --------------------------------------------------------------------------------
     * Universal file upload.
     * -------------------------------------------------------------------------------- */
    public function upload($id='', $fieldname = "userfile", $system = '')
    {
        if (trim($system) == '') {
            $system = $this->current_system;
        }

        $upload_path = 'public/files/'.$system.'/'.$id;
        if (trim($id) != '') {
            $upload_path = 'public/files/'.$system;
        }
        
        //Define some configurations for uploading files.
        $upload_config=array(
            'upload_path'           => $upload_path,
            'overwrite'             => true,
            'allowed_types'         => '*',
            'file_ext_tolower'      => true,
        );
        
        //Make directory if it does not exist.
        if (!is_dir(base_url($upload_config['upload_path']))) {
            mkdir(base_url($upload_config['upload_path']), 0777, true);
        }
        
        //Creating directory if it does not exist.
        if (!is_dir($upload_config['upload_path'])) {
            mkdir($upload_config['upload_path'], 0777, true);
        }
        
        //Load the upload library to upload files.
        $this->load->library('upload', $upload_config);
        
        //Perform the file upload.
        if ($this->upload->do_upload($fieldname)) {
            $this->set_message('File uploaded successfully!', 'success');
            
            return $this->upload->data();
        } else {
            $error=$this->upload->display_errors();
            $this->set_message($error, 'danger');
        }
        return false;
    }
}
