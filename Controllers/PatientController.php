<?php
require_once 'Models/Patient.php';
require_once 'Models/Owner.php';

class PatientController
{
    public function index()
    {
        $patient = new Patient();
        $owner = new Owner();
        $count = $patient->count();
        $patients = $patient->data();
        $owners = $owner->list();


        require_once('Views/Patient/Index.php');
    }


    public function save(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $patient = new Patient();

            if ($_POST) {
                $owner_id = isset($_POST['owner_id']) ? $_POST['owner_id'] : '';
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $animal = isset($_POST['animal']) ? $_POST['animal'] : '';
                $breed = isset($_POST['breed']) ? $_POST['breed'] : '';
                $birth = isset($_POST['birth']) ? $_POST['birth'] : '';
                $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

             


                if ($owner_id == '' || $name == '' || $animal == '' || $breed == '' || $birth == '' || $gender == '') {
                   return;
                }

                $patient->setOwnerId($owner_id);
                $patient->setName($name);
                $patient->setAnimal($animal);
                $patient->setBreed($breed);
                $patient->setBirth($birth);
                $patient->setGender($gender);

                $save = $patient->add();

                if ($save) {
                    $_SESSION['save_pat'] = true;
                }else{
                    $_SESSION['save_pat'] = false;
                }

            }



            header('Location: /VetSoft/Patient/index');
        }
    }

    public function delete()
    {
        $patient = new Patient();

        if ($_GET) {
            $url = explode('/', $_GET['url']);
            $id = $url[2];

            $delete = $patient->delete($id);

            if ($delete) {
                header('Location: http://localhost/VetSoft/Patient/index');
            }
        }
    }


    public function edit(){
        $patient = new Patient();
        $owner = new Owner();

        if ($_GET) {
            $url = explode('/', $_GET['url']);
            $id = $url[2];           

            $data = $patient->dataById($id);
            $owners = $owner->list();

            

            require_once 'Views/Patient/Edit.php';
        }
    }


    public function update()
    {
        $patient = new Patient();
        $url = explode('/', $_GET['url']);
        $id = $url[2];



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $owner_id = isset($_POST['owner_id']) ? $_POST['owner_id'] : '';
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $animal = isset($_POST['animal']) ? $_POST['animal'] : '';
            $breed = isset($_POST['breed']) ? $_POST['breed'] : '';
            $birth = isset($_POST['birth']) ? $_POST['birth'] : '';
            $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

            //echo $owner_id.' '.$name.' '.$animal.' '.$breed.' '.$birth.' '.$gender;

            if ($owner_id == '' || $name == '' || $animal == '' || $breed == '' || $birth == '' || $gender == '') {
                $_SESSION['update_pat'] = false;
            } else {
                $patient->setOwnerId($owner_id);
                $patient->setName($name);
                $patient->setAnimal($animal);
                $patient->setBreed($breed);
                $patient->setBirth($birth);
                $patient->setGender($gender);

                

                $update = $patient->update($id);

                

                if ($update) {
                    $_SESSION['update_pat'] = true;
                } else {
                    $_SESSION['update_pat'] = false;
                }

                
            }
        }

        

        header("Location: http://localhost/VetSoft/Patient/edit/" . $id);
        exit();
    }



}
