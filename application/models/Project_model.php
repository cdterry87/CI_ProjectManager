<?php defined('BASEPATH') or exit('No direct script access allowed');

class Project_model extends PROJECTS_Model
{
    
    public $table;
    public $table_id;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->table        = 'projects';
        $this->table_id     = 'project_id';
    }
    
    /* --------------------------------------------------------------------------------
     * Get all records.
     * -------------------------------------------------------------------------------- */
    public function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("(project_type='P' or project_type='R')");
        $this->db->order_by('project_date desc, project_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get all quotes.
     * -------------------------------------------------------------------------------- */
    public function get_all_quotes()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('project_type', 'Q');
        $this->db->where("project_status!='A'");
        $this->db->order_by('project_date desc, project_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get all requests.
     * -------------------------------------------------------------------------------- */
    public function get_all_requests()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('project_type', 'R');
        $this->db->order_by('project_date desc, project_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get all incomplete projects.
     * -------------------------------------------------------------------------------- */
    public function get_all_incomplete()
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
            $this->db->from('projects');
        } else {
            $this->db->from('projects, departments_projects');
            $this->db->where('projects.project_id=departments_projects.project_id');
            $this->db->where($where);
        }
        $this->db->where("(project_type='P')");
        $this->db->where('project_status', 'I');
        $this->db->order_by('project_date desc, project_name');
        $this->db->group_by('projects.project_id');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get all complete projects.
     * -------------------------------------------------------------------------------- */
    public function get_all_complete()
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
            $this->db->from('projects');
        } else {
            $this->db->from('projects, departments_projects');
            $this->db->where('projects.project_id=departments_projects.project_id');
            $this->db->where($where);
        }
        $this->db->where('project_type', 'P');
        $this->db->where('project_status', 'C');
        $this->db->order_by('project_date desc, project_name');
        $this->db->group_by('projects.project_id');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get all archived projects.
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
            $this->db->from('projects');
        } else {
            $this->db->from('projects, departments_projects');
            $this->db->where('projects.project_id=departments_projects.project_id');
            $this->db->where($where);
        }
        $this->db->where('project_status', 'A');
        $this->db->order_by('project_date desc, project_name');
        $this->db->group_by('projects.project_id');
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
        
        //Set completed date if status is initially set to complete.
        if ($data['project_status']=="C") {
            $data['project_completed_date']=date('Ymd');
        }
        
        if ($id=='') {
            //Set status to "I" (Incomplete) by default.
            if (trim($data['project_status'])=='') {
                $data['project_status']="I";
            }
            
            //Set project_type to "P" (Project) by default.
            $data['project_type']="P";
            
            //Insert the record into the database.
            $this->db->insert($this->table, $data);
            
            //Return the ID of the record that was inserted.
            $id=$this->db->insert_id();
        } else {
            //Unset fields that should not be updated.
            unset($data[$this->table_id]);
            
            //Update the record in the database.
            $this->db->where($this->table_id, $id);
            $this->db->update($this->table, $data);
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
    }

    /* --------------------------------------------------------------------------------
     * Mark project as approved.
     * -------------------------------------------------------------------------------- */
    public function approve_project($id)
    {
        $date = date('Ymd');

        //Set status to "C" (Complete).
        $data['project_status']='C';
        $data['project_completed_date']=$date;
        $data['project_approved']='Y';
        $data['project_approved_date']=$date;
        $data['project_approved_by']=$_SESSION['employee_id'];
        
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);
    }
    
    /* --------------------------------------------------------------------------------
     * Mark project as complete.
     * -------------------------------------------------------------------------------- */
    public function complete_project($id)
    {
        //Set status to "C" (Complete).
        $data['project_status']='C';
        $data['project_completed_date']=date('Ymd');
        
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);
    }
    
    /* --------------------------------------------------------------------------------
     * Mark project as incomplete.
     * -------------------------------------------------------------------------------- */
    public function incomplete_project($id)
    {
        //Set status to "I" (Incomplete).
        $data['project_status']='I';
        $data['project_completed_date']='';
        
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);
    }
    
    /* --------------------------------------------------------------------------------
     * Mark project as archived.
     * -------------------------------------------------------------------------------- */
    public function archive_project($id)
    {
        //Set status to "A" (Archived).
        $data['project_status']='A';
        $data['project_archived_date']=date('Ymd');
        
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);
    }
    
    /* --------------------------------------------------------------------------------
     * Restore project.  Remove archived status from project.
     * -------------------------------------------------------------------------------- */
    public function restore_project($id)
    {
        //Set status to "A" (Archived).
        $data['project_status']='I';
        $data['project_archived_date']='';
        
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);
    }
    
    /* --------------------------------------------------------------------------------
     * Get associated departments.
     * -------------------------------------------------------------------------------- */
    public function get_departments($id)
    {
        $this->db->select('*');
        $this->db->from('departments_projects');
        $this->db->where('project_id', $id);
        $this->db->join('departments', 'departments_projects.department_id=departments.department_id');
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
        $this->db->where('project_id', $id);
        $this->db->delete('departments_projects');
        
        //Get data from the department checkbox(es).
        $departments=$this->input->post('department');
        
        //Then insert the new departments for this employee.
        if (!empty($departments) and is_array($departments)) {
            foreach ($departments as $key => $val) {
                $insert=array();
                if (trim($val)!="") {
                    $insert['project_id']=$id;
                    $insert['department_id']=$val;
                    $this->db->insert('departments_projects', $insert);
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
        $this->db->from('employees_projects');
        $this->db->where('project_id', $id);
        $this->db->join('employees', 'employees_projects.employee_id=employees.employee_id');
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
        $this->db->where('project_id', $id);
        $this->db->delete('employees_projects');
        
        //Get data from the department checkbox(es).
        $employees=$this->input->post('employee');
        
        //Then insert the new departments for this employee.
        if (!empty($employees) and is_array($employees)) {
            foreach ($employees as $key => $val) {
                $insert=array();
                if (trim($val)!="") {
                    $insert['project_id']=$id;
                    $insert['employee_id']=$val;
                    $this->db->insert('employees_projects', $insert);
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
        $this->db->from('projects');
        $this->db->where('project_id', $id);
        $this->db->join('customers', 'projects.customer_id=customers.customer_id');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Add a task to a project.
     * -------------------------------------------------------------------------------- */
    public function add_task($id = '')
    {
        //Prepare the data from the screen.
        $data=$this->prepare('projects_tasks');
        
        $data['task_assigned_by']=$_SESSION['employee_id'];
        $data['task_date']=date('Ymd');
        
        //Insert the record into the database.
        $this->db->insert('projects_tasks', $data);
        
        $id =  $this->db->insert_id();

        $this->set_tasks_employees($id);

        return $id;
    }

    /* --------------------------------------------------------------------------------
     * Set assigned employees.
     * -------------------------------------------------------------------------------- */
    public function set_tasks_employees($id)
    {
        //First, delete the related departments that are already out there.
        $this->db->where('project_task_id', $id);
        $this->db->delete('projects_tasks_employees');
        
        //Get data from the department checkbox(es).
        $employees=$this->input->post('employee');
        
        //Then insert the new departments for this employee.
        if (!empty($employees) and is_array($employees)) {
            foreach ($employees as $key => $val) {
                $insert=array();
                if (trim($val)!="") {
                    $insert['project_task_id']=$id;
                    $insert['employee_id']=$val;
                    $this->db->insert('projects_tasks_employees', $insert);
                }
            }
            return true;
        }
        return false;
    }
    
    /* --------------------------------------------------------------------------------
     * Delete a task.
     * -------------------------------------------------------------------------------- */
    public function delete_task($project_id, $task_id)
    {
        $this->db->where('project_id', $project_id);
        $this->db->where('task_id', $task_id);
        $this->db->delete('projects_tasks');
    }
    
    /* --------------------------------------------------------------------------------
     * Mark task as complete.
     * -------------------------------------------------------------------------------- */
    public function complete_task($project_id, $task_id)
    {
        //Set status to "C" (Complete).
        $data['task_status']='C';
        
        $this->db->where('project_id', $project_id);
        $this->db->where('task_id', $task_id);
        $this->db->update('projects_tasks', $data);
    }
    
    /* --------------------------------------------------------------------------------
     * Mark task as incomplete.
     * -------------------------------------------------------------------------------- */
    public function incomplete_task($project_id, $task_id)
    {
        //Set status to "I" (Incomplete).
        $data['task_status']='I';
        
        $this->db->where('project_id', $project_id);
        $this->db->where('task_id', $task_id);
        $this->db->update('projects_tasks', $data);
    }
    
    /* --------------------------------------------------------------------------------
     * Get associated tasks.
     * -------------------------------------------------------------------------------- */
    public function get_tasks($id)
    {
        $this->db->select('*');
        $this->db->from('projects_tasks');
        $this->db->where('project_id', $id);
        $this->db->order_by('task_date', 'desc');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Get associated files.
     * -------------------------------------------------------------------------------- */
    public function get_files($id)
    {
        $this->db->select('*');
        $this->db->from('projects_files');
        $this->db->where('project_id', $id);
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Insert file information into the database.
     * -------------------------------------------------------------------------------- */
    public function upload($id, $upload_data)
    {
        $data=array(
            'project_id'    => $id,
            'file_name'     => $upload_data['file_name'],
        );
        
        //Insert the record into the database.
        $this->db->insert('projects_files', $data);
    }
    
    /* --------------------------------------------------------------------------------
     * Delete a file.
     * -------------------------------------------------------------------------------- */
    public function delete_file($project_id, $file_id)
    {
        $this->db->where('project_id', $project_id);
        $this->db->where('file_id', $file_id);
        $this->db->delete('projects_files');
    }

    /* --------------------------------------------------------------------------------
     * Project Notes.
     * -------------------------------------------------------------------------------- */
    public function add_note($id)
    {
        //Prepare the data from the screen.
        $data=$this->prepare('projects_notes');
        
        //Set data.
        $data['project_id']=$id;
        $data['employee_id']=$_SESSION['employee_id'];
        $data['datetime']=date('Y-m-d H:i:s');
        
        //Insert the record into the database.
        $this->db->insert('projects_notes', $data);
        
        return $this->db->insert_id();
    }

    public function get_notes($id)
    {
        $this->db->select('*');
        $this->db->from('projects_notes');
        $this->db->where('project_id', $id);
        $this->db->order_by('datetime', 'desc');
        $query=$this->db->get();
        
        return $query->result_array();
    }

    public function delete_note($id)
    {
        $this->db->where('project_note_id', $id);
        $this->db->delete('projects_notes');
    }

    /* --------------------------------------------------------------------------------
     * Project Reminders
     * -------------------------------------------------------------------------------- */
    public function add_reminder($id)
    {
        //Prepare the data from the screen.
        $data=$this->prepare('projects_reminders');
        
        //Set status to "I" (Incomplete) by default.
        $data['project_id']=$id;
        $data['employee_id']=$_SESSION['employee_id'];
        
        //Insert the record into the database.
        $this->db->insert('projects_reminders', $data);
        
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
        $this->db->where('project_reminder_id', $id);
        $this->db->delete('projects_reminders_employees');
        
        //Get data from the department checkbox(es).
        $employees=$this->input->post('employee');
        
        //Then insert the new departments for this employee.
        if (!empty($employees) and is_array($employees)) {
            foreach ($employees as $key => $val) {
                $insert=array();
                if (trim($val)!="") {
                    $insert['project_reminder_id']=$id;
                    $insert['employee_id']=$val;
                    $this->db->insert('projects_reminders_employees', $insert);
                }
            }
            return true;
        }
        return false;
    }

    public function get_reminders($id)
    {
        $this->db->select('*');
        $this->db->from('projects_reminders');
        $this->db->where('project_id', $id);
        $this->db->order_by('reminder_date', 'desc');
        $query=$this->db->get();
        
        return $query->result_array();
    }

    public function delete_reminder($id)
    {
        $this->db->where('project_reminder_id', $id);
        $this->db->delete('projects_reminders');
    }
}
