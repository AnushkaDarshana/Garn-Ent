<?php
// Assuming you have established a database connection
include '../config/db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $productCatId = $_POST['catagory_id'];
    $productName = $_POST['productName'];
    $productUnitPrice = $_POST['proUnitPrz'];
    $productUnitWeight = $_POST['proUnitWeight'];
    $temperature = $_POST['temperature'];
    $hours = $_POST['hours'];
    $minutes = $_POST['mins'];
    $bufferLevel = $_POST['bufferLevel'];

    // Insert data into the g_product table
    $sql = "INSERT INTO g_product (product_cat_id, product_name, product_unit_price, product_unit_weight, temp, t_hour, min, buffer_l)
            VALUES ('$productCatId', '$productName', '$productUnitPrice', '$productUnitWeight', '$temperature', '$hours', '$minutes', '$bufferLevel')";
    
    if ($conn->query($sql) === TRUE) {
        // Success message
        header("Location: ../public/productView.php");
    } else {
        // Error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
