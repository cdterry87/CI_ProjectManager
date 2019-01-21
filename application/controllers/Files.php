<?php defined('BASEPATH') or exit('No direct script access allowed');

class Files extends PROJECTS_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('File_model');
    }
    
    public function index()
    {
        $this->data['page']='files/files';
        
        $this->data['forms']=$this->File_model->get_forms();
        $this->data['documentation']=$this->File_model->get_documentation();
        
        $this->load->view('template', $this->data);
    }

    public function forms() {
        $this->data['page']='files/forms';
        
        $this->data['forms']=$this->File_model->get_forms();
        
        $this->load->view('template', $this->data);
    }

    public function documentation() {
        $this->data['page']='files/documentation';
        
        $this->data['documentation']=$this->File_model->get_documentation();
        
        $this->load->view('template', $this->data);
    }
}
