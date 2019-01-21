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

    public function validate()
    {
        $pass=$this->get_validations();
        
        return $pass;
    }

    public function action() {
        $file_type = $this->input->post('file_type');

        switch ($this->action) {
            case "add file":
                //Upload the file to the server.
                if ($this->validate()) {
                    if ($upload_data=$this->upload('', 'userfile', $file_type)) {
                        //Append the other details to the upload data array
                        $upload_data['file_title'] = $this->input->post('file_title');
                        $upload_data['file_description'] = $this->input->post('file_description');

                        //Save the file info in the database.
                        $this->File_model->upload($upload_data, $file_type);
                    }
                }
                redirect('files');
                break;
        }
    }
}
