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
include_once ('../backend/Dispatch.php');
include_once ('../backend/DispatchList.php');

if (isset($_POST['ageName']))
{

if ($_POST['ran'] == $_SESSION['rand']){

    $disInfo = new Dispatch();

    $disInfo->agentId = $_POST['ageName'];
    $disInfo->invoiceNum = $_POST['salesorder'];
    $disInfo->invoDate = $_POST['invoDate'];
    $disInfo->tax = $_POST['tax'];
    $disInfo->netTot = $_POST['netTot'];

    $disId = $disInfo->add_dispatch($_POST['salesOderId']);

    //add item lisr*******************************
    $newItemList = new DispatchList();
    $x=0;
    foreach ($_POST['totPrzList'] as $item)
    {
        $newItemList->itemId = $_POST['itemidList'][$x];
        $newItemList->dispatchId = $disId;
        $newItemList->quantity = $_POST['quantityList'][$x];
        $newItemList->discount = $_POST['discountList'][$x];
        $newItemList->totPrice = $_POST['totPrzList'][$x];
        $newItemList->add_listItem();
        $x++;
    }
}
}


$random = rand(0,100000);
$_SESSION['rand']= $random;
?>
<!--page content start-->
<div class="col-lg-12">
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
                <strong>Add New Dispatch</strong>
            </div>
            <div class="card-body card-block">
                <form method="post" data-parsley-validate="" action="dispatch_product.php" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>" >
                    <div class="row">
                        <div class="col-6">
                            <diV class="row form-group">
                                <div class="col-3"><label for="text-input" class=" form-control-label">Date</label></div>
                                <div class="col-7"><input required type="text" id="dispatchDate" name="dispatchDate" class="form-control" readonly></div>
                            </diV>
                            <div class="row form-group">
                                <div class="col-3"><label for="text-input" class="form-control-label">Agent</label></div>
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
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-3"><label for="text-input" class="form-control-label">Invoice Date</label></div>
                                <div class="col-7"><input required type="date" id="invoDate" name="invoDate" class="form-control"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col-3"><label for="text-input" class="form-control-label">Sales Order</label></div>
                                <div class="col-7">
                                    <select class="form-control" name="salesorder" id="salesorder">
                                        <option value='0'>Select Sales order</option>
                                    </select>
                                </div>
                            </div>
                            <input type="text" hidden id="salesOderId" name="salesOderId">
                            <div class="row form-group">
                                <div class="col-7"></div>
                                <div class="col-3 " id="addbuttonitem">
                                    <button type="button" data-toggle="modal" data-target="#itemAddModel" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus"></i> Add Item
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
<!--                    <div><hr></div>-->
                    <div>
                        <table class="table">
                            <thead>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Unit Price (Rs)</th>
                            <th>Quantity</th>
                            <th>Discount (%)</th>
                            <th>Total Price</th>
                            </thead>
                            <tbody class="tabfontbold" id="itemList">

                            </tbody>
                        </table>
                    </div>
                    <div>
                        <hr color="black">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <diV class="row form-group">
                                <div class="col-3"><label for="text-input" class=" form-control-label">Total</label></div>
                                <div class="col-7"><input required type="text" id="total" name="total" value="0" class="form-control" readonly></div>
                            </diV>

                            <div class="row form-group">
                                <div class="col-3"><label for="text-input" class="form-control-label">Tax (%)</label></div>
                                <div class="col-7"><input required type="text" onblur="fillNetTot()" id="tax" name="tax" class="form-control" value="0"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3"><label for="text-input" class="form-control-label">Net Total (Rs)</label></div>
                                <div class="col-7"><input required type="text" readonly id="netTot" name="netTot" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card col-12" align="center">
                            <button type="submit" class="btn btn-primary  btn-block col-lg-3" id="btnsave" onclick="validate()">
                                <i class=""></i>Save
                            </button>
                            <button type="submit" class="btn btn-danger  btn-block col-lg-3">
                                <i class=""></i>Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="itemAddModel" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Add Dispatch Item</h5>
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
                                                <form action="#" method="post" class="form-horizontal" id="salesorderFrom">
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Item ID</label></div>
                                                        <div class="col-6">
                                                            <input type='text' readonly id='itemid' name='itemid' class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Item Name</label></div>
                                                        <div class="col-6">
                                                            <select onchange="setid()" name="itemName" id="itemName" class="form-control">
                                                                <option >Select Product</option>
                                                                <?php
                                                                include_once ('../backend/Product.php');
                                                                $newPro = new Product();
                                                                $result = $newPro->view_product();
                                                                foreach ($result as $item)
                                                                {
                                                                    echo (" <option value='$item->productId'>$item->productName</option>");
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-3"><label for="text-input" class=" form-control-label">Unit Price (Rs)</label></div>
                                                        <div class="col-6">
                                                            <input type='text' id='unitPrice' name='unitPrice' class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-3"><label for="text-input" class=" form-control-label">Quantity</label></div>
                                                        <div class="col-6">
                                                            <input type='number' id='quantity' name='quantity' class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-3"><label for="text-input" class=" form-control-label">Discount (%)</label></div>
                                                        <div class="col-6">
                                                            <input type='text' id='discount' name='discount' class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="reset" class="btn btn-warning" >RESET</button>
                                                        <button type="button" class="btn btn-primary" onclick="addItem()">Add</button>
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

        </div>
    </div>
</div>
<!--page content end-->
<?php
include_once ('footer.php');
?>
<script>


    //window onlaod
    $( document ).ready(function() {
        console.log(1);
        reordercheck();
    });

    //****************************getting dispatch date********************
    var planDate = new Date(Date.now());
    var year = planDate.getFullYear();
    var month = planDate.getMonth();
    var date = planDate.getDate();
    //var to = (year +"/" + (month+1)+"/" + date);
    $("#dispatchDate").val(year + "-" + (month+1) + "-" + date);
    //******************************************************************
    //add item********************************************************
    var row_id =0;
    function addItem()
    {
        $("#itemList").append(
            "<tr>" +
            "<td><input type='hidden' id='itemid_"+row_id+"' name='itemidList[]' value='"+$("#itemid").val()+"'>"+$('#itemid').val()+"</td>" +
            "<td><input type='hidden' id='itemName_"+row_id+"' name='itemNameList[]' value='"+$("#itemName").val()+"'>"+$('#itemName').val()+"</td>" +
            "<td><input type='hidden' id='unitPrice_"+row_id+"' name='unitPriceList[]' value='"+$("#unitPrice").val()+"'>"+$('#unitPrice').val()+"</td>" +
            "<td><input type='hidden' id='quantity_"+row_id+"' name='quantityList[]' value='"+$("#quantity").val()+"'>"+$('#quantity').val()+"</td>" +
            "<td><input type='hidden' id='discount_"+row_id+"' name='discountList[]' value='"+$("#discount").val()+"'>"+$('#discount').val()+"</td>" +
            "<td><input type='hidden'  name='totPrzList[]' id='itemTotal"+row_id+"'><span id='net_tot"+row_id+"'></span></td>" +
            "</tr>");
        console.log(row_id);
        calculate_itemTotal(row_id);
        row_id++;
        $('#salesorderFrom input').val('');
    }
    //auto complete***********************************************************
    var options = {
        url: function(phrase) {
            return "../ajax/ajax_auto.php?type=getProName&phrase=" + phrase + "&format=json";
        },

        getValue: "proName",


        list: {

            onSelectItemEvent: function() {
                var pid = $("#itemName").getSelectedItemData().proId;
                var unitPr = $("#itemName").getSelectedItemData().unitPrz;
                var untiWeight = $("#itemName").getSelectedItemData().unitWeight;

                $("#itemid").val(pid);
                $("#unitWeight").val(untiWeight);
                $("#unitPrice").val(unitPr);
            }
        }        };

    $("#itemName").easyAutocomplete(options);
    //$("#productId").val(value);
    //get tot value**************************************************************************
    function getTot()
    {
        var dis = $("#discount").val();
        var qty = $("#quantity").val();
        var unitPrz = $("#unitPrice").val();
        if (dis >=0 && dis <= 100)
        {
            var tot = (unitPrz * qty) - ((unitPrz * qty) * dis)/100;
            if(isNaN(tot)){ tot = 0;}
            $("#totPrz").val(tot);
        }
    }
    //calculate the net tot*************************************************************
    function fillNetTot()
    {
        var taxVal = parseInt($("#tax").val());
        var totVal = parseInt($("#total").val());
        var netTot =  totVal + (totVal * taxVal)/ 100;
        if(isNaN(netTot)){ netTot = 0;}
        $("#netTot").val(netTot);
    }

    /* *****calculate the item total  ***** */
    function calculate_itemTotal(data){


        var quantity = parseFloat($('#quantity_'+data).val()); // parse to float
        if (isNaN(quantity)) quantity = 0; // make it 0 if it is not a number
        console.log(data);
        console.log($('#quantity_'+data).val());
        console.log($('#unitPrice_'+data).val());

        console.log($('#discount_'+data).val());
        var current = parseFloat($('#current_'+data).val());
        if (isNaN(current)) current = 0;

        console.log(current);
        console.log(quantity);
        if(current > quantity){
            $('#btnsave').removeAttr('disabled');
            $('#stockAlertdiv').addClass('nodisplay');

            var unit_price = parseFloat($('#unitPrice_'+data).val()); // paese to float
            if (isNaN(unit_price)) unit_price = 0; // make it 0 if it is not a number

            var tot = quantity * unit_price; // getting approximate total

            var discount = (parseFloat($('#discount_'+data).val()) / 100) * tot; // getting discount
            if(isNaN(discount)) discount = 0;



            var netTot =  parseFloat($('#netTot').val()); // parse to float
            if (isNaN(netTot)) netTot = 0; // make it 0 if it is not a number

            var net_tot = tot - discount;
            if (isNaN(net_tot)) net_tot = 0;

            $('#itemTotal'+data).val(net_tot); // accurate total
            $('#net_tot'+data).html(net_tot); // accurate total

            totalitemprice();
        }
        else{
            $('#stockAlertdiv').removeClass('nodisplay');
            $('#btnsave').attr('disabled','disabled');
            $.alert('Check Stock Product Might Be Low');
        }


    }

    //    #########################salse order
    $('#ageName').change(
        function () {
            if($('#ageName').val() != '0'){
                $.get("../ajax/ajax_sales_order.php?type=agentsalesorder",{id:$('#ageName').val()},function (data){
                    if(data != "0"){
                        var dataobj = JSON.parse(data);
                        $('#salesorder').html('');
                        $('#salesorder').append("<option value='0'>Select Sales order</option>");
                        dataobj.forEach(
                            function (item,index) {
                                $('#salesorder').append("<option value="+item.salesOrderID+">SO_"+item.salesOrderID+"</option>");

                            }
                        );
                    }
                });
            }
        }
    );

    //    #################################salse orderlist

    $('#salesorder').change(
        function () {
            if($('#salesorder').val() != '0'){
                $.get("../ajax/ajax_sales_order.php?type=salesorderlist",{id:$('#salesorder').val()},function (data) {
                    if(data != '0'){
                        $dataobj = JSON.parse(data);
                        $("#itemList").html('');
                        $("#salesOderId").val($('#salesorder').val());
                        $dataobj.forEach(
                            function (item,index) {
                                var dis = '';
                                if(item.reorderstatus === 0){
                                    dis = 'disabled'
                                }
                                $("#itemList").append(
                                    "<tr>" +
                                    "<td><input type='hidden' id='itemid_"+row_id+"' name='itemidList[]' value='"+item.itemID+"'>"+item.itemID+"</td>" +
                                    "<td><input type='hidden' id='itemName_"+row_id+"' name='itemNameList[]' value='"+item.itemName+"'>"+item.itemName+"</td>" +
                                    "<tde><input type='hidden' id='unitPrice_"+row_id+"' name='unitPriceList[]' value='"+item.unitprice+"'>"+item.unitprice+"</tde>" +
                                    "<td><inptut type='hidden'  id='current_"+row_id+"' value='"+item.currentstock+"'>" +
                                    "<input type='number' required min='1' "+dis+" id='quantity_"+row_id+"' name='quantityList[]' onchange='calculate_itemTotal("+row_id+")'></td>" +
                                    "<td><input type='number' required "+dis+" id='discount_"+row_id+"' name='discountList[]' onchange='calculate_itemTotal("+row_id+")'></td>" +
                                    "<td><input type='hidden'  name='totPrzList[]' id='itemTotal"+row_id+"'><span id='net_tot"+row_id+"'></span></td>" +
                                    "<td><button type='button' "+dis+" class='btn btn-danger  btn-block' onclick='delItem(this,row_id)'><i class='fa fa-minus-circle'></i></button></td>" +
                                    "</tr>");
                                calculate_itemTotal(row_id);
                                row_id++;
                            }
                    );

                    }
                });
            }
        }
    );

    function delItem(button,id)
    {
        $(button).parent().parent().remove();
        calculate_itemTotal(id);
    }

    function setid() {
        $('#itemid').val($('#itemName').val());
        var n = level.includes( parseInt($('#itemName').val()));
        if(n){
            $('#quantity').attr('disabled','disabled');
        }
        else {
            $('#quantity').removeAttr('disabled');
        }
    }
    
    function totalitemprice() {
        var tot = 0;
        for(var i = 0; i <= row_id; i++){
            if($('#itemTotal'+i).val() != undefined || $('#itemTotal'+i).val() != null){
                tot += parseFloat($('#itemTotal'+i).val());
            }
        }
        if (isNaN(tot)) tot = 0;

        var tax =  parseFloat($('#tax').val()); // parse to float
        if (isNaN(tax)) tax = 0; // make it 0 if it is not a number
        var nettot = tot + (tot * tax)/ 100;
        if (isNaN(tot)) nettot = 0;
        $('#total').val(tot);//items total
        $('#netTot').val();//items net total
    }


    var level = [];
    function reordercheck() {
        $.get("../ajax/ajax_sales_order.php?type=reordercheck",function (data)
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
                        $('#stockAlert').append("<p>"+reorderData[item].productname+" in hand stock is "+reorderData[item].currentstock+" and the its re-order level is "+reorderData[item].reorderlevel+"</p>");

                        level = [];
                        level.push(parseInt(reorderData[item].proId));
                    }
                }

            }
        });
    }
    
    function validate() {
        console.log($('.quantityList').val());
    }
</script>