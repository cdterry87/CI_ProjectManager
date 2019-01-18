<?php defined('BASEPATH') or exit('No direct script access allowed');

class Support_model extends PROJECTS_Model
{
    
    public $table;
    public $table_id;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->table        = 'support';
        $this->table_id     = 'support_id';
    }
    
    /* --------------------------------------------------------------------------------
     * Get all records.
     * -------------------------------------------------------------------------------- */
    public function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('support_date desc, support_time desc, support_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get all open support.
     * -------------------------------------------------------------------------------- */
    public function get_all_open()
    {
        $departments = $_SESSION['employee_departments'];
        $where='';
        if (!empty($departments)) {
            foreach ($departments as $code => $desc) {
                $where.="department_id='".$code."' OR ";
            }
            $where="(".substr($where, 0, -4).")";
        }
        
        $this->db->select('*');
        if (trim($where)=='') {
            $this->db->from('support');
        } else {
            $this->db->from('support, departments_support');
            $this->db->where('support.support_id=departments_support.support_id');
            $this->db->where($where);
        }
        $this->db->where('support_status', 'O');
        $this->db->order_by('support_date desc, support_time desc, support_name');
        $this->db->group_by('support.support_id');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get all closed support.
     * -------------------------------------------------------------------------------- */
    public function get_all_closed()
    {
        $departments = $_SESSION['employee_departments'];
        $where='';
        if (!empty($departments)) {
            foreach ($departments as $code => $desc) {
                $where.="department_id='".$code."' OR ";
            }
            $where="(".substr($where, 0, -4).")";
        }
        
        $this->db->select('*');
        if (trim($where)=='') {
            $this->db->from('support');
        } else {
            $this->db->from('support, departments_support');
            $this->db->where('support.support_id=departments_support.support_id');
            $this->db->where($where);
        }
        $this->db->where('support_status', 'C');
        $this->db->order_by('support_date desc, support_time desc, support_name');
        $this->db->group_by('support.support_id');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get all archived support.
     * -------------------------------------------------------------------------------- */
    public function get_all_archived()
    {
        $departments = $_SESSION['employee_departments'];
        $where='';
        if (!empty($departments)) {
            foreach ($departments as $code => $desc) {
                $where.="department_id='".$code."' OR ";
            }
            $where="(".substr($where, 0, -4).")";
        }
        
        $this->db->select('*');
        if (trim($where)=='') {
            $this->db->from('support');
        } else {
            $this->db->from('support, departments_support');
            $this->db->where('support.support_id=departments_support.support_id');
            $this->db->where($where);
        }
        $this->db->where('support_status', 'A');
        $this->db->order_by('support_date desc, support_time desc, support_name');
        $this->db->group_by('support.support_id');
        $query=$this->db->get();
        
        return $query->result_array();
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
     * Insert/Update a record.
     * -------------------------------------------------------------------------------- */
    public function save($id = '')
    {
        //Prepare the data from the screen.
        $data=$this->prepare($this->table);
        
        //Set closed date if support status is initially set to closed.
        if ($data['support_status']=="C") {
            $data['support_closed_date']=date('Ymd');
        }
        
        if ($id=='') {
            //Set status to "O" (Open) by default.
            if (trim($data['support_status'])=='') {
                $data['support_status']="O";
            }
            
            //Insert the record into the database.
            $this->db->insert($this->table, $data);
            
            //Return the ID of the record that was inserted.
            $id=$this->db->insert_id();

            //Add history
            $this->add_history($id, 'Support created');
        } else {
            //Unset fields that should not be updated.
            unset($data[$this->table_id]);
            
            //Update the record in the database.
            $this->db->where($this->table_id, $id);
            $this->db->update($this->table, $data);

            //Add history
            $this->add_history($id, 'Support updated');
        }
        
        //Set departments.
        $this->set_departments($id);
        
        //Set employees.
        $this->set_employees($id);
        
        return $id;
    }
    
    /* --------------------------------------------------------------------------------
     * Delete a record.
     * -------------------------------------------------------------------------------- */
    public function delete($id)
    {
        $this->db->where($this->table_id, $id);
        $this->db->delete($this->table);

        //Add history
        $this->add_history($id, 'Support deleted');
    }
    
    /* --------------------------------------------------------------------------------
     * Get associated departments.
     * -------------------------------------------------------------------------------- */
    public function get_departments($id)
    {
        $this->db->select('*');
        $this->db->from('departments_support');
        $this->db->where('support_id', $id);
        $this->db->join('departments', 'departments_support.department_id=departments.department_id');
        $this->db->order_by('department_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Set associated departments.
     * -------------------------------------------------------------------------------- */
    public function set_departments($id)
    {
        //First, delete the related departments that are already out there.
        $this->db->where('support_id', $id);
        $this->db->delete('departments_support');
        
        //Get data from the department checkbox(es).
        $departments=$this->input->post('department');
        
        //Then insert the new departments for this employee.
        if (!empty($departments) and is_array($departments)) {
            foreach ($departments as $key => $val) {
                $insert=array();
                if (trim($val)!="") {
                    $insert['support_id']=$id;
                    $insert['department_id']=$val;
                    $this->db->insert('departments_support', $insert);
                }
            }
            return true;
        }
        return false;
    }
    
    /* --------------------------------------------------------------------------------
     * Get associated employees.
     * -------------------------------------------------------------------------------- */
    public function get_employees($id)
    {
        $this->db->select('*');
        $this->db->from('employees_support');
        $this->db->where('support_id', $id);
        $this->db->join('employees', 'employees_support.employee_id=employees.employee_id');
        $this->db->order_by('employee_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Set associated employees.
     * -------------------------------------------------------------------------------- */
    public function set_employees($id)
    {
        //First, delete the related departments that are already out there.
        $this->db->where('support_id', $id);
        $this->db->delete('employees_support');
        
        //Get data from the department checkbox(es).
        $employees=$this->input->post('employee');
        
        //Then insert the new departments for this employee.
        if (!empty($employees) and is_array($employees)) {
            foreach ($employees as $key => $val) {
                $insert=array();
                if (trim($val)!="") {
                    $insert['support_id']=$id;
                    $insert['employee_id']=$val;
                    $this->db->insert('employees_support', $insert);
                }
            }
            return true;
        }
        return false;
    }
    
    /* --------------------------------------------------------------------------------
     * Get associated customer.
     * -------------------------------------------------------------------------------- */
    public function get_customer($id)
    {
        $this->db->select('*');
        $this->db->from('support');
        $this->db->where('support_id', $id);
        $this->db->join('customers', 'support.customer_id=customers.customer_id');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Mark support issue as closed.
     * -------------------------------------------------------------------------------- */
    public function close_issue($id)
    {
        //Set status to "C" (Complete).
        $data['support_status']='C';
        $data['support_closed_date']=date('Ymd');
        
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);

        //Add history
        $this->add_history($id, 'Support closed');
    }
    
    /* --------------------------------------------------------------------------------
     * Mark support issue as open.
     * -------------------------------------------------------------------------------- */
    public function open_issue($id)
    {
        //Set status to "O" (Open).
        $data['support_status']='O';
        $data['support_closed_date']='';
        
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);

        //Add history
        $this->add_history($id, 'Support opened');
    }
    
    /* --------------------------------------------------------------------------------
     * Mark support issue as archived.
     * -------------------------------------------------------------------------------- */
    public function archive_issue($id)
    {
        //Set status to "A" (Archived).
        $data['support_status']='A';
        $data['support_archived_date']=date('Ymd');
        
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);

        //Add history
        $this->add_history($id, 'Support archived');
    }
    
    /* --------------------------------------------------------------------------------
     * Restore support issue.  Remove archived status from support issue.
     * -------------------------------------------------------------------------------- */
    public function restore_issue($id)
    {
        //Set status to "A" (Archived).
        $data['support_status']='O';
        $data['support_archived_date']='';
        
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);

        //Add history
        $this->add_history($id, 'Support restored');
    }
    
        
    /* --------------------------------------------------------------------------------
     * Insert file information into the database.
     * -------------------------------------------------------------------------------- */
    public function upload($id, $upload_data)
    {
        $data=array(
            'support_id'    => $id,
            'file_name'     => $upload_data['file_name'],
        );
        
        //Insert the record into the database.
        $this->db->insert('support_files', $data);
        $file_id = $this->db->insert_id();

        //Add history
        $this->add_history($id, 'File #' . $file_id . ' uploaded');
    }
    
    /* --------------------------------------------------------------------------------
     * Get associated files.
     * -------------------------------------------------------------------------------- */
    public function get_files($id)
    {
        $this->db->select('*');
        $this->db->from('support_files');
        $this->db->where('support_id', $id);
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Delete a file.
     * -------------------------------------------------------------------------------- */
    public function delete_file($support_id, $file_id)
    {
        $this->db->where('support_id', $support_id);
        $this->db->where('file_id', $file_id);
        $this->db->delete('support_files');

        //Add history
        $this->add_history($support_id, 'File #' . $file_id . ' deleted');
    }

    /* --------------------------------------------------------------------------------
     * Add a task to a project.
     * -------------------------------------------------------------------------------- */
    public function add_task($id = '')
    {
        //Prepare the data from the screen.
        $data=$this->prepare('support_tasks');
        
        $data['employee_id']=$_SESSION['employee_id'];
        
        //Insert the record into the database.
        $this->db->insert('support_tasks', $data);
        $id = $this->db->insert_id();

        //Add history
        $this->add_history($data['support_id'], 'Task #' . $id . ' created');
        
        return $id;
    }

    /* --------------------------------------------------------------------------------
     * Delete a task.
     * -------------------------------------------------------------------------------- */
    public function delete_task($support_id, $task_id)
    {
        $this->db->where('support_id', $support_id);
        $this->db->where('task_id', $task_id);
        $this->db->delete('support_tasks');

        //Add history
        $this->add_history($support_id, 'Task #' . $task_id . ' deleted');
    }
    
    /* --------------------------------------------------------------------------------
     * Complete a task.
     * -------------------------------------------------------------------------------- */
    public function complete_task($support_id, $task_id)
    {
        $data['task_completed'] = date('Y-m-d H:i:s');
        $data['task_completed_by'] = $_SESSION['employee_id'];

        $this->db->where('task_id', $task_id);
        $this->db->update('support_tasks', $data);

        //Add history
        $this->add_history($support_id, 'Task #' . $task_id . ' completed');
    }

    /* --------------------------------------------------------------------------------
     * Get associated tasks.
     * -------------------------------------------------------------------------------- */
    public function get_tasks($id)
    {
        $this->db->select('*');
        $this->db->from('support_tasks');
        $this->db->where('support_id', $id);
        $this->db->order_by('task_date', 'desc');
        $query=$this->db->get();
        
        return $query->result_array();
    }

    /* --------------------------------------------------------------------------------
     * Add history record.
     * -------------------------------------------------------------------------------- */
    public function add_history($id, $action) {
        $data['support_id'] = $id;
        $data['history_action'] = $action;
        $data['history_employee_id'] = $_SESSION['employee_id'];
        $data['history_datetime'] = date('Y-m-d H:i:s');

        //Insert the record into the database.
        $this->db->insert('support_history', $data);
        $id = $this->db->insert_id();

        return $id;
    }

    /* --------------------------------------------------------------------------------
     * Get history for a project.
     * -------------------------------------------------------------------------------- */
    public function get_history($id)
    {
        $this->db->select('*');
        $this->db->from('support_history');
        $this->db->where('support_id', $id);
        $this->db->order_by('history_datetime', 'desc');
        $query=$this->db->get();
        
        return $query->result_array();
    }
}
