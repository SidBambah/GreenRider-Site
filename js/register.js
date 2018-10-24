$(document).ready(function() {
    $("#registerForm").submit(function(e) {
      $('#registerResult').removeClass('alert alert-danger alert-success');
      $('#registerResult').empty();
      var url = "/components/scripts/register_processing.php"; // the script where you handle the form input.
      var formData = $(this).serializeJSON();
      formData.register = true;
      $.LoadingOverlay("show"); //Start loading screen
      document.getElementById("registerButton").disabled = true; //Disable register button
      $.ajax({
          type: "POST",
          url: url,
          data: formData
      })
      .done(function(data) {
        data = JSON.parse(data);
        document.getElementById("registerButton").disabled = true; //Re-enable register button
        $.LoadingOverlay("hide"); //Remove loading screen
        if(data.success){
          $('#registerResult').addClass('alert alert-success');
          $('#registerResult').append('<b>You have successfully created an account! You can sign in\
          after verifying your email address.</b>');
          setTimeout(function(){
            location.reload();  //Reload the page after creating an account successfully
          }, 750);
        } else{
          $('#registerResult').addClass('alert alert-danger');
          $('#registerResult').append('<b>' + data.error + '</b>');
        }
      });
      e.preventDefault(); // avoid to execute the actual submit of the form.
    });
});