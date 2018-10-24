<?php
$root = $_SERVER['DOCUMENT_ROOT'];

if(isset($_POST['operation']) && isset($_POST['id'])){
    session_start();
    include_once("$root/components/scripts/functions.php");
    $operation = mysqli_real_escape_string($db, $_POST['operation']);
    $id = mysqli_real_escape_string($db, $_POST['id']);
    //Variable to hold response
    $data = array();
    if($operation == "numItems"){
        $numItems = (string) $cart->getTotalItem();
        $result['numItems'] = $numItems;
        echo json_encode($result);
        exit();
    }
    //Check if product exists
    $result = findProductWithID($id);
    $numRows = mysqli_num_rows($result);
    if($numRows < 1){
        $data['success'] = false;
        $data['message'] = "Invalid product ID";
        echo json_encode($data);
        exit();
    }else{
        $item = mysqli_fetch_assoc($result);
    }
    if($operation == "add"){
        //Add product to cart
        $price = $item['price'];
        $cart->add($id, 1, [
            'name' => $item['item'],
            'price' => $item['price'],
            'type' => $item['type'],
        ]);
        $data['success'] = true;
        $data['message'] = "Item successfully added to cart.";
    }elseif($operation == "remove"){
        //Remove item from cart
        $cart->remove($id);
        $data['success'] = true;
        $data['message'] = "Item successfully removed from cart";
    }elseif($operation == "update"){
        //Update item
        if(isset($_POST['quantity'])){
            $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
            $cart->update($id, $quantity, [
                'name' => $item['item'],
                'price' => $item['price'],
                'type' => $item['type'],
            ]);
            $data['success'] = true;
            $data['message'] = "Item quantity successfully updated";
        }else{
            $data['success'] = false;
            $data['message'] = "Unable to update the item";
        } 
    }else{
        $data['success'] = false;
        $data['message'] = "Invalid operation";
    }
    echo json_encode($data);
}else{
    //Send user back if they reached accidentally
    header("Location: $root/index.php");
    exit();
}