<?php
$root = $_SERVER['DOCUMENT_ROOT'];

//Globals
$taxRate = 0.05;


if(isset($_POST['orderSubmit'])){
    session_start();
    include_once("$root/components/scripts/server.php");
    include_once("$root/components/scripts/functions.php");

    //Variable to hold response
    $data = array();

    //Get all values from cart
    if(!$cart->isEmpty()){
        $subtotal = number_format($cart->getAttributeTotal('price'), 2);
        $tax = number_format($subtotal * $taxRate, 2);
        $total = number_format($subtotal + $tax, 2);

        //Process Payment

        //Get nonce from client
        $nonceFromTheClient = $_POST["payment_method_nonce"];
        //Make the payment
        $result = $gateway->transaction()->sale([
        'amount' => "$total",
        'paymentMethodNonce' => $nonceFromTheClient,
        'options' => [
            'submitForSettlement' => True
        ]
        ]);
        if(!$result->success){
            $data['success'] = false;
            $data['message'] = "There was a problem with the payment.";
        }else{
            //Insert order into database
            $u_id = $_SESSION['u_id'];
            $delivery_address = $_SESSION['deliveryAddress'];
            $sql = "INSERT INTO orders (customer_id, subtotal, tax, total, delivery_address) VALUES ('$u_id', '$subtotal',
                                    '$tax', '$total', '$delivery_address')";
            mysqli_query($db, $sql);
            //Insert items into database
            $order_id = mysqli_insert_id($db);
            $allItems = $cart->getItems();
            foreach ($allItems as $id => $items) {
                foreach ($items as $item) {
                    $item_id = $item['id'];
                    $quantity = $item['quantity'];
                    $sql = "INSERT INTO order_items (order_id, product_id, quantity) 
                            VALUES ('$order_id', '$item_id', '$quantity')";
                    mysqli_query($db, $sql);
                }
            }
            $data['success'] = true;
            $data['message'] = "Order has been placed successfully!";
        }
    }else{
        $data['success'] = false;
        $data['message'] = "Shopping cart is empty";
    }
    echo json_encode($data);
}else{
    //Send user back if they reached accidentally
    header("Location: $root/index.php");
    exit();
}