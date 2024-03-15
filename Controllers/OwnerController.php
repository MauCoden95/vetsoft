<?php 

require_once 'Models/Owner.php';

class OwnerController{
    public function index(){
        $owner = new Owner();
        $count = $owner->count();
        $owners = $owner->list();

        $data['count'] = $count;
        $data['owners'] = $owners;

        //unset($_SESSION['update_vet']);

        require_once('Views/Owner/Index.php');
    }

    public function delete(){
        $owner = new Owner(); 

        if ($_GET) {
            $url = explode('/', $_GET['url']);
            $id = $url[2];

            $delete = $owner->delete($id);

            if ($delete) {
                header('Location: http://localhost/VetSoft/Owner/index');
            }
        }
    }


    public function save()
    {
        $owner = new Owner();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $dni = $_POST['dni'];
            $phone = $_POST['phone'];
            $phone2 = $_POST['phone2'];
            $mail = $_POST['mail'];
            $address = $_POST['address'];


            if ($name == '' || $dni == '' || $phone == '' || $phone2 == '' || $mail == '' || $address == '') {
                $_SESSION['save_own'] = false;
            } else {
                $owner->setName($name);
                $owner->setDni($dni);
                $owner->setPhone($phone);
                $owner->setPhone2($phone2);
                $owner->setMail($mail);
                $owner->setAddress($address);


                $save = $owner->save();

                if ($save) {
                    $_SESSION['save_own'] = true;
                } else {
                    $_SESSION['save_own'] = false;
                }
            }
        }

        header('Location: http://localhost/VetSoft/Owner/index');
        exit();
    }

    public function edit(){
        $owner = new Owner();

        if ($_GET) {
            $url = explode('/', $_GET['url']);
            $id = $url[2];           

            $data = $owner->data($id);

            require_once 'Views/Owner/Edit.php';
        }

        
    }


    public function update()
    {
        $owner = new Owner();
        $url = explode('/', $_GET['url']);
        $id = $url[2];

       


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $dni = isset($_POST['dni']) ? $_POST['dni'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : '';
            $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
            $address = isset($_POST['address']) ? $_POST['address'] : '';

            if ($name == '' || $dni == '' || $phone == '' || $phone2 == '' || $mail == ''|| $address == '') {
                $_SESSION['update_own'] = false;
            } else {
                $owner->setName($name);
                $owner->setDni($dni);
                $owner->setPhone($phone);
                $owner->setPhone2($phone2);
                $owner->setMail($mail);
                $owner->setAddress($address);

                $update = $owner->update($id);

                

                if ($update) {
                    $_SESSION['update_own'] = true;
                } else {
                    $_SESSION['update_own'] = false;
                }
            }
        }

        header('Location: http://localhost/VetSoft/Owner/edit/'.$id);
        exit();
    }
}


?>