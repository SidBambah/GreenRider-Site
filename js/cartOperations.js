

//All cart operations that can be done on the website

//Global variables
var fadeTime = 300;
var taxRate = 0.05;

$(document).ready(function() {
    calculateCart();
    //Add to Cart
    $('.add-to-cart').on('click', function(e){
        e.preventDefault();
        var btn = $(this);
        var item_id = btn.parent().parent().find('.product-id').val();
        sendToProcessor("add", item_id);
    });
    //Remove from Cart
    $('.product-removal button').click( function(e) {
        e.preventDefault();
        var btn = $(this);
        var item_id = btn.parent().parent().find('.product-id').val();
        sendToProcessor("remove", item_id);
        removeItem(this);
    });
    //Update quantity
    $('.product-quantity input').change( function(e) {
        e.preventDefault();
        var item_id = $(this).parent().parent().find('.product-id').val();
        var quantity = $(this).val();
        if(quantity < 1 || isNaN(quantity)){
            $.notify("Item quantity must be a number at least 1!", 
                {className: "error", clickToHide: true, globalPosition: 'top center',
                autoHide: true, autoHideDelay: 2000});
        }else{
            sendToProcessor("update", item_id, quantity);
            updateQuantity(this);
        }
      });
});

function sendToProcessor(op, item_id, new_quantity){
    var url = "/components/scripts/cart_processing.php";  
        $.ajax({
            type: "POST",
            url: url,
            data: {operation: op, id: item_id, quantity: new_quantity}
        })
        .done(function(data) {
            updateItemCount();
            calculateCart();
            data = JSON.parse(data);
            if(data.success){
               $.notify(data.message, 
                {className: "success", clickToHide: true, globalPosition: 'top center',
                autoHide: true, autoHideDelay: 2000});
            } else{
                $.notify(data.message, 
                    {className: "error", clickToHide: true, globalPosition: 'top center',
                    autoHide: true, autoHideDelay: 2000});
            }
        });
}

function updateItemCount(){
    //Once items have been changed, update the count
    $.ajax({
        type: "POST",
        url: "/components/scripts/cart_processing.php",
        data: {operation: "numItems", id: "null"}
    })
    .done(function(data){
        data = JSON.parse(data);
        $("#cart-num-items").text(data.numItems);
    });
}


/* Remove item from cart */
function removeItem(removeButton)
{
  /* Remove row from DOM  */
  var productRow = $(removeButton).parent().parent();
  productRow.slideUp(fadeTime, function() {
    productRow.remove();
  });
}

/* Update the quantity */
function updateQuantity(quantityInput)
{
  /* Calculate line price */
  var productRow = $(quantityInput).parent().parent();
  var price = parseFloat(productRow.children('.product-price').text());
  var quantity = $(quantityInput).val();
  var linePrice = price * quantity;
  
  /* Update line price display and recalc cart totals */
  productRow.children('.product-line-price').each(function () {
    $(this).fadeOut(fadeTime, function() {
      $(this).text(linePrice.toFixed(2));
      $(this).fadeIn(fadeTime);
    });
  });  
}

/* Recalculate cart */
function calculateCart()
{
  var subtotal = 0;
  
  /* Sum up row totals */
  $('.product').each(function () {
    subtotal += parseFloat($(this).children('.product-line-price').text());
  });
  
  /* Calculate totals */
  var tax = subtotal * taxRate;
  var total = subtotal + tax;
  
  /* Update totals display */
  $('.totals-value').fadeOut(fadeTime, function() {
    $('#cart-subtotal').html(subtotal.toFixed(2));
    $('#cart-tax').html(tax.toFixed(2));
    $('#cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.checkout').fadeOut(fadeTime);
    }else{
      $('.checkout').fadeIn(fadeTime);
    }
    $('.totals-value').fadeIn(fadeTime);
  });
  return total;
}
