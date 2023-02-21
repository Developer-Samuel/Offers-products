<?php

class UserModel
{
    public $db;

    public function CheckUserLogin($name,$password)
    {
        try
        {
            $userQuery = "SELECT count(*) FROM users WHERE name=:name AND password=:password";
            $customerQuery = "SELECT count(*) FROM customers WHERE name=:name AND password=:password";
            
            $stmtUser = $this->db->prepare($userQuery);
            $stmtUser->bindParam(':name', $name, \PDO::PARAM_STR);
            $stmtUser->bindParam(':password', $password, \PDO::PARAM_STR);
            $stmtUser->execute();

            $stmtCustomer = $this->db->prepare($customerQuery);
            $stmtCustomer->bindParam(':name', $name, \PDO::PARAM_STR);
            $stmtCustomer->bindParam(':password', $password, \PDO::PARAM_STR);
            $stmtCustomer->execute();

            $userCount = $stmtUser->fetchColumn();
            if ($userCount > 0) 
            {
                $query = "SELECT id FROM users WHERE name=:name AND password=:password";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, \PDO::PARAM_STR);
                $stmt->execute();

                $user = $stmt->fetch(\PDO::FETCH_ASSOC);
                $_SESSION['user_id'] = $user['id'];
                return "user";
            } 
            
            $customerCount = $stmtCustomer->fetchColumn();
            if ($customerCount > 0) 
            {
                $query = "SELECT id FROM customers WHERE name=:name AND password=:password";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, \PDO::PARAM_STR);
                $stmt->execute();

                $customer = $stmt->fetch(\PDO::FETCH_ASSOC);
                $_SESSION['customer_id'] = $customer['id'];
                return "customer";
            } 

            return false;
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function UserRegister($name, $password)
    {
        try
        {
            $userQuery = "SELECT * FROM users WHERE name = :name";
            $customerQuery = "SELECT * FROM customers WHERE name = :name";

            $stmtUser = $this->db->prepare($userQuery);
            $stmtUser->bindParam(':name', $name, \PDO::PARAM_STR);
            $stmtUser->execute();

            $stmtCustomer = $this->db->prepare($customerQuery);
            $stmtCustomer->bindParam(':name', $name, \PDO::PARAM_STR);
            $stmtCustomer->execute();

            if($stmtUser->rowCount() == 0)
            {
                if ($stmtCustomer->rowCount() > 0) 
                {
                    return 0;
                }  
                elseif(strlen($password) < 6 || strlen($name) < 5)
                {
                    return 0;
                }
                else 
                {
                    $query = "INSERT INTO customers (name, password) VALUES (:name, :password)";
                    $stmtCustomer = $this->db->prepare($query);
                    $stmtCustomer->bindParam(':name', $name, PDO::PARAM_STR);
                    $stmtCustomer->bindParam(':password', $password, PDO::PARAM_STR);
                    $stmtCustomer->execute();
                    return 1;
                }
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }
}