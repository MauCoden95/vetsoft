<?php
    require_once 'Models/User.php';

    class UserController{
        public function index(){
            require_once('Views/User/Login.php');
        }

        public function register(){
            require_once('Views/User/Register.php');
        }

        public function add(){
            $user = new User();

            if (isset($_POST)) {
                $role_id = $_POST['role_id'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $mail = $_POST['mail'];
                $password = $_POST['password'];

                $user->setRoleId($role_id);
                $user->setName($name);
                $user->setPhone($phone);
                $user->setMail($mail);
                $user->setPassword($password);

                $save = $user->register();

                
            }
        }

        public function dashboard(){
            require_once('Views/User/Dashboard.php');
        }


        public function login(){
            $user = new User();

            if (isset($_POST)) {
                $mail = $_POST['mail'];
                $password = $_POST['password'];

                

                $login = $user->login($mail,$password);

                if ($login) {
                    $_SESSION['user'] = $login;
                    unset($_SESSION['login']);
                    header('Location: http://localhost/VetSoft/User/dashboard');
                }else{
                    header('Location: http://localhost/VetSoft/User/index');
                    $_SESSION['login'] = false;
                }
            }
        }


        public function logout(){
            unset($_SESSION['user']);
            header('Location: http://localhost/VetSoft/User/index');
        }
    }




?>