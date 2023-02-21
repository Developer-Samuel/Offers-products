<?php include_once('templates/head.php'); ?>
<!--begin::Body-->
<body class="body">
    <!--begin::Card-->
    <div id="card" class="vh-100">
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
            <div class="container" id="white-container">
                <!--begin::Table-->
                <table class="table" id="table-showOffer">
                    <!--begin::Table thead-->
                    <thead>
                        <!--begin::Table row-->
                        <tr>
                            <th scope="col">Offer name</th>
                            <th scope="col">Customer name</th>
                            <th scope="col">Validity offer</th>
                            <th scope="col">Note</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table thead-->
                    <!--begin::Table tbody-->
                    <tbody>
                        <!--begin::Table row-->
                        <tr>
                            <td scope="row"><?php echo $offer['offer_name']; ?></td>
                            <td scope="row"><?php echo $offer['customer_name']; ?></td>
                            <td scope="row"><?php echo $offer['validity_offer']; ?></td>
                            <td scope="row"><?php echo $offer['note']; ?></td>
                        </tr>
                        <!--end::Table row-->
                    </tbody>
                    <!--end::Table tbody-->
                </table>
                <!--end::Table-->
                <!--begin::Title-->
                <div id="products-title">
                    <h2 class="text-center">Products</h2>
                </div>
                <!--end::Title-->
                <!--begin::Table-->
                <table class="table" id="products-table">
                    <!--begin::Table thead-->
                    <thead id="main-thead" class="thead-dark">
                        <!--begin::Table row-->
                        <tr>
                            <th scope="col">Product name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Count</th>
                            <th scope="col">Discount</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table thead-->
                    <!--begin::Table tbody-->
                    <tbody class="table-light">
                        <?php foreach ($products as $product): ?>
                            <!--begin::Table row-->
                            <tr>
                                <td scope="row"><?php echo $product['product_name']; ?></td>
                                <td scope="row"><?php echo $product['price']; ?></td>
                                <td scope="row"><?php echo $product['count']; ?></td>
                                <td scope="row"><?php echo $product['discount']; ?></td>
                            </tr>
                            <!--end::Table row-->
                        <?php endforeach; ?>
                    </tbody>
                    <!--end::Table tbody-->
                </table>
                <!--end::Table-->
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