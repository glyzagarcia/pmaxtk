
<?php
	Class Activity_management extends MY_Controller{
	
		public function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->helper('string');
			$this->load->library('form_validation');// Load form validation library
			$this->load->library('session');// Load session library
			$this->load->model('ActivityModel');
			$this->load->model('UserModel');
		}

		public function start_activity() {
			$sess_userdata = $this->session->userdata('logged_in');//all_userdata();
			$timeconvert = reduce_multiples($this->input->post('timeStarted'),"T"); 
			$timeconvert =  substr($timeconvert, 0, -5);
			//$activity_id = $this->GUIDv4();
			print_r($sess_userdata);
			$data = array(
					//'activity_id' => $activity_id,
					'shift_id' => $this->session->userdata['logged_in']['currentShiftID'],
					'activity_done' => $this->input->post('activityDone'),
					'time_started' => $timeconvert//, 
					//'remarks'	=> $this->input->post('remarks')
					);

			//if(isset($sess_userdata['currentActivityID'])){
			//	unset($sess_userdata['currentActivityID']);
			//}
				$currentActivityID= $this->ActivityModel->startLog_activity($data);
				//$sessionUpdate = array('currentActivityID' => $currentActivityID, 'logged_in' => TRUE);
				$sess_userdata['currentActivityID'] = $currentActivityID;
				$this->session->set_userdata('logged_in', $sess_userdata);
							
							
		}

		public function end_activity() {
			$sess_userdata = $this->session->all_userdata();
			$timeconvert = reduce_multiples( $this->input->post('timeEnded'),"T"); 
			$timeconvert =  substr($timeconvert, 0, -5);
			//$currentActivityID = $sess_userdata['currentActivityID'];
			print_r ($sess_userdata);
			$data = array(
					'activity_id' => $sess_userdata['logged_in']['currentActivityID'],
					//'shift_id' => $sess_userdata['currentShiftID'],
					'time_ended' => $timeconvert,
					'process_time' => $this->input->post('timePassed'),
					'remarks' => $this->input->post('remarks'),
					'completion' => $this->input->post('completion') 
					);

			$this->ActivityModel->endLog_activity($data);
			//$this->session->set_userdata('logged_in', $sess_userdata);

		}

		public function loadMembers(){

			if(is_null($this->input->get('id')))
	        {
	        	$this->load->view('MainView');    
			}
	        else
	        {
	        	//$this->load->model('Bookmodel'); 
	        
	        	$data['memberTable']=$this->UserModel->memberTable($this->input->get('id')); 
	        
	        	$this->load->view('output2',$data);
	        
       		}

		}
		
		public function startActivity(){
			 
			$act_id =  $this->input->post('activity');
			// $remarks =  $this->input->post('textAreaName');
			$activityname = $this->ActivityModel->getActivityNameById($act_id);
			
			$practice = "Misc";			
			$data = array(				
			'employee_id' => $this->session->userdata['logged_in']['employee_id'],
			'activity_tid' => $act_id,			
			'remarks'	=> "",
			'status'	=> 1,
			'practice'	=> $practice			
			);
								
			$currentActivityID= $this->ActivityModel->logStartActivity($data);
			$timestarted = $this->ActivityModel->gettimestarted($currentActivityID);
			$data2 = array(				
			'employee_id' => $this->session->userdata['logged_in']['employee_id'],
			'activity_tid' => $act_id,			
			'remarks'	=> "",
			'status'	=> 1,
			'practice'	=> $practice,
			'activityName' => $activityname,
			'timestarted' => $timestarted
			);
		
			if($currentActivityID)
				echo json_encode($data2);							
		}
		
		 public function endActivityNow(){
			 $id = $this->input->post('id');
			 $remarks = $this->input->post('remarks');			 
			 $affected= $this->ActivityModel->endActivityNowModel($id,$remarks);
			 echo $affected;
			 
		 }
		
		

	}
?>