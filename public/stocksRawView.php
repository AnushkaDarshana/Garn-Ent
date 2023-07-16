<html>
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
    <link rel="stylesheet" href="assets/css/new.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<head>
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
                            <strong class="card-title">Current Raw Material Stock</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-bordered superfeed-table">
                                <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Raw Material Name</th>
                                    <th>In Hand Quantity (Units)</th>
                                    <th>Buffer Level (Units)</th>
                                    <th>Last Update Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include_once ('../backend/RowStock.php');
                                $itemList = new RowStock();
                                $result = $itemList->get_currentStock();
                                foreach ($result as $item)
                                {
                                    $bufferClass = 'act';
                                    if($item->stock_status === 'false'){
                                        $bufferClass = 'suspend';
                                    }
                                    echo ("
                                            <tr id='pro_$item->rawID' class='$bufferClass'>
                                            <td>$item->rawID</td>
                                            <td>$item->stock_item_name</td>
                                            <td id='hand_$item->rawID'>$item->currenTotal</td>
                                            <td id='buff_$item->rawID'>$item->stock_reOrder</td>
                                            <td>$item->stock_logDate</td>
                                            </tr>");
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
<?php
include_once ('footer.php');
?>
<script>

</script>
