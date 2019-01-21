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
    
    
}
