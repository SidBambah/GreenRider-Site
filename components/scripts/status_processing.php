<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include_once("$root/components/scripts/functions.php");


$status = mysqli_real_escape_string($db, $_POST['value']);
$id = mysqli_real_escape_string($db, $_POST['id']);

$result = findOrderWithID($id);
$numRows= mysqli_num_rows($result);
if($numRows == 1){
    $sql = "UPDATE orders SET status='$status' WHERE id='$id'";
    mysqli_query($db, $sql);
}