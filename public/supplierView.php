

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


<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Suppliers</strong>
                    </div>
                    <div class="card-body">
                        <table id="da" class="table superfeed-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Fax</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include '../config/db.php';

                                    $sql = "SELECT * FROM g_supplier";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                                <tr id='supplier_" . $row['s_id'] . "'>
                                                    <td>" . $row['s_id'] . "</td>
                                                    <td>" . $row['s_name'] . "</td>
                                                    <td>" . $row['s_email'] . "</td>
                                                    <td>" . $row['s_contact'] . "</td>
                                                    <td>" . $row['s_fax'] . "</td>
                                                    <td>
                                                        <!-- Action buttons here -->
                                                        <button type='button' class='btn btn-primary btn-sm' onclick='editSupplier(" . $row['s_id'] . ")'>Edit</button>
                                                        <button type='button' class='btn btn-danger btn-sm' onclick='deleteSupplier(" . $row['s_id'] . ")'>Delete</button>
                                                    </td>
                                                </tr>
                                            ";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No suppliers found.</td></tr>";
                                    }
                                
                                $conn->close();

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- page content end -->
<!--modal start-->
<div class="modal fade" id="viewInfo" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Raw Materials</h5>
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
                                        <div class="row justify-content-md-center">
                                            <div class="col-10">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Raw Material ID</th>
                                                        <th>Raw Material Name</th>
                                                    </tr>
                                                    <tbody id="rawIfo">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
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
<!--modal end-->
<!--edit modal start-->
<div class="modal fade" id="editInfo" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Edit Supplier</h5>
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
                                    <form action="supplier_view.php" method="post" class="form-horizontal">
                                        <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                                        <input type="text" hidden  id="s_id" name="s_id">
                                        <div class="row justify-content-md-center">
                                            <div class="col-12">
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
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
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
</div>
<!--edit modal end-->
<script>
    function viewInfo(supID)
    {
        $.get("../ajax/ajax_supplier.php?type=get_sup_list",{sup_ID:supID},function (data)
        {
            if (data)
            {
                rawMatInfo = JSON.parse(data);
                $('#rawIfo').html("");

                for(var index = 0; index < rawMatInfo.length; index++)
                {
                    $('#rawIfo').append("<tr>" +
                        "<td>"+rawMatInfo[index].rawItemId+"</td>" +
                        "<td>"+rawMatInfo[index].rawName+"</td>" +
                        "</tr>");
                }
            }
        });
    }
    function editInfo(supID)
    {
        $("#s_id").val(supID);
        $.get("../ajax/ajax_supplier.php?type=view_sup_info",{sup_ID:supID},function (data)
        {
            if (data)
            {
                supInfo = JSON.parse(data);
                $("#s_name").val(supInfo.supplier_name);
                $("#s_address").val(supInfo.supplier_address);
                $("#s_email").val(supInfo.supplier_email);
                $("#s_tp").val(supInfo.supplier_contact);
                $("#s_fax").val(supInfo.supplier_fax);
            }
        });
    }
    function delete_sup(supId)
    {
        $.confirm({
            title: 'Confirm!',
            content: 'Supplier Delete Confirmation',
            buttons: {
                confirm: function () {
                    $.get("../ajax/ajax_supplier.php?type=del_sup",{sup_ID:supId},function (data)
                    {
                        if (data == 1)
                        {
                            $.alert('Data Deleted is Success!');
                            $('#sup_'+supId).hide();
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




