<?php defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends PROJECTS_Model
{
    
    public $table;
    public $table_id;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->table        = 'customers';
        $this->table_id     = 'customer_id';
    }
    
    /* --------------------------------------------------------------------------------
     * Get all records.
     * -------------------------------------------------------------------------------- */
    public function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('customer_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }

    /* --------------------------------------------------------------------------------
     * Get only live records.
     * -------------------------------------------------------------------------------- */
    public function get_live()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_status', 'live');
        $this->db->order_by('customer_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }

    /* --------------------------------------------------------------------------------
     * Get a customer name by id
     * -------------------------------------------------------------------------------- */
    public function get_customer_name($id)
    {
        $this->db->select('customer_name');
        $this->db->from($this->table);
        $this->db->where($this->table_id, $id);
        $this->db->order_by('customer_name');
        $query=$this->db->get();
        $result = $query->row_array();

        if (!empty($result)) {
            return $result['customer_name'];
        }
        return false;
    }
    
    /* --------------------------------------------------------------------------------
     * Get a record.
     * -------------------------------------------------------------------------------- */
    public function get($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($this->table_id, $id);
        $query=$this->db->get();
        
        return $query->row_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get a record formatted for dropdowns as a key/value pair.
     * -------------------------------------------------------------------------------- */
    public function get_dropdown()
    {
        $dropdown_key       = 'customer_id';
        $dropdown_val       = 'customer_name';
        
        $this->db->select($dropdown_key.','.$dropdown_val);
        $this->db->from($this->table);
        $this->db->order_by($dropdown_val);
        $query=$this->db->get();
        $result=$query->result_array();
        
        $dropdown=array(''=>'');
        if (!empty($result)) {
            foreach ($result as $row) {
                $dropdown[$row[$dropdown_key]]=$row[$dropdown_val];
            }
        }
        return $dropdown;
    }

    /* --------------------------------------------------------------------------------
     * Get a record formatted for dropdowns as a key/value pair (live only)
     * -------------------------------------------------------------------------------- */
    public function get_dropdown_live()
    {
        $dropdown_key       = 'customer_id';
        $dropdown_val       = 'customer_name';
        
        $this->db->select($dropdown_key.','.$dropdown_val);
        $this->db->from($this->table);
        $this->db->where('customer_status', 'live');
        $this->db->order_by($dropdown_val);
        $query=$this->db->get();
        $result=$query->result_array();
        
        $dropdown=array(''=>'');
        if (!empty($result)) {
            foreach ($result as $row) {
                $dropdown[$row[$dropdown_key]]=$row[$dropdown_val];
            }
        }
        return $dropdown;
    }
    
    /* --------------------------------------------------------------------------------
     * Insert/Update a record.
     * -------------------------------------------------------------------------------- */
    public function save($id = '')
    {
        //Prepare the data from the screen.
        $data=$this->prepare($this->table);
        
        if ($id=='') {
            //Insert the record into the database.
            $this->db->insert($this->table, $data);
            
            //Return the ID of the record that was inserted.
            $id = $this->db->insert_id();
        } else {
            //Unset fields that should not be updated.
            unset($data[$this->table_id]);
            
            //Update the record in the database.
            $this->db->where($this->table_id, $id);
            $this->db->update($this->table, $data);
        }

        //Set systems.
        $this->set_systems($id);
        
        return $id;
    }
    
    /* --------------------------------------------------------------------------------
     * Delete a record.
     * -------------------------------------------------------------------------------- */
    public function delete($id)
    {
        $this->db->where($this->table_id, $id);
        $this->db->delete($this->table);
    }
    
    public function get_projects_quotes($id)
    {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('customer_id', $id);
        $this->db->where('project_type', 'Q');
        $this->db->order_by('project_date desc, project_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    public function get_projects_incomplete($id)
    {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('customer_id', $id);
        $this->db->where('project_type', 'P');
        $this->db->where("project_status='I'");
        $this->db->order_by('project_date desc, project_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    public function get_projects_complete($id)
    {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('customer_id', $id);
        $this->db->where('project_type', 'P');
        $this->db->where('project_status', 'C');
        $this->db->order_by('project_date desc, project_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    public function get_projects_archived($id)
    {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('customer_id', $id);
        $this->db->where('project_status', 'A');
        $this->db->order_by('project_date desc, project_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    public function get_support_open($id)
    {
        $this->db->select('*');
        $this->db->from('support');
        $this->db->where('customer_id', $id);
        $this->db->where("support_status='O'");
        $this->db->order_by('support_date, support_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    public function get_support_closed($id)
    {
        $this->db->select('*');
        $this->db->from('support');
        $this->db->where('customer_id', $id);
        $this->db->where('support_status', 'C');
        $this->db->order_by('support_date, support_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    public function get_support_archived($id)
    {
        $this->db->select('*');
        $this->db->from('support');
        $this->db->where('customer_id', $id);
        $this->db->where('support_status', 'A');
        $this->db->order_by('support_date, support_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get systems owned.
     * -------------------------------------------------------------------------------- */
    public function get_systems($id)
    {
        $this->db->select('*');
        $this->db->from('customers_systems');
        $this->db->where('customer_id', $id);
        $this->db->join('systems', 'customers_systems.system_id=systems.system_id');
        $this->db->order_by('system_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Set associated systems.
     * -------------------------------------------------------------------------------- */
    public function set_systems($id)
    {
        //First, delete the related systems that are already out there.
        $this->db->where('customer_id', $id);
        $this->db->delete('customers_systems');
        
        //Get data from the system checkbox(es).
        $systems = $this->input->post('system');
        
        //Then insert the new systems for this customer.
        if (!empty($systems) and is_array($systems)) {
            foreach ($systems as $key => $val) {
                $insert=array();
                if (trim($val)!="") {
                    $insert['customer_id']=$id;
                    $insert['system_id']=$val;
                    $this->db->insert('customers_systems', $insert);
                }
            }
            return true;
        }
        return false;
    }
    
    /* --------------------------------------------------------------------------------
     * Customer Contacts.
     * -------------------------------------------------------------------------------- */
    public function add_contact($id)
    {
        //Prepare the data from the screen.
        $data=$this->prepare('customers_contacts');
        
        //Set status to "I" (Incomplete) by default.
        $data['customer_id']=$id;
        
        //Insert the record into the database.
        $this->db->insert('customers_contacts', $data);
        
        return $this->db->insert_id();
    }

    public function get_contacts($id)
    {
        $this->db->select('*');
        $this->db->from('customers_contacts');
        $this->db->where('customer_id', $id);
        $this->db->order_by('contact_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    public function delete_contact($contact_id)
    {
        $this->db->where('customer_contact_id', $contact_id);
        $this->db->delete('customers_contacts');
    }

    /* --------------------------------------------------------------------------------
     * Customer Notes.
     * -------------------------------------------------------------------------------- */
    public function add_note($id)
    {
        //Prepare the data from the screen.
        $data=$this->prepare('customers_notes');
        
        //Set status to "I" (Incomplete) by default.
        $data['customer_id']=$id;
        $data['employee_id']=$_SESSION['employee_id'];
        $data['datetime']=date('Y-m-d H:i:s');
        
        //Insert the record into the database.
        $this->db->insert('customers_notes', $data);
        
        return $this->db->insert_id();
    }

    public function get_notes($id)
    {
        $this->db->select('*');
        $this->db->from('customers_notes');
        $this->db->where('customer_id', $id);
        $this->db->order_by('datetime', 'desc');
        $query=$this->db->get();
        
        return $query->result_array();
    }

    public function delete_notes($id)
    {
        $this->db->where('customer_note_id', $id);
        $this->db->delete('customers_notes');
    }

    /* --------------------------------------------------------------------------------
     * Customer Reminders
     * -------------------------------------------------------------------------------- */
    public function add_reminder($id)
    {
        //Prepare the data from the screen.
        $data=$this->prepare('customers_reminders');
        
        //Set status to "I" (Incomplete) by default.
        $data['customer_id']=$id;
        $data['employee_id']=$_SESSION['employee_id'];
        
        //Insert the record into the database.
        $this->db->insert('customers_reminders', $data);
        
        $id = $this->db->insert_id();

        //Set employees.
        $this->set_reminders_employees($id);

        return $id;
    }

    /* --------------------------------------------------------------------------------
     * Set associated employees.
     * -------------------------------------------------------------------------------- */
    public function set_reminders_employees($id)
    {
        //First, delete the related departments that are already out there.
        $this->db->where('customer_reminder_id', $id);
        $this->db->delete('customers_reminders_employees');
        
        //Get data from the department checkbox(es).
        $employees=$this->input->post('employee');
        
        //Then insert the new departments for this employee.
        if (!empty($employees) and is_array($employees)) {
            foreach ($employees as $key => $val) {
                $insert=array();
                if (trim($val)!="") {
                    $insert['customer_reminder_id']=$id;
                    $insert['employee_id']=$val;
                    $this->db->insert('customers_reminders_employees', $insert);
                }
            }
            return true;
        }
        return false;
    }

    public function get_reminders($id)
    {
        $this->db->select('*');
        $this->db->from('customers_reminders');
        $this->db->where('customer_id', $id);
        $this->db->order_by('reminder_date', 'desc');
        $query=$this->db->get();
        
        return $query->result_array();
    }

    public function delete_reminder($id)
    {
        $this->db->where('customer_reminder_id', $id);
        $this->db->delete('customers_reminders');
    }
}
