<html>
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
    <link rel="stylesheet" href="assets/css/new.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<head>
<body>

        <!-- Left Panel -->

        <?php include './components/leftNav.html'; ?>

        <!-- Header-->

        <?php include './components/topNav.html'; ?>


<div class="col-lg-12">
    <div class="card">
        <div class="card-header" id="productHead">
            <strong>New Product</strong>
        </div>
        <div class="card-header nodisplay" id="ingHead">
            <strong>Set Recipe</strong>
        </div>
        <div class="card-header nodisplay" id="qtyHead">
            <strong>Set Quality Attributes</strong>
        </div>
        <form data-parsley-validate="" action="product_new.php" method="post" class="form-horizontal" id="newproduct">
            <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
            <div class="card-body card-block">
                <span id="basicIfo">
                <div class="row form-group" >
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                    <div class="col-12 col-md-7"><input type="text" data-parsley-group="block1" required id="productName" name="productName" placeholder="Cattle Feed" class="form-control"></div>
                </div>
                    <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Catagory</label></div>
                    <div class="col-12 col-md-7">
                        <select id="prdocuctCat" required data-parsley-group="block1"  name="prdocuctCat" class="form-control">
                            <option>Select Catagory</option>
                            <?php
                            include_once ('../backend/ProductCatagory.php');
                            $cat = new ProductCatagory();
                            $result = $cat->get_catagory();

                            foreach ($result as $item)
                            {
                                echo
                                ("
                                        <option value='$item->catId'>$item->catName</option>
                                    ");
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Heating Temperature (celsius)</label></div>
                    <div class="col-12 col-md-7"><input data-parsley-group="block1" data-parsley-type="number" required type="number" step="0.01" id="temperature" name="temperature" placeholder="45.5" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Heating Time</label></div>
                    <div class="col-12 col-md-1"><input data-parsley-group="block1" data-parsley-type="number" required type="number" step="1" id="hours" name="hours" placeholder="2" class="form-control"></div>
                    <div class="col col-md-1"><label for="text-input" class=" form-control-label">Hours</label></div>
                    <div class="col-12 col-md-1"><input data-parsley-group="block1" data-parsley-type="number" required type="number" step="1" id="mins" name="mins" placeholder="30" class="form-control"></div>
                    <div class="col col-md-1"><label for="text-input" class=" form-control-label">Minutes</label></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Unit Price (Rs)</label></div>
                    <div class="col-12 col-md-7"><input data-parsley-group="block1" data-parsley-type="number" required type="number" step="0.01" id="proUnitPrz" name="proUnitPrz" placeholder="125.50" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Unit Weight (kg)</label></div>
                    <div class="col-12 col-md-7"><input data-parsley-group="block1" data-parsley-type="number" required  type="number" step="0.01" id="proUnitWeight" name="proUnitWeight" placeholder="45" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Buffer Levele (Units)</label></div>
                    <div class="col-12 col-md-7"><input data-parsley-group="block1" data-parsley-type="number" required  type="number" step="0.01" id="bufferLevel" name="bufferLevel" placeholder="1500" class="form-control"></div>
                </div>
                <div class="card-footer" align="center">
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                    <button type="button" class="btn btn-success btn-sm" onclick="nextWiz()" id="btn1">
                        Next <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
                </span>
<!--****************************************set recipe wizard start*************************************************-->
                <span id="ingList" class="nodisplay">
                    <div class="card-body card-block">
                        <div class="row">
                            <div class="col-6">
                                <div class="row form-group">
                                    <div class="col-12">
                                        <div class="col-4">
                                            <label for="text-input" class="form-control-label">Recipe Name</label>
                                        </div>
                                        <div class="col-8">
                                            <input  type="text" data-parsley-group="block2"  required id="recName" name="recName" placeholder="Test Recipe" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12">
                                        <div class="col-4">
                                            <label for="text-input" class="form-control-label">Description</label>
                                        </div>
                                        <div class="col-8">
                                            <textarea name="description" required data-parsley-group="block2"  id="description" rows="3" placeholder="Enter Description Here" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Currently Available Raw Materials</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                    include_once ('../backend/RawMaterial.php');
                                    $rawInfo = new RawMaterial();
                                    $res = $rawInfo->view_raw_material();
                                    if ($res)
                                    {
                                        echo ("<ul class=\"list-unstyled\">");
                                        foreach ($res as $item)
                                        {
                                            echo ("<li><a href=\"#\">$item->rawName</a></li>");
                                        }
                                        echo ("</ul>");
                                    }
                                ?>
                            </div>
                        </div>
                            </div>
                        </div>
                        <div>
                            <div class="card">
                                <div class="col-sm-12">
                                    <div class="page-header float-right">
                                        <div class="page-title">
                                            <ol class="breadcrumb pull-right">
                                                <div>
                                                    <button type="button" onclick="add_list()" data-toggle="modal" data-target="#largeModal" class="btn btn-primary pull-right">
                                                        <i class="fa fa-plus"></i> Add Item
                                                    </button>
                                                </div>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Unit Type</th>
                                        <th>Quantity Per Kilo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><input type="text"  readonly name="itemid" id="itemid" class="form-control"></td>
                                    <td><input type="text" placeholder="Soya"   name="itemName" id="itemName" class="form-control"></td>
                                    <td><input type="text"  readonly name="itemType" id="itemType" class="form-control"></td>
                                    <td><input type="text" onchange="setTitle()"  placeholder="0.75" min="0" max="1" name="qtyPK" id="qtyPK" class="form-control"></td>
                                    <td><button type="button" onclick="resetRecipe()" id="resetBtn" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Reset</td>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <table class="table nodisplay" id="dataTabale">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Unit Type</th>
                                        <th>Quantity Per Kilo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="recipeListBody">

                                </tbody>
                            </table>
                        </div>
<!--****************************buttons******************************************************************************-->
                        <div>
                            <div class="card-footer" align="center">
                                <button type="button" class="btn btn-primary btn-sm" onclick="to_wiz_1()">
                                    <i class="fa fa-arrow-left"></i> previous
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
                                <button type="button" class="btn btn-success btn-sm" onclick="nextWiz_2()">
                                    Next <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
<!--*****************************************************************************************************************-->
                        </div>
                    </div>
                </span>
<!--****************************************set recipe wizard end****************************************************-->
<!--****************************************set qualty atrtibute wizard start****************************************-->
                <span id="qtyList" class="nodisplay">
                    <div class="card-body card-block">
                        <div class="row form-group col-12">
                            <div class="col-3">
                                <label for="text-input" class="form-control-label">Quality Attribute</label>
                            </div>
                            <div class="col-7">
                                <select id="qtyAttribute" data-parsley-group="block3" required class="form-control">
                                    <option>Select Quality Attribute</option>
                                        <?php
                                        include_once ('../backend/QualityAttribute.php');
                                        $qty = new QualityAttribute();
                                        $result = $qty->get_all_attributes();

                                        foreach ($result as $item)
                                        {
                                            echo
                                            ("
                                            <option value='$item->qtyAtriId'>$item->qtyAtriName</option>
                                        ");
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group col-12">
                            <div class="col-3">
                                <label for="text-input" class="form-control-label">Min Value</label>
                            </div>
                            <div class="col-7">
                                <input  type="text" data-parsley-group="block3"  name="minValTab" id="minValTab" placeholder="1.5"  class="form-control">
                            </div>
                        </div>
                        <div class="row form-group col-12">
                            <div class="col-3">
                                <label for="text-input" class="form-control-label">Max Value</label>
                            </div>
                            <div class="col-7">
                                <input  type="text" data-parsley-group="block3"  name="maxValTab" id="maxValTab"  placeholder="5.5" class="form-control">
                            </div>
                        </div>
                        <div>
                            <ol class="breadcrumb pull-right">
                                <div>
                                <button type="button" onclick="addQuality()" class="btn btn-primary pull-right">
                                    <i class="fa fa-plus"></i> Add Quality Attribute
                                </button>
                            </div>
                            </ol>
                        </div>
<!--                        *****************************data table*******************************-->
                        <div>
                            <table class="table nodisplay" id="dataTabale_quality">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Min Val</th>
                                        <th>Max Val</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="qtyAtt">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row form-group col-12">
                        <div class="card-footer col-12" align="center">
                            <button type="button" class=" btn btn-primary btn-sm" onclick="to_wiz_2()">
                                <i class="fa fa-arrow-left"></i> previous
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Save
                            </button>
                        </div>
                    </div>
                </span>
<!--****************************************set qualty atrtibute wizard end******************************************-->
            </form>
        </div>
    </div>
</div>
<?php
include_once ('footer.php');
?>
<script>
    var exicuted = false;
    var exicuted_quality = false

//    go to next-recipe wizard*************************************************************************
    function nextWiz()
    {

        var x = $('#newproduct').parsley().validate({
            group: 'block1',
            force: true
        });

        if(x){
            $("#ingList").removeClass("nodisplay");
            $("#ingHead").removeClass("nodisplay");
            $("#basicIfo").addClass("nodisplay");
            $("#productHead").addClass("nodisplay");
        }
        else{

        }
    }
//    go to next-recipe wizard*************************************************************************
    function nextWiz_2()
    {
        var x = $('#newproduct').parsley().validate({
            group: 'block2',
            force: true
        });

        var w = $('#recipeListBody').children().length;

        if(x && (w != 0)) {
            $("#ingList").addClass("nodisplay");
            $("#ingHead").addClass("nodisplay");
            $("#basicIfo").addClass("nodisplay");
            $("#productHead").addClass("nodisplay");
            $("#qtyList").removeClass("nodisplay");
            $("#qtyHead").removeClass("nodisplay");
        }
        else {}
    }
//    go to first wizart***********************************************************************************
    function to_wiz_1()
    {
        $("#ingList").addClass("nodisplay");
        $("#ingHead").removeClass("nodisplay");
        $("#basicIfo").removeClass("nodisplay");
        $("#productHead").addClass("nodisplay");
        $("#qtyList").addClass("nodisplay");
        $("#qtyHead").addClass("nodisplay");
    }
//    go to seconf wizard*******************************************************************************
    function to_wiz_2()
    {
        $("#ingList").removeClass("nodisplay");
        $("#ingHead").addClass("nodisplay");
        $("#basicIfo").addClass("nodisplay");
        $("#productHead").addClass("nodisplay");
        $("#qtyList").addClass("nodisplay");
        $("#qtyHead").addClass("nodisplay");
    }
//    append data recipe*****************************************************************************
    var golbalenum = 0;
    function add_list()
    {
        if($('#itemid').val && $("#itemName").val() && $("#itemType").val() && $("#qtyPK").val()){
            var w = $('#recipeListBody').children().length;
            var x = parseFloat($('#qtyPK').val());
            if (isNaN(x)){x=0;}
            var ok = false;
            if(w != 0){

                ok = test(x);
            }
            else{
                golbalenum = x;
                ok = true;
            }
            if(ok){
                if (exicuted == false)
                {
                    $("#dataTabale").removeClass("nodisplay");
                    $("#recipeListBody").append("<tr id='raw_"+$("#itemid").val()+"'>" +
                        "<td><input type='text' class='form-control' readonly id='item_Id_list' name='item_Id_list[]' value='"+$('#itemid').val()+"'></td>" +
                        "<td><input type='text' class='form-control' readonly id='itemName_list' name='itemName_list[]' value='"+$("#itemName").val()+"'></td>" +
                        "<td><input type='text' class='form-control' readonly id='itemName_list' name='itemName_list[]' value='"+$("#itemType").val()+"'></td>" +
                        "<td><input type='text' class='form-control' readonly id="+$('#itemid').val()+"'itemQty_list' name='itemQty_list[]' value='"+$("#qtyPK").val()+"'></td>" +
                        "<td><button type='button' class='btn btn-danger  btn-block' onclick='delItem("+$("#itemid").val()+","+ $("#qtyPK").val()+")'><i class='fa fa-minus-circle'></i></button></td>" +
                        "</tr>");
                    $("#itemid").val("");
                    $("#itemName").val("");
                    $("#itemType").val("");
                    $("#qtyPK").val("");

                    exicuted = true
                }
                else
                {
                    $("#recipeListBody").append("<tr id='raw_"+$("#itemid").val()+"'>" +
                        "<td><input type='text' readonly class='form-control' id='item_Id_list' name='item_Id_list[]' value='"+$('#itemid').val()+"'></td>" +
                        "<td><input type='text' readonly class='form-control' id='itemName_list' name='itemName_list[]' value='"+$("#itemName").val()+"'></td>" +
                        "<td><input type='text' readonly class='form-control' id='itemName_list' name='itemName_list[]' value='"+$("#itemType").val()+"'></td>" +
                        "<td><input type='text' readonly class='form-control' id='itemQty_list' name='itemQty_list[]' value='"+$("#qtyPK").val()+"'></td>" +
                        "<td><button type='button' class='btn btn-danger  btn-block' onclick='delItem("+$("#itemid").val()+","+ $("#qtyPK").val()+")'><i class='fa fa-minus-circle'></i></button></td>" +
                        "</tr>");
                    $("#itemid").val("");
                    $("#itemName").val("");
                    $("#itemType").val("");
                    $("#qtyPK").val("");
                }
            }
            else
            {
                $.alert('Total quantity of recipe items must be 1KG.');
            }
        }

    }

    // delete >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    function delItem(i_id,qu)
    {
        golbalenum -= parseFloat(qu);
        $('#raw_'+i_id).remove();
    }

//    append data quality*****************************************************************************
    function addQuality()
    {

        var minVal = $("#minValTab").val();
        var maxVal = $("#maxValTab").val();

        if (minVal < maxVal)
        {
            $("#dataTabale_quality").removeClass("nodisplay");

            $("#qtyAtt").append("<tr id='rec_"+$('#qtyAttribute :selected').val()+"'>" +
                "<td><input type='text' readonly class='form-control'  id='attId' name='attId[]' value='"+$('#qtyAttribute :selected').val()+"'></td>" +
                "<td><input type='text' readonly class='form-control' id='attName' name='attName[]' value='"+$("#qtyAttribute :selected").text()+"'></td>" +
                "<td><input type='text' readonly class='form-control' id='minVal' name='minVal[]' value='"+$("#minValTab").val()+"'></td>" +
                "<td><input type='text' readonly class='form-control' id='maxVal' name='maxVal[]' value='"+$("#maxValTab").val()+"'></td>" +
                "<td><button type='button' class='btn btn-danger  btn-block' onclick='delQty("+$('#qtyAttribute :selected').val()+")'><i class='fa fa-minus-circle'></i></button></td>" +
                "</tr>");
            $("#minValTab").val("");
            $("#maxValTab").val("");
        }
        else
        {
            $.alert("Min value is greater than max value..!")
        }
    }
    function resetRecipe()
    {
        $("#itemid").val("");
        $("#itemName").val("");
        $("#itemType").val("");
        $("#qtyPK").val("");
    }
    function delQty(recId)
    {
        $('#rec_'+recId).remove();

    }
    function setTitle()
    {
        $('#resetBtn').prop('title', 'title2');
    }
    //auto complete*****************************************************

        /*Clear image*/
        /*  Auto Complete code */

        var options = {
            url: function(phrase) {
                return "../ajax/ajax_auto.php?type=getRawMatName&phrase=" + phrase + "&format=json";
            },

            getValue: "rawName",


            list: {

                onSelectItemEvent: function() {

                    var valueName = $("#itemName").getSelectedItemData().rawName;
                    var valueID = $("#itemName").getSelectedItemData().rawId;
                    var valueType = $("#itemName").getSelectedItemData().rawType;


                    $("#itemName").val(valueName);
                    $("#itemid").val(valueID);
                    $("#itemType").val(valueType);
                }
            }        };

        $("#itemName").easyAutocomplete(options);

        function test(x)
        {
            if ((golbalenum + x) <= 1 )
            {
                golbalenum = golbalenum + x;
                return true;
            }
            else
            {
                return false;
            }
        }
</script>