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
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Products</strong>
                        </div>
                        <div class="card-body">
                            <table class="table superfeed-table">
                                <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Product Name</th>
<!--                                    <th scope="col">Category</th>-->
                                    <th scope="col">Unit Price (Rs)</th>
                                    <th scope="col">Unit Weight (Kg)</th>
                                    <th scope="col">Buffer Level (Units)</th>
                                    <th scope="col">Time (Minutes)</th>
                                    <th scope="col">Temperature (Celsius)</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include '../config/db.php';

                                    $sql = "SELECT * FROM g_product";
                                    $result = $conn->query($sql);
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            
                                            echo "
                                                    <tr id='pro_" . $row['product_id'] . "'>
                                                    <td>" . $row['product_id'] . "</td>
                                                    <td>" . $row['product_name'] . "</td>
                                                    <td>" . $row['product_unit_price'] . "</td>
                                                    <td>" . $row['product_unit_weight'] . "</td>
                                                    <td>" . $row['buffer_l'] . "</td>
                                                    <td>" . $row['t_hour'] . "</td>
                                                    <td>" . $row['temp'] . "</td>
                                                    <td>
                                                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editInfo' onclick='editInfo(" . $row['product_id'] . ")' title='Product Edit'>
                                                            <i class='fa fa-edit'></i>
                                                        </button>
                                                        <button type='button' class='btn btn-danger btn-sm' onclick='deletePro(" . $row['product_id'] . ")' title='Product Delete'>
                                                            <i class='fa fa-trash-o'></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            ";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No products found.</td></tr>";
                                    }
                                    
                                    $conn->close();
                                    
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
<!--*************************************************Modal start product info edit************************************-->
<div class="modal fade" id="editInfo" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Edit Product</h5>
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
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product ID</label></div>
                                            <div class="col-12 col-md-7"><input readonly type="text" id="proID" name="proID" placeholder="Enter Unit Price" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Name</label></div>
                                            <div class="col-12 col-md-7"><input  type="text" id="proName" name="proName" placeholder="Enter Unit Weight" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Category</label></div>
                                            <div class="col-12 col-md-7"><input disabled  type="text" id="catName" name="catName" placeholder="Enter Unit Count" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Unit Weight (Kg)</label></div>
                                            <div class="col-12 col-md-7"><input  type="text" id="unitWeight" name="unitWeight" placeholder="Enter Unit Count" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Unit Price (Rs)</label></div>
                                            <div class="col-12 col-md-7"><input  type="text" id="unitPrice" name="unitPrice" placeholder="Enter Unit Count" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Buffer Level</label></div>
                                            <div class="col-12 col-md-7"><input  type="text" id="bufferLevel" name="bufferLevel" placeholder="Enter Unit Count" class="form-control"></div>
                                        </div>
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
</div>
<!--****************************************************************************************************************-->
<!--***************************************************view product recipe modal***************************************-->
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
                                            <div class="row justify-content-md-center">
                                                <div class="col-10">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Raw Name</th>
                                                            <th>Raw Quanity</th>
                                                        </tr>
                                                        <tbody id="productRawDeatils">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
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
<!--*******************************************************view quality attributes modal************************************-->
<div class="modal fade" id="qualityAttri" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Quality Attributes</h5>
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
                                                        <th>Quality Attribute</th>
                                                        <th>Low Margin</th>
                                                        <th>High Margin</th>
                                                    </tr>
                                                    <tbody id="productQualityAttribute">

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

<script>
//    ********************************************edit product info********************************
    function editInfo(productId)
    {
        $.get("../ajax/ajax_product_new.php?type=view_product_by_id",{pro_id:productId},function (data)
        {
            if (data)
            {
                proItem = JSON.parse(data);
                $("#proID").val(proItem.productId);
                $("#proName").val(proItem.productName);
                $("#catName").val(proItem.productCatName);
                $("#unitWeight").val(proItem.productUnitWeight);
                $("#unitPrice").val(proItem.productUnitPrz);
                $("#bufferLevel").val(proItem.productBufferLevel);
            }
        });
    }
//    *************************************************delete product**********************************
    function deletePro(productId)
    {
        $.confirm({
            title: 'Confirm!',
            content: 'Data Delete Confirmation',
            buttons: {
                confirm: function () {
                    $.get("../ajax/ajax_product_new.php?type=delete_product",{pro_id:productId},function (data)
                    {
                        if (data)
                        {
                            $('#pro_'+productId).hide();
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
//    **********************************************view recipe**************************************
    function viewReicpe(productID)
    {
        $.get("../ajax/ajax_product_new.php?type=view_product_recipe",{pro_id:productID},function (data)
        {
            if (data)
            {
                resInfo = JSON.parse(data);
                $("#recName").val(resInfo[0].recipeName);
                $("#recDescription").val(resInfo[0].recipeDescription);
                $('#productRawDeatils').html("");
                for(var index = 0; index < resInfo.length; index++)
                {
                    $('#productRawDeatils').append("<tr>"
                        +"<td>"+resInfo[index].rawName+"</td>"
                        +"<td>"+resInfo[index].rawQty+"</td>"
                        +"</tr>");
                }
            }
        });
    }
//    ************************************************view quality atributes of products************
    function viewQualityAtr(productID)
    {
        $.get("../ajax/ajax_product_new.php?type=view_quality_attri",{pro_id:productID},function (data)
        {
            if (data)
            {
                qtyInfo = JSON.parse(data);
                $('#productQualityAttribute').html("")

                for(var index = 0; index < qtyInfo.length; index++)
                {
                    $('#productQualityAttribute').append("<tr>" +
                        "<td>"+qtyInfo[index].atributeName+"</td>" +
                        "<td>"+qtyInfo[index].minVal+"</td>" +
                        "<td>"+qtyInfo[index].maxVal+"</td>" +
                        "</tr>");
                }
            }
        });
    }
</script>