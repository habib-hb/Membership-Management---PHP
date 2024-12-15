<?php
include('includes/config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['type'] == 'Accountant') {
    header("Location: index.php");
    exit();
}

$response = array('success' => false, 'message' => '');

$productsQuery = "SELECT id, product, price FROM products";
$productsResult = $conn->query($productsQuery);

if (isset($_GET['id'])) {
    $memberId = $_GET['id'];
    $id=$memberId;

    $fetchMemberQuery = "SELECT * FROM members WHERE id = $memberId";
    $fetchMemberResult = $conn->query($fetchMemberQuery);

    if ($fetchMemberResult->num_rows > 0) {
        $memberDetails = $fetchMemberResult->fetch_assoc();
    } else {
        header("Location: members_list.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];

    $expiryDate = date('Y-m-d', strtotime("+$quantity months"));

 



    $totalAmount = $_POST['totalAmount'];
    $renewDate = date('Y-m-d');
    $insertRenewQuery = "INSERT INTO renew_and_sales (member_id, total_amount, expenditure_type , renew_date ) VALUES ($memberId, $totalAmount, 'Product' , '$renewDate')";
    $insertRenewResult = $conn->query($insertRenewQuery);

    if ($insertRenewResult) {
        $response['success'] = true;
        $response['message'] = 'Product Sold successfully.';
    } else {

        if($conn->error == "Unknown column 'NaN' in 'field list'"){
            $response['message'] = 'Quantity is required';
        }else{
            $response['message'] = 'Something went wrong: ' . $conn->error;
        }

        
    }
}
?>

<?php include('includes/header.php');?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <?php include('includes/nav.php'); ?>

    <?php include('includes/sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php include('includes/pagetitle.php'); ?>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">

                        <?php if ($response['success']): ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Success</h5>
                                <?php echo $response['message']; ?>
                            </div>
                        <?php elseif (!empty($response['message'])): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Error</h5>
                                <?php echo $response['message']; ?>
                            </div>
                        <?php endif; ?>

                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-keyboard"></i> Renew Membership Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- Visit codeastro.com for more projects -->
                            <!-- form start -->
                            <form method="post" action="">
                            <input type="hidden" name="member_id" value="<?php echo $id; ?>">
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-sm-6">
                                    <label for="fullname">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                        placeholder="Enter full name" required value="<?php echo $memberDetails['fullname']; ?>" disabled>
                                </div>
                                        <div class="col-sm-6">
                                            <label for="dob">Membership Number</label>
                                            <input type="text" class="form-control" id="mm" name="mm" value="<?php echo $memberDetails['membership_number']; ?>" disabled>
                                        </div>
                                        
                                    </div>


                                    <div class="row mt-3">
                                    <div class="col-sm-6">
                                    <label for="membershipType">Product</label>
                                    <select class="form-control" id="product" name="product" required>
                                        <?php
                                        if ($productsResult) {
                                            while ($row = $productsResult->fetch_assoc()) {
                                                echo "<option value='{$row['id']}'>{$row['product']} - {$row['price']}</option>";
                                            }
                                        } else {
                                            echo "Error: " . $conn->error;
                                        }
                                        ?>
                                    </select>
                                </div>
                                        <div class="col-sm-6">
                                        <label for="extendate">Quantity</label>
                                           <input type="number" class="form-control" id="quantity" name="quantity" value="1">
                                        </div>
                                       
                                    </div>

                                    <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <label for="totalAmount">Total Amount</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="currencySymbol"><?php echo getCurrencySymbol(); ?></span>
                                            </div>
                                            <input type="text" class="form-control" id="totalAmount" name="totalAmount" placeholder="Total Amount" readonly>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                function getCurrencySymbol()
                                {
                                    global $conn;

                                    $currencyQuery = "SELECT currency FROM settings";
                                    $currencyResult = $conn->query($currencyQuery);

                                    if ($currencyResult->num_rows > 0) {
                                        $currencyRow = $currencyResult->fetch_assoc();
                                        return $currencyRow['currency'];
                                    } else {
                                        return '$';
                                    }
                                }
                                ?>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->

                </div>
                <!-- /.row -->


            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <!-- Visit codeastro.com for more projects -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong> &copy; <?php echo date('Y');?> codeastro.com</a> -</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        <b>Developed By</b> <a href="https://codeastro.com/">CodeAstro</a>
        </div>
    </footer>
</div>
<!-- ./wrapper -->

<?php include('includes/footer.php'); ?>

<script>
    $(document).ready(function () {
        function updateTotalAmount() {
            var product_price = parseFloat($('#product option:selected').text().split('-').pop());

            var quantity = parseFloat($('#quantity').val());

            var totalAmount = product_price * quantity;

            $('#totalAmount').val(totalAmount.toFixed(2));
        }

        $('#product, #quantity').change(updateTotalAmount);
        $('#quantity').keyup(updateTotalAmount);

        updateTotalAmount();
    });
</script>







</body>
</html>
