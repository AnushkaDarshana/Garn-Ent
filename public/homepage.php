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

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Admin Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
    <div class="col-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-users text-success border-success"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Total Number of Employees</div>
                                <div class="stat-digit">
                                    0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="view_user_list.php">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-user text-success border-success"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Total Number of Active Users</div>
                                <div class="stat-digit">
                                    0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="view_user_list.php">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-users text-success border-success"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Total Number of Online Users</div>
                                <div class="stat-digit" id="onlineUser">
                                    0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-cogs text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">In progress production</div>
                            <div class="stat-digit">
                                0
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="sales_order_view.php">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-truck text-success border-success"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Pending Sales Orders</div>
                                <div class="stat-digit">
                                    0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="order_view.php">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-shopping-cart text-success border-success"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Pending Purchase Order</div>
                                <div class="stat-digit">
                                    0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">Finish Product Stock</h4>
                <canvas id="barChartFinishPro"></canvas>
                adminhome.PNG
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">Raw Material Stock</h4>
                <canvas id="barChartRowStock"></canvas>
            </div>
        </div>
    </div>
</div>






    

</body>
</html>
