<?php
    // Start the session
    session_start();

    
    
   $userType = $_SESSION['userType'];

    // Check if the user is logged in by checking if session variables are set
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        // User is logged in.
    } else{
        // User is not logged in.
        // Store message to display as a JavaScript alert.
        echo "<script type='text/javascript'>alert('You are not logged in.');</script>";
        // Redirect to login page
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit;
    }
?>

<html>
    <head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Garn Enterprices</title>
    <meta name="description" content="Admin Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="icon" href="images/logo2.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/new.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<head>
<body>

        <!-- Left Panel -->

        <?php
            if ($userType === "admin") {
                include './components/leftNav.html';
            } elseif ($userType === "pm") {
                include './components/pmleftNav.html';
            }
            elseif ($userType === "sk") {
                include './components/skleftNav.html';
            }
        ?>

        <!-- Header-->

        <?php include './components/topNav.html'; ?>




<div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Sales Orders</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-bordered superfeed-table">
                                <thead>
                                <tr>
                                    <th>SO ID</th>
                                    <th>SO Create Date</th>
                                    <th>SO Delivery Date</th>
                                    <th>Agent</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include_once ('../backend/SalesOrder.php');
                                $itemList = new SalesOrder();
                                $result = $itemList->get_slaes_info();
                                if($result){
                                    foreach ($result as $item)
                                    {
                                        $btnDis = '';
                                        $clrDis = '';
                                        if ($item->status == 'approve')
                                        {
                                            $btnDis = 'nodisplay';
                                            $clrDis = 'act';
                                        }
                                        echo ("
                                            <tr id='ord_$item->salesOrderID' class='$clrDis'>
                                            <td>$item->salesOrderID</td>
                                            <td>$item->createDate</td>
                                            <td>$item->deliveryDate</td>
                                            <td>$item->agent</td>
                                            <td>$item->remarks</td>
                                            <td>$item->status</td>
                                            <td>
                                            <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#viewInfo' onclick='viewInfo($item->salesOrderID)' title='Product Edit'>
                                                    <i class='fa fa-flag-o'></i> View</button>");
                                        if($_SESSION['usertype'] == 'Admin')
                                        {
                                            echo ("
                                                <button type='button' class='btn btn-success btn-sm $btnDis' onclick='approveOrder($item->salesOrderID)' title='Product Reicipe'>
                                                    <i class='fa fa-check-square-o'></i> approve</button>
                                                <button type='button' class='btn btn-danger btn-sm $btnDis' onclick='rejectOrder($item->salesOrderID)' title='Product Quailty Check'>
                                                    <i class='fa fa-close'> reject</i></button>");
                                        }

                                        echo ("</td>
                                            </tr>");
                                    }
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--page content end-->
<!--order info modal start-->
<div class="modal fade" id="viewInfo" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Sales Order Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body card-block">
                                <div>
                                    <form action="product_view.php" method="post" class="form-horizontal">
                                        <div>
                                            <div class="row justify-content-md-center">
                                                <div class="col-10">
                                                    <table class="table table-bordered superfeed-table">
                                                        <tr>
                                                            <th>Product Item Code</th>
                                                            <th>Product Item Name</th>
                                                            <th>Quantity (Units)</th>
                                                        </tr>
                                                        <tbody id="productInfo">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--order info modal end-->
<?php
include_once ('footer.php');
?>
<script>
    function viewInfo(orderID)
    {
        $.get("../ajax/ajax_sales_order.php?type=get_order_info",{order_id:orderID},function (data)
        {
            if (data)
            {
                proInfo = JSON.parse(data);
                $('#productInfo').html("");
                for(var index = 0; index < proInfo.length; index++)
                {
                    $('#productInfo').append("<tr>"
                        +"<td>"+proInfo[index].itemID+"</td>"
                        +"<td>"+proInfo[index].itemName+"</td>"
                        +"<td>"+proInfo[index].itemQty+"</td>"
                        +"</tr>");
                }
            }
        });
    }
    function rejectOrder(orderID)
    {
        $.confirm({
            title: 'Confirm!',
            content: 'Order Reject Confirmation',
            buttons: {
                confirm: function () {
                    $.get("../ajax/ajax_sales_order.php?type=reject_order",{order_id:orderID},function (data)
                    {
                        if (data)
                        {
                            location.reload();
                        }
                    });
                },
                cancel: function () {
                    $.alert('Canceled');
                }
            }
        });
    }
    function approveOrder(orderID)
    {
        $.confirm({
            title: 'Confirm!',
            content: 'Order Approve Confirmation',
            buttons: {
                confirm: function () {
                    $.get("../ajax/ajax_sales_order.php?type=approve_order",{order_id:orderID},function (data)
                    {
                        if (data)
                        {
                            location.reload();
                        }
                    });
                },
                cancel: function () {
                    $.alert('Canceled');
                }
            }
        });
    }
</script>
