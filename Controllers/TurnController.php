<?php

require_once 'Models/Turn.php';
require_once 'Models/Patient.php';

class TurnController
{
    public function index()
    {
        $turn = new Turn();
        $turns = $turn->todayTurns();

        require_once('Views/Turn/Index.php');
    }

    public function addTurnPatient()
    {
        $patient = new Patient();
        $url = explode('/', $_GET['url']);
        $id = $url[2];

        $name = $patient->getNameById($id);

        require_once('Views/Turn/AddTurnPatient.php');
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $turn = new Turn();

            $patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : '';
            $day = isset($_POST['day']) ? $_POST['day'] : '';
            $hour = isset($_POST['hour']) ? $_POST['hour'] : '';
            $appointment = isset($_POST['appointment']) ? $_POST['appointment'] : '';




            if ($patient_id == '' || $day == '' || $hour == '' || $appointment == '') {
                $_SESSION['save_turn_failed'] = "Campos vacíos";
            } else {
                $turn->setPatientId($patient_id);
                $turn->setDate($day);
                $turn->setHour($hour);
                $turn->setAppointment($appointment);

                $save = $turn->save();

                if ($save) {
                    $_SESSION['save_turn'] = true;
                } else {
                    $_SESSION['save_turn_failed'] = "Hubo un error al guardar el turno";
                }
            }
        }

        header('Location: http://localhost/VetSoft/Turn/addTurnPatient/' . $patient_id);
    }

    public function getDateByDay()
    {
        $turn = new Turn();
        $url = explode('/', $_GET['url']);
        $date = $url[2];

        $turns = $turn->turnByDay($date);

        //print_r($turns);
        
        echo json_encode($turns);
    }


   
}
