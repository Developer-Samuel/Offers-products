<?php

class HomeController extends UserController
{
    public $model;

    public function indexAction($page = 1, $sort = 'offer_id', $order = 'asc')
    {
        $this->checkUserAccess();
        try 
        {
            $user = $this->model->getUserById($_SESSION['user_id']);
            $customers = $this->model->getAllCustomers();

            if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) 
            {
                $page = $_GET['page'];
            }
            if (isset($_GET['sort']) && !empty($_GET['sort']) && in_array($_GET['sort'], ['id', 'offer_name', 'customer_name', 'validity_offer', 'note'])) 
            {
                $sort = $_GET['sort'];
            }
            if (isset($_GET['order']) && !empty($_GET['order']) && in_array($_GET['order'], ['asc', 'desc'])) 
            {
                $order = $_GET['order'];
            }
        
            $limit = 10;
            $offset = ($page - 1) * $limit;

            $offers = $this->model->getAllOffers($limit, $offset, $sort, $order);
            $totalOffers = $this->model->getCountOffers();
            $totalPages = ceil($totalOffers / $limit);

            return require_once('../views/home.php');
        } 
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function myOffersAction($page = 1, $sort = 'offer_id', $order = 'asc')
    {
        $this->checkUserAccess();

        try 
        {
            $user = $this->model->getUserById($_SESSION['user_id']);

            if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) 
            {
                $page = $_GET['page'];
            }
            if (isset($_GET['sort']) && !empty($_GET['sort']) && in_array($_GET['sort'], ['id', 'offer_name', 'customer_name', 'validity_offer', 'note'])) 
            {
                $sort = $_GET['sort'];
            }
            if (isset($_GET['order']) && !empty($_GET['order']) && in_array($_GET['order'], ['asc', 'desc'])) 
            {
                $order = $_GET['order'];
            }
        
            $limit = 10;
            $offset = ($page - 1) * $limit;

            $totalOffers = $this->model->getCountOffers();
            $totalPages = ceil($totalOffers / $limit);

            $offers = $this->model->getMyOffers($limit, $offset, $sort, $order);
            
            return require_once('../views/my-offers.php');
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function addOfferAction()
    {
        $this->checkUserAccess();

        try 
        {
            if(isset($_POST['AddOffer']))
            {
                $user_id = $_SESSION['user_id'];
                $offer_name = $_POST['offer-name'];
                $customer_name = $_POST['customer-name'];
                $validity_offer = $_POST['validity-offer'];
                $note = $_POST['note'];

                $offerStatus = $this->model->addOffer($user_id, $offer_name, $customer_name, $validity_offer, $note);

                if(isset($offerStatus))
                {
                    $offer_id = $this->model->getMaxOfferId() + 1;
                    if ($offerStatus == 1) 
                    {
                        for ($i = 1; $i <= 5; $i++) 
                        {
                            if(isset($_POST["product-name-$i"]) && isset($_POST["product-price-$i"]) && isset($_POST["product-count-$i"]) && isset($_POST["product-discount-$i"])) 
                            {
                                $product_name = $_POST["product-name-$i"];
                                $product_price = $_POST["product-price-$i"];
                                $product_count = $_POST["product-count-$i"];
                                $product_discount = $_POST["product-discount-$i"];

                                $productStatus = $this->model->addProduct($user_id, $offer_id, $product_name, $product_price, $product_count, $product_discount);

                                if (!$productStatus) 
                                {
                                    $_SESSION['alerts']['errors'][] = "Error adding product to the offer.";
                                }
                            }
                        }
                        $_SESSION['alerts']['success'][] = "Offer successfully added.";
                    } 
                    else
                    {
                        $_SESSION['alerts']['errors'][] = "Date cannot be less than actually date!";
                    }
                }
                header('Location: home');
                exit;
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function showOfferAction($id) 
    {
        $this->checkUserAccess();

        try 
        {
            $user = $this->model->getUserById($_SESSION['user_id']);
            $offer = $this->model->getOfferById($id);
            $products = $this->model->getProductsByOfferId($id);

            return require_once '../views/offer.php';
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function editOfferAction($id) 
    {
        $this->checkUserAccess();

        try 
        {
            $user = $this->model->getUserById($_SESSION['user_id']);
            $customers = $this->model->getAllCustomers();
            
            $offer = $this->model->getOfferById($id);
            $products = $this->model->getProductsByOfferId($id);

            $product_prices = $this->model->getProductPricesByOfferId($id);
            $total_count = array_reduce($products, function ($acc, $product) { return $acc + $product['count']; }, 0);

            return require_once '../views/offer-edit.php';
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function updateOfferAction()
    {
        $this->checkUserAccess();

        try 
        {
            if(isset($_POST['UpdateOffer']))
            {
                $offer_id = $_POST['offer-id'];
                $offer_name = $_POST['offer-name'];
                $customer_name = $_POST['customer-name'];
                $validity_offer = $_POST['validity-offer'];
                $note = $_POST['note'];

                $offerStatus = $this->model->updateOffer($offer_id, $offer_name, $customer_name, $validity_offer, $note);

                if($offerStatus !== null)
                {
                    if ($offerStatus == 1) 
                    {
                        $_SESSION['alerts']['success'][] = "Offer successfully updated.";
                    } 
                    else
                    {
                        $_SESSION['alerts']['errors'][] = "Date cannot be less than actually date!";
                    }
                    header('Location: ../offer-edit/' . $offer_id);
                    exit;
                }
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function deleteOfferAction()
    {
        $this->checkUserAccess();
        try 
        {
            if (isset($_POST['offer-id'])) 
            {
                $offer_id = $_POST['offer-id'];
                $offerStatus = $this->model->deleteOffer($offer_id);
        
                if ($offerStatus !== null) 
                {
                    if ($offerStatus == 1) 
                    {
                        $_SESSION['alerts']['success'][] = "Offer successfully deleted.";
                    } else 
                    {
                        $_SESSION['alerts']['errors'][] = "Error occurred while deleting offer!";
                    }
                }
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function addProductAction($id) 
    {
        $this->checkUserAccess();
        try 
        {
            $user = $this->model->getUserById($_SESSION['user_id']);
            $offer = $this->model->getOfferById($id);

            return require_once '../views/product-add.php';
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function createProductAction() 
    {
        $this->checkUserAccess();

        try 
        {
            if(isset($_POST['CreateProduct']))
            {
                $offer_id = $_POST['offer-id'];
                $product_name = $_POST['product-name'];
                $count = $_POST['count'];
                $price = $_POST['price'];
                $discount = $_POST['discount'];
                $products = $this->model->getProductsByOfferId($offer_id);
        
                if (count($products) >= 5) 
                {
                    $_SESSION['alerts']['errors'][] = "Maximum number of products for this offer is already reached.";
                } 
                else 
                {
                    $productStatus = $this->model->createProduct($offer_id, $product_name, $count, $price, $discount);

                    if($productStatus !== null)
                    {
                        if ($productStatus == 1) 
                        {
                            $_SESSION['alerts']['success'][] = "Product successfully created.";
                        } 
                        else
                        {
                            $_SESSION['alerts']['errors'][] = "Failed to create product.";
                        }
                    }
                }

                header('Location: ../offer-edit/' . $offer_id);
                exit;
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function editProductAction($id) 
    {
        $this->checkUserAccess();

        try 
        {
            $user = $this->model->getUserById($_SESSION['user_id']);
            $offer = $this->model->getOfferById($id);
            $product = $this->model->getProductById($id);
            return require_once '../views/product-edit.php';
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function updateProductAction()
    {
        $this->checkUserAccess();

        try 
        {
            if(isset($_POST['UpdateProduct']))
            {
                $product_id = $_POST['product-id']; 
                $product_name = $_POST['product-name']; 
                $count = $_POST['count']; 
                $price = $_POST['price']; 
                $discount = $_POST['discount']; 

                $productStatus = $this->model->updateProduct($product_id, $product_name, $count, $price, $discount); 

                if($productStatus !== null)
                {
                    if ($productStatus == 1) 
                    {
                        $_SESSION['alerts']['success'][] = "Product successfully updated.";
                    } 
                    else
                    {
                        $_SESSION['alerts']['errors'][] = "Date cannot be less than actually date!";
                    }
                }
                header('Location: ../product-edit/' . $product_id);
                exit;
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function deleteProductAction()
    {
        $this->checkUserAccess();
        
        try 
        {
            if (isset($_POST['product-id'])) 
            {
                $product_id = $_POST['product-id'];
                $productStatus = $this->model->deleteProduct($product_id);
        
                if ($productStatus !== null) 
                {
                    if ($productStatus == 1) 
                    {
                        $_SESSION['alerts']['success'][] = "Product successfully deleted.";
                    } 
                    else 
                    {
                        $_SESSION['alerts']['errors'][] = "Error occurred while deleting product!";
                    }
                }
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }
}