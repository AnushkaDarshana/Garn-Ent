<?php
include_once ('permission_log.php');
if ($_SESSION['usertype'] == 'storeKeeper' || $_SESSION['usertype'] == 'qualityManager')
{
    header('Location:errorpage/error.php?errorId=1001');
}
include_once ($head);
include_once ('../backend/ProductCatagory.php');
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Product Categories</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Product Categories</strong>
                        </div>
                        <div class="card-body">
                            <table class="table superfeed-table">
                                <thead>
                                <tr>
                                    <th scope="col">Catagory ID</th>
                                    <th scope="col">Catagory Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $viewCatagory = new ProductCatagory();
                                $result = $viewCatagory->get_catagory();

                                foreach ($result as $item)
                                {
                                    $dis = '';
                                    if ($_SESSION['usertype'] != "Admin")
                                    {
                                        $dis = 'disabled';
                                    }
                                    echo
                                    ("
                                          <tr id='cat_$item->catId'>
                                            <td>$item->catId</td>
                                            <td>$item->catName</td>
                                            <td>$item->catDescription</td>
                                            <td>
                                                <button type='button' class='btn btn-danger btn-sm' onclick='del_cat($item->catId)' $dis>
                                                <i class='fa fa-times-circle'></i> Delete</button>
                                            </td>
                                          </tr>
                                        ");
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
</div>
<?php
include_once ("footer.php");
?>
<script>
    function del_cat(catID)
    {
        $.confirm({
            title: 'Confirm!',
            content: 'Data Delete Confirmation',
            buttons: {
                confirm: function () {
                    $.get("../ajax/ajax_product_catagory.php?type=cat_delete",{cat_id:catID},function (data)
                    {
                        if (data == 1)
                        {
                            $.alert('Data Deleted is Success!');
                            $('#cat_'+catID).hide();
                        }
                        else{
                            $.alert('Something went wrong. Data didn\'t Delete!');
                        }
                    });
                },
                cancel: function () {
                    $.alert('Canceled');
                }
            }
        });
    }
</script>
