<?php
// Include the database connection file
include '../config/db.php'; 

$s_name = $_POST['s_name'];
$s_address = $_POST['s_address'];
$s_email = $_POST['s_email'];
$s_tp = $_POST['s_tp'];
$s_fax = $_POST['s_fax'];


// Create the SQL query
$sql = "INSERT INTO g_supplier (s_name, s_address, s_email, s_contact, s_fax) VALUES ('$s_name', '$s_address', '$s_email', '$s_tp', '$s_fax')";


// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === TRUE) {
    // The category was added successfully
    echo "<script>alert('Raw Materials added successfully');</script>";
    header("Location: ../public/supplierView.php");
} else {
    // The category was not added successfully
    echo "Error adding category: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
