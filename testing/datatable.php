<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/components/header.php");
session_start();
?>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>

<div class="jumbotron">
    <h1 class="display-4">Orders</h1>
</div>

<div class="container" style="padding-top: 40px; padding-bottom: 100px">
    <table id="orders" class="table table-striped table-bordered dt-responsive hover" style="width:100%">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Delivery Address</th>
                    <th>Status</th>
                    <th>Time</th>
                </tr>
            </thead>
    </table>
</div>

<?php
include_once("../components/footer.php");
?>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript" src="socket.io.js"></script>
<script type="text/javascript" src ="jquery.jeditable.min.js"></script>
<script>
    $(document).ready(function() {
        var socket = io('http://localhost:3000');
        var data = null;
        var orderTable = $('#orders').DataTable({
            responsive: true,
            select: true,
            autoWidth: true,
            columns: [
                {data: "id"},
                {data: "firstname"},
                {data: "delivery_address"},
                {data: "status", className: "status-edit text-center"},
                {data: "datetime"},
            ]
        });
        socket.emit('getOrderData');
        socket.on('orderData', function(orders){
            orders = JSON.parse(orders);
            for(x in orders){
                switch(orders[x].status){
                    case "Placed":
                        orders[x].status = '<h3><span class="badge badge-danger">Placed</span></h3>';
                        break;
                    case "Accepted":
                        orders[x].status = '<h3><span class="badge badge-warning">Accepted</span></h3>';
                        break;
                    case "Ready":
                        orders[x].status = '<h3><span class="badge badge-success">Ready</span></h3>';
                        break;
                    case "Delivered":
                        orders[x].status = '<h3><span class="badge badge-dark">Delivered</span></h4>';
                        break;
                }
            }
            orderTable.clear();
            orderTable.rows.add(orders);
            orderTable.draw();
            $('.status-edit').editable('status_processing.php', {
                indicator : '<span class="fa fa-spinner"></span?',
                type: 'select',
                data   : '{"Ready":"Ready","Placed":"Placed","Accepted":"Accepted", "Delivered":"Delivered", "selected":"Delivered"}',
                style: 'inherit',
                submitdata: function(){
                    var orderID = orderTable.rows( { selected: true } ).data()[0]['id'];
                    return {id: orderID};
                },
                callback: function(){
                    socket.emit('getOrderData');
                }
            });
        });
    });
</script>