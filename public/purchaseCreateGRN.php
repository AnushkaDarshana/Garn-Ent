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
include_once ('../backend/GRN.php');
include_once ('../backend/GRN_list.php');
if ($_SESSION['usertype'] == 'storeKeeper' || $_SESSION['usertype'] == 'qualityManager')
{
    header('Location:errorpage/error.php?errorId=1001');
}
$alert = "";
if(isset($_POST['grn_pur_no']))
{
    if($_POST['ran'] == $_SESSION['rand'])
    {
        $grn = new GRN();

        $grn->grn_issuedDate = $_POST['grn_date'];
        $grn->grn_invoice_id = $_POST['grn_ino_no'];
        $grn->grn_purchase_order = $_POST['grn_pur_no'];
        $grn->grn_supplier_id = $_POST['grn_sup_id'];
        $grn->grn_invoice_date = $_POST['invoDate'];
        $grn->grn_extraChargers = $_POST['grn_ext_chargers'];
        $grn->grn_tax = $_POST['grn_tax'];

        $grnId = $grn->add_grn();

        $grnlist = new  GRN_list();
        $count = 0 ;
        $finAlert = false;
        foreach ($_POST['itemidList'] as $item){
            $grnlist->item_id = $_POST['itemidList'][$count];
            $grnlist->item_quntity = $_POST['itemqun'][$count];
            $grnlist->item_totalPrice = $_POST['itemtotalPrice'][$count];
            $grnlist->item_discount = $_POST['itemdiscount'][$count];
            $grnlist->grnOrder_exdate = $_POST['itemexdate'][$count];
            $grnlist->add_grnList($grnId);
            $count++;

            $finAlert = true;
        }

        if ($finAlert)
        {
            $msg = 'yes';
            $alert = ("<div class=''>
                <div class='alert alert-success alert-dismissable' id='success_alert'>
                <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'><span class='fa fa-times'></span></button>
                <div><b>Well done!</b> successfully added to the raw material stock.</div>
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
}

$random = rand(0,100000);
$_SESSION['rand']= $random;

include_once ($head);
?>
<!--page content start-->
<div class="col-lg-12">
    <?$alert?>
    <div class="card">
        <div class="card-header">
            <div class="card-header">
                <strong>Good Receive Note</strong>
            </div>
            <div class="card-body card-block">
                <form action="" data-parsley-validate="" method="post" action="#" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                    <div class="row">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col col-md-3"><lable class="form-control-label">GRN Date</lable></div>
                                <div class="col-12 col-md-7"><input type="date" id="grn_date" name="grn_date" placeholder="" class="form-control" required></div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3"><label for="text-input" class="form-control-label">Purchase Order No</label></div>
                                <div class="col-7">
                                    <select class="form-control"  name="grn_pur_no" id="grn_pur_no">
                                        <option>Select Purchase Order</option>
                                        <?php
                                        include_once ('../backend/Order.php');
                                        $supInfo = new Order();
                                        $result = $supInfo->get_all_approved_purchers_order();

                                        foreach ($result as $item)
                                        {
                                            echo ("
                                                     <option value='$item->orderID'>PO_$item->orderID</option>
                                                    ");
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3"><label for="text-input" class="form-control-label">Invoice Date</label></div>
                                <div class="col-7"><input required type="date" id="invoDate" name="invoDate" class="form-control"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3"><label for="text-input" class="form-control-label">Tax</label></div>
                                <div class="col-7"><input required type="text" id="grn_tax" name="grn_tax" class="form-control"></div>
                            </div>
                        </div>

                        <div class="col-6">
                            <diV class="row form-group">
                                <div class="col-3"><label for="text-input" class=" form-control-label">Invoice No</label></div>
                                <div class="col-7"><input required type="text" id="grn_ino_no" name="grn_ino_no" class="form-control"></div>
                            </diV>

                            <div class="row form-group">
                                <div class="col-3"><label for="text-input" class="form-control-label">Supplier Name</label></div>
                                <div class="col-7"><input readonly type="text" id="grn_sup_name" name="grn_sup_name" class="form-control"></div>
                                <input  type="hidden" id="grn_sup_id" name="grn_sup_id" class="form-control">
                            </div>

                            <div class="row form-group">
                                <div class="col-3"><label for="text-input" class="form-control-label">Extra Chargers</label></div>
                                <div class="col-7"><input type="text" id="grn_ext_chargers" name="grn_ext_chargers" class="form-control"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col-7"></div>
                                <div class="col-3 pull-right nodisplay" id="addbuttonitem">
                                    <button type="button" data-toggle="modal" data-target="#itemAddModel" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus"></i> Add Item
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="nodisplay" id="tableRaw">
                        <table class="table">
                            <thead>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Unit Price (Rs)</th>
                            <th>Quantity</th>
                            <th>Discount (%)</th>
                            <th>Expire Date</th>
                            <th>Total Price</th>
                            </thead>
                            <tbody class="tabfontbold" id="itemList">

                            </tbody>
                        </table>
                    </div>
                    <div>
                        <hr color="black">
                    </div>
                    <div>
                        <div class="card col-12" align="center">
                            <button type="submit" class="btn btn-primary  btn-block col-lg-3">
                                <i class=""></i>Save
                            </button>
                            <button type="submit" class="btn btn-danger  btn-block col-lg-3">
                                <i class=""></i>Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--page content end-->

<div class="modal fade" id="itemAddModel" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Add GRN Item</h5>
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
                                    <form action="production_plan_create.php" method="post" class="form-horizontal" id="addgrnForm">
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Item ID</label></div>
                                            <div class="col-6">
                                                <input type='text' readonly id='itemid' name='itemid' class="form-control">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Item Name</label></div>
                                            <div class="col-6">
                                                <input type='text' id='itemNameraw' name='itemNameraw' class="form-control" onchange="fill(this.value)">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-3"><label for="text-input" class=" form-control-label">Unit Price (Rs)</label></div>
                                            <div class="col-6">
                                                <input type='text' id='uprice' name='unitPrice' class="form-control">
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-3"><label for="text-input" class=" form-control-label">Quantity</label></div>
                                            <div class="col-6">
                                                <input type='number' id='itemqun' name='itemqun' class="form-control">
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-3"><label for="text-input" class=" form-control-label">Discount (%)</label></div>
                                            <div class="col-6">
                                                <input type='text' id='itemdiscount' name='itemdiscount' class="form-control">
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-3"><label for="text-input" class=" form-control-label">Expire Date</label></div>
                                            <div class="col-6">
                                                <input type='date' id='itemexdate' name='itemexdate' class="form-control">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="reset" class="btn btn-warning" >RESET</button>
                                            <button type="button" class="btn btn-primary" onclick="add_grn()">Add</button>
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




<?php
include_once ('footer.php')
?>
<script>
//    disable the past dates***************************************************************************
    today = new Date().toISOString().split('T')[0];
    document.getElementById("grn_date").setAttribute('min', today);
    document.getElementById("invoDate").setAttribute('min', today);
    //    *****************************************************************************************************
    var row_id =0;
    //****************************getting GRN date********************
    var planDate = new Date(Date.now());
    var year = planDate.getFullYear();
    var month = planDate.getMonth();
    var date = planDate.getDate();
    //var to = (year +"/" + (month+1)+"/" + date);
    $("#grnDate").val(year + "-" + (month+1) + "-" + date);
    //******************************************************************

    function add_grn() {
        console.log('iamhere');
        $("#itemList").append(
            "<tr>" +
            "<td><input type='hidden' id='itemidList' name='itemidList[]' value='"+$('#itemid').val()+"'>"+$('#itemid').val()+"</td>" +
            "<td><input type='hidden' id='itemName' name='itemNameList[]' value='"+$('#itemNameraw').val()+"'>"+$('#itemNameraw').val()+"</td>" +
            "<td><input type='hidden' id='uprice"+row_id+"' name='unitPriceList[]' value='"+$('#uprice').val()+"'>"+$('#uprice').val()+"</td>" +
            "<td><input type='number' min='0' name='itemqun[]' class='form-control' id='qun"+row_id+"' required value='"+$('#itemqun').val()+"'></td>"+
            "<td><input type='number' min='0' name='itemdiscount[]' class='form-control'  id='discount"+row_id+"' required value='"+$('#itemdiscount').val()+"'></td>" +
            "<td><input type='date' class='form-control' name='itemexdate[]'  value='"+$('#itemexdate').val()+"' required></td>"+
            "<td><input type='hidden' class='form-control' name='itemtotalPrice[]' id='itemTotal"+row_id+"' ><span id='net_tot"+row_id+"'></span></td>"+
             "<td><button type='button' class='btn btn-danger  btn-block col-lg-4' onclick='delItem(this,row_id)'><i class='fa fa-minus-circle'></i></button></td>" +
            "</tr>");
        calculate_itemTotal(row_id);
        row_id++;
        $('#addgrnForm input').val('');
    }

        $('#grn_pur_no').change(function () {
            $('#tableRaw').removeClass('nodisplay');
            $('#addbuttonitem').removeClass('nodisplay');
            get_supplier();
            $.get("../ajax/ajax_order_create.php?type=get_order_list",{id:$('#grn_pur_no').val()},function (data)
            {
                if (data)
                {
                    var order = JSON.parse(data);
                    $("#itemList").html('');
                    for(var item in order){
                        $("#itemList").append(
                            "<tr>" +
                            "<td><input type='hidden' id='itemidList' name='itemidList[]' value='"+order[item].itemId+"'>"+order[item].itemId+"</td>" +
                            "<td><input type='hidden' id='itemName' name='itemNameList[]' value='"+order[item].rawName+"'>"+order[item].rawName+"</td>" +
                            "<td><input type='hidden' id='uprice"+row_id+"' name='unitPriceList[]' value='"+order[item].productUnitPrz+"'>"+order[item].productUnitPrz+"</td>" +
                            "<td><input type='number' min='0' name='itemqun[]' class='form-control' onchange='calculate_itemTotal("+row_id+")' id='qun"+row_id+"' required></td>"+
                            "<td><input type='number' min='0' name='itemdiscount[]' class='form-control' onchange='calculate_itemTotal("+row_id+")' id='discount"+row_id+"' required></td>" +
                            "<td><input type='date' class='form-control' name='itemexdate[]'  value='' required></td>"+
                            "<td><input type='hidden' class='form-control' name='itemtotalPrice[]' id='itemTotal"+row_id+"' ><span id='net_tot"+row_id+"'></span></td>" +
                            "<td><button type='button' class='btn btn-danger  btn-block' onclick='delItem(this,row_id)'><i class='fa fa-minus-circle'></i></button></td>" +
                            "</tr>");
                        row_id++;
                    }
                }
            });
        });

    function delItem(button,id)
    {
        $(button).parent().parent().remove();
        calculate_itemTotal(id);
    }

    function get_supplier() {
        $.get("../ajax/ajax_order_create.php?type=get_supplier",{id:$('#grn_pur_no').val()},function (data)
        {
            if (data){
                var sup = JSON.parse(data);
                $('#grn_sup_name').val(sup[0].orderSupName);
                $('#grn_sup_id').val(sup[0].orderSupId);
            }
        });
    }

    /* *****calculate the item total  ***** */
    function calculate_itemTotal(data){


        var quantity = parseFloat($('#qun'+data).val()); // parse to float
        if (isNaN(quantity)) quantity = 0; // make it 0 if it is not a number

        var unit_price = parseFloat($('#uprice'+data).val()); // paese to float
        if (isNaN(unit_price)) unit_price = 0; // make it 0 if it is not a number

        var tot = quantity * unit_price; // getting approximate total

        var discount = (parseFloat($('#discount'+data).val()) / 100) * tot; // getting discount
        if(isNaN(discount)) discount = 0;

        var net_tot = tot - discount;
        $('#itemTotal'+data).val(net_tot); // accurate total
        $('#net_tot'+data).html(net_tot); // accurate total

    }

    /*  Auto Complete code */

    var options = {
        url: function(phrase) {
            return "../ajax/ajax_auto.php?type=getRawMatName&phrase=" + phrase + "&format=json";
        },

        getValue: "rawName",


        list: {

            onSelectItemEvent: function() {

                var valueID = $("#itemNameraw").getSelectedItemData().rawId;

                $("#itemid").val(valueID);

            }
        }
    };

    $("#itemNameraw").easyAutocomplete(options);

    function fill(name)
    {
        $.get("../ajax/ajax_order_create.php?type=view_item",{itemName:name},function (data)
        {
            var item = JSON.parse(data);

            $("#itemid").val(item[0].rawId);
            $("#uprice").val(item[0].rawUnitPrz);
        });
    }
</script>