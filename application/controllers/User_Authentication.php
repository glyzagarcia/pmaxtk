<?php
	Class User_Authentication extends MY_Controller{
	
		public function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');// Load form validation library
			$this->load->library('session');// Load session library
			$this->load->model('UserModel');
			$this->load->helper('string');
			$this->load->helper('url');
		}

		public function sign_in() {
				
			$this->form_validation->set_rules('IDnumber', 'ID Number', 'trim|required|numeric|exact_length[4]');
			$this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[3]|max_length[100]');
		    
			if ($this->form_validation->run() == FALSE) {
				//$this->load->view('MainVIEW');
				echo "<script>alert('');</script>";
				$this->load->view('Login');
				//$errors = "<p><h2>Invalid Input/s</h2></p> <br>";
				//$this->load->view('PromptModal',$errors);
			} else {
				$IDnumber = $this->security->xss_clean($this->input->post('IDnumber'));
				$Password = $this->input->post('Password');//$this->security->xss_clean($this->input->post('Password'));
				$data = array(
						'password' => $this->input->post('Password'),
						'IDnumber' => $this->input->post('IDnumber')
						);
				$loginData = array(
				'IDnumber' => $IDnumber,
				'Password' => $Password
				);

				//print_r($this->input->post('Password'));

				$result1 = $this->UserModel->login($loginData);
				$nameGot = $this->UserModel->nameGet($IDnumber);
				$shiftState = $this->UserModel->checkShift($IDnumber);
				// print_r($shiftState);
				if($nameGot != false){
					$FNcut = substr($nameGot[0]->first_name,0,3);
					$SNcut = substr($nameGot[0]->last_name,0,3);
					$fullpass = $FNcut.$SNcut.$nameGot[0]->employee_id;
				}
				
				if($Password == strtolower($fullpass) && $result1 != false ){
					$this->load->view('PasswordChangeForm', $data);
				}
				else if($result1 != false && $Password != $fullpass){
					$session_data = array(
						'employee_id' 		=> $result1[0]->employee_id,
						'first_name' 		=> $result1[0]->first_name,
						'last_name' 		=> $result1[0]->last_name,
						'middle_initial' 	=> $result1[0]->middle_initial,
						'line_of_business' 	=> $result1[0]->line_of_business,
						'user_level'		=> $result1[0]->user_level,
						'position'			=> $result1[0]->position,
						'currentShiftID'	=> null,
						'currentActivityID'	=> null
						); 
						// Add user data in session
						// print_r($session_data);
					$this->session->set_userdata('logged_in', $session_data);
					if($shiftState != null){
						// $sess_userdata = $this->session->userdata['logged_in'];
						$session_data['currentShiftID'] = $shiftState[0]->shift_id;						
						$this->session->set_userdata('logged_in', $session_data);
					}
					
					
					$empDetails = $this->UserModel->getListofTeamMember($IDnumber); 
					if(!empty($empDetails)){
					$getLoginDetailsForTeamMemeberStarted = $this->UserModel->getLoginDetailsForTeamMemeber($empDetails,"started"); 					
					$getLoginDetailsForTeamMemeberEnded = $this->UserModel->getLoginDetailsForTeamMemeber($empDetails,"ended"); 
					$getLoginDetailsForTeamMemeberAbsent = $this->UserModel->getAbsentForTeamMemeber($IDnumber); 
					$empDetailsListWithShifts = $this->UserModel->getListofTeamMemberDetailsWithShifts($IDnumber); 
			
																				
					$data = array(
						'logged_in' => $getLoginDetailsForTeamMemeberStarted,						
						'logged_out' => $getLoginDetailsForTeamMemeberEnded,
						'absent' => $getLoginDetailsForTeamMemeberAbsent,
						'mymembers' => $empDetailsListWithShifts							
						);
					}
						
					$getEmpLogins = $this->UserModel->getEmpLogins($IDnumber); 
					if(!empty($getEmpLogins)){						
						$data['mylogins'] = $getEmpLogins;			
													
					}
					
					$listOfActivityTypeMisc = $this->UserModel->getlistOfActivityTypeMisc(); 
					$AllActiveAct = $this->UserModel->getAllActiveAct(); 
					$AllPreviousAct = $this->UserModel->getAllPreviousAct(); 
					$data['listOfActivityType'] = $listOfActivityTypeMisc;	
					$data['AllActiveAct'] = $AllActiveAct;	
					$data['AllPreviousAct'] = $AllPreviousAct;		
					$this->load->view('MainVIEW',$data);
				}else{
						//$this->load->view('PromptModal');
						echo "<script>alert('Username/Password invalid');</script>";
						$this->load->view('Login');
						//$this->load->view('MainView');
				}
			}
		}	

		public function sign_out() {
			session_destroy();
			$this->load->view('Login');
		}
		
		public function resetPasswordBySup() {				
				$id = explode("resetpas",$this->input->post('passname'));		
				$password = $this->UserModel->updatePasswordBySup($id[1]);
				echo $password;
		
		}
	}

?>