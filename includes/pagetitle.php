<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <?php
                
                if (strpos($_SERVER['REQUEST_URI'], 'add_members.php') !== false) {
                    $pageTitle = 'Add Members';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'view_type.php') !== false) {
                    $pageTitle = 'Manage Membership Types';
                }  elseif (strpos($_SERVER['REQUEST_URI'], 'renew.php') !== false) {
                    $pageTitle = 'Renew Membership';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'edit_member.php') !== false) {
                  $pageTitle = 'Edit Members';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'edit_type.php') !== false) {
                  $pageTitle = 'Edit Membership Type';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'list_renewal.php') !== false) {
                  $pageTitle = 'Renewal';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'manage_members.php') !== false) {
                  $pageTitle = 'Manage Members';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'memberProfile.php') !== false) {
                  $pageTitle = 'Member Profile';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'print_membership_card.php') !== false) {
                  $pageTitle = 'Print Membership';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'revenue_report.php') !== false) {
                  $pageTitle = 'Revenue Report';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'report.php') !== false) {
                  $pageTitle = 'Membership Report';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'settings.php') !== false) {
                  $pageTitle = 'Settings';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'add_type.php') !== false) {
                  $pageTitle = 'Add Membership Type';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false) {
                  $pageTitle = 'Dashboard';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'add_product.php') !== false) {
                  $pageTitle = 'Add Product';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'view_products.php') !== false) {
                  $pageTitle = 'Manage Products';
                }  elseif (strpos($_SERVER['REQUEST_URI'], 'edit_product.php') !== false) {
                  $pageTitle = 'Edit Product';
                }  elseif (strpos($_SERVER['REQUEST_URI'], 'delete_product.php') !== false) {
                  $pageTitle = 'Delete Product';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'list_sale_products.php') !== false) {
                  $pageTitle = 'Sale Products';
                } elseif (strpos($_SERVER['REQUEST_URI'], 'sale_products.php') !== false) {
                  $pageTitle = 'Sale Products Form';
                } 
                
                echo '<h1 class="m-0 text-dark">' . $pageTitle . '</h1>';
                ?>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
