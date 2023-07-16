<!doctype html>
<?php
    // Start the session
    session_start();

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
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Garn Enterprices</title>
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
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->

        <?php include './components/leftNav.html'; ?>

        <!-- Header-->

        <?php include './components/topNav.html'; ?>
        
<div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Good Receive Notes</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-bordered superfeed-table">
                                <thead>
                                <tr>
                                    <th>GRN ID</th>
                                    <th>Supplier Name</th>
                                    <th>Issue Date</th>
                                    <th>Invoice ID</th>
                                    <th>Invoice Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include_once ('../backend/GRN.php');
                                $itemList = new GRN();
                                $result = $itemList->get_all_grn();
                                if($result){
                                    foreach ($result as $item)
                                    {
                                        echo ("
                                            <tr id='ord_$item->grn_id'>
                                            <td>$item->grn_id</td>
                                            <td>$item->grn_supplier_name</td>
                                            <td>$item->grn_issuedDate</td>
                                            <td>$item->grn_invoice_id</td>
                                            <td>$item->grn_invoice_date</td>
                                            <td>
                                                <button type='button' data-toggle='modal' data-target='#viewInfo' class='btn btn-primary btn-sm' onclick='getItems($item->grn_id)' title='GRN Items'>
                                                    <i class='fa fa-magic'></i> Items</button>
                                            </td>
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
<div class="modal fade" id="viewInfo" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">GRN Items</h5>
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
                                                            <th>Item Name</th>
                                                            <th>Unit Type</th>
                                                            <th>Quantity (Units)</th>
                                                            <th>Price (LKR)</th>
                                                            <th>Expire Date</th>
                                                        </tr>
                                                        <tbody id="grnInfo">

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
<?php
include_once ('footer.php');
?>
<script>
    function getItems(grnID)
    {
        $('#grnInfo').html("");
        $.get("../ajax/ajax_grn.php?type=grn_info",{grn_id:grnID},function (data)
        {
            if (data)
            {
                item = JSON.parse(data);
                for(var index = 0; index < item.length; index++)
                {
                    $('#grnInfo').append("<tr>"
                        +"<td>"+item[index].item_name+"</td>"
                        +"<td>"+item[index].unitType+"</td>"
                        +"<td>"+item[index].item_quntity+"</td>"
                        +"<td>"+item[index].item_totalPrice+"</td>"
                        +"<td>"+item[index].grnOrder_exdate+"</td>"
                        +"</tr>");
                }
            }
        });
    }
</script>
