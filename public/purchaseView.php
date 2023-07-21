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
        ?>

        <!-- Header-->

        <?php include './components/topNav.html'; ?>

        
<div>
    <div class="content mt-3">
        <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Purchase Orders</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-bordered superfeed-table">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Supplier Name</th>
                                        <th>Create Date</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price (LKR)</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include '../config/db.php';

                                    // SQL query to retrieve data from the database
                                    $sql = "SELECT o.order_id, s.s_name, o.date, p.	product_name, o.quantity, o.price, o.status
                                            FROM g_purch_order o
                                            INNER JOIN g_supplier s ON o.supplierID = s.s_id
                                            INNER JOIN g_product p ON o.productID = p.product_id";
                                    
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['order_id'] . "</td>";
                                            echo "<td>" . $row['supplierName'] . "</td>";
                                            echo "<td>" . $row['date'] . "</td>";
                                            echo "<td>" . $row['productName'] . "</td>";
                                            echo "<td>" . $row['quantity'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "<td><a href='edit_order.php?order_id=" . $row['order_id'] . "'>Edit</a> | <a href='delete_order.php?order_id=" . $row['order_id'] . "'>Delete</a></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No data found.</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
        <!-- Button to open the pop-up modal -->
        <button id="addOrderBtn" class="btn btn-primary" data-toggle="modal" data-target="#addOrderModal">Add Purchase Order</button>

        <!-- Bootstrap Modal -->
        <div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog" aria-labelledby="addOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addOrderModalLabel">Add Purchase Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for adding a new purchase order -->
                        <form id="addOrderForm" action="add_purchase_order.php" method="post">
                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <!-- Dropdown to select the supplier -->
                                <select name="supplier_id" id="supplier_id" class="form-control" required>
                                    <option value="">Select Supplier</option>
                                    <?php
                                    // Fetch suppliers from the database and populate the dropdown
                                    $sql = "SELECT s_id, s_name FROM g_supplier";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['s_id'] . "'>" . $row['s_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <!-- Dropdown to select the product (will be populated dynamically based on the selected supplier) -->
                                <select name="product_id" id="product_id" class="form-control" required>
                                    <option value="">Select Product</option>
                                    <!-- Products will be populated here via AJAX -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price (LKR)</label>
                                <input type="number" name="price" id="price" class="form-control" required>
                            </div>
                            <!-- Add other form fields for Date, Status, etc. if needed -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="addOrderForm" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Button to open the pop-up modal -->

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Event listener for supplier selection change
        document.getElementById('supplier_id').addEventListener('change', function () {
            var supplierId = this.value;

            // Make an AJAX request to retrieve products for the selected supplier
            // Replace 'get_products.php' with the server endpoint to fetch products based on supplierId
            fetch('get_products.php?supplier_id=' + supplierId)
                .then(response => response.json())
                .then(data => {
                    // Populate the product dropdown with the retrieved products
                    var productDropdown = document.getElementById('product_id');
                    productDropdown.innerHTML = '<option value="">Select Product</option>';
                    data.forEach(product => {
                        productDropdown.innerHTML += '<option value="' + product.product_id + '">' + product.product_name + '</option>';
                    });
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                });
        });
    });
</script>