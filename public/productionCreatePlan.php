<?php
include_once ('permission_log.php');
if ($_SESSION['usertype'] == 'storeKeeper' || $_SESSION['usertype'] == 'qualityManager')
{
    header('Location:errorpage/error.php?errorId=1001');
}
include_once ($head);

include_once ('../backend/ProductPlan.php');
include_once ('../backend/ProductPlanItemList.php');

if (isset($_POST['productiondate']))
{
    if($_POST['ran'] == $_SESSION['rand'])
    {
        $newPlan = new ProductPlan();

        $newPlan->planName = $_POST['planName'];
        $newPlan->startDate = $_POST['productiondate'];

        $planID = $newPlan->add_product_plan();

        $planList = new ProductPlanItemList();
        $x = 0;
        foreach ($_POST['productCodeList'] as $item)
        {
            $planList->planIdFK = $planID;
            $planList->productId = $_POST['productCodeList'][$x];
            $planList->productQty = $_POST['proQtyList'][$x];

            $planList->add_product_list();
            $x++;
        }
    }
}
$random = rand(0,100000);
$_SESSION['rand']= $random;
?>
<!--page content start-->

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

                include './components/pmleftNav.html';

        ?>

        <!-- Header-->

        <?php include './components/topNav.html'; ?>





<div>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Create Production Plan</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <div><button type="button" data-toggle="modal" data-target="#planCreateModal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Create Plan</button> </div>
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
                            <strong class="card-title">Current Production Plans</strong>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table superfeed-table" id="proInfoTab">
                                    <thead>
                                    <tr>
                                        <div><th>Plan ID</th></div>
                                        <div><th>Plan Name</th></div>
                                        <div><th>Create Date</th></div>
                                        <div><th>Start Date</th></div>
                                        <div><th>Status</th></div>
                                        <div><th>Action</th></div>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $planList = new ProductPlan();
                                        $result = $planList->get_all_production_info();
                                        if ($result)
                                        {

                                            foreach ($result as $item)
                                            {
                                                $dis = '';
                                                if(($item->finishPercentage > 0) || $item->check == $item->planID ){
                                                    $dis = 'disabled';
                                                }
                                                else{
                                                    $dis = '';
                                                }
                                                echo ("
                                                <tr id='plan_$item->planID'>
                                                <td>$item->planID</td>
                                                <td>$item->planName</td>
                                                <td>$item->planDate</td>
                                                <td>$item->startDate</td>
                                                <td>
                                                    <div class='progress'>
                                                        <div class='progress-bar progress-bar-success' role='progressbar'
                                                           aria-valuemin='0' aria-valuemax='100' style='width:$item->finishPercentage%'> 
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type='button' data-toggle='modal' data-target='#planTarget' class='btn btn-success btn-sm' onclick='planTarget($item->planID)' title='View Plan Targets'>
                                                    <i class='fa fa-arrows'></i> Target</button>
                                                    <button type='button'  class='btn btn-danger btn-sm' onclick='deletePlan($item->planID)' title='Plan Delete' $dis>
                                                    <i class='fa fa-trash-o'></i> Delete</button>
                                                </td>
                                                </tr>
                                            ");
                                            }
                                        }
                                        else
                                        {
                                            echo "<script>";
                                            echo "$('#proInfoTab').addClass('nodisplay');";
                                            echo "</script>";
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
</div>
<!--page content end-->
<!--production plan create modal start-->
<div class="modal fade" id="planCreateModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Create Production Plan</h5>
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
                                    <form action="production_plan_create.php" method="post" class="form-horizontal">
                                        <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Plan Name</label></div>
                                            <div class="col-6"><input type="text" id="planName"required name="planName" placeholder="Enter Plan Name" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Plan Create Date</label></div>
                                            <div class="col-6"><input readonly type="text" id="planCreateDate" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-3"><label for="text-input" class=" form-control-label">Production Date</label></div>
                                            <div class="col-6"><input  type="date" required name="productiondate" id="productiondate" class="form-control"></div>
                                        </div>
                                        <div>
                                            <table class="table superfeed-table">
                                                <thead>
                                                    <tr>
                                                        <div><th>Product Name</th></div>
                                                        <div><th>Quantity (Units)</th></div>
                                                        <div><th></th></div>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="col-12">
                                                    <td >
                                                        <div class="col-12">
                                                            <select id="products"  name="products" class="form-control">
                                                                <option>Select Product</option>
                                                                <?php
                                                                include_once ('../backend/Product.php');
                                                                $pro = new Product();
                                                                $result = $pro->view_product();

                                                                foreach ($result as $item)
                                                                {
                                                                    echo
                                                                    ("
                                                                <option value='$item->productId'>$item->productName</option>
                                                                ");
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td><div class="col-12"><input  type="text" id="proQty" class="form-control"></div></td>
                                                    <td><div class="col-12"><button type="button" class="btn btn-primary" onclick="addProducts()"><i class="fa fa-plus"></i> Add Item</button></div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div>
                                            <table class="table superfeed-table">
                                                <thead>
                                                <tr>
                                                    <div><th></th></div>
                                                    <div><th>Product Name</th></div>
                                                    <div><th>Quantity (Units)</th></div>
                                                    <div><th>Action</th></div>
                                                </tr>
                                                </thead>
                                                <tbody id="productInfo">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <input type="reset" class="btn btn-warning">
                                            <input type="submit" class="btn btn-primary" id="btnModaOk" value="Save">
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
<!--production plan create modal end-->
<!--production target modal start-->
<div class="modal fade" id="planTarget" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Plan Target</h5>
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
                                    <table class="table superfeed-table">
                                        <thead>
                                            <th>Product Name</th>
                                            <th>Quantity (Units)</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody id="tarInfo">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--production target modal end-->
<?php
include_once ("footer.php");
?>
<script>
//    get plan date********************************************************************************
    var planDate = new Date(Date.now());
    var year = planDate.getFullYear();
    var month = planDate.getMonth();
    var date = planDate.getDate();
    $("#planCreateDate").val((month+1) + "/" + date + "/" + year);
//validate date*************************************************************************************
    today = new Date().toISOString().split('T')[0];
    document.getElementById("productiondate").setAttribute('min', today);
//    append data to the table*************************************************************************
    function addProducts()
    {
        $("#productInfo").append("<tr id='pro_"+$("#products :selected").val()+"'>" +
            "<td><input type='text' readonly hidden class='form-control' id='productCodeList' name='productCodeList[]' value='"+$("#products :selected").val()+"'></td>" +
            "<td><input type='text' readonly class='form-control' id='productNameList' name='productNameList[]' value='"+$("#products :selected").text()+"'></td>" +
            "<td><input type='text' readonly class='form-control' id='proQtyList' name='proQtyList[]' value='"+$("#proQty").val()+"'></td>" +
            "<td><button type='button' class='btn btn-danger  btn-block' onclick='delItem("+$("#products :selected").val()+")'><i class='fa fa-minus-circle'></i></button></td>" +
            "</tr>");
        $("#products").val("Select Product");
        $("#proQty").val("");
    }
//    view production plan items*************************************************************************
    function planTarget(planId)
    {
        $('#tarInfo').html("");
        $.get("../ajax/ajax_production_plan.php?type=view_products",{plan_id:planId},function (data)
        {
            if (data)
            {
                proInfo = JSON.parse(data);
                for(var index = 0; index < proInfo.length; index++)
                {
                    $('#tarInfo').append("<tr>"
                        +"<td>"+proInfo[index].productName+"</td>"
                        +"<td>"+proInfo[index].productQty+"</td>"
                        +"<td>"+proInfo[index].productStatus+"</td>"
                        +"</tr>");
                }

            }
        });
    }
    function deletePlan(planID)
    {
        $.confirm({
            title: 'Confirm!',
            content: 'Prodution Plan Delete Confirmation',
            buttons: {
                confirm: function () {
                    $.get("../ajax/ajax_production_plan.php?type=delete_plan",{plan_id:planID},function (data)
                    {
                        if (data)
                        {
                            $('#plan_'+planID).hide();
                            $.alert('Data Deleted is Success!');
                        }
                        else
                        {
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
//    auto complete***************************************************************************
var options = {
    url: function(phrase) {
        return "../ajax/ajax_auto.php?type=getProName&phrase=" + phrase + "&format=json";
    },

    getValue: "proName",


    list: {

        onSelectItemEvent: function() {
            //var value = $("#name.").getSelectedItemData().name;
            var value = $("#productName").getSelectedItemData().proId;

            $("#proCode").val(value);
        }
    }        };

$("#productName").easyAutocomplete(options);

    function test()
    {
      $("#proInfoTab").addClass('nodisplay');
    }

    function delItem(productId)
    {
        $('#pro_'+productId).remove();
    }
</script>