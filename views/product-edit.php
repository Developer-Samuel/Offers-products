<?php include_once('templates/head.php'); ?>
<!--begin::Body-->
<body class="body">
    <!--begin::Card-->
    <div id="card vh-100">
        <?php include_once('templates/alerts.php'); ?>
        <!--begin::Card header-->
        <div id="card-header" class="card-header">
            <?php include_once('templates/header.php'); ?>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Container-->
            <div class="container vh-100">
                <!--begin::Title-->
                <div id="editProduct-title" class="w-100 text-center">
                    <h2>Product [<?php echo htmlspecialchars($product['product_name']); ?>]</h2>
                </div>
                <!--end::Title-->
                <!--begin::Form-->
                <form class="updateProduct-form w-75" action="../product-update/<?php echo $product['id'] ?>" method="POST" data-product-id="<?php echo $product['id']; ?>">
                    <!--begin::Input ID-->
                    <input type="hidden" name="product-id" value="<?php echo $product['id'] ?>"> 
                    <!--end::Input ID-->  
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label for="product-name">Name</label>
                        <input type="text" class="form-control" name="product-name" value="<?php if(isset($product['product_name'])) { echo htmlspecialchars($product['product_name']); } ?>" required>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label for="count">Count</label>
                        <input type="number" class="form-control" name="count" value="<?php if(isset($product['count'])) { echo htmlspecialchars($product['count']); } else { echo "1"; }?>" min="1">
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label for="price">Price [$]</label>
                        <input type="number" class="form-control" name="price" value="<?php if(isset($product['price'])) { echo htmlspecialchars($product['price']); } else { echo "1"; }?>" min="1" step="0.01">
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label for="discount">Discount [%]</label>
                        <input type="number" class="form-control" name="discount" value="<?php if(isset($product['discount'])) { echo htmlspecialchars($product['discount']); } else { echo "0"; }?>" min="0" max="100">
                    </div>
                    <!--end::Form group-->
                    <br>
                    <!--begin::Submit button-->
                    <button type="submit" id="updateProduct-btn" class="btn btn-primary" name="UpdateProduct">Edit</button>
                    <!--end::Submit button-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    <!--begin::Footer-->
    <footer class="flex-shrink-0 py-4 bg-dark text-white-50">
        <?php include_once('templates/footer.php'); ?>
    </footer>
    <!--end::Footer-->
</body>
<!--end::Body-->
<?php include_once('templates/scripts.php'); ?>
</html>
<!--end::HTML-->