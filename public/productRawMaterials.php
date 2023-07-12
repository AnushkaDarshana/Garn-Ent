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


<div>
    <div class="breadcrumbs">
        <?$alert?>
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Raw Materials</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <?php

                        if ($_SESSION['usertype'] === 'Admin')
                        {
                            echo ('<div><button type="button" $dis2 data-toggle="modal" data-target="#largeModal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Item</button> </div>');
                        }
                        ?>
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
                            <strong class="card-title">Raw Materials</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Item Code</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Reorder Level (Units)</th>
                                    <th scope="col">Unit Type</th>
                                    <th scope="col">Unit Price (Rs)</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $rawMats = new RawMaterial();
                                $result = $rawMats->view_raw_material();

                                foreach ($result as $item)
                                {
                                    $dis = '';
                                    if ($_SESSION['usertype'] != 'Admin')
                                    {
                                        $dis = 'disabled';
                                    }
                                    echo
                                    ("
                                          <tr id='raw_$item->rawId'>
                                            <td>$item->rawId</td>
                                            <td>$item->rawName</td>
                                            <td>$item->reOrderLevel</td>
                                            <td>$item->rawType</td>
                                            <td>$item->unitPrice</td>
                                            <td>$item->description</td>
                                            <td>
                                                <button type='button' data-toggle='modal' data-target='#editModal' $dis class='btn btn-success btn-sm' onclick='edit_raw($item->rawId)'>
                                                <i class='fa fa-edit'></i> Edit</button>
                                                <button type='button' class='btn btn-danger btn-sm' $dis onclick='del_raw($item->rawId)'>
                                                <i class='fa fa-times-circle'></i> Delete</button>
                                            </td>
                                          </tr>
                                        ");
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
<!--modal start-->
<div class="modal fade" id="largeModal" tabiraw_materials.phpndex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Add Raw Materials</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body card-block">
                                <form data-parsley-validate=""  method="post" action="raw_materials.php" enctype="multipart/form-data" class="form-horizontal">
                                    <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Item Name</label></div>
                                        <div class="col-9"><input type="text" required id="rawName" name="rawName" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Unit Type</label></div>
                                        <div class="col-9">
                                            <select id="unitType" required name="unitType" class="form-control">
                                                <option>Select Unit Type</option>
                                                <option>Kilogram</option>
                                                <option>Gram</option>
                                                <option>Liters</option>
                                                <option>Milliliters</option>
                                                <option>Packets</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Unit Price</label></div>
                                        <div class="col-9"><input required data-parsley-type="number" type="text" id="uniPrice" name="unPrice" placeholder="Enter Unit Price" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Reorder Level (Units)</label></div>
                                        <div class="col-9"><input required data-parsley-type="number" type="text" id="reLevel" name="reLevel" placeholder="Enter Reorder Level" class="form-control"></div>
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
<!--edit modal start-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Edit Raw Materials</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body card-block">
                                <form data-parsley-validate=""  method="post" action="raw_materials.php" enctype="multipart/form-data" class="form-horizontal">
                                    <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Item Name</label></div>
                                        <div class="col-9"><input type="text" id="rawNameEdit" name="rawNameEdit" placeholder="Enter Name" class="form-control" required></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Unit Type</label></div>
                                        <div class="col-9">
                                            <select id="unitTypeEdit" name="unitTypeEdit" class="form-control" required>
                                                <option value="">Select Unit Type</option>
                                                <option value="Kilogram">Kilogram</option>
                                                <option value="Gram">Gram</option>
                                                <option value="Liters">Liters</option>
                                                <option value="Milliliters">Milliliters</option>
                                                <option value="Packets">Packets</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Unit Price</label></div>
                                        <div class="col-9"><input type="text" required id="uniPriceEdit" name="unPriceEdit" placeholder="Enter Unit Price" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Reorder Level</label></div>
                                        <div class="col-9"><input type="text" required id="reLevelEdit" name="reLevelEdit" placeholder="Enter Reorder Level" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Description</label></div>
                                        <div class="col-9"><textarea id="descriptionEdit" required rows="3" name="descriptionEdit" placeholder="Enter Description" class="form-control"></textarea></div>
                                    </div>
                                    <input hidden type="text" name="rawId" id="rawId">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <input type="reset" class="btn btn-warning">
                                        <input type="submit" class="btn btn-primary" id="btnModaOk" value="Update">
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
<!--edit modal end-->
<?php
include_once ('footer.php');
?>
<script>
//    function del_raw(rawID)
//    {
//
//        $.get("../ajax/ajax_raw_material.php?type=del_raw",{raw_id:rawID},function (data)
//        {
//            if (data == 111)
//            {
//                $('#raw_'+rawID).hide();
//            }
//        });
//    }
    function edit_raw(rawID)
    {

        $.get("../ajax/ajax_raw_material.php?type=raw_edit",{raw_id:rawID},function (data)
        {
            if (data)
            {
                rawItem = JSON.parse(data);
                $("#rawId").val(rawID);
                $("#rawNameEdit").val(rawItem.rawName);
                $("#uniPriceEdit").val(rawItem.unitPrice);
                $("#reLevelEdit").val(rawItem.reOrderLevel);
                $("#descriptionEdit").val(rawItem.description);
                $("#unitTypeEdit").val(rawItem.rawType);
            }
        });
    }
    function del_raw(rawID)
    {
        $.confirm({
            title: 'Confirm!',
            content: 'Raw Material Delete Confirmation',
            buttons: {
                confirm: function () {
                    $.get("../ajax/ajax_raw_material.php?type=del_raw",{raw_id:rawID},function (data)
                    {
                        if (data)
                        {
                            $.alert('Data Deleted is Success!');
                            $('#raw_'+rawID).hide();
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
