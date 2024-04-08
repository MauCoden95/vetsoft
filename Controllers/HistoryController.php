<?php

require_once 'Models/History.php';
require_once 'Models/Patient.php';

class HistoryController
{
    public function index()
    {
        $url = explode('/', $_GET['url']);
        $id = $url[2];

        $_SESSION['id'] = $id;

        $history = new History();
        $patient = new Patient();
        $patient_history = $history->getHistoryByPatient($id);
        $name_patient = $patient->getNameById($id);


        require_once('Views/History/Index.php');
    }

    public function save()
    {
        $url = explode('/', $_GET['url']);
        $id = $url[2];

        $history = new History();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $historyText = isset($_POST['history']) ? $_POST['history'] : '';
            $date = isset($_POST['date']) ? $_POST['date'] : '';

            if ($historyText == '') {
                $_SESSION['save_his_failed'] = "Campos vacíos";
            } else {
                $history->setPatientId($id);
                $history->setHistory($historyText);
                $history->setDate($date);


                $save = $history->add($id);

                if ($save) {
                    $_SESSION['save_his'] = true;
                    unset($_SESSION['save_his_failed']);
                } else {
                    $_SESSION['save_his_failed'] = "Hubo un error al guardar";
                }
            }
        }

        header('Location: http://localhost/VetSoft/History/index/' . $id);
        exit();
    }

    public function delete()
    {
        $history = new History();

        if ($_GET) {
            $url = explode('/', $_GET['url']);
            $id = $url[2];

            $delete = $history->delete($id);

            if ($delete) {
                header('Location: http://localhost/VetSoft/History/index/'. $_SESSION['id']);
            }
        }
    }

    public function edit()
    {
        $url = explode('/', $_GET['url']);
        $id = $url[2];

        $history = new History();
        $data = $history->data($id);

        

        require_once('Views/History/Edit.php');
    }

    public function update()
    {
        $history = new History();
        $url = explode('/', $_GET['url']);
        $id = $url[2];



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $historyText = isset($_POST['history']) ? $_POST['history'] : '';

            if ($historyText == '') {
                $_SESSION['update_hist_failed'] = "Campos vacíos";
            } else {
                $history->setHistory($historyText);

                $update = $history->update($id);

                if ($update) {
                    $_SESSION['update_hist'] = true;
                } else {
                    $_SESSION['update_hist_failed'] = "Error al actualizar el veterinario";
                }
            }
        }


        header("Location: http://localhost/VetSoft/History/Edit/" . $id);
        exit();
    }
}
