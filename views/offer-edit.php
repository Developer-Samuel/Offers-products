<?php include_once('templates/head.php'); ?>
<!--begin::Body-->
<body class="body">
    <!--begin::Card-->
    <div id="card" style="height: 120vh;">
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
                <!--begin::Title-->
                <div id="editOffer-title" class="w-100 text-center">
                    <h2>Offer [<?php echo htmlspecialchars($offer['offer_name']); ?>]</h2>
                </div>
                <!--end::Title-->
                <!--begin::Form-->
                <form class="form w-100 editOffer-form" action="../offer-update/<?php echo $offer['id'] ?>" method="POST">
                    <!--begin::Input ID-->
                    <input type="hidden" name="offer-id" value="<?php echo $offer['id'] ?>">
                    <!--end::Input ID-->
                    <!--begin::Form group-->
                    <div class="form-group w-75">
                        <label for="offer-name">Name</label>
                        <input type="text" class="form-control" name="offer-name" id="offer-name" value="<?php echo htmlspecialchars($offer['offer_name']); ?>" required>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group w-75">
                        <label for="customer-name">Customer name</label>       
                        <!--begin::Select--> 
                        <select class="form-select" name="customer-name" id="customer-name">
                            <option value="" selected></option>
                            <?php foreach ($customers as $customer): ?>
                                <option value="<?php echo htmlspecialchars($customer['name']); ?>" <?php if ($offer['customer_name'] === $customer['name']) echo 'selected'; ?>>
                                    <?php echo $customer['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!--end::Select--> 
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group w-75">
                        <label for="validity-offer">Validity offer</label>
                        <input type="date" class="form-control" name="validity-offer" id="validity-offer" value="<?php echo htmlspecialchars($offer['validity_offer']); ?>" required>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group w-75">
                        <label for="note">Note</label>
                        <textarea class="form-control" name="note" id="note" rows="3" required><?php echo htmlspecialchars($offer['note']); ?></textarea>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="py-4 text-center">
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary" name="UpdateOffer">Update</button>
                        <!--end::Button-->
                    </div>
                    <!--end::Form group-->
                </form>
                <!--end::Form-->
                <hr>
                <!--begin::Title-->
                <div id="offer-products-title" class="w-100 text-center">
                    <h2>Products</h2>
                </div>
                <!--end::Title-->
                <?php if (count($products) !== 5): ?>
                    <!--begin::Button-->
                    <a href="../product-add/<?php echo $offer['id']; ?>"><button class="btn btn-sm btn-primary add-product">Add</button></a>
                    <!--end::Button-->
                <?php endif; ?>
                <!--begin::Table-->
                <table class="table" id="offer-products-table">
                    <!--begin::Table thead-->
                    <thead id="main-thead" class="thead-dark">
                        <!--begin::Table row-->
                        <tr>
                            <th scope="col">Product name</th>
                            <th scope="col">Count</th>
                            <th scope="col">Discount [%]</th>
                            <th scope="col">Price [$]</th>
                            <th scope="col">Price difference after discount [$]</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table thead-->
                    <!--begin::Table tbody-->
                    <tbody class="table-light">
                        <?php foreach ($products as $product): ?>
                            <!--begin::Table product row-->
                            <tr class="product-div">
                                <td scope="row"><?php echo $product['product_name']; ?></td>
                                <td scope="row"><?php echo $product['count']; ?></td>
                                <td scope="row"><?php echo $product['discount']; ?> %</td>
                                <?php if ($product['discount'] >= 1) { ?>
                                    <td scope="row" id="old_price"><?php echo $product['price']; ?> $</td>
                                    <td scope="row" id="discount"><?php echo $product['discounted_price']; ?> $</td>
                                <?php } else { ?>
                                    <td scope="row"><?php echo $product['price']; ?> $</td>
                                    <td scope="row"><?php echo $product['discounted_price']; ?> $</td>
                                <?php } ?>
                                <td scope="row" id="td-actions">
                                    <a href="../product-edit/<?php echo $product['id']; ?>"><button class="btn btn-sm btn-primary edit-product">Edit</button></a>
                                    <form style="margin-left: 5px;" method="post" action="../product-delete/<?php echo $product['id'] ?>">
                                        <input type="hidden" name="product-id" value="<?php echo $product['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger delete-product" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <!--end::Table product row-->
                        <?php endforeach; ?>
                    </tbody>
                    <!--end::Table tbody-->
                    <!--begin::Table tfoot-->
                    <tfoot>
                        <!--begin::Table row-->
                        <tr>
                            <td scope="row"></td>
                            <td scope="row"><?php echo $total_count; ?></td>
                            <td scope="row"></td>
                            <td scope="row" id="old_price"><?php echo $product_prices['total_price']; ?> $</td>
                            <td scope="row" id="discount">
                                <?php if ($product_prices['total_discount'] > 0): ?>
                                <?php echo "- " . $product_prices['total_discount'] . " $"; ?> 
                                <?php else: ?>
                                <?php echo "0 $"; ?> 
                                <?php endif; ?>
                            </td>
                            <td></td>
                        </tr>
                        <!--end::Table row-->
                        <!--begin::Table row-->
                        <tr class="text-center">
                            <td colspan="6" style="font-weight: bold;">Total</td>
                        </tr>
                        <!--end::Table row-->
                        <!--begin::Table row-->
                        <tr class="text-center">
                            <td colspan="6" id="total_price" style="font-weight: bold;"><?php echo $product_prices['total_discounted_price']; ?> $</td>
                        </tr>
                        <!--end::Table row-->
                    </tfoot>
                    <!--end::Table tfoot-->
                </table>
                <!--end::Table -->                 
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