<?php
	Class User_management extends MY_Controller{
	
		public function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');// Load form validation library
			$this->load->library('session');// Load session library
			$this->load->model('UserModel');
		}

		public function register_User() {
				
			//$this->form_validation->set_rules('', '', 'trim|required');
			            
			//if ($this->form_validation->run() == FALSE) {
			//}else{
			//}

			$hashedPassword = password_hash($this->input->post('password'), PASSWORD_DEFAULT);//, ['cost' => 8]);
			$data = array(
						'employee_id'		=> $this->input->post('employee_id'),
						'first_name' 		=> $this->input->post('first_name'),
						'middle_initial' 	=> $this->input->post('middle_initial'),
						'last_name'			=> $this->input->post('last_name'),
						'line_of_business'	=> $this->input->post('line_of_business'),
						'password'     		=> $this->input->post('password'),//$hashedPassword,
						'user_level'		=> $this->input->post('user_level'),
						'Head_Person'		=> $this->input->post('Head_Person')
					);

			$this->UserModel->register_NewUser($data);
							
		}

		public function ajax_autocomplete(){
        	$searchText = $_GET['term'];
        	$availableResults = $this->UserModel->get_autocomplete_results($searchText);

	        if(!empty($availableResults)){            
	            foreach ($availableResults as $key => $value) {                
	                $searchData[] = $value['employee_id'];
	            }        
	        }else{
	            $searchData[] = '';
	        }

	        echo json_encode($searchData); 
	     }

	    public function ajaxsearch(){
	     	//print_r($this->input->get('id'));
	     	if(is_null($this->input->get('id')))
	        {
	        	$this->load->view('MainView');    
			}
	        else
	        {
	        	//$this->load->model('Bookmodel'); 
	        
	        	$data['booktable']=$this->UserModel->booktable($this->input->get('id')); 
	        
	        	$this->load->view('output',$data);
	        
       		}
	    }

	    public function getUserDetails($data){

	    	$data = $this->UserModel->getDetails($data);
	    	$jsonData[0] = $data[0]->employee_id;
	    	$jsonData[1] = $data[0]->user_level;
	    	$jsonData[2] = $data[0]->first_name;
	    	$jsonData[3] = $data[0]->middle_initial;
	    	$jsonData[4] = $data[0]->last_name;
	    	$jsonData[5] = $data[0]->line_of_business;
	    	$jsonData[6] = $data[0]->Head_Person;
	    	echo json_encode($jsonData);
    		header("Content-type:application/json");
	    	//print_r($data);
	    	//$data['UserDetails'] = $data;
	    	//$this->load->view('UserDetailEditOutput',$data);

	    }

	    public function updateUserDetails() {
				
			$data = array(
						'employee_id'		=> $this->input->post('employee_id'),
						'first_name' 		=> $this->input->post('first_name'),
						'middle_initial' 	=> $this->input->post('middle_initial'),
						'last_name'			=> $this->input->post('last_name'),
						'line_of_business'	=> $this->input->post('line_of_business'),
						'user_level'		=> $this->input->post('user_level'),
						'Head_Person'		=> $this->input->post('Head_Person')
					);

			$this->UserModel->updateUserDetails($data);
							
		}

		public function ChangePassword(){

			$data = array(
					'Password' => $this->input->post('hiddenPassword'),
					'newPassword' => $this->input->post('NewPassword'),
					'confirmPassword' => $this->input->post('ConfirmPassword'),
					'IDnumber' => $this->input->post('thisIDnumber')
					);

			$data1 = array(
					'IDnumber' => $this->input->post('thisIDnumber'),
					'Password' => $this->input->post('NewPassword')
					);
					
			$oldDetails = array(
					'password' => $this->input->post('hiddenPassword'),					
					'IDnumber' => $this->input->post('thisIDnumber')
					);
					
			$oldPassword = $this->UserModel->getOldPassword($data['IDnumber']);
			
			if(!empty($oldPassword) && $oldPassword != $data['Password']){
				
				echo "<script>alert('Wrong Current Password. Please try again.');</script>";
						$this->load->view('PasswordChangeForm', $oldDetails);
			}
			else if ($data['newPassword'] != $data['confirmPassword']) {				
				echo "<script>alert('New Password do not match.');</script>";
						$this->load->view('PasswordChangeForm', $oldDetails);				
			}
			else if ($data['newPassword'] == "" || $data['Password'] == "" || $data['confirmPassword'] == "" ) {				
				echo "<script>alert('All fields are required.');</script>";
						$this->load->view('PasswordChangeForm', $oldDetails);				
			}
			else{		
				$this->UserModel->passwordChange($data);
				$result1 = $this->UserModel->login($data1);
				$session_data = array(
							'employee_id' 		=> $result1[0]->employee_id,
							'first_name' 		=> $result1[0]->first_name,
							'last_name' 		=> $result1[0]->last_name,
							'middle_initial' 	=> $result1[0]->middle_initial,
							'line_of_business' 	=> $result1[0]->line_of_business,
							'user_level'		=> $result1[0]->user_level,
							'position'			=> $result1[0]->position,
							'currentShiftID'	=> 'NULL',
							'currentActivityID'	=> 'NULL'
							); 
							// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);
				$this->load->view('MainVIEW');
			}
		}

	}	
	

?>
