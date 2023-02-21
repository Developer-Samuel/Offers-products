<!--begin::HTML-->
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--begin::Title-->
    <title>Slovak Telekom</title>
    <!--end::Title-->
    <!--begin::Stylesheets-->
    <link rel="stylesheet" href="styles/app.css">
    <!--end::Stylesheets-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body class="body">
    <!--begin::Card-->
    <div id="card" class="vh-100">
        <?php include_once('templates/alerts.php'); ?>
        <!--begin::Card header-->
        <div id="card-header" class="card-header">
            <!--begin::Logo-->
            <div class="logo px-2">
                <!--begin::Link-->
                <a href="home">
                    <img src="img/logo.png" alt="logo">
                </a>
                <!--end::Link-->
            </div>
            <!--end::Logo-->

            <!--begin::Dropdown-->
            <div class="dropdown px-2">
                <!--begin::Dropdown button-->
                <button id="dropdown-button">
                    <img src="icons/menu.png" alt="menu">
                </button>
                <!--end::Dropdown button-->
                <!--begin::Dropdown menu-->
                <div id="dropdown-menu" class="dropdown-menu text-center">
                    <!--begin::Name-->
                    <p class="dropdown-text"><?php echo $user['name'] ?></p>
                    <!--end::Name-->
                    <hr>
                    <?php if (isset($_SESSION['userSession']) && $_SESSION['userSession'] == 1): ?>
                    <!--begin::Dropdown link-->
                    <a class="dropdown-item <?php if (basename($_SERVER['REQUEST_URI']) == 'my-offers') echo 'active'; ?>" href="my-offers">My offers</a>
                    <!--end::Dropdown link-->
                    <?php endif; ?>
                    <!--begin::Dropdown link-->
                    <a class="dropdown-item" href="logout">Logout</a>
                    <!--end::Dropdown link-->
                </div>
                <!--end::Dropdown menu-->
            </div>
            <!--end::Dropdown-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Container-->
            <div class="container" id="white-container">
                <!--begin::Button-->
                <div class="text-center py-5">
                    <?php if (isset($_SESSION['userSession']) && $_SESSION['userSession'] == 1): ?>
                    <button id="add-offer" class="btn btn-info">Add offer</button>
                    <?php endif ?>
                </div>
                <!--end::Button-->
                <!--begin::Modals-->
                <?php if (isset($_SESSION['userSession']) && $_SESSION['userSession'] == 1) { include_once('modals/addOffer.php'); } ?>
                <!--end::Modals-->

                <!--begin::Table-->
                <table class="table" id="offers-table">
                    <!--begin::Table thead-->
                    <thead id="main-thead" class="thead-dark">
                        <!--begin::Row-->
                        <tr>
                            <th scope="col">
                                <a href="home?page=<?php echo $page; ?>&sort=offer_id&order=<?php echo ($sort == 'offer_id' && $order == 'asc') ? 'desc' : 'asc'; ?>">
                                    #
                                    <?php if ($sort == 'offer_id') { ?>
                                        <?php if ($order == 'asc') { ?>
                                            <span class="table-arrow-up">&#129053;</span>
                                        <?php } else { ?>
                                            <span class="table-arrow-down">&#129055;</span>
                                        <?php } ?>
                                    <?php } ?>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="home?page=<?php echo $page; ?>&sort=offer_name&order=<?php echo ($sort == 'offer_name' && $order == 'asc') ? 'desc' : 'asc'; ?>">
                                    Offer Name
                                    <?php if ($sort == 'offer_name') { ?>
                                        <?php if ($order == 'asc') { ?>
                                            <span class="table-arrow-up">&#129053;</span>
                                        <?php } else { ?>
                                            <span class="table-arrow-down">&#129055;</span>
                                        <?php } ?>
                                    <?php } ?>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="home?page=<?php echo $page; ?>&sort=customer_name&order=<?php echo ($sort == 'customer_name' && $order == 'asc') ? 'desc' : 'asc'; ?>">
                                    Customer name
                                    <?php if ($sort == 'customer_name') { ?>
                                        <?php if ($order == 'asc') { ?>
                                            <span class="table-arrow-up">&#129053;</span>
                                        <?php } else { ?>
                                            <span class="table-arrow-down">&#129055;</span>
                                        <?php } ?>
                                    <?php } ?>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="home?page=<?php echo $page; ?>&sort=validity_offer&order=<?php echo ($sort == 'validity_offer' && $order == 'asc') ? 'desc' : 'asc'; ?>">
                                    Validity offer
                                    <?php if ($sort == 'validity_offer') { ?>
                                        <?php if ($order == 'asc') { ?>
                                            <span class="table-arrow-up">&#129053;</span>
                                        <?php } else { ?>
                                            <span class="table-arrow-down">&#129055;</span>
                                        <?php } ?>
                                    <?php } ?>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="home?page=<?php echo $page; ?>&sort=note&order=<?php echo ($sort == 'note' && $order == 'asc') ? 'desc' : 'asc'; ?>">
                                    Note
                                    <?php if ($sort == 'note') { ?>
                                        <?php if ($order == 'asc') { ?>
                                            <span class="table-arrow-up">&#129053;</span>
                                        <?php } else {?>
                                            <span class="table-arrow-down">&#129055;</span>
                                        <?php } ?>
                                    <?php } ?>
                                </a>
                            </th>
                            <th class="text-end" scope="col">Actions</th>
                        </tr>
                        <!--end::Row-->
                    </thead>
                    <!--end::Table thead-->
                    <!--begin::Table tbody-->
                    <tbody class="table-light">
                        <?php foreach ($offers as $offer): ?>
                        <!--begin::Row-->
                        <tr>
                            <td scope="row"><?php echo $offer['id']; ?></td>
                            <td scope="row"><?php echo $offer['offer_name']; ?></td>
                            <td scope="row"><?php echo $offer['customer_name']; ?></td>
                            <td scope="row"><?php echo $offer['validity_offer']; ?></td>
                            <td scope="row"><?php echo $offer['note']; ?></td>
                            <td scope="row" id="td-actions">
                                <a href="offer/<?php echo $offer['id']; ?>"><button class="btn btn-sm btn-success">Show</button></a>
                                <?php if (isset($_SESSION['userSession']) && $_SESSION['userSession'] == 1): ?>
                                <a style="margin-left: 5px;" href="offer-edit/<?php echo $offer['id']; ?>"><button class="btn btn-sm btn-primary edit-offer">Edit</button></a>
                                <form style="margin-left: 5px;" method="post" action="offer-delete/<?php echo $offer['id'] ?>">
                                    <input type="hidden" name="offer-id" value="<?php echo $offer['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger delete-offer" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <!--end::Row-->
                        <?php endforeach; ?>
                                  
                    </tbody>
                    <!--end::Table tbody-->
                </table>
                <!--end::Table-->
                <!--begin::Pagination-->
                <div class="pagination py-5 d-flex justify-content-sm-center">
                    <?php if ($page > 1): ?>
                        <!--begin::Previous button-->
                        <a id="prev" href="home?page=<?php echo $page - 1; ?>">«</a>
                        <!--end::Previous button-->
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <!--begin::Page button-->
                        <a href="home?page=<?php echo $i; ?>" <?php if ($i == $page): ?>class="active"<?php endif; ?>><?php echo $i; ?></a>
                        <!--end::Page button-->
                    <?php endfor; ?>
                    <?php if ($page < $totalPages): ?>
                        <!--begin::Next button-->
                        <a id="next" href="home?page=<?php echo $page + 1; ?>">»</a>
                        <!--end::Next button-->
                    <?php endif; ?>
                </div>
                <!--end::Pagination-->
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
<!--begin::CDN Scripts-->
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha384-Dziy8F2VlJQLMShA6FHWNul/veM9bCkRUaLqr199K94ntO5QUrLJBEbYegdSkkqX" crossorigin="anonymous"></script>
<!--end::CDN Scripts-->
<!--begin::Custom Scripts-->
<script type="text/javascript" src="js/modalWindow.js"></script>
<script type="text/javascript" src="js/alerts.js"></script>
<script type="text/javascript" src="js/dropdownMenu.js"></script>
<script type="text/javascript" src="js/addProduct.js"></script>
<script type="text/javascript" src="js/currentDate.js"></script>
<script type="text/javascript" src="js/loginToggle.js"></script>
<script type="text/javascript" src="js/selectRequired.js"></script>
<script type="text/javascript" src="js/dragdrop.js"></script>
<!--end::Custom Scripts-->
</html>
<!--end::HTML-->