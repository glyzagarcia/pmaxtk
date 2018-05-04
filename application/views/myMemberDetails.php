	       
	<div class="nav-tabs-custom" >	
		<div class="tab-content no-padding">
		<?php if(!empty($myDetails)):?>
			<button id="viewdetails<?php echo $myDetails->Head_Person;?>" name="<?php echo $myDetails->last_name.", ".$myDetails->first_name;?>" onclick="viewdetailsfunction(this)">Back</button>
			<table id="myDetails" class="dataTables table-striped table-bordered" >
				<thead>
				  <tr>
					<th width=100px>&nbsp;ID number</th>								
					<th width=300px>&nbsp;Last Name</th>
					<th width=300px>&nbsp;First Name</th>
					<th width=300px>&nbsp;Position</th>
					<th width=300px>&nbsp;Immediate Supervisor</th>
				  </tr>
				</thead>
				
				<tbody>
				
					<tr>
						<td> <?php echo $myDetails->employee_id;?></td>									
						<td> <?php echo $myDetails->last_name;?></td>
						<td> <?php echo $myDetails->first_name;?></td>
						<td> <?php echo $myDetails->position;?></td>
						<td> 
							<?php 
								$this->load->model('UserModel');
								$mysup = $this->UserModel->getMyDetails($myDetails->Head_Person);			
								echo $mysup->last_name.", ".$mysup->first_name;
							
							?>
						</td>					
					</tr>								
				</tbody>			
			</table>		
		<?php endif;?>
		</div>	
	</div>	
		

		<?php if(!empty($submemeber)):?>
		<div class="nav-tabs-custom" >	
			<div class="tab-content no-padding">			
				<div class="box-body">		
					<h1>Subordinates</h1>
					<table id="myMemberDetails_table" class="dataTables table-striped table-bordered" >
						<thead>
						  <tr>
							<th width=100px>&nbsp;ID number</th>								
							<th width=300px>&nbsp;Last Name</th>
							<th width=300px>&nbsp;First Name</th>
							<th width=300px>&nbsp;Log Status</th>
							<th width=300px>&nbsp;</th>
						  </tr>
						</thead>
					
						<tbody>
						<?php foreach($submemeber as $data) :?>
							<tr>
								<td> <?php echo $data->employee_id;?></td>									
								<td> <?php echo $data->last_name;?></td>
								<td> <?php echo $data->first_name;?></td>
								<td> <?php echo $data->status;?></td>
								<td> 
									<button id="resetpas<?php echo $data->employee_id;?>" name="<?php echo $data->last_name.", ".$data->first_name;?>"  onclick="resspassfunction(this)">Reset Password</button>
									<button id="viewdetails<?php echo $data->employee_id;?>" name="<?php echo $data->last_name.", ".$data->first_name;?>" onclick="viewdetailsfunction(this)">View Details</button>
								</td>
							</tr>	
							
						<?php endforeach;?>										 
						</tbody>
					
					</table>				
				</div>
			</div>
		</div>
		<?php endif;?>		
		
		<?php if(!empty($myLoginsDetails)):?>		
		<div class="nav-tabs-custom" >	
			<div class="tab-content no-padding">					
				<div class="box-body">				
				<?php if(!empty($myDetails)):?>				
					<h1>Clock Ins [ <?php echo $myDetails->last_name.", ".$myDetails->first_name;?>  ]</h1>
				<?php endif;?>
				<table id="tablemyloginsDetails" class="dataTables table-striped table-bordered" >
					<thead>
					  <tr >
						<!--<th width=100px>&nbsp;Shift Id</th>-->
						<th width=200px>&nbsp;Date Started</th>
						<th width=200px>&nbsp;Time Started</th>
						<th width=200px>&nbsp;Date Ended</th>
						<th width=200px>&nbsp;Time Ended</th>								
						<th width=300px>&nbsp;No. of Hours Worked</th>
						<th width=300px>&nbsp;Shift Status</th>
					  </tr>
					</thead>
					
					<tbody>
					<?php foreach($myLoginsDetails as $data) :?>
						<tr>
							<!--<td> <?php echo $data->shift_id;?></td>	-->								
							<td> <?php echo date("d M Y",strtotime($data->time_started));?></td>
							<td> <?php echo date("H:i:s",strtotime($data->time_started));?></td>
							<td> <?php if($data->time_ended != "0000-00-00 00:00:00") { if(date("d M Y",strtotime($data->time_started)) != date("d M Y",strtotime($data->time_ended))) echo date("d M Y",strtotime($data->time_ended)); } else echo "Shift On Progress";?></td>
							<td> <?php if($data->time_ended != "0000-00-00 00:00:00") echo date("H:i:s",strtotime($data->time_ended)); else echo "Shift On Progress";?></td>													
							<td> <?php if($data->time_ended != "0000-00-00 00:00:00") {
											$dteStart = new DateTime($data->time_started); 
											$dteEnd   = new DateTime($data->time_ended); 
											$dteDiff  = $dteStart->diff($dteEnd); 
											echo $dteDiff->format("%H:%I:%S"); 																			

										}	else echo "Shift On Progress";?>  </td>
							<td> <?php if(!empty($data->status) ) echo "Shift ".$data->status; else "";?></td>
							
						</tr>							
					<?php endforeach;?>							  
					</tbody>					
				</table>					
				</div><!-- /.box-body -->
			</div>
		  </div>
			<?php endif;?>
			
		<script type="text/javascript">
		  $(function () {

			var myMemberDetailsAA = $('#myMemberDetails_table').dataTable({          
			  "pageLength": 10
			});
			
			var tablemyloginsDetailsAA = $('#tablemyloginsDetails').dataTable({          
			  "pageLength": 10
			});
			
			
		  });
		  
		</script>