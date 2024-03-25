<?php
require_once 'Models/User.php';

class UserController
{
    public function index()
    {
        require_once 'Views/User/Login.php';
    }

    public function register()
    {
        require_once 'Views/User/Register.php';
    }

    public function add()
    {
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

    public function dashboard()
    {
        require_once 'Views/User/Dashboard.php';
    }

    public function login()
    {
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

    public function logout()
    {
        session_destroy();
        header('Location: /VetSoft/User/index');
        exit();
    }

    public function settings()
    {
        require_once 'Views/User/Settings.php';
    }

    public function change()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();

            $psw1 = isset($_POST['pw1']) ? $_POST['pw1'] : '';
            $psw2 = isset($_POST['pw2']) ? $_POST['pw2'] : '';

            $user->setPassword($psw1);
            //var_dump($psw2);
            $user->changePassword($_SESSION['user']->id);
            $_SESSION['change_success'] = "Contraseña cambiada con exito!!!";

            // if ($psw1 == '' || $psw2 == '') {
            //     $_SESSION['change_failed'] = "Campos vacíos";
            // } else {
            //     if ($psw1 != $psw2) {
            //         $_SESSION['change_failed'] = "Las contraseñas no coinciden";
            //     } else {
            //     }
            // }
        }

        //header('Location: /VetSoft/User/settings');
    }
}
