<?php
// Include the database connection file
include '../config/db.php'; 

// Get the form data
$attributeName = $_POST['attributeName'];
$attributeDes = $_POST['attributeDes'];

// Create the SQL query
$sql = "INSERT INTO g_quality_attribute (g_attribute_name, g_attribute_desc	) VALUES ('$attributeName', '$attributeDes')";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === TRUE) {
    // The category was added successfully
    echo "<script>alert('Attribute added successfully');</script>";
    header("Location: ../public/productQualityAttribute.php");
} else {
    // The category was not added successfully
    echo "Error adding category: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
