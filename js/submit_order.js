
function submitOrder(payloadNonce){
    var url = "/components/scripts/order_processing.php";
    $.LoadingOverlay("show"); //Show Loading Screen
    $.ajax({
        type: "POST",
        url: url,
        data: {"orderSubmit": true, "payment_method_nonce": payloadNonce}
    })
    .done(function(data){
        $.LoadingOverlay("hide"); //Remove Loading Screen
        data = JSON.parse(data);
        if(data.success){
            $.notify(data.message, 
                {className: "success", clickToHide: true, globalPosition: 'top center',
                autoHide: true, autoHideDelay: 2000});
            $.get('/components/scripts/logout.php', { return: 'logout'}).done(function(data) {
                $.notify("You will now be signed out and a confirmation email will be sent", 
                {className: "success", clickToHide: true, globalPosition: 'top center',
                autoHide: true, autoHideDelay: 2000});
                setTimeout(function(){
                    location.href = "/index.php";  //Reload the page after signing out
                }, 2000);
            });
        }else{
            $.notify(data.message, 
                {className: "error", clickToHide: true, globalPosition: 'top center',
                autoHide: true, autoHideDelay: 2000});
        }
    });
}