$(document).ready(function(){
  var hiddenPass = $('#hiddenPassword').val();

  $("#CurrentPassword").keyup(function(event) {
    
    var newPasswordField = document.getElementById('ChangedPassword');
    var currentPasswordField = document.getElementById('CurrentPassword');
    var currentPasswordFieldValue = $('#CurrentPassword').val();
    
    if (event.keyCode === 13) {

      if(currentPasswordFieldValue == hiddenPass){           
        $('#currentPasswordFieldGlyphicon').css("color", "green");
        $('#currentPasswordFieldGlyphicon').removeClass('glyphicon-remove');
        $('#currentPasswordFieldGlyphicon').removeClass('glyphicon-edit');
        $('#currentPasswordFieldGlyphicon').toggleClass('glyphicon-ok');
        $('#CurrentPassword').attr('readonly', true);
        newPasswordField.disabled = false;
        newPasswordField.focus();
      }
      if(currentPasswordFieldValue == '' || currentPasswordFieldValue == null ){
        $('#currentPasswordFieldGlyphicon').removeClass('glyphicon-ok');
        $('#currentPasswordFieldGlyphicon').removeClass('glyphicon-remove');
        $('#currentPasswordFieldGlyphicon').toggleClass('glyphicon-edit');
        $('#currentPasswordFieldGlyphicon').css("color", "#777");
      }
      else if(currentPasswordFieldValue != hiddenPass){
        $('#currentPasswordFieldGlyphicon').removeClass('glyphicon-edit');
        $('#currentPasswordFieldGlyphicon').removeClass('glyphicon-ok');
        $('#currentPasswordFieldGlyphicon').toggleClass('glyphicon-remove');
       $('#currentPasswordFieldGlyphicon').css("color", "red");
      }

    }

  });


  $("#ChangedPassword").keyup(function(event) {

    var letterNumber = /^[0-9a-zA-Z]+$/;
    var newPasswordField = document.getElementById('ChangedPassword');
    var newPasswordFieldValue = $('#ChangedPassword').val();
    var confirmPasswordField = document.getElementById('ConfirmPassword');
    var alphanumericmatch = newPasswordFieldValue.match(letterNumber);

    if (event.keyCode === 13) {

      if( alphanumericmatch && newPasswordFieldValue != hiddenPass && newPasswordFieldValue.length > 7){           
        $('#newPasswordFieldGlyphicon').css("color", "green");
        $('#newPasswordFieldGlyphicon').removeClass('glyphicon-remove');
        $('#newPasswordFieldGlyphicon').removeClass('glyphicon-edit');
        $('#newPasswordFieldGlyphicon').toggleClass('glyphicon-ok');
        $('#ChangedPassword').attr('readonly', true); 
        confirmPasswordField.disabled = false;
        confirmPasswordField.focus();
      }
      else if(newPasswordFieldValue == '' || newPasswordFieldValue == null ){
        $('#newPasswordFieldGlyphicon').removeClass('glyphicon-ok');
        $('#newPasswordFieldGlyphicon').removeClass('glyphicon-remove');
        $('#newPasswordFieldGlyphicon').toggleClass('glyphicon-edit');
        $('#newPasswordFieldGlyphicon').css("color", "#777");
      }
      else{
        $('#newPasswordFieldGlyphicon').removeClass('glyphicon-edit');
        $('#newPasswordFieldGlyphicon').removeClass('glyphicon-ok');
        $('#newPasswordFieldGlyphicon').toggleClass('glyphicon-remove');
        $('#newPasswordFieldGlyphicon').css("color", "red");
      }

    }

  });

  $("#ConfirmPassword").keyup(function(event) {

    var newPasswordField = document.getElementById('ChangedPassword');
    var newPasswordFieldValue = $('#ChangedPassword').val();
    var confirmPasswordField = document.getElementById('ConfirmPassword');
    var confirmPasswordFieldValue = $('#ConfirmPassword').val();
    var submitButton = document.getElementById('CONTINUEbutton');

    if (event.keyCode === 13) {
    
      if( newPasswordFieldValue == confirmPasswordFieldValue){           
        $('#confirmPasswordFieldGlyphicon').css("color", "green");
        $('#confirmPasswordFieldGlyphicon').removeClass('glyphicon-remove');
        $('#confirmPasswordFieldGlyphicon').removeClass('glyphicon-edit');
        $('#confirmPasswordFieldGlyphicon').toggleClass('glyphicon-ok');
        $('#ConfirmPassword').attr('readonly', true);
        submitButton.disabled = false;
      }
      else if(confirmPasswordFieldValue == '' || confirmPasswordFieldValue == null){
        $('#confirmPasswordFieldGlyphicon').removeClass('glyphicon-ok');
        $('#confirmPasswordFieldGlyphicon').removeClass('glyphicon-remove');
        $('#confirmPasswordFieldGlyphicon').toggleClass('glyphicon-edit');
        $('#confirmPasswordFieldGlyphicon').css("color", "#777");
      }
      else{
        $('#confirmPasswordFieldGlyphicon').removeClass('glyphicon-edit');
        $('#confirmPasswordFieldGlyphicon').removeClass('glyphicon-ok');
        $('#confirmPasswordFieldGlyphicon').toggleClass('glyphicon-remove');
        $('#confirmPasswordFieldGlyphicon').css("color", "red");
      }

    }

  });

});