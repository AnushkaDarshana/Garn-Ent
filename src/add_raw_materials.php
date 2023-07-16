<?php
// Include the database connection file
include '../config/db.php'; 

// Get the form data
$itemName = $_POST['itemName'];
$unitType = $_POST['unitType'];
$unitPrice = $_POST['unitPrice'];
$reorderLevel = $_POST['reorderLevel'];
$desc = $_POST['desc'];

// Create the SQL query
$sql = "INSERT INTO g_raw_meterial (raw_name, raw_description, raw_type, raw_reorder_level, raw_unit_price) VALUES ('$itemName', '$desc', '$unitType', '$reorderLevel', '$unitPrice' )";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === TRUE) {
    // The category was added successfully
    echo "<script>alert('Raw Materials added successfully');</script>";
    header("Location: ../public/productRawMaterials.php");
} else {
    // The category was not added successfully
    echo "Error adding category: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
