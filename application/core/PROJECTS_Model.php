<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PROJECTS_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	/* --------------------------------------------------------------------------------
	 * Prepare $_POST data to be inserted into a database table.
	 * -------------------------------------------------------------------------------- */
	public function prepare($table){
		$parsed			= array();	//Array of fields that must be parsed to be inserted into the database.
		$prepared		= array();	//Array of fields that are prepared to be inserted into the database.
		
		//Set post data.
		$data=$this->input->post();
		
		if(!empty($data) and is_array($data)){
			//Get a list of database fields from the specified table.
			$db_fields=$this->db->list_fields($table);
			
			//Compare prefixed field names to the database field names, and if the fields are in the database, add them to the prepared array.
			//The end result should leave out anything that was on the screen but isn't in the database so there won't be any SQL errors.
			foreach ($data as $key=>$val){
				$parse=false;
				
				//Automatically parse dates.
				if(strpos($key, 'date_')!==false){
					$temp=str_replace(array('_mo','_day','_yr'),'',$key);
					
					//Automatically format the date value as YYYYMMDD
					if(!array_key_exists($temp, $parsed)){
						$parsed[$temp]=$val;
					}else{
						if(strpos($key,'_yr')!==false){
							//$key is a "year" so prepend the value to the beginning.
							$parsed[$temp]=$val.$parsed[$temp];
						}else{
							//$key is a "month" or "day" so append the value to the end.
							$parsed[$temp].=$val;
						}
					}
					continue;
				}
				
				//Automatically parse times.
				if(strpos($key, 'time_')!==false){
					$temp=str_replace(array('_hr','_mn'),'',$key);
					$parse=true;
				}
				
				//Automatically parse phones.
				if(strpos($key, 'phone_')!==false){
					$temp=str_replace(array('_1','_2','_3'),'',$key);
					$parse=true;
				}
				
				//Automatically parse SSN.
				if(strpos($key, 'ssn_')!==false){
					$temp=str_replace(array('_1','_2','_3'),'',$key);
					$parse=true;
				}
				
				//Automatically parse any field that needs to be combined.
				if($parse){
					if(!array_key_exists($temp, $parsed)){
						$parsed[$temp]=$val;
					}else{
						$parsed[$temp].=$val;
					}
					continue;
				}
				
				if(in_array($key,$db_fields)){
					$prepared[$key] = $val;
				}
			}
			
			//Get fields that need to be parsed and prepare them.
			if(!empty($parsed)){
				foreach($parsed as $key=>$val){
					if(in_array($key,$db_fields)){
						$prepared[$key] = $val;
					}
				}
			}
			
			//Return the prepared array.
			return $prepared;
		}
		return false;
	}
	
	//Could this function be made generic?
	public function save(){
		
	}
	
}