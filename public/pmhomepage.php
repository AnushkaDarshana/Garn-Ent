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

    <!-- for In progress production  -->
    <style> 
    #clockdiv{
        font-family: sans-serif;
        color: #fff;
        display: inline-block;
        font-weight: 100;
        text-align: center;
        font-size: 30px;
    }

    #clockdiv > div{
        padding: 10px;
        border-radius: 3px;
        background: #00BF96;
        display: inline-block;
        /*margin: 1rem;*/
    }

    #clockdiv div > span{
        padding: 15px;
        border-radius: 3px;
        background: #00816A;
        display: inline-block;
    }

    .smalltext{
        padding-top: 5px;
        font-size: 16px;
    }
</style>


</head>
<body>


        <!-- Left Panel -->

        <?php include './components/pmleftNav.html'; ?>

        <!-- Header-->

        <?php include './components/topNav.html'; ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>PM Dashboard</h1>
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
<div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="row form-group col-12">
                    <div class="col-7">
                        <h4>In Progress Production Plans</h4>
                    </div>
                    <div class="col-3">
                        <button type='button' class='btn btn-primary btn-sm' onclick="window.location.href = 'production_plan_create.php'">
                            Production Plans</button>
                    </div>
                    <div class="col-2">
                        <button type='button' class='btn btn-success btn-sm' onclick="window.location.href = 'start_production_batch.php'">
                            Start Production</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="plnaInfo">

                </div>
            </div>
        </div>
    </div>

    <div class="card">
    <div class="card-header">
        <div class="row form-group col-12">
            <div class="col-7">
                <h4>In Progress Production</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div id="noPro" class="nodisplay">
            No Production In Progress
        </div>
        <div id="counter-progress" class="">
            <div>
                <div id="clockdiv" class="row" style="width: 100%; margin: 0">
                    <div class="col-12">
                        <div class="col-4">
                            <span class="hours" id="hours"></span>
                            <div class="smalltext">Hours</div>
                        </div>
                        <div class="col-4">
                            <span class="minutes" id="minutes"></span>
                            <div class="smalltext">Minutes</div>
                        </div>
                        <div class="col-4">
                            <span class="seconds" id="seconds"></span>
                            <div class="smalltext">Seconds</div>
                        </div>
                    </div>

                </div>
                <br>
                <div class="row" style="width: 100%; margin: 0">
                    <div class='progress' style="width: 100%;">
                        <div id="progressbar" class='progress-bar bg-success progress-bar-striped progress-bar-animated' role='progressbar' style='aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="row form-group col-12">
                <div class="col-9">
                    <h4>Last Completed Batches</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div>
                <table class="table superfeed-table">
                    <thead>
                    <th>Batch ID</th>
                    <th>Product Name</th>
                    <th>Manufacture Date</th>
                    <th>Status</th>
                    </thead>
                    <tbody>
                    <?php
                    include_once ('../backend/Batch.php');
                    $batchInfo = new Batch();
                    $res = $batchInfo->get_last_n_batches(3);
                    if ($res)
                    {
                        foreach ($res as $item)
                        {
                            $bufferClass = '';
                            if ($item->batchStatus == "Fail")
                            {
                                $bufferClass = 'suspend';
                            }
                            elseif ($item->batchStatus == "Pass")
                            {
                                $bufferClass = 'act';
                            }
                            echo ("<tr class='$bufferClass'>
                                    <td>$item->batchId</td>
                                    <td>$item->produtName</td>
                                    <td>$item->endTime</td>
                                    <td>$item->batchStatus</td>
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





    

</body>
</html>
