$(document).ready(function() {
    $("#loginForm").submit(function(e) {
      $('#loginResult').removeClass('alert alert-danger alert-success'); //Remove any previous error messages
      $('#loginResult').empty();
      var url = "/components/scripts/login_processing.php";
      var formData = $(this).serializeJSON();    //Collect the form input
      formData.login = true;
      $.LoadingOverlay("show"); //Show loading screen
      document.getElementById("loginButton").disabled = true; //Disable login button
      $.ajax({
          type: "POST",
          url: url,
          data: formData
      })
      .done(function(data) {
        data = JSON.parse(data);
        $.LoadingOverlay("hide"); //Remove Loading Screen
        document.getElementById("loginButton").disabled = false; //Re-enable login button
        if(data.success){
          $('#loginResult').addClass('alert alert-success');
          $('#loginResult').append('<b>You have logged in successfully!</b>');
          setTimeout(function(){      //Reload the page after signing in
            location.reload();
          }, 750);
        } else{
          $('#loginResult').addClass('alert alert-danger');        //Display any error messages
          $('#loginResult').append('<b>' + data.error + '</b>');
        }
      });
      e.preventDefault(); // avoid to execute the actual submit of the form.
    });
  });