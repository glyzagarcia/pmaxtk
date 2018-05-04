<?php	

	class ShiftModel extends CI_Model {

		public function startLog_shift($data1) {
			$this->db->insert('shifts',$data1);
			return $this->db->insert_id();
		}

		public function endLog_shift($data2){


			$this->db->set('status', $data2['status']);
			//$this->db->set('time_ended', $data2['time_ended']);		
			//$this->db->set('process_time', $data['process_time']);		
			$this->db->where('shift_id', $data2['shift_id']);
			$this->db->update('shifts', $data2);
			if($this->db->affected_rows()){

			$startshift = $this->db->select('time_started')
									->from('shifts')
									->where('shift_id', $data2['shift_id'])
									->get();
			$endShift = $this->db->select('time_ended')
									->from('shifts')
									->where('shift_id', $data2['shift_id'])
									->get();
	
			$startshift2 = $startshift->row()->time_started;
			$endShift2 = $endShift->row()->time_ended;
	
			$processTime1 = strtotime($endShift2) - strtotime($startshift2);
			print_r($processTime1);
			
			$processTime['process_time'] = gmdate('H:i:s', $processTime1);
			print_r($processTime);

			$this->db->set('process_time', $processTime['process_time']);
			$this->db->where('shift_id', $data2['shift_id']);
			$this->db->update('shifts', $processTime);
			}
			else{
				echo "wala mu sulod";
			}
			
		}
		
		public function getStartTime($shiftId) {			
			$query = $this->db->query("SELECT time_started FROM shifts WHERE shift_id =".$shiftId);
			if($query->num_rows() > 0){
				return $query->row()->time_started;
			}
		}
	}
?>