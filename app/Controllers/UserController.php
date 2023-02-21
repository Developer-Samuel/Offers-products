<?php

class UserController 
{
    public $model;

    public function checkUserAccess()
    {
        try 
        {
            if(!isset($_SESSION['userLoginStatus']))
            {
                header("Location: login");
                exit;
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function loginAction()
    {
        try 
        {
            if(isset($_POST['LoginSubmit']))
            {
                $errors = [];

                $name = $_POST['name'];
                $password = $_POST['password'];

                $result = $this->model->CheckUserLogin($name, md5($password));

                if($result)
                {
                    $_SESSION['userLoginStatus'] = 1;
                    if($result == "user")
                    {
                        $_SESSION['userSession'] = 1;
                        header("Location: home");
                        exit;
                    } 
                    
                    elseif($result == "customer")
                    {
                        $_SESSION['customerSession'] = 1;
                        header("Location: home");
                        exit;
                    }
                }
                else
                {
                    array_push($errors, "User not exist!");
                }
            }
            if(!isset($_SESSION['userSession']) || !!isset($_SESSION['customerSession']))
            {
                return require_once('../views/login.php');
            }
            else
            {
                header("Location: home");
                exit;
            }
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function logoutAction()
    {
        try 
        {
            if(isset($_SESSION['userSession']))
            {
                unset($_SESSION['userSession']);
            }
            elseif(isset($_SESSION['customerSession']))
            {
                unset($_SESSION['customerSession']);
            }
            unset($_SESSION['userLoginStatus']);

            header("Location: login");
            exit;
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }

    public function registerAction()
    {
        try
        {
            if(isset($_POST['RegisterSubmit']))
            {
                $errors = [];
                $success = [];

                $name = $_POST['name'];
                $password = $_POST['password'];

                $registrationStatus = $this->model->UserRegister($name, md5($password));
                if ($registrationStatus == 0) 
                {
                    array_push($errors, "User | Client already registered");
                } 
                else 
                {
                    echo "<script>alert('Client successfully registered');</script>";
                }

                if(strlen($password) < 6)
                {
                    array_push($errors, "Password must have at least 6 characters!");
                }
                if(strlen($name) < 5)
                {
                    array_push($errors, "Name must have at least 5 characters!");
                }
            }
            return require_once('../views/login.php');
        }
        catch(Exception $e) { echo 'An error occurred: ' . $e->getMessage(); }
    }
}