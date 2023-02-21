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
            <!--begin::Back button-->
            <a class="redirect-back" href="../home">
                <img src="../public/icons/back.png" alt="back">
            </a>
            <!--end::Back button-->
            <!--begin::Container-->
            <div class="container vh-100">
                <!--begin::Title-->
                <div id="editProduct-title" class="w-100 text-center">
                    <h2>Add product to offer [<?php echo htmlspecialchars($offer['offer_name']); ?>]</h2>
                </div>
                <!--end::Title-->
                <!--begin::Form-->
                <form class="updateProduct-form w-75" action="../product-create/<?php echo $offer['id'] ?>" method="POST">
                    <!--begin::Input ID-->
                    <input type="hidden" name="offer-id" value="<?php echo $offer['id'] ?>">   
                    <!--end::Input ID-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label for="product-name">Name</label>
                        <input type="text" class="form-control" name="product-name" required>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label for="count">Count</label>
                        <input type="number" class="form-control" name="count" value="1" min="1">
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label for="price">Price [$]</label>
                        <input type="number" class="form-control" name="price" value="1" min="1" step="0.01">
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label for="discount">Discount [%]</label>
                        <input type="number" class="form-control" name="discount" value="0" min="0" max="100">
                    </div>
                    <!--end::Form group-->
                    <br>
                    <!--begin::Submit button-->
                    <button type="submit" id="updateProduct-btn" class="btn btn-primary" name="CreateProduct">Add</button>
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