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
    <link rel="stylesheet" href="assets/css/new.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<head>
<body>

        <!-- Left Panel -->

        <?php include './components/leftNav.html'; ?>

        <!-- Header-->

        <?php include './components/topNav.html'; ?>


<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-header">
                <strong>Add Employee</strong>
            </div>
            <div class="card-body card-block">
                <form data-parsley-validate=""  method="post" action="../src/add_employee.php" enctype="multipart/form-data" class="form-horizontal" id="empForm">
                        <span id="basic_info" class="">
                            <input type="hidden" id="randomNo" name="ran" value="">
                            <input type='hidden' id='' name='id' value='' >
                           <div class="row form-group" >
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Name</label></div>
                                <div class="col-12 col-md-7"><input required type="text" id="e_name" name="e_name" placeholder="Enter Name" class="form-control" value="" required></div>
                           </div>

                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Address</label></div>
                                <div class="col-12 col-md-7"><textarea required name="e_address" id="e_address" rows="4" placeholder="Address..." class="form-control" required></textarea></div>
                            </div>
                            
                            <div class="row form-group">
                            <div class="col col-md-2"><label for="e_tp" class="form-control-label">Telephone No</label></div>
                            <div class="col-12 col-md-7">
                                <input type="text" id="e_tp" name="e_tp" pattern="0[0-9]{9}" placeholder="Enter Telephone No" class="form-control" value="" required>
                                <small class="text-danger" id="error-msg" style="display: none;">Please enter a 10-digit telephone number starting with 0.</small>
                            </div>
</div>
                            
                            <div class="row form-group">
                                <div class="col col-md-2"><label for="e_nic" class="form-control-label">NIC</label></div>
                                <div class="col-12 col-md-7">
                                    <input type="text" required id="e_nic" name="e_nic" placeholder="Enter NIC" class="form-control" value="" required>
                                    <small class="text-danger" id="nic-error-msg" style="display: none;">Please enter a valid NIC number.</small>
                                </div>
                                </div>

                                <div class="row form-group">
                                <div class="col col-md-2"><label for="e_user_type" class="form-control-label">Employee Type</label></div>
                                <div class="col-12 col-md-7">
                                <select name="e_user_type" id="e_user_type" class="form-control" required>
                                <option value=''>Select User Type</option>
                                <?php
                                // Assuming you have a database connection established
                                include '../config/db.php';
                                $sql = "SELECT userType FROM g_user WHERE userType != 'admin'";
                                $result = $conn->query($sql);
                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['userType'] . "'>" . $row['userType'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No values</option>";
                                }
                                ?>
                                </select>

                                </div>
                                </div>

                            <div class="row form-group" >
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Gender</label></div>
                                <div class="col-12 col-md-7">
                                    <input type='radio' name='e_gender' id="e_gender" value='male' required>
                                       
                                            Male &nbsp;&nbsp;&nbsp;&nbsp;

                                        <input type='radio' name='e_gender' id="e_gender" value='female' required>Female
                                </div>
                           </div>

                            <div class="row form-group" >
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Social Status</label></div>
                                <div class="col-12 col-md-7">
                                    <input type="radio" name="e_soc_status" id="e_soc_status" value="married" required
                                        >
                                            Married &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="e_soc_status" id="e_soc_status" value="unmarried" required
                                            >
                                            Unmarried
                                </div>
                           </div>

                            <span class="nodisplay" id="userdiv">

                                <div class="row form-group" >
                                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Email</label></div>
                                    <div class="col-12 col-md-7"><input required type="email" id="e_email" name="e_email" placeholder="Enter Email" class="form-control" value="" required></div>
                                </div>


                                <div class="row form-group" >
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Password</label></div>
                                    <div class="col-12 col-md-7"><input  type="password" id="password" name="password" placeholder="Enter Password" class="form-control"></div>
                                </div>
                                <div class="row form-group" >
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Confirm Passoword</label></div>
                                    <div class="col-12 col-md-7">
                                        <input  type="password" id="confirm-password" name="confirm-password" class="form-control"
                                        data-parsley-equalto = '#u_password' data-parsley-trigger="change" placeholder="Conform Password" data-parsley-equalto-message="Password didn't matching">
                                    </div>
                                    <span id="password-error" style="color: red;"></span>
                                </div>
                            </span>

                            <div class="card-footer" align="center">
                                <button type="submit" class="btn-success-add-emp">
                                    Add Employee
                                </button>
                                 <button type="reset" class="btn-reset-add-emp">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                            </div>
                        </span>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
  var passwordField = document.getElementById('password');
  var confirmPasswordField = document.getElementById('confirm-password');
  var passwordError = document.getElementById('password-error');

  confirmPasswordField.addEventListener('input', function() {
    var password = passwordField.value;
    var confirmPassword = confirmPasswordField.value;

    if (password !== confirmPassword) {
      passwordError.textContent = 'Password and Confirm Password do not match!';
    } else {
      passwordError.textContent = '';
    }
  });
const telephoneField = document.getElementById('e_tp');
const errorMessage = document.getElementById('error-msg');

telephoneField.addEventListener('input', function() {
  if (telephoneField.validity.valid) {
    errorMessage.style.display = 'none';
  } else {
    errorMessage.style.display = 'block';
  }
});
const nicField = document.getElementById('e_nic');
const errorContainer = document.getElementById('nic-error-msg');

nicField.addEventListener('input', function() {
  const nicPattern = /(\d{9}[Vv]|\d{12})/;
  const nicValue = nicField.value;
  if (nicPattern.test(nicValue)) {
    errorContainer.style.display = 'none';
  } else {
    errorContainer.style.display = 'block';
  }
});

</script>

</body>
</html>