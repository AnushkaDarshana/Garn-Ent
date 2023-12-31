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
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
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
    <div class="breadcrumbs">
        <?$alert?>
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1> Add Quality Attributes</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">


                <form action="../src/quality_attribute_add.php" data-parsley-validate="" method="post" action="#" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                    <div class="row form-group">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Attribute</label></div>
                        <div class="col-12 col-md-7"><input type="text" required id="attributeName" name="attributeName" class="form-control" placeholder="Enter Attribute Name"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Description</label></div>
                        <div class="col-12 col-md-7"><textarea  name="attributeDes" required id="attributeDes" rows="3" placeholder="Enter Attribute Description" class="form-control"></textarea></div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Save
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>

        </div>
    </div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Quality Attributes</strong>
                        </div>
                        <div class="card-body">
                            <table class="table superfeed-table">
                                <thead>
                                <tr>
                                    <th scope="col">Attribute ID</th>
                                    <th scope="col">Attribute Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include '../config/db.php';

                                $sql = "SELECT * FROM g_quality_attribute";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                
                                    while ($row = $result->fetch_assoc()) {
                                        echo "
                                            <tr id='attr_" . $row['g_attribute_id'] . "'>
                                                <td>" . $row['g_attribute_id'] . "</td>
                                                <td>" . $row['g_attribute_name'] . "</td>
                                                <td>" . $row['g_attribute_desc'] . "</td>
                                                <td>
                                                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editInfo' onclick='editInfo(" . $row['g_attribute_id'] . ")' title='Product Edit'>
                                                            <i class='fa fa-edit'></i>
                                                        </button>
                                                        <button type='button' class='btn btn-danger btn-sm' onclick='deletePro(" . $row['g_attribute_id'] . ")' title='Product Delete'>
                                                            <i class='fa fa-trash-o'></i>
                                                        </button>
                                                    </td>
                                            </tr>
                                        ";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No attributes found.</td></tr>";
                                }
                                
                                $conn->close();
                                
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
</div>
<!--modal start-->
<div class="modal fade" id="largeModal" tabiraw_materials.phpndex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Add Quality Attribute</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body card-block">
                                <form data-parsley-validate=""  method="post" action="#" enctype="multipart/form-data" class="form-horizontal">
                                    <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Attribute Name</label></div>
                                        <div class="col-9"><input type="text" required id="qtyName" name="qtyName" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Description</label></div>
                                        <div class="col-9"><textarea required id="description" rows="3" name="description" placeholder="Enter Description" class="form-control"></textarea></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <input type="reset" class="btn btn-warning">
                                        <input type="submit" class="btn btn-primary" id="btnModaOk">
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
<!--modal end-->
<script>
    function del_qty(qtyID)
    {
        $.confirm({
            title: 'Confirm!',
            content: 'Quality Attribute Delete Confirmation',
            buttons: {
                confirm: function () {
                    $.get("../ajax/ajax_quality.php?type=del_qty_attr",{qtyID:qtyID},function (data)
                    {
                        if (data == '111')
                        {
                            $.alert('Data Deleted is Success!');
                            $('#qty_'+qtyID).hide();
                        }
                        else{
                            $.alert('Something went wrong. Data didn\'t Delete!');
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
