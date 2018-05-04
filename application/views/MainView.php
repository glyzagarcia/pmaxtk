<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>TimeKeeping System | PmaxGLOBAL</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url('');?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="<?php echo base_url('');?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('');?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('');?>assets/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url('');?>assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('');?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url('');?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url('');?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url('');?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('');?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue"  onload="startTime()" ><!-- onload="ongoingShift()" -->
  <?php $sess_userdata = $this->session->userdata('logged_in'); ?>
    <div class="wrapper" >
      
      <header class="main-header" style="background-color:#222d32">
        <!-- Logo -->
        <div class="logo" style="background-color:#1a2226"><b>TimeKeeper</b></div>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation" style="background-color:#222d32">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a> 
          <div class="navbar-custom-menu">
            <bold style="font-size:30px;color:white !important">PMAXGlobal</bold>    
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar" style="">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
		  
          <div class="user-panel">
            <div class="pull-left image" style="position:relative;text-align:center;" >
              <img src="<?php echo base_url('');?>assets/dist/img/UnknownProfile.png" class="img-circle" alt="User Image"/><?php echo "<div style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)'><h5><b>".$sess_userdata['employee_id']."</b></h5></div>"; ?>
              <form>
                <input type="hidden" id="employee_id" name = "employee_id" value="<?php echo $sess_userdata['employee_id']; ?>">
              </form>
            </div>
            <div class="pull-left info" >
              <p><?php echo $sess_userdata['first_name']." ".$sess_userdata['middle_initial'].". ".$sess_userdata['last_name']; ?></p>

              <i class="fa fa-briefcase text-success"></i> <?php echo $sess_userdata['position']; ?>
            </div>
          </div>
          <!-- search form
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="#" id="dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>

            <li>
              <a href="#" id="AddUser"><i class="fa fa-plus"></i>Add new user</a>
            </li>
            <li>
              <a href="#" id="FindUser"><i class="fa fa-search"></i>Find a user</a>
            </li>
			<li>
              <a href="#" id="myTeam"><i class="fa fa-search"></i>My Team</a>
            </li>
            <li>
              <a id="ActivityTracker" href="#">
                <i class="fa fa-crosshairs"></i> <span>Activity Tracker</span>
				<?php  if($AllActiveAct)
					echo  '<span class="badge badge-Success">'.sizeof($AllActiveAct).'</span>';
					else echo "";
				?>
              </a>
            </li>
            <!-- <li class="treeview">
              <a >
                <i class="fa fa-users"></i>
                <span>User Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" id="AddUser"><i class="fa fa-plus"></i>Add new user</a></li>
                <li><a href="#" id="FindUser"><i class="fa fa-search"></i>Find a user</a></li>
               
              </ul>
            </li> -->          
            <li>
              <a >
                <i class="fa fa-unlock-alt"></i> <span>Lockscreen</span>
                
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('');?>User_Authentication/sign_out">
                <i></i> <span>Sign out</span>
                
              </a>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper"  >
        <!-- Content Header (Page header) -->
      <div id="registrationForm" style="display:none">
         <!--FORM INPUTS -->
            <center><div style="padding-bottom:10px" id="popup">Note: All fields must be inputted</div></center>
            <center>
            <table>
            <form id="regisForm">
            <tr>
              <td style="text-align:right" > <label>ID Number:&nbsp;&nbsp;</label> </td> 
              <td style="padding-bottom:5px"><input id="IDtextfield" type="text" name="ID_Number" placeholder="0000" size=1 maxlength=4>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>USER LEVEL:&nbsp;&nbsp;</label>
              </td>
              <td>              
                <select id="ULevel">
                  <option value="LOW">LOW</option>
                  <option value="TECH">MID</option>
                  <option value="HIGH">HIGH</option>
                  <option value="TECH">TECH</option>
                </select>
              </td>
                
            </tr>
            <tr>  
                  <td style="text-align:right"> <label>First name:&nbsp;&nbsp;</label> </td> 
                  <td style="padding-bottom:5px"> <input id="FNtextfield" type="text" name="First_name" placeholder="~ At least 2 letters ~" > </td>
                <td style="padding-left:10px">&nbsp;|&nbsp;&nbsp;<input size="3" type="text" id="MItextfield" name="MItextfield" minlength="1" maxlength="1" placeholder="~ M.I. ~" > </td> 
            </tr>
            <tr>
                <td style="padding-top:5px;text-align:right"><label>Surname:&nbsp;&nbsp;</label> </td> 
                <td style="padding-bottom:5px"> <input  type="text" id="SNtextfield" name="Surname" placeholder="~ At least 2 letters ~"></td>
                <td style="padding-left:10px">&nbsp;|&nbsp;&nbsp;<input size="3" type="text" id="MItextfield" name="Suffix" minlength="1" placeholder=" ~Suffix~" > </td> 
            </tr>
              <!--<tr >
              <td colspan=3 style="text-align:left;padding-top:5px;"><label>Line of Business:&nbsp;&nbsp;</label> </td>
                <td> 
                  <select id="LOBoptions">
                    <option value="Accounts Receivables">Accounts Receivables</option>
                    <option value="Data Entry">Data Entry</option>
                    <option value="Development">Development</option>
                    <option value="Patient Intake">Patient Intake</option>
                  </select>
                </td>
          </tr> -->
          <tr>
            <td colspan=3 style="text-align:left;padding-top:5px;"><label>Head Person:&nbsp;&nbsp;</label> <!--</td> -->
                <!-- <td> -->
                  <input id="HeadID" type="textfield" placeholder="~ Input name or ID number ~" size=30>
                </td>
          </tr>
          </form>
          </table>
          </center>
      </div>
      <div id="ControlPanel" >
        <section class="content-header">
          <h1>
            Dashboard 
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="nav-tabs-custom" >
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  <li class="pull-left header">Shift Controls</li>
                  <li class="pull-left header" id="runningTime" ></li>
                </ul>
                
                <div class="tab-content no-padding">
                  <?php if($sess_userdata['currentShiftID'] == null){ ?>
                  <div class="chart tab-pane active" id="ShiftControls" >
						<table>
							<tbody>
								<tr>
									<td id="buttonContainer" align="center" style="padding-top:10px;padding-right:10px"><!--<button id="start">START</button>--><a class="btn btn-app" id="start"><i class="fa fa-sign-in"></i> CLOCK IN</a></td>
									<td align="center" ><!--<center><h1 style="padding:0px 20px 10px 20px"><time>00:00:00</time></h1></center>--><i id="shiftCOG" class="fa fa-cog fa-4x" ></i></td>
									<td style="padding-top:10px"><a class="btn btn-app" id="stop" disabled><i class="fa fa-sign-out"></i> CLOCK OUT</a></td>
								</tr>
						</tbody></table>
					</div>
                  <?php }else{ 
						// $this->load->model('UserModel');
				       $timestarted = $this->UserModel->getStartTime($sess_userdata['currentShiftID']);
					   
				  ?>
                  <div class="chart tab-pane active" id="ShiftControls" >
						<table ><tbody><tr align="center" ><td id="buttonContainer" align="center" style="padding-top:10px;padding-right:10px"><!--<button id="start">START</button>--><a class="btn btn-app" id="start" disabled><i class="fa fa-sign-in"></i> CLOCK IN</a></td>
						<td ><!--<center><h1 style="padding:0px 20px 10px 20px"><time>00:00:00</time></h1></center>--><i id="shiftCOG" class="fa fa-cog fa-4x fa-spin" ></i></td>
						<td style="padding-top:10px"><a class="btn btn-app" id="stop"><i class="fa fa-sign-out"></i> CLOCK OUT</a></td>
						</tr>
						<tr align="center" >
							<td colspan="3"><b>Time Started: </b><?php echo $timestarted;?></td>
							
						</tr></tbody></table>
				 </div>
                  <?php } ?>
                </div>
              </div><!-- /.nav-tabs-custom -->
              <!--<div class="small-box bg-aqua">
                <div class="inner">
                  <label style="font-size:430%">#</label>
                  <br>
                </div>
                <div class="icon">
                  <i class="ion ion-clock"></i>

                </div>
                <a class="small-box-footer">Overall number of shifts done</a>
              </div> -->
            </div><!-- ./col -->
        <section class="col-lg-2" style="padding-top:10px;padding-right:10px"  >
              <!-- Custom tabs (Charts with tabs)-->
              <?php if($sess_userdata['currentShiftID'] != null){ ?>
              <form>
                <input type="hidden" id="currentShiftID" value="<?php echo $sess_userdata['currentShiftID']; ?>">
              </form>
              <?php } ?>
              
              
            </section><!-- /.Left col -->
        
        
            <div class="row">
            </div><!-- /.row (main row) -->
        <section>

        <div class="col-lg-5 col-xs-6">
              <!-- small box -->
              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right" >
                  <li class="pull-left header">Activity Control 
                </ul>
                <div class="tab-content no-padding">
                  <div class="chart tab-pane active" >
                    <table class='table table-bordered'>					
					<tr>
						<td>
						  <span style="padding:0px 0px 10px 5px">ACTIVITY NAME:</span>
						  <span style="padding:0px 0px 10px 5px">
						  <select class="form-control select2" id="ActivityOptions">
								<option>~ Choose an activity ~</option>        
								<?php foreach ($listOfActivityType as $activity):?>
								<option value="<?php echo $activity->activity_tid;?>"><?php echo $activity->activity_name;?></option>
								<?php endforeach;?>
							  </select>
							</span>
						</td>
						<td class="tdstartbutton">
							<a id="startACT" class="btn btn-app" >
							  <i class="fa fa-bolt" ></i> START ACTIVITY
							</a > 
						</td>
					</tr>
					<tr colspan="2">
						<td class="latestaddedact" style="display:none;"></td>
					</tr>
                    <!--<th>
                      <a class="btn btn-app" id="cancelACT" disabled>
                          <i class="fa fa-unlink" ></i> CANCEL ACTIVITY
                        </a> 
                    </th>
                    <th>
                      <a class="btn btn-app" id="stopACT" disabled>
                          <i class="fa fa-flag-checkered"></i> END ACTIVITY
                        </a> 
                    </th> -->
					
                    <tr class="trIdOngoingAct" style="display:none;" >
						<td>						
							<textarea class="form-control select2"   rows="4" placeholder="Add Remarks Here.." id="textAreaName"></textarea>													
						</td>
						<td>
							<a class="btn btn-app" id="stopACT" >
								<i class="fa fa-flag-checkered"></i> END ACTIVITY
							</a> 
						</td>
                    </tr>
                    </table>
					
                  </div>
                </div>
              </div><!-- /.nav-tabs-custom -->
              <!--<div class="small-box bg-blue">
                <div class="inner">
                  <label style="font-size:430%">#</label>
                  <br>
                </div>
                <div class="icon">
                  <i class="fa fa-tasks"></i>

                </div>
                <a class="small-box-footer">Current number of activities done</a>
              </div> -->
            </div><!-- ./col -->
			
			
			
        <section class="col-lg-5 " style="padding-top:10px;padding-left:10px;">
              <!-- Custom tabs (Charts with tabs)-->
              
              
            </section><!-- /.Left col -->

        
      </section><!-- /.content -->
      <section class="col-lg-12" style="margin-left:10px;padding-right:38px">
      <!-- Main row -->
          <div class="row"> 
            <!--<div><h2>line of business: <b><?php echo $sess_userdata['line_of_business']; ?></b></h2></div>-->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs no-border">
                 <!-- <li class="active pull-left header "><a href="#yourActivity" class="no-border" data-toggle="tab" >Your Activity</a></li>-->
                  <!--<li  class="pull-left header"><a href="#memberActivity" class="no-border" data-toggle="tab">Members </a></li>-->
				  <?php if(!empty($logged_in)):?>
				  <li  class="pull-left header"><a href="#loggedIn" class="no-border" data-toggle="tab">Logged In </a></li>
				  <?php endif; ?>
				  <?php if(!empty($logged_out)):?>
                  <li  class="pull-left header"><a href="#loggedOut" class="no-border" data-toggle="tab">Logged Out </a></li>
				  <?php endif; ?>
				  <?php if(!empty($absent)):?>
				  <li  class="pull-left header"><a href="#absent" class="no-border" data-toggle="tab">Absent</a></li>
				  <?php endif; ?>
				  <li  class="active pull-left header"><a href="#mylogins" class="no-border" data-toggle="tab">My Logins</a></li>                  
              </ul>
            <div class="tab-content no-padding">
            <div class="chart tab-pane active" id="yourActivity" style="display:none;">
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped" >
                    <thead>
                      <tr>
                        <th>Activities</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Visit Number</th>
                        <th>Practice</th>
                        <th>System</th>
                        <th>Process</th>
                        <th>Remarks</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan=9><center><i>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ This section contains activities done on this shift ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ </i></center></td>
                      </tr>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Activities</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Visit Number</th>
                        <th>Practice</th>
                        <th>System</th>
                        <th>Process</th>
                        <th>Remarks</th>
                        <th>Status</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->

              </div><!-- /.box -->
              <div class="chart tab-pane" id="memberActivity" style="display:none;">
                <div class="box-body">
                  <div style="float:left;display-inline;" >
                  <div style="display:inline">&nbsp;<label><h4>ACTIVE MEMBERS</h4></label><button id="loadMembersButton" style="margin-left:630px;float=center"><i class="fa fa-refresh"></i>&nbsp;<b>LOAD TABLES</b></button></div>
                  <table id="example2" class="table-bordered table-striped" >
                    <thead>
                      <tr>
                        <th width=100px>&nbsp;ID number</th>
                        <th width=300px>&nbsp;Employee Name</th>
                        <th width=300px>&nbsp;Current Activity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan=3><center><i>~ Contains members currently signed in ~</i></center></td>
                      </tr>
                      
                    </tbody>
                  </table>
                  </div>
                  <div style="display:inline-block;padding-left:150px">
                  &nbsp;<label ><h4>INACTIVE MEMBERS</h4></label><br>
                  <table id="example3" class=" table-bordered table-striped" >
                    <thead>
                      <tr>
                        
                        <th width=100px>&nbsp;ID number</th>
                        <th width=300px>&nbsp;Employee Name</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan=4><center><i>~ Contains members not currently signed in ~</i></center></td>
                      </tr>
                      
                    </tbody>
                    
                  </table>
                </div>
                </div><!-- /.box-body -->
                

              </div><!-- /.box -->
			  
			  <div class="chart tab-pane" id="loggedIn">
                <div class="box-body">
						<table id="tableloggedIn" class="dataTables table-striped table-bordered" >
							<thead>
							  <tr>
								<th width=100px>&nbsp;ID number</th>
								<th width=200px>&nbsp;Time Started</th>
								<th width=200px>&nbsp;Time Ended</th>
								<th width=300px>&nbsp;Employee Name</th>
								<th width=300px>&nbsp;Log Status</th>
								<th width=300px>&nbsp;</th>
							  </tr>
							</thead>
							<?php if(!empty($logged_in)):?>
							<tbody>
							<?php foreach($logged_in as $data) :?>
								<tr>
									<td> <?php echo $data->employee_id;?></td>
									<td> <?php echo $data->time_started;?></td>
									<td> <?php echo $data->time_ended;?></td>									
									<td> <?php echo $data->first_name." ".$data->last_name;?></td>
									<td> <?php echo $data->logStatus;?></td>
									<td> <?php echo $data->shift_id;?></td>
								</tr>	
								
							<?php endforeach;?>
							  						  
							</tbody>
							<?php endif;?>
						</table>					
                </div><!-- /.box-body -->
			  </div>
			  
			  <div class="chart tab-pane" id="loggedOut">
                <div class="box-body">							 
						<table id="tableloggedOut" class="dataTables table-striped table-bordered" >
							<thead>
							  <tr>
								<th width=100px>&nbsp;ID number</th>
								<th width=200px>&nbsp;Time Started</th>
								<th width=200px>&nbsp;Time Ended</th>
								<th width=300px>&nbsp;Employee Name</th>
								<th width=300px>&nbsp;No. of Hours Worked</th>
								<th width=300px>&nbsp;Log-in Status</th>
							  </tr>
							</thead>
							<?php if(!empty($logged_out)):?>
							<tbody>
							<?php foreach($logged_out as $data) :?>
								<tr>
									<td> <?php echo $data->employee_id;?></td>
									<td> <?php echo $data->time_started;?></td>
									<td> <?php echo $data->time_ended;?></td>
									<td> <?php echo $data->first_name." ".$data->last_name;?></td>
									<td> <?php echo $data->process_time;?></td>
									<td> <?php echo $data->logStatus;?></td>									
									<!--<td> <?php echo $data->shift_id;?></td>-->
								</tr>	
								
							<?php endforeach;?>
													  
							</tbody>
							<?php endif;?>
						</table>					
                </div><!-- /.box-body -->
			  </div>
			  
			  <div class="chart tab-pane" id="absent">
                <div class="box-body">					
						<table id="tableabsent" class="dataTables table-striped table-bordered" >
							<thead>
							  <tr>
								<th width=100px>&nbsp;ID number</th>								
								<th width=300px>&nbsp;Employee Name</th>								
							  </tr>
							</thead>
							<?php if(!empty($absent)):?>
							<tbody>
							<?php foreach($absent as $data) :?>
								<tr>
									<td> <?php echo $data->employee_id;?></td>									
									<td> <?php echo $data->first_name." ".$data->last_name;?></td>																		
								</tr>	
								
							<?php endforeach;?>
												  
							</tbody>
							<?php endif;?>
						</table>
					</div>                          
			  </div>
			  
			  <div class="chart tab-pane active" id="mylogins">
                <div class="box-body">										 
						<table id="tablemylogins" class="dataTables table-striped table-bordered" >
							<thead>
							  <tr >
								<!--<th width=100px>&nbsp;Shift Id</th>-->
								<th width=200px>&nbsp;Date Started</th>
								<th width=200px>&nbsp;Time Started</th>
								<th width=200px>&nbsp;Date Ended</th>
								<th width=200px>&nbsp;Time Ended</th>								
								<th width=300px>&nbsp;No. of Hours Worked</th>
								<th width=300px>&nbsp;Shift Statusss</th>
							  </tr>
							</thead>
							<?php if(!empty($mylogins)):?>
							<tbody>
							<?php foreach($mylogins as $data) :?>
								<tr>
									<!--<td> <?php echo $data->shift_id;?></td>	-->								
									<td> <?php echo date("d M Y",strtotime($data->time_started));?></td>
									<td> <?php echo date("H:i:s",strtotime($data->time_started));?></td>
									<td> <?php if($data->time_ended != "0000-00-00 00:00:00" ) { if(date("d M Y",strtotime($data->time_started)) != date("d M Y",strtotime($data->time_ended))) echo date("d M Y",strtotime($data->time_ended)); } else echo "Shift On Progress";?></td>									
									<td> <?php if($data->time_ended != "0000-00-00 00:00:00") echo date("H:i:s",strtotime($data->time_ended)); else echo "Shift On Progress";?></td>													
									<!--<td> <?php if($data->time_ended == "0000-00-00 00:00:00") echo "0000-00-00"; else echo date("d M Y",strtotime($data->time_ended)) ; ?></td>
									<td> <?php echo date("H:i:s",strtotime($data->time_ended));?></td>-->
									
									<td> <?php if($data->time_ended != "0000-00-00 00:00:00") {
													$dteStart = new DateTime($data->time_started); 
													$dteEnd   = new DateTime($data->time_ended); 
													$dteDiff  = $dteStart->diff($dteEnd); 
													// echo $dteDiff->format("%H:%I:%S"); 																			
													echo $data->totalworkedhr;		

												}	else echo "Shift On Progress";?>  </td>
									<td> <?php if(!empty($data->status) ) echo "Shift ".$data->status; else "";?></td>
									
								</tr>	
								
							<?php endforeach;?>							  
							</tbody>
							<?php endif;?>
						</table>
					
                </div><!-- /.box-body -->
			  </div>
			  
            </div>
            </div>
       </section>     
            
        <!--  </div><!-- /.row (main row) -->
      </div>
	  
	   <div id="myTeamDiv" style="display:none;">
		<?php $this->load->view('find_user');?>
	  </div>
	  
	  <div id="myActivityTracker" style="display:none;">
		<?php $this->load->view('activity_tracker');?>
	  </div>
	  
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>2018</b>
        </div>
        Powered By: <strong>PmaxGLOBAL
      </footer>
    </div><!-- ./wrapper -->



	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('');?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="<?php echo base_url('');?>assets/other/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
	  
	  $('#myTeam').click(function(){
		  $('#myTeamDiv').css("display","block");		 
		  $('#ControlPanel').css("display","none");		 
		  $('#myActivityTracker').css("display","none");		 
	  });
	  
	  $('#dashboard').click(function(){
		  $('#myTeamDiv').css("display","none");		 
		  $('#ControlPanel').css("display","block");		 
		  $('#myActivityTracker').css("display","none");		 
	  });
	  
	  $('#ActivityTracker').click(function(){
		  $('#myActivityTracker').css("display","block");		 
		  $('#myTeamDiv').css("display","none");		 
		  $('#ControlPanel').css("display","none");		 
	  });
	  
	  function startTime() {

			var today = new Date();
			var h = today.getHours();
			h = h > 12 ? h - 12 : h;
			var m = today.getMinutes();
			var s = today.getSeconds();
			m = checkTime(m);
			s = checkTime(s);
			document.getElementById('runningTime').innerHTML =
			h + ":" + m + ":" + s;
			var t = setTimeout(startTime, 500);
		}
		function checkTime(i) {
			if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
			return i;
		}
	  	 
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('');?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="<?php echo base_url('');?>assets/other/raphael-min.js"></script>
    <!-- <script src="<?php echo base_url('');?>assets/plugins/morris/morris.min.js" type="text/javascript"></script> -->
    <!-- Sparkline -->
    <script src="<?php echo base_url('');?>assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url('');?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('');?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url('');?>assets/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url('');?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url('');?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('');?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('');?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url('');?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url('');?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('');?>assets/dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url('');?>assets/dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('');?>assets/dist/js/demo.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
     <!-- SlimScroll -->
    <script src="<?php echo base_url('');?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url('');?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('');?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('');?>assets/dist/js/demo.js" type="text/javascript"></script>
    <!-- page script -->
    <script src="<?php echo base_url('');?>assets/other/ControlPanel.js" type="text/javascript"></script> 
	
	<script src="<?php echo base_url('');?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script src="<?php echo base_url('');?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	
	 <script type="text/javascript">
      $(function () {
        // $("#example1").dataTable();
        var findUserTableAA = $('#findUser_table').dataTable({          
		  "pageLength": 10
        });
		
		 var tablemyloginsAA = $('#tablemylogins').dataTable({          
		  "pageLength": 10,
		   "order": [[ 3, "desc" ]]
        });
		
		 var tableabsentAA = $('#tableabsent').dataTable({          
		  "pageLength": 10
        });
		
		
		 var tableloggedOutAA = $('#tableloggedOut').dataTable({          
		  "pageLength": 10
        });
		
		
		 var tableloggedInAA = $('#tableloggedIn').dataTable({          
		  "pageLength": 10
        });
		
		var activitytrackertableAA = $('#activitytrackertable').dataTable({          
		  "pageLength": 10
        });
		
		var listOfActivitiesAA = $('#listOfActivities').dataTable({          
		  "pageLength": 10,
			ajax: "data.json"
        });
		
		
		
      });
	  
    </script> 
    <!--<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script> -->
  </body>
</html>