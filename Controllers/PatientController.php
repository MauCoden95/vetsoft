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
                    $_SESSION['save_pat_failed'] = "Campos vacíos";
                    header('Location: /VetSoft/Patient/index');
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
                    $_SESSION['save_pat_failed'] = "Error al guardar el paciente";
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
                header("Location: http://localhost/VetSoft/Patient/index");
                exit();
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

            

            if ($owner_id == '' || $name == '' || $animal == '' || $breed == '' || $birth == '' || $gender == '') {
                $_SESSION['update_patient_failed'] = "Campos vacíos";
            } else {
                $patient->setOwnerId($owner_id);
                $patient->setName($name);
                $patient->setAnimal($animal);
                $patient->setBreed($breed);
                $patient->setBirth($birth);
                $patient->setGender($gender);

                

                $update = $patient->update($id);

                

                if ($update) {
                    $_SESSION['update_patient'] = true;
                } else {
                    $_SESSION['update_patient_failed'] = "Error al actualizar el paciente";
                }

                
            }
        }

        

        header("Location: http://localhost/VetSoft/Patient/edit/" . $id);
        exit();
    }


    public function patientsByOwner(){
        $patient = new Patient();
        $url = explode('/', $_GET['url']);
        $id = $url[2];

        $patients = $patient->patientsByOwner($id);

      

        require_once('Views/Patient/PatientByOwner.php');
    }


    public function saveByOwner(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $patient = new Patient();

            if ($_POST) {
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $animal = isset($_POST['animal']) ? $_POST['animal'] : '';
                $breed = isset($_POST['breed']) ? $_POST['breed'] : '';
                $birth = isset($_POST['birth']) ? $_POST['birth'] : '';
                $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

             
                $url = explode('/', $_GET['url']);
                $id = $url[2];

                if ($name == '' || $animal == '' || $breed == '' || $birth == '' || $gender == '') {
                    header('Location: /VetSoft/Patient/index');
                }

                $patient->setOwnerId($id);
                $patient->setName($name);
                $patient->setAnimal($animal);
                $patient->setBreed($breed);
                $patient->setBirth($birth);
                $patient->setGender($gender);

                $save = $patient->addPatientByOwnerId();

                if ($save) {
                    $_SESSION['save_pat_own'] = true;
                }else{
                    $_SESSION['save_pat_own'] = false;
                }

            }



            header('Location: /VetSoft/Patient/patientsByOwner/'.$id);
        }
    }
}
