<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
	
	public $action;
	
	public function __construct(){
		parent::__construct();
		
		//Determine the action of a form submission.
		$this->action=strtolower($this->input->post('action'));
		
		$this->load->model('Employee_model');
	}
	
	/* --------------------------------------------------------------------------------
	 * A users index page does not exist so redirect to the home page.
	 * NOTE: This will force the user to login if they are not already logged in.
	 * -------------------------------------------------------------------------------- */
	public function index(){
		redirect($this->config->item('home'));
	}
	
	/* --------------------------------------------------------------------------------
	 * Verify if a user is already logged in by whether their USER ID is set.
	 * -------------------------------------------------------------------------------- */
	public function logged_in(){
		if(trim($this->session->userdata('employee_id'))!=''){
			return true;
		}
		return false;
	}
	
	/* --------------------------------------------------------------------------------
	 * Load the user login page.
	 * NOTE: If a user is already logged in, redirect to the home page.
	 * -------------------------------------------------------------------------------- */
	public function login(){
		//If an administrator does not exist, allow the user to create one.
		if($this->Employee_model->admin_exists()==0){
			
		}
		
		//Verify if user is already logged in, and if so, redirect to the home page.
		if($this->logged_in()){
			redirect($this->config->item('home'));
		}
		
		//If user has valid login cookies, automatically log them in, otherwise load login page.
		if(!$this->validate_cookies()){
			$this->load->view('login');
		}
	}
	
	public function validate_cookies(){
		//Get stored cookies.
		$ck_employee_id=$this->input->cookie('ck_employee_id',true);
		$ck_employee_username=$this->input->cookie('ck_employee_username',true);
		$ck_employee_password=$this->input->cookie('ck_employee_password',true);
		
		//Make sure the cookies have data in them.
		if(trim($ck_employee_id)!="" and trim($ck_employee_username)!="" and trim($ck_employee_password)!=""){
			$user=$this->Employee_model->get_login($ck_employee_username);
			
			//If the cookie matches the user information in the database, go ahead and redirect to the home page.
			if($user['employee_id']==$ck_employee_id and $user['employee_username']==$ck_employee_username and $user['employee_password']==$ck_employee_password){
				//Retain user sessions.
				$this->set_sessions($user);
				
				//Redirect to the home page.
				redirect('/');
			}
		}
		return false;
	}
	
	/* --------------------------------------------------------------------------------
	 * Allow user to change their settings.
	 * -------------------------------------------------------------------------------- */
	public function settings(){
		//If user is not logged in, redirect to login page.
		if(!$this->logged_in()){
			redirect('employee/login');
		}
		$data['page']='employee/settings';
		
		$this->load->view('template', $data);
	}
	
	/* --------------------------------------------------------------------------------
	 * Authenticate a user upon login attempt.
	 * -------------------------------------------------------------------------------- */
	public function authenticate(){
		if(!empty($user=$this->Employee_model->get_login($this->input->post('employee_username')))){
			if(password_verify($this->input->post('employee_password'), $user['employee_password'])){
				//This user exists and their passwords match so set their session so they can login.
				$this->set_sessions($user);
				
				//If user selects 'remember me' save out a cookie.
				if($this->input->post('remember')=="CHECKED"){
					$this->remember($user);
				}
			}
		}
		
		//If user is logged in, redirect to the home page.
		if($this->logged_in()){
			redirect($this->config->item('home'));
		}
		
		//If user is not logged in, display an error and reload the login page.
		$this->set_message('Invalid username/password.');
		redirect('employee/login');
	}
	
	/* --------------------------------------------------------------------------------
	 * When a user clicks "Remember Me", store out a cookie for them to log them in automatically.
	 * -------------------------------------------------------------------------------- */
	public function remember($user){
		//Expire 10 days from now.
		$expiration=time()+60*60*24*10;
		
		//Set a cookie for user_id, username, and password.
		$ck_employee_id=array(
			'name'=>'ck_employee_id',
			'value'=>$user['employee_id'],
			'expire'=>$expiration
		);
		
		$ck_employee_username=array(
			'name'=>'ck_employee_username',
			'value'=>$user['employee_username'],
			'expire'=>$expiration
		);
		
		$ck_employee_password=array(
			'name'=>'ck_employee_password',
			'value'=>$user['employee_password'],
			'expire'=>$expiration
		);
		
		$this->input->set_cookie($ck_employee_id);
		$this->input->set_cookie($ck_employee_username);
		$this->input->set_cookie($ck_employee_password);
	}
	
	/* --------------------------------------------------------------------------------
	 * When a user signs in or updates their information, set/reset user session.
	 * -------------------------------------------------------------------------------- */
	public function set_sessions($user){
		//Set new sessions based on the user information provided.
		if(!empty($user)){
			$employee_departments=array();
			$departments=$this->Employee_model->get_departments($user['employee_id']);
			if(!empty($departments)){
				foreach($departments as $row){
					$employee_departments[$row['department_id']]=$row['department_name'];
				}	
			}
			
			$session=array(
				'employee_id'			=> $user['employee_id'],
				'employee_username'		=> $user['employee_username'],
				'employee_email'		=> $user['employee_email'],
				'employee_name'			=> $user['employee_name'],
				'employee_admin'		=> $user['employee_admin'],
				'employee_departments'	=> $employee_departments,
			);
			
			$this->session->set_userdata($session);
		}
	}
	
	/* --------------------------------------------------------------------------------
	 * Set a message to be displayed on the screen.
	 * -------------------------------------------------------------------------------- */
	public function set_message($message, $class='danger'){
		$this->message[$class][]=$message;
		
		$this->session->set_userdata('projects_messages', $this->message);
	}
	
	/* --------------------------------------------------------------------------------
	 * Destroy user cookies/session and redirect to the login page.
	 * -------------------------------------------------------------------------------- */
	public function logout(){
		//Set user's cookies to cookies to expire.
		$expire=time()-2600000;
		$this->input->set_cookie('ck_employee_id','',$expire);
		$this->input->set_cookie('ck_employee_username','',$expire);
		$this->input->set_cookie('ck_employee_password','',$expire);
		
		//Destroy the user's current session.
		$this->session->sess_destroy();
		
		//Redirect to the login screen.
		redirect('employee/login');
	}
	
}
