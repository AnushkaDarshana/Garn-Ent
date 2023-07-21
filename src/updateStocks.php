<?php
include '../config/db.php';

// Get the data from the form
$stockId = $_POST['stockId'];
$usedQuantity = $_POST['usedQuantity'];

// Query to get the current quantity and matName of the stock item
$sql = "SELECT quantity, matName FROM g_raw_stock WHERE stock_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $stockId);
$stmt->execute();
$result = $stmt->get_result();

// Check if the stock item was found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentQuantity = $row['quantity'];
    $matName = $row['matName'];

    // Check if the used quantity is less than or equal to the current quantity
    if ($usedQuantity <= $currentQuantity) {
        $remainingQuantity = $currentQuantity - $usedQuantity;

        // Update the quantity of the stock item in the g_raw_stock table
        $sql = "UPDATE g_raw_stock SET quantity = ? WHERE stock_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $remainingQuantity, $stockId);
        $stmt->execute();

        // Check if the stock item already exists in the g_finished_stock table
        $sql = "SELECT quantity FROM g_finish_stock WHERE stock_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $stockId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // The stock item exists in the g_finished_stock table, update the quantity
            $row = $result->fetch_assoc();
            $currentFinishedQuantity = $row['quantity'];
            $newFinishedQuantity = $currentFinishedQuantity + $usedQuantity;
            
            $sql = "UPDATE g_finish_stock SET quantity = ? WHERE stock_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $newFinishedQuantity, $stockId);
            $stmt->execute();
        } else {
            // The stock item does not exist in the g_finished_stock table, insert a new row
            $sql = "INSERT INTO g_finish_stock (stock_id, matName, quantity) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isi", $stockId, $matName, $usedQuantity);
            $stmt->execute();
        }

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
