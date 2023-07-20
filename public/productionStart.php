<?php
include_once ('permission_log.php');
if ($_SESSION['usertype'] == 'storeKeeper' || $_SESSION['usertype'] == 'qualityManager')
{
    header('Location:errorpage/error.php?errorId=1001');
}
include_once ($head);
?>

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





<!--page content start-->
<div class="col-lg-12 nodisplay" id="startProduct">
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show nodisplay" id="stockAlertdiv">
            <h4><b>Warning !!</b></h4>
            <div>Exceed current stock (or reorder level).</div>
            <div id="stockAlert"></div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-header">
                <strong>Start Production Batch</strong>
            </div>
        </div>
        <div class="card-body card-block">
            <div action="" data-parsley-validate="" method="post" action="#" enctype="multipart/form-data" class="form-horizontal">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Select Production Plan</label></div>
                        <div class="col-12 col-md-7">
                            <select id="ProPlan" name="proPlan" class="form-control" onchange="fillData()">
                                <option>Select Catagory</option>
                                <?php
                                include_once ('../backend/ProductPlan.php');
                                $plan = new ProductPlan();
                                $result = $plan->get_all_production_info_incom();

                                foreach ($result as $item)
                                {
                                    echo
                                    ("
                                        <option value='$item->planID'>$item->planName</option>
                                    ");
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
<!--                    <div>-->
<!--                        <input type="button" onclick="test()">-->
<!--                    </div>-->
                    <div class=" row justify-content-lg-center">
                        <div class="col-8">
                            <table class="table superfeed-table table-active table-bordered nodisplay" id="proTable">
                                <thead>
                                    <th>Product</th>
                                    <th>Target Quantity (Units)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="proDuctInfo" class="">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--in progress window start-->
<div class="col-lg-12 nodisplay" id="inProgress">
    <div class="card">
        <div class="card-header">
            <div class="card-header">
                <strong>Production In Progress</strong>
            </div>
        </div>
        <div class="card-body card-block" id="startProduct">
            <div>
                <table class="table superfeed-table">
                    <thead>
                        <th>#Product Plan ID</th>
                        <th>Plan Name</th>
                        <th>Product Name</th>
                        <th>Target Quantity (Units)</th>
                        <th>Production Started Time</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="progressInfo">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--in progress window end-->
<!--page content end-->
<!--product recipe modal start-->
<div class="modal fade" id="recInfo" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Product Recipe</h5>
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
                                            <div class="row form-group">
                                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Recipe Name</label></div>
                                                <div class="col-12 col-md-7"><input readonly type="text" id="recName" name="recName" placeholder="Enter Unit Price" class="form-control"></div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Recipe Description</label></div>
                                                <div class="col-12 col-md-7"><textarea readonly type="text" id="recDescription" name="recDescription" placeholder="Enter Unit Price" class="form-control"></textarea></div>
                                            </div>
                                            <div class="row form-group nodisplay">
                                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product ID</label></div>
                                                <div class="col-12 col-md-7"><input readonly type="text" id="proIdModal" name="proIdModal" class="form-control"></div>
                                            </div>
                                            <div class="row form-group nodisplay">
                                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Target</label></div>
                                                <div class="col-12 col-md-7"><input readonly type="text" id="proTarget" name="proTarget" class="form-control"></div>
                                            </div>
                                            <div class="row justify-content-md-center">
                                                <div class="col-10">
                                                    <table class="table superfeed-table table-bordered">
                                                        <tr>
                                                            <th>Raw Name</th>
                                                            <th>Type</th>
                                                            <th>Raw Quanity</th>
                                                        </tr>
                                                        <tbody id="productRawDeatils">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" onclick="startPro()" data-dismiss="modal" id="startpro"><i class="fa fa-gears"></i> Start Production</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
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
<!--product recipe modal end-->
<!--finished production modal start-->
<div class="modal fade" id="finPro" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Finish Product</h5>
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
                                    <div>
                                        <div>
                                            <div>
                                                <div>
                                                    <table class="table">
                                                        <thead>
                                                        <th>Product Name</th>
                                                        <th>Target Quantity (Units)</th>
                                                        <th>Finished Quantity (Units)</th>
                                                        <th>Difference</th>
                                                        </thead>
                                                        <tbody id="finProBody">
                                                        <tr>
                                                            <td><input type="text" readonly class="form-control" id="proName" name="proName"></td>
                                                            <td><input type="text" readonly class="form-control" id="target" name="target"></td>
                                                            <td><input type="text"  class="form-control" onblur="filDifference()" id="finQty" name="finQty"></td>
                                                            <td><input type="text" readonly  class="form-control" id="difference" name="difference"></td>
                                                            <td><input type="text" readonly hidden   class="form-control" id="batchId" name="batchId"></td>
                                                            <td><input type="text" readonly hidden   class="form-control" id="planID" name="planID"></td>
                                                            <td><input type="text" readonly hidden class="form-control" id="proID" name="proID"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                    <div>
                                                        <hr>
                                                    </div>
                                                    <div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Remarks</label></div>
                                                            <div class="col-12 col-md-7"><textarea  name="remarks" id="remarks" rows="3" placeholder="Enter here..." class="form-control"></textarea></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" onclick="finishProduct()" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check-circle-o"></i> Finish Production</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--finished production modal end-->
<?php
include_once ("footer.php");
?>
<script>

    //window onlaod
    $( document ).ready(function() {
        reordercheck();
    });
//    view products in production plan
    function fillData()
    {
        planID = $("#ProPlan").val();
        $("#proTable").removeClass("nodisplay");
        $("#proDuctInfo").html("");
        $.get("../ajax/ajax_production_plan.php?type=view_products",{plan_id:planID},function (data)
        {
            if (data)
            {
                proInfo = JSON.parse(data);
                for(var index = 0; index < proInfo.length; index++)
                {
                    if ((proInfo[index].productStatus) == "Completed")
                    {
                        $('#proDuctInfo').append("<tr>"
                            +"<td>"+proInfo[index].productName+"</td>"
                            +"<td>"+proInfo[index].productQty+"</td>"
                            +"<td>"+proInfo[index].productStatus+"</td>"
                            +"<td><button type='button' class='btn btn-success btn-sm disabled'><i class='fa fa-check-square-o'></i> Completed</button></td>"
                            +"</tr>");
                    }
                    else if ((proInfo[index].productStatus) == "In Progress")
                    {
                        $('#proDuctInfo').append("<tr>"
                            +"<td>"+proInfo[index].productName+"</td>"
                            +"<td>"+proInfo[index].productQty+"</td>"
                            +"<td>"+proInfo[index].productStatus+"</td>"
                            +"<td><button type='button' class='btn btn-warning btn-sm disabled'><i class='fa fa-gears'></i> In Progress</button></td>"
                            +"</tr>");
                    }
                    else
                    {
                        $('#proDuctInfo').append("<tr>"
                            +"<td>"+proInfo[index].productName+"</td>"
                            +"<td>"+proInfo[index].productQty+"</td>"
                            +"<td>"+proInfo[index].productStatus+"</td>"
                            +"<td><button type='button' data-toggle='modal' data-target='#recInfo' onclick='viewReicpe("+proInfo[index].productId+","+proInfo[index].productQty+","+proInfo[index].unitweight+")' class='btn btn-primary btn-sm'><i class='fa fa-bolt'></i> Start Production</button></td>"
                            +"</tr>");
                    }
                }

            }
        });
    }
//    view product recipe
    function viewReicpe(proID,proQty,proUnit)
    {
        $.get("../ajax/ajax_product_recipe.php?type=get_pro_recipe",{pro_id:proID},function (data)
        {
            if (data)
            {
                resInfo = JSON.parse(data);
                $("#recName").val(resInfo[0].recipeName);
                $("#recDescription").val(resInfo[0].recipeDescription);
                $('#productRawDeatils').html("");
                var testArr = [];
                for(var index = 0; index < resInfo.length; index++)
                {
                    $('#productRawDeatils').append("<tr>"
                        +"<td>"+resInfo[index].rawName+"</td>"
                        +"<td>"+resInfo[index].rawType+"</td>"
                        +"<td>"+resInfo[index].rawQty * proQty * proUnit+"</td>"
                        +"</tr>");

                    testArr.push(resInfo[index].reorderstatus);

                }

                if(testArr.includes(0)){

                    $('#startpro').attr('disabled','disabled').button('refresh');
                }
                else{
                    $('#startpro').removeAttr('disabled').button('refresh');
                }
                $("#proIdModal").val(proID);
                $("#proTarget").val(proQty);
            }
        });
    }
//    start production
    function startPro()
    {
        proID = $("#proIdModal").val();
        planID = $("#ProPlan").val();
        proTarget = $("#proTarget").val();
//        alert(proTarget);
        $.get("../ajax/ajax_product_recipe.php?type=update_batch_status",{pro_id:proID,plan_id:planID,pro_target:proTarget},function (data)
        {
            if (data)
            {
                location.reload(true);
            }
        });
    }
    window.onload = function()
    {
        $.get("../ajax/ajax_product_recipe.php?type=check_batch_status",function (data)
        {
            if (data == 0)
            {
                $("#startProduct").removeClass("nodisplay");
            }
            else{

                $("#inProgress").removeClass("nodisplay");
                proInf = JSON.parse(data);
                $('#progressInfo').append("<tr>"
                    +"<td>"+proInf.planID+"</td>"
                    +"<td>"+proInf.planName+"</td>"
                    +"<td>"+proInf.productName+"</td>"
                    +"<td>"+proInf.target+"</td>"
                    +"<td>"+proInf.startedTime+"</td>"
                    +"<td><button type='button' onclick='fillFinPro()' data-toggle='modal' data-target='#finPro' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i> Finish Production</button> " +
                    "<button type='button' class='btn btn-danger btn-sm'><i class='fa fa-close'></i> Cancel</button>" +
                    "</td>"
                    +"</tr>");
            }
        });
    }
    //get final product info modal
    function fillFinPro()
    {
        $("#difference").val("");
        $("#finQty").val("");
        $.get("../ajax/ajax_product_recipe.php?type=check_batch_status",function (data)
        {
            if (data)
            {
                proInfo = JSON.parse(data);
                $("#proName").val(proInf.productName);
                $("#target").val(proInf.target);
                $("#planID").val(proInf.planID);
                $("#proID").val(proInf.proID);
            }
        });
        $.get("../ajax/ajax_product_recipe.php?type=get_last_add_batch",function (data)
        {
            if (data)
            {
                batchInfo = JSON.parse(data);
                $("#batchId").val(batchInfo.batchId);
            }
        });
    }
//    fill difference valu in modal
    function filDifference()
    {
        finVal = $("#finQty").val();
        tarval = $("#target").val();
        if (tarval >= finVal)
        {
            $("#difference").val(tarval - finVal);
        }
        else
        {
            $.alert("Finish Quantity Cannot be Greater Than Target Quantity");
        }
    }
//    finish product
    function finishProduct()
    {
        planID = $("#planID").val();
        proID = $("#proID").val();
        batchID = $("#batchId").val();
        remarks = $("#remarks").val();
        finQty = $("#finQty").val();

        $.get("../ajax/ajax_product_recipe.php?type=finish_product",{
            plan_id : planID,
            pro_id : proID,
            batch_id : batchID,
            remarks : remarks,
            fin_qty : finQty
        },function (data)
        {
            if (data == 1)
            {
                location.reload(true);
            }
        });
    }

    function reordercheck() {
        $.get("../ajax/ajax_product_recipe.php?type=reordercheck",function (data)
        {
            if (data)
            {
                var reorderData = JSON.parse(data);
                $('#stockAlert').html('');
                console.log(reorderData);
                for(var item in reorderData){
                    console.log(item);
                    if(parseInt(reorderData[item].reorderStatus) == 0){
                        console.log('s')
                        $('#stockAlertdiv').removeClass('nodisplay');
                        $('#stockAlert').append("<p>"+reorderData[item].rawname+" in hand stock is "+reorderData[item].currentstock+" and the its re-order level is "+reorderData[item].reorderlevel+"</p>");
                    }
                }

            }
        });
    }
</script>