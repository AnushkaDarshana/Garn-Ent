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
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header('Location:../errorpage/error.php?errorId=1001');
}
    include_once ($head);
    include_once ("../backend/Order.php");
    include_once ("../backend/OrderItemList.php");
    $alert = "";
    if(isset($_POST['net_amount']))
    {
        if ($_POST['ran'] == $_SESSION['rand']){
            $newOrder = new Order();

            $newOrder->orderSupId = $_POST['sup_id'];
            $newOrder->OrderDescription = $_POST['order_description'];
            $newOrder->orderTax = $_POST['tax'];
            $newOrder->orderNetValue = $_POST['net_amount'];
            $newOrder->orderexpDate = $_POST['sup_exp_date'];
            $newOrder->orderPayType = $_POST['sup_payType'];

            $order_id = $newOrder->create_order();

            $newItemList = new OrderItemList();
            $x=0;
            $finRes = false;
            foreach ($_POST['itemCode_List'] as $item)
            {
                $newItemList->itemId = $_POST['itemCode_List'][$x];
                $newItemList->itemQunatity = $_POST['itemQuantity_List'][$x];
                $newItemList->orderId = $order_id;
                $newItemList->add_item_list();
                $x++;

                $finRes = true;
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
    }

$random = rand(0,100000);
$_SESSION['rand']= $random;
?>

<div>
    <div class="card">
        <?=$alert?>
        <div class="card-header">
            <div class="card-header">
                <strong>Create Order</strong>
            </div>
            <div class="card-body card-block">
                <form  method="post" data-parsley-validate="" action="order_create.php" class="form-horizontal">
                    <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                    <div class="row">
<!--###########################  first column ###############################################################################-->
                        <div class="col-md-6" >
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Supplier ID</label></div>
                                <div class="col-12 col-md-7"><input required type="text" id="sup_id" name="sup_id" placeholder=" " class="form-control" readonly></div>
                            </div>

                            <div class="row form-group" >
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Supplier</label></div>
                                <div class="col-12 col-md-7"><input required type="text" id="sup_name" name="sup_name" placeholder="Enter name" class="form-control"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Description</label></div>
                                <div class="col-12 col-md-7"><textarea required name="order_description" id="order_description" rows="4" placeholder="Enter here..." class="form-control"></textarea></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col col-md-3"><lable class="form-control-label">Date</lable></div>
                                <div class="col-12 col-md-6"><input required type="text" id="sup_date" name="sup_date" placeholder="" class="form-control" readonly></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><lable class="form-control-label">Expected Date</lable></div>
                                <div class="col-12 col-md-6"><input required type="date" id="sup_exp_date" name="sup_exp_date" placeholder="" class="form-control" required></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><lable class="form-control-label">Payment Type</lable></div>
                                <div class="col-12 col-md-6">
                                    <select name="sup_payType" id="sup_payType" class="form-control" required>
                                        <option value="">Select Payment Type</option>
                                        <option value="cash">On Cash</option>
                                        <option value="credit">Credit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div><hr color="black"></div>
                    <div>
                        <table class="table">
                            <thead>
                                <th></th>
                                <th>Item Name</th>
                                <th>Unit Type</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Item Total Price</th>
                                <th></th>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="text" hidden   id="order_code" name="order_code"  class="form-control" readonly></td>
                                <td><input type="text"  id="order_name" name="order_name"  class="form-control" onchange="fill(this.value)"></td>
                                <td><input type="text"  readonly id="unitType" name="unitType"  class="form-control"></td>
                                <td><input type="text"  id="order_quantity" name="order_quantity"  class="form-control" onblur="getTotPrz(this.value)"></td>
                                <td><input type="text"  readonly id="order_unt_prz" name="order_unt_prz"  class="form-control"></td>
                                <td><input type="text"  id="order_tot_prz" name="order_tot_prz"  class="form-control" readonly></td>
                                <td><button type="button" onclick="resetRaw()" id="resetBtn" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Reset</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <button type="button" id="addbtn" class="btn btn-primary pull-right" style="margin-bottom: 10px" onclick="add_item();"><i class="fa fa-plus"></i> Add Item</button>
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                                <th></th>
                                <th>Item Name</th>
                                <th>Unit type</th>
                                <th>Quantity</th>
                                <th></th>
                                <th>Item Total Price</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="itemList">

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                       <div class="col-md-6">
                            <div class="form-group row" >
                                <div class="col-5"><label for="text-input" class="form-control-label">Total Amount</label></div>
                                <div class="col-7"><input required type="text" id="tot_amount" name="tot_amount" class="form-control" readonly value='0'></div>
                            </div>
                            <div class="form-group row" >
                                <div class="col-5"><label for="text-input" class="form-control-label">Tax</label></div>
                                <div class="col-7"><input required type="text" id="tax" name="tax" class="form-control" onchange="netTotal()" value="0"></div>
                            </div>
                            <div class="form-group row" >
                                <div class="col-5"><label for="text-input" class="form-control-label">Net Total Amount</label></div>
                                <div class="col-7"><input required type="text" id="net_amount" name="net_amount" class="form-control" readonly></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card col-12" align="center">
                            <button type="submit" class="btn btn-primary  btn-block col-lg-3" id="btnsub" onclick="return validate()">
                                <i class="fa fa-check-circle-o"></i> Create Order
                            </button>
                            <button type="reset" class="btn btn-danger  btn-block col-lg-3">
                                <i class="fa fa-times-circle-o"></i> Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include_once ("footer.php");
?>

<script>
//    disable the past dates***************************************************************************
    today = new Date().toISOString().split('T')[0];
    document.getElementById("sup_exp_date").setAttribute('min', today);
//    *****************************************************************************************************
//    function fill(name)
//    {
//        $.get("../ajax/ajax_order_create.php?type=view_item",{itemName:name},function (data)
//        {
//            var item = JSON.parse(data);
//
//            $("#order_code").val(item[0].rawId);
//            $("#order_unt_prz").val(item[0].rawUnitPrz);
//        });
//    }
    function getTotPrz(quntity)
    {
        var unitPrz = parseFloat($("#order_unt_prz").val());
        if(isNaN(unitPrz)) unitPrz = 0;
        var tot_price = quntity * unitPrz;
        if(isNaN(tot_price)) tot_price = 0;
        $("#order_tot_prz").val(tot_price);
    }
    function add_item()
    {
        if( $("#order_code").val() && $("#order_name").val() && $("#unitType").val() && $("#order_quantity").val() && $("#order_unt_prz").val() && $("#order_tot_prz").val()){
            $("#itemList").append("<tr>" +
                "<td><input type='text' hidden readonly class='form-control' id='itemCode_List' name='itemCode_List[]' value='"+$("#order_code").val()+"'></td>" +
                "<td><input type='text' readonly class='form-control' id='itemName_List' name='itemName_List[]' value='"+$("#order_name").val()+"'></td>" +
                "<td><input type='text' readonly class='form-control' id='unitType' name='unitType[]' value='"+$("#unitType").val()+"'></td>" +
                "<td><input type='text' readonly class='form-control' id='itemQuantity_List' name='itemQuantity_List[]' value='"+$("#order_quantity").val()+"'></td>" +
                "<td><input type='text' hidden readonly class='form-control' id='itemUnitPrz_List' name='itemList[]' value='"+$("#order_unt_prz").val()+"'></td>" +
                "<td><input type='text' readonly class='form-control' id='itemTotPrz' name='itemList[]' value='"+$("#order_tot_prz").val()+"'></td>" +
                "<td><button type='button' class='btn btn-danger  btn-block' onclick='delItem(this)'><i class='fa fa-minus-circle'></i></button></td>" +
                "</tr>");

            get_tot_amount();

            $("#order_code").val("");
            $("#order_name").val("");
            $("#order_quantity").val("");
            $("#order_unt_prz").val("");
            $("#order_tot_prz").val("");
            $("#unitType").val("");
        }
        else {
            $.alert('select item');
        }

    }

    function get_tot_amount()
    {
        $totAmount = parseFloat($("#tot_amount").val());
        if (isNaN($totAmount)) $totAmount = 0;
        $totAmount = $totAmount + parseFloat($("#order_tot_prz").val());
        if (isNaN($totAmount)) $totAmount = 0;
        $("#tot_amount").val($totAmount);

        netTotal();
    }
    
    function netTotal() {
        var taxAmount = parseFloat($('#tax').val());
        if(isNaN(taxAmount)) taxAmount = 0;
        var tot = parseFloat($('#tot_amount').val());
        if(isNaN(tot)) tot =0;
        net_tot = ( tot + ((taxAmount/100) * tot)).toFixed(2);

        $('#net_amount').val(net_tot);
    }
    function delItem(button)
    {
        $(button).parent().parent().remove();
        get_tot_amount();
    }
    function resetRaw()
    {
        $("#order_code").val("");
        $("#order_name").val("");
        $("#unitType").val("");
        $("#order_quantity").val("");
        $("#order_unt_prz").val("");
        $("#order_tot_prz").val("");
    }
    //auto complete***********************************************
    var options = {
        url: function(phrase) {
            return "../ajax/ajax_auto.php?type=getSupName&phrase=" + phrase + "&format=json";
        },

        getValue: "supName",


        list: {

            onSelectItemEvent: function() {
                var value = $("#sup_name").getSelectedItemData().supId;

                $("#sup_id").val(value);
            }
        }        };

    $("#sup_name").easyAutocomplete(options);

    /* ************getting current date********************************************* */

    var tdate = new Date(Date.now());
    var mm = tdate.getMonth(); //getting month
    var dd = tdate.getDate(); //getting date
    var yy = tdate.getFullYear(); //getting year
    var currentdate = (mm+1) + ' / ' + dd + ' / ' + yy; // getting full date
    $('#sup_date').val(currentdate);

    //auto complete*****************************************************

    /*  Auto Complete code */

    var options = {
        url: function(phrase) {
            return "../ajax/ajax_auto.php?type=getRagetRawMatNameBysupwMatName&id="+$('#sup_id').val()+"&phrase=" + phrase + "&format=json";
        },

        getValue: "rawName",


        list: {

            onSelectItemEvent: function() {

                var valueID = $("#order_name").getSelectedItemData().rawId;
                var unitType = $("#order_name").getSelectedItemData().rawType;
                var unitPrice = $("#order_name").getSelectedItemData().unitPrice;

                $("#order_code").val(valueID);
                $("#unitType").val(unitType);
                $("#order_unt_prz").val(unitPrice);

            }
        }        };

    $("#order_name").easyAutocomplete(options);

//    validate form
    $("#order_name").on('blur', function () {
      var unittype = $('#unitType').val();
      var unitPrice = $('#order_unt_prz').val();

      if(unitPrice === '' && unittype === ''){
          $('#addbtn').attr('disabled','disabled');
          $.alert({
              title: 'Invalid!',
              content: 'Invalid Item!',
          });
      }
      else{
          $('#addbtn').removeAttr('disabled');
      }
    });

    function validate() {
        var tbody = $('#itemList')
        if (tbody.children().length == 0) {
            //$('#btnsub').attr('disabled','disabled');
            $.alert('Add Item');
            return false;
        }
        else {
            //$('#btnsub').removeAttr('disabled');
            return true;
        }
    }
</script>