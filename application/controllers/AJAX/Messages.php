<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {
	
	/* --------------------------------------------------------------------------------
	 * Get any messages that have been set.
	 * -------------------------------------------------------------------------------- */
	public function index(){
		//Get messages.
		$messages=$this->session->userdata('projects_messages');
		
		//Clear messages.
		$this->session->unset_userdata('projects_messages');
		
		//Parse messages.
		if(!empty($messages)){
			foreach($messages as $class=>$message_array){
				if(!empty($message_array)){
					echo '<ul class="alert alert-'.$class.'">';
					foreach($message_array as $key=>$message){
						echo "<li>".$message."</li>";
					}
					echo '</ul>';
				}
			}
		}
	}
	
}
