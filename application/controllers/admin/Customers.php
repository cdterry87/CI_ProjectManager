<?php defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends PROJECTS_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Employee_model');
        $this->load->model('Customer_model');
        $this->load->model('System_model');
    }
    
    public function index()
    {
        $this->data['page']='admin/customers/customers';
        
        //Get all customers.
        $this->data['customers']=$this->Customer_model->get_all();
        
        $this->load->view('template', $this->data);
    }
    
    public function form($id = '')
    {
        $this->data['page']='admin/customers/customers_form';
        
        $this->data['employees'] = $this->Employee_model->get_dropdown();
        $this->data['systems'] = $this->System_model->get_all();
        
        $this->data['customer_id']=$id;
        
        $this->data['states'] = array(
            ''=>'',
            'AL'=>"Alabama",
            'AK'=>"Alaska",
            'AZ'=>"Arizona",
            'AR'=>"Arkansas",
            'CA'=>"California",
            'CO'=>"Colorado",
            'CT'=>"Connecticut",
            'DE'=>"Delaware",
            'DC'=>"District Of Columbia",
            'FL'=>"Florida",
            'GA'=>"Georgia",
            'HI'=>"Hawaii",
            'ID'=>"Idaho",
            'IL'=>"Illinois",
            'IN'=>"Indiana",
            'IA'=>"Iowa",
            'KS'=>"Kansas",
            'KY'=>"Kentucky",
            'LA'=>"Louisiana",
            'ME'=>"Maine",
            'MD'=>"Maryland",
            'MA'=>"Massachusetts",
            'MI'=>"Michigan",
            'MN'=>"Minnesota",
            'MS'=>"Mississippi",
            'MO'=>"Missouri",
            'MT'=>"Montana",
            'NE'=>"Nebraska",
            'NV'=>"Nevada",
            'NH'=>"New Hampshire",
            'NJ'=>"New Jersey",
            'NM'=>"New Mexico",
            'NY'=>"New York",
            'NC'=>"North Carolina",
            'ND'=>"North Dakota",
            'OH'=>"Ohio",
            'OK'=>"Oklahoma",
            'OR'=>"Oregon",
            'PA'=>"Pennsylvania",
            'RI'=>"Rhode Island",
            'SC'=>"South Carolina",
            'SD'=>"South Dakota",
            'TN'=>"Tennessee",
            'TX'=>"Texas",
            'UT'=>"Utah",
            'VT'=>"Vermont",
            'VA'=>"Virginia",
            'WA'=>"Washington",
            'WV'=>"West Virginia",
            'WI'=>"Wisconsin",
            'WY'=>"Wyoming"
        );
        
        //If an id is set, get record in order to populate the screen.
        if ($id!='') {
            if (!empty($result = $this->Customer_model->get($id))) {
                $this->populate_screen($result);
            }
            
            //And get systems owned.
            if (!empty($result = $this->Customer_model->get_systems($id))) {
                $systems=array();
                foreach ($result as $row) {
                    //Mark any departments in the result-set as CHECKED.
                    $systems['system['.$row['system_id'].']']='CHECKED';
                }
                
                $this->populate_screen($systems);
            }
        }
        
        $this->load->view('template', $this->data);
    }
    
        
    public function view($id)
    {
        $this->data['page']='admin/customers/customers_view';
        
        //Get customer information.
        $this->data['customer']=$this->Customer_model->get($id);
        
        //Get customer projects - incomplete.
        $this->data['projects_incomplete']=$this->Customer_model->get_projects_incomplete($id);
        
        //Get customer support - open.
        $this->data['support_open']=$this->Customer_model->get_support_open($id);
        
        $project_manager = $this->Employee_model->get_by_employee_id($this->data['customer']['customer_adsi_project_manager']);
        if (!empty($project_manager)) {
            $this->data['project_manager'] = $project_manager['employee_name'];
        }
        
        //Get customer's owned systems
        $this->data['systems'] = $this->Customer_model->get_systems($id);
        
        $this->load->view('template', $this->data);
    }
    
    public function validate()
    {
        $pass=$this->get_validations();
        
        return $pass;
    }
    
    public function action()
    {
        //Retrieve the record's id if it exists in the form.
        $id=$this->input->post('customer_id');
        
        switch ($this->action) {
            case "save":
                //Validate the form submission.
                if ($this->validate()) {
                    $this->Customer_model->save($id);
                    $this->set_message('Customer information saved successfully', 'success');
                    redirect('admin/customers');
                }
                
                //The validation failed so retrieve POST data and reload the page.
                $this->populate_screen($this->input->post());
                redirect('admin/customers/form/'.$id);
                break;
            case "delete":
                $this->Customer_model->delete($id);
                $this->set_message('Customer deleted successfully!', 'danger');
                redirect('admin/customers');
                break;
            case "add contact":
                if ($this->validate()) {
                    $this->Customer_model->add_contact($id);
                    $this->set_message('Contact added successfully.', 'success');
                }
                redirect('admin/customers/view/'.$id);
                break;
            case "add note":
                if ($this->validate()) {
                    $this->Customer_model->add_note($id);
                    $this->set_message('Note added successfully.', 'success');
                }
                redirect('admin/customers/view/'.$id);
                break;
            case "add reminder":
                if ($this->validate()) {
                    $this->Customer_model->add_reminder($id);
                    $this->set_message('Reminder added successfully.', 'success');
                }
                redirect('admin/customers/view/'.$id);
                break;
        }
    }
}
