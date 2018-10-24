
// Fraternity Delivery Locations
var dropdown = '<div class="input-group mb-3">\
<select class="custom-select" id="deliveryLocations">\
  <option selected>Choose...</option>\
  <option value="Alpha Epsilon Pi">Alpha Epsilon Pi</option>\
  <option value="Alpha Gamma Omega">Alpha Gamma Omega</option>\
  <option value="Beta Theta Pi">Beta Theta Pi</option>\
  <option value="Delta Sigma Phi">Delta Sigma Phi</option>\
  <option value="Delta Tau Delta">Delta Tau Delta</option>\
  <option value="Kappa Sigma">Kappa Sigma</option>\
  <option value="Lambda Chi Alpha">Lambda Chi Alpha</option>\
  <option value="Phi Delta Theta">Phi Delta Theta</option>\
  <option value="Phi Kappa Sigma">Phi Kappa Sigma</option>\
  <option value="Phi Kappa Psi">Phi Kappa Psi</option>\
  <option value="Pi Kappa Phi">Pi Kappa Phi</option>\
  <option value="Sigma Alpha Epsilon">Sigma Alpha Epsilon</option>\
  <option value="Sigma Alpha Mu">Sigma Alpha Mu</option>\
  <option value="Sigma Chi">Sigma Chi</option>\
  <option value="Sigma Nu">Sigma Nu</option>\
  <option value="Sigma Phi Epsilon">Sigma Phi Epsilon</option>\
  <option value="Sigma Pi">Sigma Pi</option>\
  <option value="Theta Chi">Theta Chi</option>\
  <option value="Theta Delta Chi">Theta Delta Chi</option>\
  <option value="Theta Xi">Theta Xi</option>\
  <option value="Triangle">Triangle</option>\
  <option value="Zeta Beta Tau">Zeta Beta Tau</option>\
</select>\
</div>';

function getDeliveryAddress(){
    
    var modal = vex.dialog.open({
        message: 'Enter a delivery address:',
        input: dropdown,
        buttons: [
            $.extend({}, vex.dialog.buttons.YES, { text: 'Submit' }),
            $.extend({}, vex.dialog.buttons.NO, { text: 'Logout' }),
        ],
        showCloseButton: false,
        escapeButtonCloses: false,
        overlayClosesOnClick: false,
        callback: function (data) {
            if (!data) {
                $('.vex-content').notify("You are being signed out", 
                        {className: "warning", clickToHide: true, position: 'top center',
                        autoHide: true, autoHideDelay: 2000});
                $.get('/components/scripts/logout.php', { return: 'logout'}).done(function(data) {
                    location.reload();  //Reload the page after signing out
                });
            } else {
                address = $('#deliveryLocations option:selected').val();
                insertAddress(address, modal);
            }
        }
    });
}

function insertAddress(address, modal){
    $.ajax({
        type: "POST",
        url: "/components/scripts/address_processing.php",
        data: {"address": address, "submit": true}
    })
    .done(function(data){
        data = JSON.parse(data);
        if(data.success){
            $.notify(data.message, 
                {className: "success", clickToHide: true, position: "top right",
                autoHide: true, autoHideDelay: 2000});
        }else{
            getDeliveryAddress();
            $('.vex-content').notify(data.message, 
                {className: "error", clickToHide: true, position: "top right",
                autoHide: true, autoHideDelay: 3000});
            $( ".vex-content" ).effect( "shake" );
        }
    });
}
