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

<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><h5>GARN Enterprices</h5></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="homepage.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Admin Tools</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Employees</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="employeeList.php">View Employees</a></li>
                            <li><i class="fa fa-th"></i><a href="employeeAdd.php">Add Employees</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Components</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html">Buttons</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="ui-badges.html">Badges</a></li>
                            <li><i class="fa fa-bars"></i><a href="ui-tabs.html">Tabs</a></li>
                            <li><i class="fa fa-share-square-o"></i><a href="ui-social-buttons.html">Social Buttons</a></li>
                            <li><i class="fa fa-id-card-o"></i><a href="ui-cards.html">Cards</a></li>
                            <li><i class="fa fa-exclamation-triangle"></i><a href="ui-alerts.html">Alerts</a></li>
                            <li><i class="fa fa-spinner"></i><a href="ui-progressbar.html">Progress Bars</a></li>
                            <li><i class="fa fa-fire"></i><a href="ui-modals.html">Modals</a></li>
                            <li><i class="fa fa-book"></i><a href="ui-switches.html">Switches</a></li>
                            <li><i class="fa fa-th"></i><a href="ui-grids.html">Grids</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="ui-typgraphy.html">Typography</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tables</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="tables-basic.html">Basic Table</a></li>
                            <li><i class="fa fa-table"></i><a href="tables-data.html">Data Table</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Icons</h3><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Icons</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="font-fontawesome.html">Font Awesome</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Themefy Icons</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="widgets.html"> <i class="menu-icon ti-email"></i>Widgets </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Charts</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="charts-chartjs.html">Chart JS</a></li>
                            <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-flot.html">Flot Chart</a></li>
                            <li><i class="menu-icon fa fa-pie-chart"></i><a href="charts-peity.html">Peity Chart</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Maps</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-map-o"></i><a href="maps-gmap.html">Google Maps</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i><a href="maps-vector.html">Vector Maps</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Extras</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Pages</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="page-login.html">Login</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="page-register.html">Register</a></li>
                            <li><i class="menu-icon fa fa-paper-plane"></i><a href="pages-forget.html">Forget Pass</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <div id="right-panel" class="right-panel">

<!-- Header-->
<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                        <!-- <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a> -->

                        <!-- <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a> -->

                        <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
                </div>
            </div>

        </div>
    </div>

</header><!-- /header -->


<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-header">
                <strong>Add Employee</strong>
            </div>
            <div class="card-body card-block">
                <form action="" data-parsley-validate=""  method="post" action="add_employee.php" enctype="multipart/form-data" class="form-horizontal" id="empFrom">
                        <span id="basic_info" class="">
                            <input type="hidden" id="randomNo" name="ran" value="">
                            <input type='hidden' id='' name='id' value='' >
                           <div class="row form-group" >
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Name</label></div>
                                <div class="col-12 col-md-7"><input required type="text" id="e_name" name="e_name" placeholder="Enter Name" class="form-control" value=""></div>
                           </div>

                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Address</label></div>
                                <div class="col-12 col-md-7"><textarea required name="e_address" id="e_address" rows="4" placeholder="Address..." class="form-control" ></textarea></div>
                            </div>

                            <div class="row form-group" >
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Email</label></div>
                                <div class="col-12 col-md-7"><input required type="email" id="e_email" name="e_email" placeholder="Enter Email" class="form-control" value=""></div>
                            </div>

                            <div class="row form-group" >
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Telephone No</label></div>
                                <div class="col-12 col-md-7"><input required type="text" id="e_tp" name="e_tp" placeholder="Enter Telephone No" class="form-control" value=""></div>
                            </div>
                            
                            <div class="row form-group" >
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Nic</label></div>
                                <div class="col-12 col-md-7"><input type="text" required id="e_nic" name="e_nic" placeholder="Enter Nic" class="form-control" value=""></div>
                           </div>

                            <div class="row form-group" >
                                <div class="col col-md-2"><label for="text-input" class="form-control-label">Employee Type</label></div>
                                <div class="col-12 col-md-7">
                                    <select name="e_user_type" id="e_user_type" class="form-control" required>
                                        <option value=''>Select User Type</option>
                                        
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
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">User Name</label></div>
                                    <div class="col-12 col-md-7"><input  type="text" id="userName" name="userName" placeholder="Enter User Name" class="form-control" value=""></div>
                                </div>

                                <div class="row form-group" >
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Passoword</label></div>
                                    <div class="col-12 col-md-7"><input  type="password" id="u_password" name="u_password" placeholder="Enter Password" class="form-control"></div>
                                </div>
                                <div class="row form-group" >
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Confirm Passoword</label></div>
                                    <div class="col-12 col-md-7">
<!--                                        <input  type="password" id="u_confrm_password" name="u_confrm_password" class="form-control"-->
<!--                                          placeholder="Conform Password">-->

                                                                                <input  type="password" id="u_confrm_password" name="u_confrm_password" class="form-control"
                                                                                        data-parsley-equalto = '#u_password' data-parsley-trigger="change" placeholder="Conform Password" data-parsley-equalto-message="Password didn't matching">
                                    </div>
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

<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>

</body>
</html>