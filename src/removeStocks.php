<?php
include '../config/db.php';

// Get the data from the form
$stockId = $_POST['stockId'];
$usedQuantity = $_POST['usedQuantity'];

// Query to get the current quantity of the stock item
$sql = "SELECT quantity FROM g_raw_stock WHERE stock_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $stockId);
$stmt->execute();
$result = $stmt->get_result();

// Check if the stock item was found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentQuantity = $row['quantity'];

    // Check if the used quantity is less than or equal to the current quantity
    if ($usedQuantity <= $currentQuantity) {
        $remainingQuantity = $currentQuantity - $usedQuantity;

        // Update the quantity of the stock item in the g_raw_stock table
        $sql = "UPDATE g_raw_stock SET quantity = ? WHERE stock_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $remainingQuantity, $stockId);
        $stmt->execute();

        header("Location: http://localhost/Garn-ent/public/stocksRawIn.php");
        exit();
    } else {
        echo "Used quantity is greater than current quantity.";
    }
} else {
    echo "Stock item not found.";
}

$conn->close();
?>
