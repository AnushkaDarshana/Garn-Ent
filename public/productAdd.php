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

        <form data-parsley-validate="" action="../src/product_add.php" method="post" class="form-horizontal" id="newproduct">
            <div class="card-body card-block">

                <div class="row form-group" >
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                    <div class="col-12 col-md-7"><input type="text" data-parsley-group="block1" required id="productName" name="productName" placeholder="Cattle Feed" class="form-control"></div>
                </div>
                    <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Catagory</label></div>
                    <div class="col-12 col-md-7">
                        <select id="catagory_id" required data-parsley-group="block1"  name="catagory_id" class="form-control">
                        <option value="">Select Category</option>
                        <?php
                            // Assuming you have established a database connection
                            include '../config/db.php';

                            // Retrieve product categories from the database
                            $sql = "SELECT catagory_id, catagory_name FROM g_product_catagory";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Generate option elements for each category
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['catagory_id'] . "'>" . $row['catagory_name'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No categories found</option>";
                            }

                            // Close the database connection
                            $conn->close();
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
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Buffer Levels (Units)</label></div>
                    <div class="col-12 col-md-7"><input data-parsley-group="block1" data-parsley-type="number" required  type="number" step="0.01" id="bufferLevel" name="bufferLevel" placeholder="1500" class="form-control"></div>
                </div>
                <div class="card-footer" align="center">
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-success btn-sm" onclick="nextWiz()" id="btn1">
                        Submit <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
                        </div>
            </form>

