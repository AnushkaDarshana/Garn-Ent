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
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Product Categories</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Product Categories</strong>
                        </div>
                        <div class="card-body">
                            <table class="table superfeed-table">
                                <thead>
                                <tr>
                                    <th scope="col">Catagory ID</th>
                                    <th scope="col">Catagory Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include '../config/db.php';
                                $sql = "SELECT * FROM g_product_catagory";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Display the product categories in the table
                                    while ($row = $result->fetch_assoc()) {
                                        $dis = '';
                                        echo "<tr id='cat_" . $row['catagory_id'] . "'>";
                                        echo "<td>" . $row['catagory_id'] . "</td>";
                                        echo "<td>" . $row['catagory_name'] . "</td>";
                                        echo "<td>" . $row['catagory_description'] . "</td>";
                                        echo "<td>";
                                        echo "<button type='button' class='btn btn-danger btn-sm' onclick='del_cat(" . $row['catagory_id'] . ")' $dis>";
                                        echo "<i class='fa fa-times-circle'></i> Delete</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    // No product categories found
                                    echo "<tr><td colspan='4'>No product categories found.</td></tr>";
                                }
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
<?php
// include_once ("footer.php");
?>
<script>
    function del_cat(catID)
    {
        $.confirm({
            title: 'Confirm!',
            content: 'Data Delete Confirmation',
            buttons: {
                confirm: function () {
                    $.get("../ajax/ajax_product_catagory.php?type=cat_delete",{cat_id:catID},function (data)
                    {
                        if (data == 1)
                        {
                            $.alert('Data Deleted is Success!');
                            $('#cat_'+catID).hide();
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
