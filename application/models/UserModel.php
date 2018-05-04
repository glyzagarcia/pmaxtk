<?php	

	class UserModel extends CI_Model {

		public function login($data) {

			//$this->db->select('*');
			//$this->db->from('pmaxglobal_users');
			//$this->db->where('employee_id', $data['IDnumber']);
			//$this->db->where('password', $data['Password']);
			//$this->db->limit(1);
			//$query = $this->db->get();

			//if ($query->num_rows() == 1) {
			//	return $query->result();
			//}
			//else{
			//	return false;
			//}

        	$query = $this->db->select("*")
					          ->from("pmaxglobal_users")
					          ->where("employee_id", $data['IDnumber'])
                              ->where("password", $data['Password'])
							  ->where("pmaxglobal_users.status", "active")
					          ->get();

        	if ($query->num_rows() != 1){
        		return false;
        	  // throw new UnexpectedValueException("Wrong user!");
        	}else{
                return $query->result();
        		//$row = $query->row();
        		//$result = password_verify($data['Password'], $row->password);
                //if($result == true){
                //    return $query->result();
                //}else{
                //    return false;
                //}
            }  //throw new UnexpectedValueException("Invalid password!");
		}

    public function nameGet($data){
        $query = $this->db->select('*')
                          ->from("pmaxglobal_users")
                          ->where("employee_id", $data)
                          ->get();
        if ($query->num_rows() != 1){
                return false;
              // throw new UnexpectedValueException("Wrong user!");
        }else{
                return $query->result();
        }  
    }

	public function register_NewUser($data){

		$this->db->insert('pmaxglobal_users',$data);

	}

	public function get_autocomplete_results($search_term) { 
    $this->db->SELECT('*');
    $this->db->from('pmaxglobal_users'); 
    $this->db->like('employee_id',$search_term); 
    $this->db->or_like('first_name',$search_term); 
    $this->db->or_like('last_name',$search_term);
    $query = $this->db->get(); 
    return $query->result_array(); 
    }

    function booktable($search){

        $query = $this
                ->db
                ->select('*')
                ->from('pmaxglobal_users')
                ->like('employee_id',$search)
                ->or_like('first_name', $search)
                ->or_like('last_name',$search)
                ->get();
     
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
		
    }

    public function getDetails($data){

        $query = $this->db->select('*')
                           ->from('pmaxglobal_users')
                           ->where('employee_id', $data)
						   ->where("pmaxglobal_users.status", "active")
                           ->get();
        
        if($query->num_rows() == 1)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
    }

    public function updateUserDetails($data)
        {
            $this->db->where('employee_id', $data['employee_id'])
                     ->update('pmaxglobal_users', $data);
        }

    public function memberTable($search)
        {

        $query =  $this->db->query("SELECT * FROM `pmaxglobal_users` left join shifts using (employee_id) left join activities using (shift_id) where pmaxglobal_users.status = 'active' AND  Head_Person ="+$search+" and shifts.status = 'signed in' and activities.status = 'started'");
            //->db
            //->select('*')
            //->from('pmaxglobal_users')
            //->where('Head_Person', $search)
            //->get();
     
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }

        }

    public function passwordChange($data){
        $ID = $data['IDnumber'];
        $newPass = $data['newPassword'];
        $newData = array('password' => $newPass);
        $this->db->set('password', $newPass);
        $this->db->where('employee_id', $ID);
        $this->db->update('pmaxglobal_users');
    }

    public function checkShift($data){
        $query = $this->db->select('shift_id')
                          ->from('shifts')
                          ->where('employee_id', $data)
                          ->where('status', 'started')
                          ->or_where('status', 'locked')
                          ->get();
		// echo "checkShift";
       	// print_r( $query);
        if($query->num_rows() > 0 ){
            return $query->result();
        }

    }
	
	
	 public function getOldPassword($emp_id){
        $query = $this->db->select('password')
                          ->from('pmaxglobal_users')
                          ->where('employee_id', $emp_id) 
					      ->where("pmaxglobal_users.status", "active")						  
                          ->get();

        if($query->num_rows() == 1 ){
            return $query->row()->password;
        }
		else
			return null;

    }
	
	public function getListofTeamMember($leaderId){		
		$id = ltrim($leaderId, "0");		
        $query = $this->db->select('employee_id')
                          ->from('pmaxglobal_users')
                          ->where('Head_Person='.$id)
						  ->where("pmaxglobal_users.status", "active")                          
                          ->get();
		
		
        if($query->num_rows()  >0 ){
			$ids = "";
            foreach($query->result() as $empID){
					$ids .= $empID->employee_id.",";				
			}
			$clean_id = rtrim($ids,",");
			$listofId = "(".$clean_id.")";			
			return $listofId;
        }
		else{		
			return null;
		} 
    }
	
	public function getLoginDetailsForTeamMemeber($listofIDs,$status){			
		date_default_timezone_set('Asia/Manila');
		$date2 = date("Y-m-d");		        
		$date1 = date("Y-m-d",strtotime("-1 day"));
		$query =  $this->db->query("SELECT shifts.`status` as logStatus, shifts.*, pmaxglobal_users.*  FROM `shifts`  LEFT JOIN `pmaxglobal_users` USING(employee_id) WHERE  pmaxglobal_users.status = 'active'  AND employee_id IN".$listofIDs." AND time_started BETWEEN '".$date1." 00:00:01' AND '".$date2." 23:59:59'  AND shifts.`status` = '".$status."'" );
		if($query->num_rows() > 0 ){			
			 return $query->result();
        }
		else{		
			return null;
		} 
    }
	
	
	public function getAbsentForTeamMemeber($leaderId){			
		date_default_timezone_set('Asia/Manila');
		
		$id = ltrim($leaderId, "0");		
		$returnValue = null;
        $query = $this->db->select('employee_id')
                          ->from('pmaxglobal_users')
                          ->where('Head_Person='.$id)                          
						  ->where("pmaxglobal_users.status", "active")
                          ->get();
		
		
        if($query->num_rows()  >0 ){
			$ids = "";
            foreach($query->result() as $empID){				
				$started = $this->checkIfLoggedIn($empID->employee_id);				
				if(empty($started)){
					$ids .= $empID->employee_id.",";
				}					
			}			
			$clean_id = rtrim($ids,",");
			$listofId = "(".$clean_id.")";						
        }
		
		if($listofId != "()"){					
			$query =  $this->db->query("SELECT * FROM `pmaxglobal_users` WHERE  pmaxglobal_users.status = 'active' AND employee_id IN ".$listofId);
			if($query->num_rows() > 0 ){			
				 $returnValue = $query->result();
			}			
		}
		
		return $returnValue;
    }
	
	
	public function checkIfLoggedIn($empID){	
		date_default_timezone_set('Asia/Manila');
		$date2 = date("Y-m-d");		        
		$date1 = date("Y-m-d",strtotime("-1 day"));
		$query =  $this->db->query("SELECT shift_id FROM shifts WHERE employee_id = ".$empID."	 AND time_started BETWEEN '".$date1." 00:00:01' AND '".$date2." 23:59:59' AND `status` = 'started' " );
		if($query->num_rows() > 0 ){
			 return $query->row()->shift_id;
        }
		else{		
			return null;
		} 

	
	}
	
	
	public function getEmpLogins($empID){
		$returnValue = null;
		$query =  $this->db->query("SELECT * , timediff(time_ended,time_started) as totalworkedhr FROM shifts WHERE employee_id = ".$empID."  AND  time_started > '2018-02-12' order by shift_id desc " );
		if($query->num_rows() > 0 ){			
			 $returnValue =  $query->result() ;
        }
		
		return $returnValue;		
	}
	
	public function getListofActivityType($empID){
	    $returnValue = null;			
		$query =  $this->db->query("SELECT * FROM activity_type WHERE team_id=99 AND a_type_status = 1 ORDER BY a_type_name ASC");                			
        if($query->num_rows() > 0 ){
			$returnValue =  $query->result();
        }
		
		return $returnValue;
    }
	
	
	
	public function getListofTeamMemberDetailsWithShifts($leaderId){
	    $returnValue = null;
		// $date = date("Y-m-d");	
		// $date2 = date("Y-m-d",strtotime("+1 day"));
		$id = ltrim($leaderId, "0");		
		// $query =  $this->db->query("SELECT * FROM pmaxglobal_users LEFT JOIN shifts USING (employee_id) WHERE Head_Person=".$id." AND time_started BETWEEN '".$date." 00:00:01' AND '".$date2." 23:59:59' ");                			
		$query =  $this->db->query("SELECT * FROM pmaxglobal_users WHERE Head_Person=".$id);                			
        				
        if($query->num_rows() > 0 ){
			$returnValue =  $query->result();
        }
		
		return $returnValue;
    }
	
	
	public function updatePasswordBySup($empID){
		// $nozeroId = str_replace("0","",$empID);
		$query =  $this->db->query("SELECT first_name,last_name FROM pmaxglobal_users WHERE employee_id=".$empID);
		
		if($query->num_rows() > 0 ){
			 $id =  str_pad($empID, 4, "0", STR_PAD_LEFT); 
			 // echo "glaiza".$id;
			$pass = substr($query->row()->first_name, 0,3)."".substr($query->row()->last_name,0, 3)."".$id;			
			$password = strtolower($pass);
		
			$query2 =  $this->db->query("UPDATE pmaxglobal_users set password ='".$password."' WHERE employee_id =".$empID);                			
			 if($this->db->affected_rows() > 0 ){
				 return $password;
			 }
			 else
				 return 0;

        }
		else
			return 0;
		
		
    }
	
	public function getStartTime($shiftId) {			
			$query = $this->db->query("SELECT time_started FROM shifts WHERE shift_id =".$shiftId);
			if($query->num_rows() > 0){
				return $query->row()->time_started;
			}
		}
	
	
	public function getlistOfActivityTypeMisc(){
		$returnValue = null;
		$id = $this->session->userdata['logged_in']['employee_id'];
		
		// $query =  $this->db->query("SELECT * FROM activity_type INNER JOIN activities USING (activity_tid)  WHERE dept_id = 1 AND employee_id = ".$id." AND status <> 'started' ORDER BY activity_name asc");                			        					
		$query =  $this->db->query("select * from activity_type where activity_tid NOT IN ( SELECT activity_tid FROM activities WHERE employee_id = ".$id." AND status = 'started' )  AND activity_status = 1 ORDER BY activity_name asc");                			        					
        if($query->num_rows() > 0 ){
			$returnValue =  $query->result();
        }		
		return $returnValue;
		
	}
	
	
	public function getAllActiveAct(){
		$returnValue = null;
		$id = $this->session->userdata['logged_in']['employee_id'];
			
		$query =  $this->db->query("SELECT * FROM activities INNER JOIN activity_type USING (activity_tid) WHERE employee_id = ".$id." AND status = 'started' ");                			        					
        if($query->num_rows() > 0 ){
			$returnValue =   $query->result();
        }		
		return $returnValue;
		
	}
	
	public function getAllPreviousAct(){
		$returnValue = null;
		$id = $this->session->userdata['logged_in']['employee_id'];
			
		$query =  $this->db->query("SELECT * FROM activities INNER JOIN activity_type USING (activity_tid) WHERE employee_id = ".$id." AND status = 'ended' ");                			        					
        if($query->num_rows() > 0 ){
			$returnValue =   $query->result();
        }		
		return $returnValue;
		
	}
	
	
	
	

	}
?>