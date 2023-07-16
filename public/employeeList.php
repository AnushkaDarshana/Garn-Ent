<html>
    <head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Garn Enterprices</title>
    <meta name="description" content="Admin Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="icon" href="images/logo2.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body>

        <!-- Left Panel -->

        <?php include './components/leftNav.html'; ?>

        <!-- Header-->

        <?php include './components/topNav.html'; ?>
<?php
    include '../config/db.php'; // include the connection file here

    // Select all employee records
    $sql = "SELECT * FROM g_employee";
    $result = $conn->query($sql);
?>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All Current Employees</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-bordered superfeed-table">
                            <thead>
                            <tr>
                                <th>Emp ID</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Social Status</th>
                                <th>Account Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while($row = $result->fetch_assoc()) {?>
                                           <tr class='$btn'  id = 'user_$item->employee_id'>
                                                <?php 
                                                echo "<td>" . $row["e_id"] . "</td>";
                                                echo "<td>" . $row["e_name"] . "</td>";
                                                
                                                echo "<td>" . $row["designation"] . "</td>";
                                                echo "<td>" . $row["e_email"] . "</td>";
                                                echo "<td>" . $row["e_contact"] . "</td>";                                                
                                                echo "<td>" . $row["e_soc_status"] . "</td>";
                                                
                                                ?>
                                                
                                                <td>
                                                    <button type='button' id='btn_active'
                                                    class='btn btn-success btn-sm $act' title='Activate Employee' onclick='user_active($item->employee_id, this)'>
                                                        <i class='fa fa-check-square'></i>
                                                    </button>

                                                    <button type='button' id='btn_suspend' title='Deactivate Employee' class='btn btn-warning btn-sm $sus' onclick='user_suspend($item->employee_id, this)'>
                                                    <i class='fa fa-ban'></i>
                                                    </button>
                                                <?php
                                                echo "<td> <button class='btn btn-info' data-toggle='modal' data-target='#employeeModal' 
                                                data-id='".$row["e_id"]."' 
                                                data-name='".$row["e_name"]."' 
                                                data-designation='".$row["designation"]."' 
                                                data-email='".$row["e_email"]."' 
                                                data-contact='".$row["e_contact"]."' 
                                                data-status='".$row["e_soc_status"]."' 
                                                data-reg-date='".$row["e_reg_date"]."' 
                                                data-address='".$row["e_address"]."' 
                                                data-nic='".$row["e_nic"]."' 
                                                data-gender='".$row["e_gender"]."' 
                                                data-user-type='".$row["e_user_type_fk"]."'>View More</button></td>";
                                                echo "</tr>";
                                                ?>

                                                 </td>
                                           </tr>
                                           <?php
                                        }
                                    }
                                ?>
                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Employee Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- Modal body with placeholders for the data -->
        <div class="modal-body">
            <p><strong>ID:</strong> <input type="text" id="employee-id" readonly /></p>
            <p><strong>Name:</strong> <input type="text" id="employee-name" /></p>
            <p><strong>Designation:</strong> <input type="text" id="employee-designation" /></p>
            <p><strong>Email:</strong> <input type="email" id="employee-email" /></p>
            <p><strong>Contact:</strong> <input type="text" id="employee-contact" /></p>
            <p><strong>Status:</strong> <input type="text" id="employee-status" /></p>
            <p><strong>Reg Date:</strong> <input type="text" id="employee-reg-date" readonly /></p>
            <p><strong>Address:</strong> <input type="text" id="employee-address" /></p>
            <p><strong>NIC:</strong> <input type="text" id="employee-nic" /></p>
            <p><strong>Gender:</strong> <input type="text" id="employee-gender" /></p>
            <p><strong>User Type:</strong> <input type="text" id="employee-user-type" /></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="save-button">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<!-- jQuery to populate and show the modal -->
<script>
$(document).ready(function() {
    $('.btn-info').click(function() {
        $('#employee-id').val($(this).data('id'));
        $('#employee-name').val($(this).data('name'));
        $('#employee-designation').val($(this).data('designation'));
        $('#employee-email').val($(this).data('email'));
        $('#employee-contact').val($(this).data('contact'));
        $('#employee-status').val($(this).data('status'));
        $('#employee-reg-date').val($(this).data('reg-date'));
        $('#employee-address').val($(this).data('address'));
        $('#employee-nic').val($(this).data('nic'));
        $('#employee-gender').val($(this).data('gender'));
        $('#employee-user-type').val($(this).data('user-type'));
    });

    $('#save-button').click(function() {
        $.ajax({
            url: '../src/update_employee.php', // The URL of your PHP script that will update the database
            type: 'POST',
            data: {
                id: $('#employee-id').val(),
                name: $('#employee-name').val(),
                designation: $('#employee-designation').val(),
                email: $('#employee-email').val(),
                contact: $('#employee-contact').val(),
                status: $('#employee-status').val(),
                reg_date: $('#employee-reg-date').val(),
                address: $('#employee-address').val(),
                nic: $('#employee-nic').val(),
                gender: $('#employee-gender').val(),
                user_type: $('#employee-user-type').val()
            },
            success: function(result) {
                // Optional: Do something with the result of the AJAX request (e.g., show a success message)
                console.log('Success: ', result);
                window.location.href = "employeeList.php";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // This function will be called if the AJAX request fails
                console.log('Error: ', textStatus, errorThrown);
            }
        });
    });
});
</script>
<?php
    //include_once ("footer.php");
?>
    </body>
</html>
<script>
    function user_delete(u_id)
    {
        $.confirm({
            title: 'Delete Employee?',
            content: "Once deleted you'll not able to recover this record.",
            buttons: {
                deleteUser: {
                    text: 'delete user',
                    action: function ()
                    {
                        //delete

                        $.get("../ajax/ajax_emp.php?type=del_user",{user_id: u_id}, function (data)
                        {
                            if (data === '1')
                            {
                                $('#user_'+u_id).hide();
                            }
                            else
                            {
                                //rrrr
                            }
                        });

                        $.alert('Deleted the employee!');
                    }
                },
                cancelAction: function () {
                    $.alert('action is canceled');
                }
            }
        });
    }


    function user_suspend(u_id,button)
    {

        $.confirm({
            title: 'Suspend Employee?',
            content: "Suspend the employee he/she no longer active.",
            buttons: {
                deleteUser: {
                    text: 'suspend user',
                    action: function ()
                    {
                        //suspend
                        $.get("../ajax/ajax_emp.php?type=sus_emp",{user_id: u_id}, function (data)
                        {
                            if (data)
                            {
                                $(button).parent().parent().removeClass("act");
                                $(button).parent().parent().addClass("suspend");
                                $(button).addClass('nodisplay');
                                $(button).parent().parent().find('#btn_active').removeClass('nodisplay');
                                $(button).parent().parent().find('#status').html('Suspend');

                                $.alert('Employee is Deactivated !');
                            }

                        });
                    }
                },
                cancelAction: function () {
                    $.alert('action is canceled');
                }
            }
        });
    }



    function user_active(u_id,button)
    {

        $.confirm({
            title: 'Activate Employee?',
            content: "Activate the employee he/she no longer deactivate.",
            buttons: {
                deleteUser: {
                    text: 'activate user',
                    action: function ()
                    {
                        //active
                        $.get("../ajax/ajax_emp.php?type=act_emp",{user_id: u_id}, function (data)
                        {
                            if (data === '1')
                            {
                                $(button).parent().parent().removeClass("suspend");
                                $(button).parent().parent().addClass("act");
                                $(button).addClass('nodisplay');
                                $(button).parent().parent().find('#btn_suspend').removeClass('nodisplay');
                                $(button).parent().parent().find('#status').html('Active');

                                $.alert('Employee is Activated !');
                            }
                        });
                    }
                },
                cancelAction: function () {
                    $.alert('action is canceled');
                }
            }
        });
    }
    function viewInfo(empID)
    {
        $.get("../ajax/ajax_emp.php?type=view_info",{user_id:empID}, function (data)
        {
            if (data)
            {
                var empInfo = JSON.parse(data);
                $("#empID").val(empInfo.employee_id);
                $("#empName").val(empInfo.empName);
                $("#desig").val(empInfo.user_type);
                $("#nic").val(empInfo.nic);
                $("#email").val(empInfo.emp_email);
                $("#tel").val(empInfo.tel);
                $("#addrss").val(empInfo.address);
                $("#cstatus").val(empInfo.emp_socialStatus);
                $("#gender").val(empInfo.empGender);

                var d = new Date(empInfo.emp_reg_date);
                var m = d.getMonth();
                var y = d.getFullYear();
                var n = d.getDate();

                $("#date").val(y +"-"+(m+1)+"-"+n);

            }
        });
    }
</script>
