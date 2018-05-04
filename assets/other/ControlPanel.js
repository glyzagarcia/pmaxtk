 
	var table = document.getElementById("ActivityTable");
	var h1 = document.getElementsByTagName('h3')[0],
    start = document.getElementById('start'),
    stop = document.getElementById('stop'),
	StartActivity = document.getElementById('StartActivity'),
    clear = document.getElementById('clear'),
    seconds = 0, minutes = 0, hours = 0,
    t;
  var AddUser = document.getElementById('AddUser');
  var FindUser = document.getElementById('FindUser');
  

  
//var e  = document.getElementById('FNtextfield');
//var e0 = document.getElementById('IDtextfield');
//var e1 = document.getElementById('MItextfield');
//var e2 = document.getElementById('SNtextfield');
//e.onclick = function() {
//	document.getElementById('popup').innerHTML = 'Note: Also add second name/s if available';
//}
//e.onmouseout = function() {
//	document.getElementById('popup').innerHTML  = 'Note: All fields must be inputted';
//}
//e0.onclick = function() {
//	document.getElementById('popup').innerHTML = 'Note: Maximum of four digit numbers';
//}
//e0.onmouseout = function() {
//	document.getElementById('popup').innerHTML  = 'Note: All fields must be inputted';
//}  
//e1.onclick = function() {
//	document.getElementById('popup').innerHTML = 'Note: Middle Initial only';
//}
//e1.onmouseout = function() {
//	document.getElementById('popup').innerHTML  = 'Note: All fields must be inputted';
//}
//e2.onclick = function() {
//	document.getElementById('popup').innerHTML = 'Note: Also add generational suffix (Jr., Sr., etc) if available';
//}

//function loadMembers(){
//      var id =  $("#employee_id").val();
//      console.log("pressed refresh button with id:"+id); 
//      document.getElementById('refreshTableButton').value = "REFRESH TABLE"
//      $.get( "<?php echo base_url();?>Activity_management/loadMembers?id="+id, function( data ){
//             $( "#SubordinatesTable" ).html( data );  
//      });
//}
//$(document).ready( function () {
//  var table = $('#ActivityTable').DataTable();
//} );

//$(document).ready(function(){
//        var passwordVerify = "<?php echo $password; ?>";
//        var slicedFN = "<?php echo $sess_userdata['first_name'];?>";
//        slicedFN = slicedFN.slice(0,3);
//        var slicedSN = "<?php echo $sess_userdata['last_name'];?>";
//        slicedSN = slicedSN.slice(0,3);
//        var finalPassword = slicedFN.concat(slicedSN,document.getElementById('employee_id').value);
//        console.log(finalPassword);
//        if(finalPassword == "RufRem0019"){
//         document.getElementById('myModal3').modal('true');
//        }
//});
//function passwordChange(){
//
//
//}

//function passwordChangeModal(){
//  var passwordVerify = "<?php echo $password; ?>";
//  var slicedFN = "<?php echo $sess_userdata['first_name'];?>";
//  slicedFN = slicedFN.slice(0,3);
//  var slicedSN = "<?php echo $sess_userdata['last_name'];?>";
//  slicedSN = slicedSN.slice(0,3);
//  var finalPassword = slicedFN.concat(slicedSN,document.getElementById('employee_id').value);
//  console.log(finalPassword);
//  if(finalPassword == "RufRem0019"){
//    document.getElementById('myModal3').modal({backdrop: true});
//}
//}

//$(document).ready(function(){
//   $("#search").keyup(function(){
//       var str=  $("#search").val();
//       if(str == "") {
//               $( "#txtHint" ).html("<b>User information will be listed here...</b>"); 
//       }else {
//               $.get( "<?php echo base_url();?>User_management/ajaxsearch?id="+str, function( data ){
//                   $( "#txtHint" ).html( data );  
//            });
//       }
//  });  
//});

//function editUser(id){
//	var editTable = document.getElementById('UserEditSection');
	
//	$.ajax({
//        url: "<?php echo base_url('User_management/getUserDetails/"+id+"'); ?>",
//        type: 'POST',
//        dataType: "json",
//        //data: { id : id },
//        success: function(data){
//          console.log(data);
//          editTable.style.display = "block";
//          document.getElementById('IDtextfieldEDIT').value    = data[0];
//          document.getElementById('ULevelEDIT').value         = data[1];
//          document.getElementById('FNtextfieldEDIT').value    = data[2];
//          document.getElementById('MItextfieldEDIT').value    = data[3];
//          document.getElementById('SNtextfieldEDIT').value    = data[4];
//          document.getElementById('LOBoptionsEDIT').value     = data[5];
//          document.getElementById('HeadIDedit').value         = data[6];
//          document.getElementById('SaveNewUserDetailsButton').disabled = false;
//        }
//    });
//}  

//function updateUserDetails(){
//  var updatedUserDetails =  
//    {
//      employee_id:        document.getElementById('IDtextfieldEDIT').value  ,
//      user_level:         document.getElementById('ULevelEDIT')     .value  ,
//      first_name:         document.getElementById('FNtextfieldEDIT').value  ,
//      middle_initial:     document.getElementById('MItextfieldEDIT').value  ,
//      last_name:          document.getElementById('SNtextfieldEDIT').value  ,
//      line_of_business:   document.getElementById('LOBoptionsEDIT') .value  ,
//      Head_Person:        document.getElementById('HeadIDedit')     .value  
//    };    

//  $.ajax(
//    {
//      url     : "<?php echo base_url('User_management/updateUserDetails'); ?>",
//      type    : "POST",
//      data    : updatedUserDetails,
//      success : function()
//                  {
//                    alert("Update Successful!");
//                  }
//    }   );

//}

//function register(){
//  var slicedFN = document.getElementById('FNtextfield').value;
//	slicedFN = slicedFN.slice(0,3);
//	var slicedSN = document.getElementById('SNtextfield').value;
//	slicedSN = slicedSN.slice(0,3);
//	var finalPassword = slicedFN.concat(slicedSN,document.getElementById('IDtextfield').value);
  //console.log(finalPassword);
//	var regFormData ={
//		employee_id 	: document.getElementById('IDtextfield').value,
//		first_name 		: document.getElementById('FNtextfield').value,
//		middle_initial 	: document.getElementById('MItextfield').value,
//		last_name		: document.getElementById('SNtextfield').value,
//		line_of_business: document.getElementById('LOBoptions').value,
//		password     	: finalPassword,
//		user_level		: document.getElementById('ULevel').value,
//		Head_Person		: document.getElementById('HeadID').value,

//	};

//	$.ajax({
//        url: "<?php echo base_url('User_management/register_User'); ?>",
//        type: 'POST',
//        data: regFormData,
//        success: function (){
//          document.getElementById('IDtextfieldEDIT').value = null;
//          document.getElementById('ULevelEDIT').innerHTML       = "";
//          document.getElementById('FNtextfieldEDIT').innerHTML  = "";
//          document.getElementById('MItextfieldEDIT').innerHTML  = "";
//          document.getElementById('SNtextfieldEDIT').innerHTML  = "";
//          document.getElementById('LOBoptionsEDIT').innerHTML   = "";
//          document.getElementById('HeadIDedit').innerHTML       = "";
//          alert("Registration Successful!");
//        }
//    });

//    return false;

//}

//function add() {
//    seconds++;
//    if (seconds >= 60) {
//        seconds = 0;
//        minutes++;
//        if (minutes >= 60) {
//            minutes = 0;
//            hours++;
//        }
//    }
    
//    h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
//	timer();
//}
//function timer() {
//    t = setTimeout(add, 1000);
//}

/* Start button */
start.onclick = function() {
//    timer();  
	$('#start').attr('disabled', 'disabled');
	$('#stop').removeAttr('disabled');
	$('#shiftCOG').addClass('fa-spin');
  // $('#startACT').removeAttr('disabled');
	$('#ActivityOptions').removeAttr('disabled');
	var employeeID = document.getElementById('employee_id').value;

	//var today = new Date();
	//document.getElementById("StartShiftTime").innerHTML =
	//moment().format('Do [of] MMM YYYY, h:mm:ss a');//today.toLocaleString();    	
	//document.getElementById("LineOfBusiness").disabled=false;
	//document.getElementById("Practice").disabled=false;
	//document.getElementById("Activity").disabled=false;
	//document.getElementById("StartActivity").disabled=false;
	//document.getElementById("hiddenStartShiftTime").value= moment().format();
	//alert(today.toLocaleString("en-GB", {timeZone: "Asia/Taipei"}));

	var form_data = {
        IDnumber: employeeID//$('#employee_id').val(),
//        hiddenStartShiftTime: document.getElementById("hiddenStartShiftTime").value
    };
    console.log(form_data);
    $.ajax({
        // url: "http://10.1.241.29/TimeInMotionBETA/Shift_management/start_shift",
		type: 'POST',
        data: form_data,
        url: "../Shift_management/start_shift" ,
		success:function(response){
			alert(response);
			if(response > 1){
				location.reload();
			}
			
		}
    });
	
    var htmlContents = $('#ShiftControls').html();
    localStorage.setItem("running", htmlContents);
   // console.log(localStorage.getItem("running"));

    return false;
}




//StartActivity.onclick = function() {
//function startActivity(){
	//event.preventDefault();
//	var table = document.getElementById("ActivityTable");
//    var rowCount = table.rows.length;
//    var row = table.insertRow(rowCount);
	//var newCell1 = row.insertCell(0);
    //newCell1.innerHTML = document.getElementById("LineOfBusiness").value;
//	var newCell2 = row.insertCell(0);
//	newCell2.innerHTML = document.getElementById("Practice").value;
//	var newCell3 = row.insertCell(1);
//	newCell3.innerHTML = document.getElementById("Activity").value;
//	var newCell4 = row.insertCell(2);
	//var currentACT = new Date();
	//newCell4.innerHTML = moment().format('h:mm:ss a');
	
//	var newCell5 = row.insertCell(3);
	/* newCell5.id = "TimeEndCell"+rowCount; */
	//newCell5.innerHTML = "...";
//	var newCell6 = row.insertCell(4);
	//newCell6.innerHTML = "...";
//	var newCell7 = row.insertCell(5);
	//newCell7.innerHTML = '<textarea id="RemarksCell'+table.rows.length+'" rows=3 cols=80></textarea>';
	/*var newCell8 = row.insertCell(7);
	newCell8.innerHTML = '<input id="ButtonCell'+table.rows.length+'" type="button" value="END">'; */
//	var newCell8 = row.insertCell(6);
	//newCell8.innerHTML = '<input id="RadioCell'+rowCount+'A" name="RadioCell" type="radio">&nbsp;YES<input id="RadioCell'+rowCount+'B" name="RadioCell" type="radio">&nbsp;NO';
	
	//var textAreaCell = "RemarksCell"+rowCount;
	
//	var form_data = {
//        'practice': newCell2.innerHTML ,
//        'activityDone': newCell3.innerHTML ,
//        'timeStarted': moment().format(),
        
//	};

	//debugger;
//	$.ajax({
//        url: "<?php echo base_url('Activity_management/start_activity');?>",
//        type: 'POST',
//        data: form_data,
//        success: function(data) {
//	            console.log(form_data);
	            //console.log(data);
	            //newCell2.innerHTML = document.getElementById("Practice").value;
	            //newCell3.innerHTML = document.getElementById("Activity").value;
//	            newCell4.innerHTML = moment().format('h:mm:ss a');
//	            newCell5.innerHTML = "...";
//	            newCell6.innerHTML = "...";
//	            newCell7.innerHTML = '<textarea id="RemarksCell'+table.rows.length+'" rows=3 cols=80 style="resize:none" placeholder=" ~ Type in your remarks here ~"></textarea>';
//	            newCell8.innerHTML = '<select id="OptionCell'+table.rows.length+'"><option value="Completed">Completed</option><option value="Uncompleted">Uncompleted</option><option value="Pending Client">Pending Client</option><option value="Pending Patient">Pending Patient</option><option value="Pending POC">Pending POC</option></select>';
               //'<input id="RadioCell'+rowCount+'A" name="RadioCell" type="radio">&nbsp;YES<input id="RadioCell'+rowCount+'B" name="RadioCell" type="radio">&nbsp;NO';
//				document.getElementById("LineOfBusiness").disabled=true;
//				document.getElementById("Practice").disabled=true;
//				document.getElementById("Activity").disabled=true;
//				document.getElementById("StartActivity").disabled=true;
//				document.getElementById("stop").disabled=true;
//				document.getElementById('EndActivity').disabled=false;

//        }
//    });

	
//    return false;
//}

//$(document).ready(function(){
//EndActivity.onclick = function(){
	
//	var table = document.getElementById("ActivityTable");
	
//	var rowCount = table.rows.length;
//	var x = table.rows[rowCount-1].cells;
//	var startTime = Date.parse(x[2].innerHTML);
//	x[3].innerHTML = moment().format('h:mm:ss a');
//	var endTime = Date.parse(x[3].innerHTML);
//	var diff = endTime - startTime;
//	var msec = diff;
//	var hh = Math.floor(msec / 1000 / 60 / 60);
//	msec -= hh * 1000 * 60 * 60;
//	var mm = Math.floor(msec / 1000 / 60);
//	msec -= mm * 1000 * 60;
//	var ss = Math.floor(msec / 1000);
//	msec -= ss * 1000;
//	x[4].innerHTML = hh + ":" + mm + ":" + ss;
	
//  var RemarksCell = 'RemarksCell'+rowCount;
//  var OptionCell = 'OptionCell'+rowCount;
//  document.getElementById(OptionCell).disabled = true;
	//var RadioCellA = 'RadioCell'+(rowCount-1)+'A';
	//var RadioCellB = 'RadioCell'+(rowCount-1)+'B';

	//var compare1 = document.getElementById(RadioCellA).checked;
	//var compare2 = document.getElementById(RadioCellB).checked;
	
	//var radioResult ;
	
	//if ( compare1 === true) {
	//	radioResult = 'finished';
	//}else{
	//	radioResult = 'unfinished';
	//};
	
//	var form_data = {
//        'timeEnded':moment().format() ,
//        'remarks': document.getElementById(RemarksCell).value ,
//        'completion': document.getElementById(OptionCell).value,//radioResult,
//        'timePassed': x[4].innerHTML
                 
//	};
	
//	$.ajax({
//        url: "<?php echo base_url('Activity_management/end_activity'); ?>",
//        type: 'POST',
//        data: form_data,
//        success: function() {
//            console.log(form_data);
//            document.getElementById('EndActivity').disabled=true;
//			document.getElementById("StartActivity").disabled=false;
//			document.getElementById("LineOfBusiness").disabled=false;
//			document.getElementById("Practice").disabled=false;
//			document.getElementById("Activity").disabled=false;
//			document.getElementById("stop").disabled=false;
//		}
//    });

//    return false;
//}
//});

AddUser.onclick = function() {
  document.getElementById('registrationForm').display = "block";
  document.getElementById('ControlPanel').display = "none";
}
FindUser.onclick = function() {
  document.getElementById('registrationForm').display = "none";
  document.getElementById('ControlPanel').display = "none";
}
/* Stop button */
stop.onclick = function() {
  
//function EndingShift(){	
//    clearTimeout(t);
    //var today = new Date();
	//document.getElementById("EndShiftTime").innerHTML =
  //  moment().format('Do [of] MMM YYYY, h:mm:ss a');//new Date().toLocaleString();
	$('#stop').attr('disabled', 'disabled');
  $('#shiftCOG').removeClass('fa-spin')
	/* document.getElementById("buttonContainer").innerHTML =
    "SHIFT IS OVER. GO HOME SAFELY"; */
	//document.getElementById("LineOfBusiness").disabled=true;
	//document.getElementById("Practice").disabled=true;
	//document.getElementById("Activity").disabled=true;
	//document.getElementById("StartActivity").disabled=true;
	//document.getElementById("EndActivity").disabled=true;

	//document.getElementById("hiddenEndShiftTime").value= moment().format();

	var form_data = {
        status: 'ended'
        //hiddenEndShiftTime:document.getElementById("hiddenEndShiftTime").value,
        //processTime: h1.textContent
    };

	$.ajax({
        // url: "http://10.1.241.29/TimeInMotionBETA/Shift_management/end_shift",
        url: "../Shift_management/end_shift",
        //type: 'POST',
        //data: form_data,
        success: function (response){
          alert('Shift Ended, SIGNING OUT!')		  			
		  location.reload();						
          //document.getElementsByTagName('body').html(data);
        }
    });
    localStorage.removeItem("running");
    console.log("end shift htmlContents!")
    console.log(localStorage.getItem("running"));
    return false;
}
function ongoingShift(){
    if (localStorage.getItem("running") != null) {
      console.log("empty localStorage");
      var script_tag = document.createElement('script');
      script_tag.setAttribute('type', 'text/javascript');
      script_tag.setAttribute('src', "http://10.1.241.29/TimeInMotionBETA/assets/other/ControlPanel.js");
      $('#ShiftControls').html(localStorage.getItem("running"));
      document.getElementById('ShiftControls').appendChild(script_tag);

      //.innerHTML = localStorage.getItem("running");
      //document.write(localStorage.getItem("running"));
    }else{
      //document.getElementById('ControlPanel').innerHTML = localStorage.getItem("running");
      console.log("empty localStorage");
    }
  }
  
  $("#startACT").click(function(){
	  
	 // $(".trIdOngoingAct").css("display", "block");
	  //$("#startACT").css("display", "none");
	  //$(".tdstartbutton").html("wwwe");
	  
	   activitytype = $("#ActivityOptions option:selected" ).val();
	   // textAreaNamevar =  $("#textAreaName" ).val();
	  $.ajax({        
        url: "../Activity_management/startActivity",
        type: 'POST',
        data: { activity: activitytype },
        success: function (response){          
		  var msg = $.parseJSON(response);		  
		  // alert("Latest Activity Started : "+msg.activityName);				
		 
		   $(".modal-title").html("Latest Activity Started ");
		   $(".modal-body").html("Activity : "+msg.activityName+"<br> Time Started : "+msg.timestarted);		  
		   $('#exampleModal').modal('toggle')
			$('#exampleModal').on('hidden.bs.modal', function () {
			 location.reload();
			});
					  // $("#ActivityOptions").val("~ Choose an activity ~");
		  // $(".latestaddedact").html("Latest Activity Started : <b>"+msg.activityName+"</b>");
		  // $(".latestaddedact").css("display", "block");
          
        }
    });
	
  });
  

