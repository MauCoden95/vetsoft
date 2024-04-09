<?php
require_once 'Models/User.php';
require_once 'Models/Owner.php';
require_once 'Models/Patient.php';
require_once 'Models/Veterinary.php';
require_once 'Models/Turn.php';

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
        $owner = new Owner();
        $patient = new Patient();
        $veterinary = new Veterinary();
        $turn = new Turn();

        $owners_count = $owner->count();
        $patients_count = $patient->count();
        $veterinaries_count = $veterinary->count();
        $turns_count = $turn->count();

        require_once 'Views/User/Dashboard.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();

            $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';


            if (!empty($mail) || !empty($password)) {
                $login = $user->login($mail, $password);

                if ($login) {
                    session_start();
                    $_SESSION['user'] = $login;
                    unset($_SESSION['login']);
                    $_SESSION['login_success'] = true;
                    header('Location: /VetSoft/User/dashboard');
                    exit();
                } else {
                    $_SESSION['login'] = false;
                    header('Location: /VetSoft/User/index');
                    exit();
                }    
            }else{
                $_SESSION['login'] = false;
                header('Location: /VetSoft/User/index');
            }

            
        }
    }

    public function logout()
    {
        session_destroy();
        // header('Location: /VetSoft/User/index');
        // exit();
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

            if ($psw1 == '' || $psw2 == '') {
                $_SESSION['change_failed'] = "Campos vacíos";
            } else {
                if ($psw1 != $psw2) {
                    $_SESSION['change_failed'] = "Las contraseñas no coinciden";
                    var_dump($_SESSION['change_failed']);
                } else {
                    $user->setPassword($psw1);
                    $change = $user->changePassword($_SESSION['user']->id);
                    
        
                    if ($change) {
                        $_SESSION['change_success'] = "Contraseña cambiada con exito!!!";
                        unset($_SESSION['change_failed']);
                    }
                }
            }
        }

        header('Location: /VetSoft/User/settings');
    }

    public function users(){
        $user = new User();
        $users_count = $user->count();
        $list = $user->list();


        require_once 'Views/User/Index.php';
    }


    public function delete()
    {
        $user = new User();

        if ($_GET) {
            $url = explode('/', $_GET['url']);
            $id = $url[2];

            $delete = $user->delete($id);

            if ($delete) {
                header('Location: http://localhost/VetSoft/User/users');
            }
        }
    }

    public function save()
    {
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_id = isset($_POST['role_id']) ? $_POST['role_id'] : '';
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $mail = isset($_POST['mail']) ? $_POST['mail'] : '';

            if ($role_id == '' || $name == '' || $mail == '') {
                $_SESSION['save_user_failed'] = "Campos vacíos";
            } else {
                $user->setRoleId($role_id);
                $user->setName($name);
                $user->setMail($mail);
                $user->setPassword("nuevousuario");

                

                $save = $user->save();

                if ($save) {
                    $_SESSION['save_user'] = true;
                    unset($_SESSION['save_user_failed']);
                } else {
                    $_SESSION['save_user_failed'] = "Hubo un error al guardar";
                }
            }
        }

        header('Location: http://localhost/VetSoft/User/users');
        exit();
    }
}
