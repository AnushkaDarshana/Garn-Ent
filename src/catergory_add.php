

<?php
// Include the database connection file
include '../config/db.php'; 

// Get the form data
$catName = $_POST['catName'];
$catDes = $_POST['catDes'];

// Create the SQL query
$sql = "INSERT INTO g_product_catagory (catagory_name, catagory_description) VALUES ('$catName', '$catDes')";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === TRUE) {
    // The category was added successfully
    echo "<script>alert('Category added successfully');</script>";
    header("Location: ../public/catergoryView.php");
} else {
    // The category was not added successfully
    echo "Error adding category: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
