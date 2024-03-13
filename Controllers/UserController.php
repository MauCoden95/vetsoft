<?php
require_once 'Models/User.php';

class UserController{
    public function index(){
        require_once 'Views/User/Login.php';
    }

    public function register(){
        require_once 'Views/User/Register.php';
    }

    public function add(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            
            $role_id = isset($_POST['role_id']) ? $_POST['role_id'] : '';
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            
            if (empty($role_id) || empty($name) || empty($phone) || empty($mail) || empty($password)) {
                return;
            }

            $user->setRoleId($role_id);
            $user->setName($name);
            $user->setPhone($phone);
            $user->setMail($mail);
            $user->setPassword($password);

            $save = $user->register();
        }
    }

    public function dashboard(){
        require_once 'Views/User/Dashboard.php';
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            
            $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            
            if (empty($mail) || empty($password)) {
                return;
            }

            $login = $user->login($mail, $password);

            if ($login) {
                session_start();
                $_SESSION['user'] = $login;
                unset($_SESSION['login']);
                header('Location: /VetSoft/User/dashboard');
                exit();
            } else {
                header('Location: /VetSoft/User/index');
                exit();
            }
        }
    }

    public function logout(){
        session_start();
        unset($_SESSION['user']);
        header('Location: /VetSoft/User/index');
        exit();
    }
}
?>
