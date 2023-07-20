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
                            <strong class="card-title">Dispatch Orders</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-bordered superfeed-table">
                                <thead>
                                <tr>
                                    <th>DO ID</th>
                                    <th>Invoice No</th>
                                    <th>DO Create Date</th>
                                    <th>DO Invoice Date</th>
                                    <th>Agent</th>
                                    <th>Tax (LKR)</th>
                                    <th>Net Total (LKR)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include_once ('../backend/Dispatch.php');
                                $itemList = new Dispatch();
                                $result = $itemList->get_all_dispatch();
                                if ($result)
                                {
                                    foreach ($result as $item)
                                    {

                                        echo ("
                                            <tr id='ord_$item->dispatchId'>
                                            <td>$item->dispatchId</td>
                                            <td>$item->invoiceNum</td>
                                            <td>$item->date</td>
                                            <td>$item->invoDate</td>
                                            <td>$item->agentName</td>
                                            <td>$item->tax</td>
                                            <td>$item->netTot</td>
                                            <td>
                                            <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#viewInfo' onclick='viewInfo($item->dispatchId)'  title='Product Edit'>
                                                    <i class='fa fa-flag-o'></i> View</button>");

                                        echo ("</td>
                                            </tr>");
                                    }
                                }
                                else
                                {

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
                                                            <th>Product Name</th>
                                                            <th>Quantity (Uts)</th>
                                                            <th>Discount (LKR)</th>
                                                            <th>Total Price (LKR)</th>
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
    function viewInfo(id)
    {
        $.get("../ajax/ajax_sales_order.php?type=dispatchorderlist",{id:id},function (data)
        {
            if (data)
            {
                proInfo = JSON.parse(data);
                $('#productInfo').html("");
                for(var index = 0; index < proInfo.length; index++)
                {
                    $('#productInfo').append("<tr>"
                        +"<td>"+proInfo[index].itemName+"</td>"
                        +"<td>"+proInfo[index].quantity+"</td>"
                        +"<td>"+proInfo[index].discount+"</td>"
                        +"<td>"+proInfo[index].totalprice+"</td>"
                        +"</tr>");
                }
            }
        });
    }
</script>
