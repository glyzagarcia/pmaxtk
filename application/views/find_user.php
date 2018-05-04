
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.8.2.js"></script>  
  <script src="//code.jquery.com/ui/1.8.24/jquery-ui.js"></script>
  
 <section class="content-header">
          <h1>
            My Team Members            
          </h1>
         
</section>
		
<div class="box-body">
	<div >					  
		<table id="findUser_table" class="dataTables table-striped table-bordered" >
			<thead>
			  <tr>
				<th width=100px>&nbsp;ID number</th>								
				<th width=300px>&nbsp;Last Name</th>
				<th width=300px>&nbsp;First Name</th>
				<th width=300px>&nbsp;Log Status</th>
				<th width=300px>&nbsp;</th>
			  </tr>
			</thead>
			<?php if(!empty($mymembers)):?>
			<tbody>
			<?php foreach($mymembers as $data) :?>
				<tr>
					<td> <?php echo $data->employee_id;?></td>									
					<td> <?php echo $data->last_name;?></td>
					<td> <?php echo $data->first_name;?></td>
					<td> <?php echo $data->status;?></td>
					<td> <button id="resetpas<?php echo $data->employee_id;?>" name="<?php echo $data->last_name.", ".$data->first_name;?>" onclick="resspassfunction(this)">Reset Password</button></td>
				</tr>	
				
			<?php endforeach;?>										 
			</tbody>
			<?php endif;?>
		</table>
	</div>          
</div><!-- /.box-body -->

<div id="dialog-confirm" title="Reset Password?" >
  <p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
		<span id="dialogContent"></span>
	</p>
</div>


<script>

		$( "#dialog-confirm" ).dialog({ autoOpen: false });
function resspassfunction(dataValue){
	$('#dialogContent').html("You are about to reset password for <b>"+dataValue.name+"</b>. Are you sure?");
	
	$( "#dialog-confirm" ).dialog({	  	
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
	  closeText: "hide",
      buttons: {
        "Reset Password Now": function() {						
			$.ajax({
				data: { passname: dataValue.id },
				type: 'POST',
				url: "../User_Authentication/resetPasswordBySup",		
				success: function (response) {				   
					if(response != 0){
						alert("Password Successfully reset to '"+response+"'");
						// $( this ).dialog( "close" );
						// exit
					}
					else{
						alert("Unable to reset password");
						$( this ).dialog( "close" );						
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

