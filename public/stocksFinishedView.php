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
                            <strong class="card-title">Finish Stock</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-bordered superfeed-table">
                                <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Product Name</th>
                                    <th>Unit Weight (kg)</th>
                                    <th>In Hand Quantity (Units)</th>
                                    <th>Buffer Level (Units)</th>
                                    <th>Last Update Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include_once ('../backend/FinishStock.php');
                                        $itemList = new FinishStock();
                                        $result = $itemList->get_finish_stock_all_item();
                                        if($result){
                                            foreach ($result as $item)
                                            {
                                                $bufferClass = 'act';
                                                if($item->bufferStatus === 'false'){
                                                    $bufferClass = 'suspend';
                                                }
                                                echo ("
                                            <tr id='pro_$item->itemID' class='$bufferClass'>
                                            <td>$item->itemID</td>
                                            <td>$item->itemName</td>
                                            <td>$item->unitWeight</td>
                                            <td id='hand_$item->itemID'>$item->itemInHand</td>
                                            <td id='buff_$item->itemID'>$item->bufferLevel</td>
                                            <td>$item->date</td>
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
<?php
include_once ('footer.php');
?>
<script>

</script>
