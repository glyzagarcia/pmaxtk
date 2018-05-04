<?php	

	class ActivityModel extends CI_Model {

		public function startLog_activity($data1) {
			//$this->db->trans_start();
			$this->db->insert('activities',$data1);
			//$this->db->trans_complete();

			//if($this->db->trans_status() === FALSE){
			//	return NULL;
			//}else{
				return $this->db->insert_id();
			//}
		}

		public function endLog_activity($data2) {
			//$this->db->trans_start();
			$this->db->set('time_ended', $data2['time_ended']);		
			$this->db->set('process_time', $data2['process_time']);		
			$this->db->set('remarks', $data2['remarks']);		
			$this->db->set('completion', $data2['completion'] );		
			$this->db->where('activity_id', $data2['activity_id']);
			$this->db->update('activities', $data2);
			//$this->db->trans_complete();

			//if($this->db->trans_status() === FALSE){
				//return NULL;
			//}else{
				//$unsetSessionData = $this->session->userdata('logged_in');
				//$unsetSessionData['currentActivityID'] = NULL;
				//unset($unsetSessionData['currentActivityID']);
				//$this->session->set_userdata('logged_in',$unsetSessionData);
			//}

		}
		
		public function logStartActivity($data1) {		
			$returnvalue = null;
			$this->db->insert('activities',$data1);
			if($this->db->insert_id())
				$returnvalue = $this->db->insert_id();
		   
			return $returnvalue;
		}
		
		public function getActivityNameById($id){
			$returnvalue = null;
			$query =  $this->db->query("SELECT activity_name FROM activity_type WHERE activity_tid =".$id );
			if($query->num_rows() > 0 )
				 $returnvalue = $query->row()->activity_name;
			
			return $returnvalue;			
		}
		
		// public function getListOfActiveActByEmpId($empid){
			
			
		// }
		
		public function gettimestarted ($actId){
			$returnvalue = null;
			$query =  $this->db->query("SELECT time_started FROM activities WHERE activity_id =".$actId );
			if($query->num_rows() > 0 )
				 $returnvalue = $query->row()->time_started;
			
			return $returnvalue;		
		}
		
		public function endActivityNowModel($id, $remarks){
			$returnvalue = 0;
			$id_exp = explode("endactivitybutton",$id);
		
			$query =  $this->db->query("UPDATE activities set remarks ='".$remarks."' , status = 'ended' WHERE activity_id =".$id_exp[1]);                			
			 if($this->db->affected_rows() > 0 ){
				 $returnvalue = 1;
				 $this->updateProcessedtime($id_exp[1]);
			 }
			 return $returnvalue;			 
		}
		 
		 public function updateProcessedtime($actId){
			 
			$query =  $this->db->query("SELECT timediff(time_ended,time_started) as totalworked FROM activities WHERE activity_id =".$actId );
			if($query->num_rows() > 0 ){
				 $totalworked = $query->row()->totalworked;
		
				$query2 =  $this->db->query("UPDATE activities set process_time ='".$totalworked."' WHERE activity_id =".$actId);                			
				if($this->db->affected_rows() > 0 )
				 $returnvalue = 1;
			}
		 }
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>