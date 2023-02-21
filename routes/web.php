<?php

error_reporting(0);

if(isset($_GET['action']))
{
    $request = $_GET['action'];

    $user = $_SESSION['userSession'];
    $customer = $_SESSION['customerSession'];

    switch($request)
    {
        case 'login':
            $route = "UserController@loginAction";
            break;
        case 'register':
            $route = "UserController@registerAction";
            break;

        default:
            $route = "ErrorController@error_404";
            break;
    }

    if($user)
    {
        switch($request)
        {
            case 'home':
                $route = "HomeController@indexAction";
                break;
            case 'my-offers':
                $route = "HomeController@myOffersAction";
                break;
            case 'offer':
                $route = "HomeController@showOfferAction";
                break;
            case 'addOffer':
                $route = "HomeController@addOfferAction";
                break;
            case 'offer-edit':
                $route = "HomeController@editOfferAction";
                break;
            case 'offer-update':
                $route = "HomeController@updateOfferAction";
                break;
            case 'offer-delete':
                $route = "HomeController@deleteOfferAction";
                break;
            case 'product-add':
                $route = "HomeController@addProductAction";
                break;
            case 'product-create':
                $route = "HomeController@createProductAction";
                break;
            case 'product-edit':
                $route = "HomeController@editProductAction";
                break;
            case 'product-update':
                $route = "HomeController@updateProductAction";
                break;
            case 'product-delete':
                $route = "HomeController@deleteProductAction";
                break;
            case 'logout':
                $route = "UserController@logoutAction";
                break;
            default:
                $route = "ErrorController@error_404";
                break;
        }
    }
    elseif($customer)
    {
        switch($request)
        {
            case 'home':
                $route = "HomeController@indexAction";
                break;
            case 'offer':
                $route = "HomeController@showOfferAction";
                break;      
            case 'logout':
                $route = "UserController@logoutAction";
                break;
            default:
                $route = "ErrorController@error_404";
                break;
        }
    }

    if (!$user && !$customer && $request != 'login' && $request != 'register') {
        header("Location: login");
        exit;
    }
}