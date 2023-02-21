<?php

class HomeModel 
{
    public $db;

    public function getUserById($id)
    {
        try
        {
            $query = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        
            return $user;
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function getAllCustomers()
    {
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM customers");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function getAllOffers($limit, $offset, $sort, $order)
    {
        try
        {
            $sortAllowed = ['id', 'offer_name', 'customer_name', 'validity_offer'];
            if (!in_array($sort, $sortAllowed)) 
            {
                $sort = 'id';
            }
            $orderAllowed = ['asc', 'desc'];
            if (!in_array($order, $orderAllowed)) 
            {
                $order = 'asc';
            }
            $stmt = $this->db->prepare("SELECT * FROM offers ORDER BY $sort $order LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function getCountOffers()
    {
        try 
        {
            $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM offers");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function getMaxOfferId() {
        try
        {
            $select_query = "SELECT MAX(id) as max_id FROM offers";
            $select_stmt = $this->db->prepare($select_query);
            $select_stmt->execute();
            $result = $select_stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result['max_id'];
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function getMyOffers($limit, $offset, $sort, $order)
    {
        try
        {
            $user_id = $_SESSION['user_id'];

            $sortAllowed = ['id', 'offer_name', 'customer_name', 'validity_offer'];
            if (!in_array($sort, $sortAllowed)) 
            {
                $sort = 'id';
            }
            $orderAllowed = ['asc', 'desc'];
            if (!in_array($order, $orderAllowed)) 
            {
                $order = 'asc';
            }
            $stmt = $this->db->prepare("SELECT * FROM offers WHERE user_id = :user_id ORDER BY $sort $order LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function getOfferById($offer_id) 
    {
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM offers WHERE id = :offer_id");
            $stmt->bindValue(':offer_id', $offer_id, PDO::PARAM_INT);
            $stmt->execute();
        
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function getProductById($id) 
    {
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function getProductsByOfferId($offer_id) 
    {
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE offer_id = :offer_id");
            $stmt->bindValue(':offer_id', $offer_id, PDO::PARAM_INT);
            $stmt->execute();

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as &$product) 
            {
                $discounted_price = $product['price'] - ($product['price'] * $product['discount'] / 100);
                $product['discounted_price'] = $discounted_price;
            }

            return $products;
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function getProductPricesByOfferId($offer_id, $count = 1) 
    {
        try
        {
            $stmt = $this->db->prepare("SELECT 
                ROUND(SUM(price * :count), 2) AS total_price, 
                ROUND(SUM(price * discount * :count / 100), 2) AS total_discount, 
                ROUND(SUM(price * (100 - discount) * :count / 100), 2) AS total_discounted_price 
                FROM products WHERE offer_id = :offer_id");
            $stmt->bindValue(':offer_id', $offer_id, PDO::PARAM_INT);
            $stmt->bindValue(':count', $count, PDO::PARAM_INT);
            $stmt->execute();
        
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function addOffer($user_id,$offer_name,$customer_name,$validity_offer,$note)
    {
        try
        {
            $today = new DateTime();
            $offer_validity = new DateTime($validity_offer);
            $offer_validity->modify('+1 day');
            
            if($offer_validity < $today)
            {
                return 0;
            }
            else
            {
                $query = "INSERT INTO offers (user_id, offer_name, customer_name, validity_offer, note) VALUES (:user_id, :offer_name, :customer_name, :validity_offer, :note)";

                $validity_offer = date("Y-m-d", strtotime($validity_offer));
        
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
                $stmt->bindParam(':offer_name', $offer_name, \PDO::PARAM_STR);
                $stmt->bindParam(':customer_name', $customer_name, \PDO::PARAM_STR);
                $stmt->bindParam(':validity_offer', $validity_offer, \PDO::PARAM_STR);
                $stmt->bindParam(':note', $note, \PDO::PARAM_STR);
                $stmt->execute();

                return 1;
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function addProduct($user_id,$offer_id,$product_name,$price,$count,$discount)
    {
        try
        {
            $query = "INSERT INTO products (user_id, offer_id, product_name, price, count, discount) VALUES (:user_id, :offer_id, :product_name, :price, :count, :discount)";
            $offer_id--;
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt->bindParam(':offer_id', $offer_id, \PDO::PARAM_INT);
            $stmt->bindParam(':product_name', $product_name, \PDO::PARAM_STR);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':count', $count, \PDO::PARAM_INT);
            $stmt->bindParam(':discount', $discount, \PDO::PARAM_INT);
            $stmt->execute();

            return 1;
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }
    
    public function updateOffer($offer_id,$offer_name,$customer_name,$validity_offer,$note)
    {
        try
        {
            $today = new DateTime();
            $offer_validity = new DateTime($validity_offer);
            $offer_validity->modify('+1 day');
            
            if($offer_validity < $today)
            {
                return 0;
            }
            else
            {
                $query = "UPDATE offers SET offer_name = :offer_name, customer_name = :customer_name, validity_offer = :validity_offer, note = :note WHERE id = :offer_id";

                $validity_offer = date("Y-m-d", strtotime($validity_offer));
        
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':offer_id', $offer_id, \PDO::PARAM_INT);
                $stmt->bindParam(':offer_name', $offer_name, \PDO::PARAM_STR);
                $stmt->bindParam(':customer_name', $customer_name, \PDO::PARAM_STR);
                $stmt->bindParam(':validity_offer', $validity_offer, \PDO::PARAM_STR);
                $stmt->bindParam(':note', $note, \PDO::PARAM_STR);
                $stmt->execute();

                return 1;
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function deleteOffer($offerId)
    {
        try
        {
            $stmt = $this->db->prepare("DELETE FROM offers WHERE id = :id");
            $stmt->bindValue(':id', $offerId, PDO::PARAM_INT);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) 
            {
                return 1;
            } 
            else 
            {
                return null;
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function createProduct($offerId, $productName, $count, $price, $discount)
    {
        try
        {
            $stmt = $this->db->prepare("INSERT INTO products (offer_id, product_name, count, price, discount) VALUES (:offer_id, :product_name, :count, :price, :discount)");
            $stmt->bindValue(':offer_id', $offerId, PDO::PARAM_INT);
            $stmt->bindValue(':product_name', $productName, PDO::PARAM_STR);
            $stmt->bindValue(':count', $count, PDO::PARAM_INT);
            $stmt->bindValue(':price', $price, PDO::PARAM_INT);
            $stmt->bindValue(':discount', $discount, PDO::PARAM_INT);
            $stmt->execute();

            return 1;
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function updateProduct($productId, $productName, $count, $price, $discount)
    {
        try
        {
            $stmt = $this->db->prepare("UPDATE products SET product_name = :product_name, count = :count, price = :price, discount = :discount WHERE id = :id");
            $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
            $stmt->bindValue(':product_name', $productName, PDO::PARAM_STR);
            $stmt->bindValue(':count', $count, PDO::PARAM_INT);
            $stmt->bindValue(':price', $price, PDO::PARAM_INT);
            $stmt->bindValue(':discount', $discount, PDO::PARAM_INT);
            $stmt->execute();

            return 1;
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function deleteProduct($productId)
    {
        try
        {
            $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
            $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) 
            {
                return 1;
            } 
            else 
            {
                return null;
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }
}