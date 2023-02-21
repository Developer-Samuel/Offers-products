<!--begin::HTML-->
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--begin::Title-->
    <title>Slovak Telekom | LOGIN</title>
    <!--end::Title-->
    <!--begin::Stylesheets-->
    <link rel="stylesheet" href="styles/app.css">
    <!--end::Stylesheets-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body class="loginBody">
    <!--begin::Login Form-->
    <form id="loginForm" action="login" method="POST" class="vh-100 gradient-custom">
        <!--begin::Container-->
        <div class="container py-5 h-100">
            <!--begin::Row-->
            <div class="row d-flex justify-content-center align-items-center h-100">
                <!--begin::Col-->
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <!--begin::Card-->
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <?php include_once('templates/alerts.php'); ?>
                        <!--begin::Card body-->
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your name and password!</p>
                
                                <div class="form-outline form-white mb-4">
                                <input type="text" name="name" class="form-control form-control-lg" />
                                <label class="form-label" for="name">Name</label>
                                </div>
                
                                <div class="form-outline form-white mb-4">
                                <input type="password" name="password" class="form-control form-control-lg" />
                                <label class="form-label" for="password">Password</label>
                                </div>
                        
                                <br>
                                <div>
                                    <button class="btn btn-primary btn-lg px-5" type="submit" name="LoginSubmit" id="loginSubmit">Login</button>
                                </div>
                            </div>
                            <div>
                                <p class="mb-0">
                                    Don't have an account? 
                                    <a href="#" id="signup" class="text-primary fw-bold">Sign Up</a>
                                </p>
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </form>
    <!--end::Login Form-->

    <!--begin::Signup Form-->
    <form id="signupForm" action="register" method="POST" class="vh-100 bg-success" style="display: none;">
        <!--begin::Container-->
        <div class="container py-5 h-100">
            <!--begin::Row-->
            <div class="row d-flex justify-content-center align-items-center h-100">
                <!--begin::Col-->
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <!--begin::Card-->
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <?php include_once('templates/alerts.php'); ?>
                        <!--begin::Card body-->
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                                <br>
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="name" class="form-control form-control-lg" />
                                    <label class="form-label" for="name">Name</label>
                                </div>
                
                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" />
                                    <label class="form-label" for="password">Password</label>
                                </div>
                        
                                <br>
                                <div>
                                    <button class="btn btn-success btn-lg px-5" type="submit" name="RegisterSubmit" id="registerSubmit">Sign Up</button>
                                </div>
                            </div>
                            <div>
                                <p class="mb-0">
                                    Already have an account? 
                                    <a href="#" id="login" class="text-primary fw-bold">Login</a>
                                </p>
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </form>
    <!--end::Signup Form-->
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