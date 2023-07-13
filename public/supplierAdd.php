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


        
<!-- page content start -->
<div class="col-lg-12">
    <?=$alert?>
    <div class="card">
        <div class="card-header">
            <strong>Add Supplier</strong>
        </div>
        <div class="card-body">
            <form action="" data-parsley-validate=""  method="post" action="supplier_add.php" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                <div class="row form-group" >
                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Name</label></div>
                    <div class="col-12 col-md-7"><input required type="text" id="s_name" name="s_name" placeholder="abc(pvt)ltd" class="form-control"></div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Address</label></div>
                    <div class="col-12 col-md-7"><input type="text" name="s_address" id="s_address" placeholder="Kandy Road,Colombo-6,Sri Lanka" class="form-control"></div>
                </div>

                <div class="row form-group" >
                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Email</label></div>
                    <div class="col-12 col-md-7"><input required type="email" id="s_email" name="s_email" placeholder="abc@gmail.com" class="form-control"></div>
                </div>

                <div class="row form-group" >
                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Contact</label></div>
                    <div class="col-12 col-md-7"><input required type="text" id="s_tp" name="s_tp" placeholder="+9412345789" class="form-control"></div>
                </div>
                <div class="row form-group" >
                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Fax</label></div>
                    <div class="col-12 col-md-7"><input required type="text" id="s_fax" name="s_fax" placeholder="+9412345789" class="form-control"></div>
                </div>
                <div><hr></div>
                <div class="row form-group">
                    <div class="col-2"><label for="text-input" class=" form-control-label">Raw Materials</label></div>
                    <div class="col-7">
                        <select id="rawMat" name="rawMat" class="form-control">
                            <option>Select Raw Material</option>
                            <?php
                            include_once ('../backend/RawMaterial.php');
                            $raw = new RawMaterial();
                            $result = $raw->view_raw_material();

                            foreach ($result as $item)
                            {
                                echo
                                ("
                                        <option value='$item->rawId'>$item->rawName</option>
                                            ");
                            }
                            ?>
                        </select>
                    </div>
                  // <div>
                        <button type="button" onclick="add_list()" data-toggle="modal" data-target="#largeModal" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add Item
                        </button>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <div class="form-control-label col-2">
                    </div>
                    <table class="table col-7">
                        <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                        </thead>
                        <tbody id="rawInfo">

                        </tbody>
                    </table>
                </div> 
                <div class="card-footer" align="center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-dot-circle-o"></i> Save
                    </button>
                    <button type="reset" class="btn btn-danger">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- page content end -->
<?php
include_once ("footer.php");
?>
<script>
    function add_list()
    {
        $("#rawInfo").append("<tr id='"+$('#rawMat :selected').val()+"'>" +
            "<td><input type='text' readonly class='form-control'  id='rawId' name='rawId[]' value='"+$('#rawMat :selected').val()+"'></td>" +
            "<td><input type='text' readonly class='form-control' id='rawName' name='rawName[]' value='"+$("#rawMat :selected").text()+"'></td>" +
            "<td><button type='button' class='btn btn-danger btn-sm' onclick='deletePro("+$("#proCode").val()+")' title='Product Delete'><i class='fa fa-trash-o'></i></button></td>" +
            "</tr>");
    }
    function deletePro()
    {

    }
</script>


