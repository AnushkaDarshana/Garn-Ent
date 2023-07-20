<html>
    <head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Garn Enterprices</title>
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


<!--page content start-->
<div class="col-lg-12">

    <div class="card">
        <div class="card-header">
            <div class="card-header">
                <strong>New Catagory</strong>
            </div>
            <div class="card-body card-block">
                <form action="../src/catergory_add.php" data-parsley-validate="" method="post" action="#" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden"  id="randomNo" name="ran" value="<?=$random;?>">
                    <div class="row form-group">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Catagory Name</label></div>
                        <div class="col-12 col-md-7"><input type="text" required id="catName" name="catName" class="form-control" placeholder="Enter Category Name"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Description</label></div>
                        <div class="col-12 col-md-7"><textarea  name="catDes" required id="catDes" rows="3" placeholder="Enter Category Description" class="form-control"></textarea></div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Save
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--page content end-->


</body>
</html>