<html>
    <head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Garn Enterprices</title>
    <meta name="description" content="Admin Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="icon" href="images/logo2.png" type="image/x-icon">

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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
             
                                           <tr class='$btn'  id = 'user_$item->employee_id'>
                                                <td>$item->employee_id</td>
                                                <td>$item->empName</td>
                                                <td>$item->user_type</td>
                                                <td>$item->emp_email</td>
                                                <td>$item->tel</td>
                                                <td id = 'status'>$item->empStatus</td>
                                                <td>
                                                    <button type='button' id='btn_active'
                                                    class='btn btn-success btn-sm $act' title='Activate Employee' onclick='user_active($item->employee_id, this)'>
                                                        <i class='fa fa-check-square'></i>
                                                    </button>

                                                    <button type='button' id='btn_suspend' title='Deactivate Employee' class='btn btn-warning btn-sm $sus' onclick='user_suspend($item->employee_id, this)'>
                                                    <i class='fa fa-ban'></i>
                                                    </button>
                                                    
                                                    <button type='button' id='btn_view' onclick='viewInfo($item->employee_id)' data-toggle=\"modal\" data-target=\"#largeModal\" title='View Employee All Informations' class='btn btn-primary btn-sm'>
                                                    <i class='fa fa-eye'></i>
                                                    </button>

                                                    <a href='add_employee.php?act=edit&id=$item->employee_id'> <button title='Edit Employee Information' type='button' class='btn btn-secondary btn-sm'>
                                                    <i class='fa fa-edit'></i>
                                                    </button></a>

                                                    <button type='button' class='btn btn-danger btn-sm' title='Delete Employee' onclick='user_delete($item->employee_id)'>
                                                        <i class='fa fa-trash'></i>
                                                    </button>

                                                 </td>
                                           </tr>
                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page content end -->
<!--emp info modal start-->
<div class="modal fade" id="largeModal" tabiraw_materials.phpndex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Employee Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body card-block">
                                <form data-parsley-validate=""  method="post" action="raw_materials.php" enctype="multipart/form-data" class="form-horizontal">
                                    <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Emp ID</label></div>
                                        <div class="col-9"><input type="text" disabled id="empID" name="empID" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Name</label></div>
                                        <div class="col-9"><input type="text" disabled id="empName" name="empName" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Designation</label></div>
                                        <div class="col-9"><input type="text" disabled id="desig" name="desig" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">NIC No</label></div>
                                        <div class="col-9"><input type="text" disabled  id="nic" name="nic" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">E mail</label></div>
                                        <div class="col-9"><input type="text" disabled id="email" name="email" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Contact No</label></div>
                                        <div class="col-9"><input type="text" disabled id="tel" name="tel" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Address</label></div>
                                        <div class="col-9"><input type="text" disabled id="addrss" name="addrss" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Civil Status</label></div>
                                        <div class="col-9"><input type="text" disabled id="cstatus" name="cstatus" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Gender</label></div>
                                        <div class="col-9"><input type="text" disabled id="gender" name="gender" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-3"><label for="text-input" class=" form-control-label">Recruit  Date</label></div>
                                        <div class="col-9"><input type="text" disabled id="date" name="date" placeholder="Enter Name" class="form-control"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--emp info modal end-->
<?php
    include_once ("footer.php");
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
