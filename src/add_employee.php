<?php

include '../config/db.php'; // include the connection file here
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST['e_name'];
    $address = $_POST['e_address'];
    $email = $_POST['e_email'];
    $contact = $_POST['e_tp'];
    $nic = $_POST['e_nic'];
    $userType = $_POST['e_user_type'];
    $gender = $_POST['e_gender'];
    $socialStatus = $_POST['e_soc_status'];
    $password = $_POST['u_password'];


    // Prepare and execute the SQL query to insert the employee into the database
    $sql = "INSERT INTO g_employee (e_name, e_reg_date, e_address, e_nic, e_contact, e_email, e_gender, e_soc_status, designation)
        VALUES ('$name', NOW(), '$address', '$nic', '$contact', '$email', '$gender', '$socialStatus', '$userType')";


    if ($conn->query($sql) === TRUE) {
        // Redirect to success page
        header("Location: ../public/employeeList.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
