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
        $this->data['page']='sales/customers/customers';
        
        //Get all customers.
        $this->data['customers']=$this->Customer_model->get_all();
        
        $this->load->view('template', $this->data);
    }
    
    public function form($id = '')
    {
        $this->data['page']='sales/customers/customers_form';
        
        $this->data['employees'] = $this->Employee_model->get_dropdown_admin_sales();
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
        $this->data['page']='sales/customers/customers_view';
        
        //Get customer information.
        $this->data['customer']=$this->Customer_model->get($id);
        
        //Get customer projects - incomplete.
        $this->data['projects_incomplete']=$this->Customer_model->get_projects_incomplete($id);
        
        //Get customer support - open.
        $this->data['support_open']=$this->Customer_model->get_support_open($id);
        
        //Get project manager name
        $project_manager = $this->Employee_model->get_by_employee_id($this->data['customer']['customer_project_manager']);
        if (!empty($project_manager)) {
            $this->data['project_manager'] = $project_manager['employee_name'];
        }
        
        //Get customer's owned systems
        $this->data['systems'] = $this->Customer_model->get_systems($id);

        //Get a list of the customer's contacts
        $this->data['contacts'] = $this->Customer_model->get_contacts($id);

        //Get a list of the customer's notes
        $this->data['notes'] = $this->Customer_model->get_notes($id);

        //Get list of employees
        $this->data['employees']=$this->Employee_model->get_all();

        //Get a list of the customer's reminders
        $this->data['reminders'] = $this->Customer_model->get_reminders($id);

        //Get customer's files.
        $this->data['files']=$this->Customer_model->get_files($id);
        
        $this->load->view('template', $this->data);
    }

    public function delete_contact($customer_id, $contact_id)
    {
        $this->Customer_model->delete_contact($contact_id);

        $this->set_message('Contact deleted successfully', 'danger');
        redirect('sales/customers/view/'.$customer_id . '/#customer-contacts-tab');
    }

    public function delete_note($customer_id, $note_id)
    {
        $this->Customer_model->delete_note($note_id);

        $this->set_message('Note deleted successfully', 'danger');
        redirect('sales/customers/view/'.$customer_id . '/#customer-notes-tab');
    }

    public function delete_reminder($customer_id, $reminder_id)
    {
        $this->Customer_model->delete_reminder($reminder_id);

        $this->set_message('Reminder deleted successfully', 'danger');
        redirect('sales/customers/view/'.$customer_id . '/#customer-reminders-tab');
    }

    public function delete_file($customer_id, $file_id)
    {
        $this->Customer_model->delete_file($customer_id, $file_id);
        $this->set_message('File has been removed!', 'danger');
        redirect('sales/customers/view/'.$customer_id . '/#customer-files-tab');
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
                    redirect('sales/customers/view/' . $id);
                }
                
                //The validation failed so retrieve POST data and reload the page.
                $this->populate_screen($this->input->post());
                redirect('sales/customers/form/'.$id);
                break;
            case "delete":
                $this->Customer_model->delete($id);
                $this->set_message('Customer deleted successfully!', 'danger');
                redirect('sales/customers');
                break;
            case "save contact":
                if ($this->validate()) {
                    $this->Customer_model->add_contact($id);
                    $this->set_message('Contact added successfully.', 'success');
                }
                echo json_encode($this->session->userdata('projects_messages'));
                exit;
                // redirect('sales/customers/view/'.$id);
                break;
            case "add note":
                if ($this->validate()) {
                    $this->Customer_model->add_note($id);
                    $this->set_message('Note added successfully.', 'success');
                }
                redirect('sales/customers/view/'.$id . '/#customer-notes-tab');
                break;
            case "add reminder":
                if ($this->validate()) {
                    $this->Customer_model->add_reminder($id);
                    $this->set_message('Reminder added successfully.', 'success');
                }
                redirect('sales/customers/view/'.$id . '/#customer-reminders-tab');
                break;
            case "add file":
                //Upload the file to the server.
                if ($upload_data=$this->upload($id, 'userfile', 'customers')) {
                    //Save the file info in the database.
                    $this->Customer_model->upload($id, $upload_data);
                }
                redirect('sales/customers/view/'.$id . '/#customer-files-tab');
                break;
        }
    }
}
