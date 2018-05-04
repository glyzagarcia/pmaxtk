<?php
	
	Class Shift_management extends MY_Controller{
	
		public function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');// Load form validation library
			$this->load->library('session');// Load session library
			$this->load->model('ShiftModel');
		}

		public function start_shift() {
				$this->load->helper('string');
				//$this->form_validation->set_rules('IDnumber', 'ID Number', 'trim|required');
				//$this->form_validation->set_rules('hiddenShiftDate', 'Shift Date', 'trim|required');
				//$this->form_validation->set_rules('hiddenStartShiftTime', 'Start Shift Time', 'trim|required');
									            
				//if ($this->form_validation->run() == FALSE) {
				//	echo "error";
				//} else {
					//echo "successfull";
					$timeconvert1 = reduce_multiples($this->input->post('hiddenStartShiftTime'),"T"); 
					$timeconvert1 =  substr($timeconvert1, 0, -5);
					$data1 = array(
						'employee_id' => $this->input->post('IDnumber'),
						'status' => "started"
						//'time_started' => $timeconvert1,
						//$this->input->post('hiddenStartShiftTime')
						);
					// print_r($data1);
					$currentShiftID = $this->ShiftModel->startLog_shift($data1);					
					$sess_userdata = $this->session->userdata('logged_in');
					$sess_userdata['currentShiftID'] = $currentShiftID;
					$this->session->set_userdata('logged_in', $sess_userdata);
					// echo $currentShiftID;
					echo $this->session->userdata['logged_in']['currentShiftID'];
				//}
		}	

		public function end_shift(){
			$this->load->helper('string');
			$timeconvert2 = reduce_multiples($this->input->post('hiddenEndShiftTime'),"T"); 
			$timeconvert2 =  substr($timeconvert2, 0, -5);
			$sess_userdata = $this->session->userdata('logged_in');
			$enddatetime = date("Y-m-d H:m:s");
			
			$data2 = array(
						'shift_id'		=> $sess_userdata['currentShiftID'],
						// 'time_ended' 	=> $enddatetime,
						//'time_ended' 	=> $timeconvert2,
						//'process_time' 	=> $this->input->post('processTime'),
						'status'		=> 'ended'
						);

			$this->ShiftModel->endLog_shift($data2);
			$sess_userdata['currentShiftID'] = null;
			$sess_userdata['currentActivityID'] = null;
			$this->session->set_userdata('logged_in', $sess_userdata);
			//$view = $this->load->view('LoginForm');
			//$this->set_output($data); 



		}
	}

?>