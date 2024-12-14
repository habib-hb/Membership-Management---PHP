<?php
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    $id = $_POST['edit_id'];

    $updateQuery = "UPDATE products SET product = '$product_name', price = $product_price WHERE id = $id";

    if ($conn->query($updateQuery) === TRUE) {
        $response['success'] = true;
        $response['message'] = 'Product updated successfully!';
    } else {
        $response['message'] = 'Error: ' . $conn->error;
    }
}

$edit_id = $_GET['id'] ?? null;
$editQuery = "SELECT * FROM products WHERE id = $edit_id";
$result = $conn->query($editQuery);
$editData = $result->fetch_assoc();
?>

<?php include('includes/header.php');?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <?php include('includes/nav.php');?>

 <?php include('includes/sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
  <?php include('includes/pagetitle.php');?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
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

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-keyboard"></i> Edit Product</h3>
              </div>

              <form method="post" action="">
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="membershipType">Product Title</label>
                      <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Title" value="<?php echo $editData['product']; ?>" required>
                    </div>
                    <div class="col-sm-6">
                      <label for="membershipAmount">Price</label>
                      <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Enter Price" value="<?php echo $editData['price']; ?>" required>
                    </div>
                  </div><!-- Visit codeastro.com for more projects -->
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
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

<?php include('includes/footer.php');?>
</body>
</html> 