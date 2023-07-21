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
    


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
                            <strong class="card-title">Raw Material Stock</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-bordered superfeed-table">
                                <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Raw Material Name</th>
                                    <th>Quantity (Units)</th>
                                    <th>GRN Reference</th>
                                    <th>Last Update Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include '../config/db.php';

                                $sql = "SELECT * FROM g_raw_stock";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "
                                            <tr>
                                                <td>" . $row['stock_id'] . "</td>
                                                <td>" . $row['matName'] . "</td>
                                                <td id='quantity_" . $row['stock_id'] . "'>" . $row['quantity'] . "</td>
                                                <td>" . $row['reference'] . "</td>
                                                <td>" . $row['date'] . "</td>
                                                <td>
                                                    <button onclick='updateStock(" . $row['stock_id'] . ")' class='btn btn-primary' data-toggle='modal' data-target='#quantityModal'>Update Stocks</button>
                                                    <button onclick='removeStock(" . $row['stock_id'] . ")' class='btn btn-danger' data-toggle='modal' data-target='#removeQuantityModal'>Remove Stocks</button>
                                                </td>
                                            </tr>
                                        ";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No data found in the raw stock table.</td></tr>";
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
<!-- Bootstrap Modal -->
<div class="modal fade" id="quantityModal" tabindex="-1" role="dialog" aria-labelledby="quantityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quantityModalLabel">Enter Quantity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" id="quantityInput" class="form-control" placeholder="Enter quantity" min="1" required>
                <div id="max-quantity"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="submitQuantity" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="removeQuantityModal" tabindex="-1" role="dialog" aria-labelledby="removeQuantityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeQuantityModalLabel">Enter Quantity to Remove</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" id="removeQuantityInput" class="form-control" placeholder="Enter quantity" min="1" required>
                <div id="remove-max-quantity"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="submitRemoveQuantity" class="btn btn-primary">Remove</button>
            </div>
        </div>
    </div>
</div>
<!-- Hidden form -->
<form id="updateForm" action="../src/updateStocks.php" method="POST" style="display: none;">
    <input type="hidden" id="stockId" name="stockId" value="">
    <input type="hidden" id="usedQuantity" name="usedQuantity" value="">
</form>
<form id="removeForm" action="../src/removeStocks.php" method="POST" style="display: none;">
    <input type="hidden" id="removeStockId" name="stockId" value="">
    <input type="hidden" id="removeUsedQuantity" name="usedQuantity" value="">
</form>
</div>

<script>
// Global variable to hold the current stock id
var currentStockId = null;

function updateStock(stockId) {
    currentStockId = stockId;
    var currentQuantity = parseInt(document.getElementById("quantity_" + stockId).innerText);

    // Show the modal
    document.getElementById("quantityModal").style.display = "block";
    
    // Show maximum quantity
    document.getElementById("max-quantity").innerText = "Maximum quantity: " + currentQuantity;

    // Set the maximum value for the input field
    document.getElementById("quantityInput").max = currentQuantity;
}

document.getElementById("submitQuantity").addEventListener("click", function() {
    var usedQuantity = parseInt(document.getElementById("quantityInput").value);
    var currentQuantity = parseInt(document.getElementById("quantity_" + currentStockId).innerText);
    
    if (isNaN(usedQuantity) || usedQuantity <= 0) {
        alert("You must enter a positive quantity!");
        return;
    }

    if (usedQuantity > currentQuantity) {
        alert("You can't use more quantity than available!");
        return;
    }

    document.getElementById("stockId").value = currentStockId;
    document.getElementById("usedQuantity").value = usedQuantity;
    
    // Submit the form
    document.getElementById("updateForm").submit();
    
    // Update the quantity display on the table
    var remainingQuantity = currentQuantity - usedQuantity;
    document.getElementById("quantity_" + currentStockId).innerText = remainingQuantity.toString();

    // Hide the modal
    document.getElementById("quantityModal").style.display = "none";
});

function removeStock(stockId) {
    currentStockId = stockId;
    var currentQuantity = parseInt(document.getElementById("quantity_" + stockId).innerText);

    // Show the modal
    document.getElementById("removeQuantityModal").style.display = "block";
    
    // Show maximum quantity
    document.getElementById("remove-max-quantity").innerText = "Maximum quantity: " + currentQuantity;

    // Set the maximum value for the input field
    document.getElementById("removeQuantityInput").max = currentQuantity;
}

document.getElementById("submitRemoveQuantity").addEventListener("click", function() {
    var usedQuantity = parseInt(document.getElementById("removeQuantityInput").value);
    var currentQuantity = parseInt(document.getElementById("quantity_" + currentStockId).innerText);
    
    if (isNaN(usedQuantity) || usedQuantity <= 0) {
        alert("You must enter a positive quantity!");
        return;
    }

    if (usedQuantity > currentQuantity) {
        alert("You can't remove more quantity than available!");
        return;
    }

    document.getElementById("removeStockId").value = currentStockId;
    document.getElementById("removeUsedQuantity").value = usedQuantity;
    
    // Submit the form
    document.getElementById("removeForm").submit();
    
    // Update the quantity display on the table
    var remainingQuantity = currentQuantity - usedQuantity;
    document.getElementById("quantity_" + currentStockId).innerText = remainingQuantity.toString();

    // Hide the modal
    document.getElementById("removeQuantityModal").style.display = "none";
});
</script>




