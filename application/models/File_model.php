<?php defined('BASEPATH') or exit('No direct script access allowed');

class File_model extends PROJECTS_Model
{
    
    /* --------------------------------------------------------------------------------
     * Get all forms.
     * -------------------------------------------------------------------------------- */
    public function get_forms()
    {
        $this->db->select('*');
        $this->db->from('files_forms');
        $this->db->order_by('file_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }

    /* --------------------------------------------------------------------------------
     * Get all documentation.
     * -------------------------------------------------------------------------------- */
    public function get_documentation()
    {
        $this->db->select('*');
        $this->db->from('files_documentation');
        $this->db->order_by('file_name');
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
    /* --------------------------------------------------------------------------------
     * Insert file information into the database.
     * -------------------------------------------------------------------------------- */
    public function upload($upload_data, $file_type)
    {
        $data=array(
            'file_name' => $upload_data['file_name'],
            'file_size' => $upload_data['file_size'],
            'file_title' => $upload_data['file_title'],
            'file_description' => $upload_data['file_description'],
        );
        
        //Insert the record into the database.
        $this->db->insert('files_'.$file_type, $data);
    }
    
    /* --------------------------------------------------------------------------------
     * Delete a file.
     * -------------------------------------------------------------------------------- */
    public function delete_file($id)
    {
        $this->db->where('file_id', $id);
        $this->db->delete('customers_files');
    }
    
}
