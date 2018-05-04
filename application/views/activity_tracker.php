<!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.8.2.js"></script>  
<script src="//code.jquery.com/ui/1.8.24/jquery-ui.js"></script>
  
		<section class="content-header"> <h1>My Activities</h1></section>  		
		<div class="nav-tabs-custom">
              <ul class="nav nav-tabs no-border">             
				  <li  class="active pull-left header"><a href="#activitytrackertableID" class="no-border" data-toggle="tab">Active Activity <span class="badge badge-Success"><?php  if($AllActiveAct) echo sizeof($AllActiveAct) ;?></span> </a></li>		
				  <li  class="pull-left header"><a href="#listOfActivitiesID" class="no-border" data-toggle="tab">Previous Activities</a></li>                  
              </ul>
            <div class="tab-content no-padding">
                         			 
			  <div class="chart tab-pane active" id="activitytrackertableID">			  
			  <div class="box-body">
					<div >					  
						<table id="activitytrackertable" class="dataTables table-striped table-bordered" >
							<thead>
							  <tr>
								<th width=100px>&nbsp;Activity Name</th>								
								<th width=300px>&nbsp;Time Started</th>
								<th width=300px>&nbsp;Remarks</th>				
								<th width=300px>&nbsp;</th>
							  </tr>
							</thead>
							
							<tbody>
							<?php if(!empty($AllActiveAct)):?>
							<?php foreach($AllActiveAct as $data) :?>
								<tr>
									<td> <?php echo $data->activity_name;?></td>									
									<td> <?php echo $data->time_started;?></td>
									<td> <textarea class="form-control select2"   style="width:500px;" rows="4" placeholder="Add Remarks Here.." id="textAreaName<?php echo $data->activity_id;?>"></textarea></td>					
									<td> <a class="btn btn-app"  id="endactivitybutton<?php echo $data->activity_id;?>" onclick="endthisactivity(this)"><i class="fa fa-flag-checkered"></i> END ACTIVITY</a></td>
								</tr>	
								
							<?php endforeach;?>										 
							<?php endif;?>
							</tbody>							
						</table>
					</div>          
				</div><!-- /.box-body -->
				</div>
				
				 <div class="chart tab-pane" id="listOfActivitiesID">
                <div class="box-body">
						<table id="listOfActivities" class="dataTables table-striped table-bordered" >
							<thead>
							  <tr>
								<th width=100px>&nbsp;Activity Name</th>								
								<th width=300px>&nbsp;Time Started</th>
								<th width=300px>&nbsp;Time Ended</th>
								<th width=300px>&nbsp;Processed Time</th>
								<th width=300px>&nbsp;Status</th>				
								<th width=300px>&nbsp;Remarks</th>																				
							  </tr>
							</thead>
							
							<tbody>
							<?php if(!empty($AllPreviousAct)):?>
							<?php foreach($AllPreviousAct as $data) :?>
								<tr>
									<td> <?php echo $data->activity_name;?></td>									
									<td> <?php echo $data->time_started;?></td>
									<td> <?php echo $data->time_ended;?></td>
									<td> <?php echo $data->process_time;?></td>
									<td> <?php echo $data->status;?></td>
									<td> <?php echo $data->remarks;?></td>
									
								</tr>	
								
							<?php endforeach;?>
							<?php endif;?>  						  
							</tbody>
							
						</table>					
                </div><!-- /.box-body -->																						
			  </div>
            </div>
         </div>
		
		
		
<div id="dialog-confirmAct" title="End Activity?" >
  <p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
		<span id="dialogContentact"></span>
	</p>
</div>
	<!-- Modal -->
	<div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			...
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
		  </div>
		</div>
	  </div>
	</div>

<script>

		$( "#dialog-confirmAct" ).dialog({ autoOpen: false });
function endthisactivity(dataValue){	
	$('#dialogContentact').html("You are about to end your activity. Are you sure?");	
	str = dataValue.id;
	splitvar  = str.split("endactivitybutton");
	
	remarksvar = $("textarea#textAreaName"+splitvar[1]).val();
	
	$( "#dialog-confirmAct" ).dialog({	  	
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
	  closeText: true,
      buttons: {
        "End Activity Now": function() {						
			$.ajax({
				data: { remarks: remarksvar, id: dataValue.id },
				type: 'POST',
				url: "../Activity_management/endActivityNow",		
				success: function (response) {							
					if(response == 1){
							$(".modal-title").html("Ended Activity");
							$(".modal-body").html("Successfully Ended Your Activity");		  
							$('#activityModal').modal('toggle')
							$('#activityModal').on('hidden.bs.modal', function () {
								location.reload();
							});
					}
					else{
						$(".modal-title").html("Ended Activity");
							$(".modal-body").html("Unable to End Your Activity");		  
							$('#activityModal').modal('toggle')
							$('#activityModal').on('hidden.bs.modal', function () {
								location.reload();
							});						
					}						
				},
				error: function(jqXHR, textStatus, errorThrown) {
				   console.log(textStatus, errorThrown);
				}				
			});
	
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
	
}
</script>			  

