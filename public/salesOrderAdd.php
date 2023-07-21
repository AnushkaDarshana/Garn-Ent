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
            elseif ($userType === "sk") {
                include './components/skleftNav.html';
            }
        ?>

        <!-- Header-->

        <?php include './components/topNav.html'; ?>



<?php
include_once ('permission_log.php');
if ($_SESSION['usertype'] == 'storeKeeper' || $_SESSION['usertype'] == 'qualityManager')
{
    header('Location:errorpage/error.php?errorId=1001');
}
include_once ($head);
include_once ('../backend/SalesOrder.php');
include_once ('../backend/SalesOrderItemList.php');
$alert = "";

if (isset($_POST['remarks']))
{
    if ($_SESSION['ranVal'] == $_POST['ranVal'])
    {
        $newSales = new SalesOrder();

        $newSales->deliveryDate = $_POST['deliveryDate'];
        $newSales->remarks = $_POST['remarks'];
        $newSales->agent = $_POST['ageName'];

        $salesOrderID = $newSales->add_sales_order();

//        add order list
        $orderList = new SalesOrderItemList();
        $x = 0;
        $finRes = false;

        foreach ($_POST['productCodeList'] as $key => $item)
        {

            $orderList->orderID = $salesOrderID;
            $orderList->itemID = $_POST['productCodeList'][$x];
            $orderList->itemQty = $_POST['proQtyList'][$x];

            $x++;
            $finRes = $orderList->add_item_list();
        }

        if ($finRes)
        {
            $msg = 'yes';
            $alert = ("<div class=''>
                <div class='alert alert-success alert-dismissable' id='success_alert'>
                <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'><span class='fa fa-times'></span></button>
                <div><b>Well done!</b> You successfully placed the order and sent for the approval.</div>
                </div>
                </div>
                
                <script>
               
                setTimeout(function() 
                {
                  $('#form_emp').val('');
                  $('#success_alert').fadeOut();
                },3000); 
                
                </script>
               ");
        }
        else
        {
            $msg = 'no';
            $alert = ("<div class=''>
                <div class='alert alert-danger alert-dismissable' id='fail_alert'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'><span class='fa fa-times'></span></button>
                <div><b>Oops!</b> Change a few things up and try submitting again.</div>
                </div>
                </div>
                 <script>
                    setTimeout(function() {
                      $('#form_emp').val('');
                      $('#fail_alert').fadeOut();
                    },3000); 
                </script>    
            ");
        }
    }
    else
    {

    }
}
$ranVal = rand(0,1000);
$_SESSION['ranVal'] = $ranVal;
?>
<div class="col-lg-12">
    <div class="card">
        <?=$alert?>
        <div class="card-header">
            <div class="card-header">
                <strong>Place New Sales Order</strong>
            </div>
            <div class="card-body card-block">
                <form method="post" action="sales_order_add.php" enctype="multipart/form-data" class="form-horizontal">
                    <div>
                        <input hidden type="text" name="ranVal" id="ranVal" value="<?=$ranVal?>">
                        <div class="row">
                            <div class="col-6">
                                <div class="row form-group">
                                    <div class="col-3"><label for="text-input" class="form-control-label">Create Date</label></div>
                                    <div class="col-7"><input type="text" readonly class="form-control" name="createDate" id="createDate"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-3"><label for="text-input" class="form-control-label">Delivery Date</label></div>
                                    <div class="col-7"><input required type="date" id="deliveryDate" name="deliveryDate" class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-3"><label for="text-input" class="form-control-label">Remarks</label></div>
                                    <div class="col-7"><textarea  name="remarks" id="remarks" rows="3" placeholder="Enter here..." class="form-control"></textarea></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <diV class="row form-group">
                                    <div class="col-4"><label for="text-input" class=" form-control-label">Sales Rep Name</label></div>
                                    <div class="col-7">
                                        <select class="form-control" name="ageName" id="ageName">
                                            <option value="0">Select Agent</option>
                                            <?php
                                            include_once ('../backend/Agent.php');
                                            $ageInfo = new Agent();
                                            $result = $ageInfo->get_agent();
                                            foreach ($result as $item)
                                            {
                                                echo ("
                                                        <option value='$item->agent_id'>$item->agent_name</option>
                                                    ");
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </diV>
                            </div>
                        </div>
                        <div><hr></div>
                        <div>
                            <table class="table superfeed-table">
                                <thead>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Quantity (Units)</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input readonly type="text" id="proCode" class="form-control"></td>
                                    <td>
                                        <select class="form-control" name="proName" id="proNam" onchange="fillProid()">
                                            <option>Select Product</option>
                                            <?php
                                            include_once ("../backend/Product.php");
                                            $proList = new Product();
                                            $result = $proList->view_product();
                                            foreach ($result as $item)
                                            {
                                                echo ("
                                                        <option value='$item->productId'>$item->productName</option>
                                                    ");
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input  type="text" id="proQty" class="form-control"></td>
                                    <td><button type="button" class="btn btn-primary" onclick="addProducts()"><i class="fa fa-plus"> Add Item</i></button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div>
                            <table class="table">
                                <thead>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Quantity (Untits)</th>
                                <th></th>
                                </thead>
                                <tbody class="tabfontbold" id="productInfo">

                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="card col-12" align="center">
                                <button type="submit" class="btn btn-primary  btn-block col-lg-3" id="btnsub" onclick="return validate()">
                                    <i class=""></i>Save
                                </button>
                                <button type="reset" class="btn btn-danger  btn-block col-lg-3">
                                    <i class=""></i>Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once ('footer.php');
?>
<script>
    //display the current date to the user
    var planDate = new Date(Date.now());
    var year = planDate.getFullYear();
    var month = planDate.getMonth();
    var date = planDate.getDate();
    $("#createDate").val((month+1) + "/" + date + "/" + year);

    //validate delivery date
    today = new Date().toISOString().split('T')[0];
    document.getElementById("deliveryDate").setAttribute('min', today);

    //fill production id
    function fillProid()
    {
        proID = $("#proNam").val();
        $("#proCode").val(proID);
    }
    //fill products to table body
    function addProducts()
    {
        if($("#proCode").val() && $("#proQty").val() && $("#proNam :selected").text()){
            $("#productInfo").append("<tr id='"+$("#proCode").val()+"'>" +
                "<td><input type='text' readonly  class='form-control' id='productCodeList' name='productCodeList[]' value='"+$("#proCode").val()+"'></td>" +
                "<td><input type='text' readonly class='form-control' id='productNameList' name='productNameList[]' value='"+$("#proNam :selected").text()+"'></td>" +
                "<td><input type='text' readonly class='form-control' id='proQtyList' name='proQtyList[]' value='"+$("#proQty").val()+"'></td>" +
                "<td><button type='button' class='btn btn-danger btn-sm' onclick='deletePro("+$("#proCode").val()+")' title='Product Delete'><i class='fa fa-trash-o'></i></button></td>" +
                "</tr>");

            $("#proCode").val("");
            $("#proNam").val("Select Product");
            $("#proQty").val("");
        }
        else{
            $.alert('Add Product');
        }


    }
    //delete product
    function deletePro(proCode)
    {
        $("#proCode").remove();
    }

    function validate() {
        var tbody = $('#productInfo');
        if (tbody.children().length == 0) {
            //$('#btnsub').attr('disabled','disabled');

            $.alert('Add Item');
            return false;
        }
        else {
            return true;
        }
    }
</script>