<?php
// Include the database connection configuration
include '../config/db.php';

if (isset($_GET['supplier_id'])) {
    // Get the selected supplier ID from the AJAX request
    $supplierId = $_GET['supplier_id'];
    
    // SQL query to retrieve products for the selected supplier
    $sql = "SELECT product_id, product_name FROM g_product WHERE supplier_id = ?";

    // Prepare the SQL query and bind the parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $supplierId);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the products as an associative array
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo 13;
    // Return the products as a JSON response
    echo json_encode($products);
} else {
    // Return an empty response if no supplier_id is provided
    echo json_encode([]);
}

$conn->close();
?>
