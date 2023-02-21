<!--begin::Logo-->
<div class="logo px-2">
    <!--begin::Link-->
    <a href="../home">
        <img src="../public/img/logo.png" alt="logo">
    </a>
    <!--end::Link-->
</div>
<!--end::Logo-->

<!--begin::Dropdown-->
<div class="dropdown px-2">
    <!--begin::Dropdown button-->
    <button id="dropdown-button">
        <img src="../public/icons/menu.png" alt="menu">
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
        <a class="dropdown-item <?php if (basename($_SERVER['REQUEST_URI']) == 'my-offers') echo 'active'; ?>" href="../my-offers">My offers</a>
        <!--end::Dropdown link-->
        <?php endif; ?>
        <!--begin::Dropdown link-->
        <a class="dropdown-item" href="../logout">Logout</a>
        <!--end::Dropdown link-->
    </div>
    <!--end::Dropdown menu-->
</div>
<!--end::Dropdown-->