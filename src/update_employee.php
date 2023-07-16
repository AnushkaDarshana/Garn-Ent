<?php
    include '../config/db.php'; // include the connection file here

     // Receive data from the AJAX request
     $id = $_POST['id'];
     $name = $_POST['name'];
     $designation = $_POST['designation'];
     $email = $_POST['email'];
     $contact = $_POST['contact'];
     $status = $_POST['status'];
     $reg_date = $_POST['reg_date'];
     $address = $_POST['address'];
     $nic = $_POST['nic'];
     $gender = $_POST['gender'];
     $user_type = $_POST['user_type'];
     
     // etc. for each field
 
     // Update the database
    $sql = "UPDATE g_employee 
    SET e_name='$name', 
        designation='$designation',
        e_email='$email',
        e_contact='$contact',
        e_soc_status='$status',
        e_reg_date='$reg_date',
        e_address='$address',
        e_nic='$nic',
        e_gender='$gender',
        e_user_type_fk='$user_type'
    WHERE e_id=$id";
 
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
 
    $conn->close();
?>