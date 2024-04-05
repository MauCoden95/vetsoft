<?php 

require_once 'Models/Turn.php';
require_once 'Models/Patient.php';

class TurnController{
    public function addTurnPatient(){
        $patient = new Patient();
        $url = explode('/', $_GET['url']);
        $id = $url[2];

        $name = $patient->getNameById($id);

        require_once('Views/Turn/AddTurnPatient.php');
    }
}
?>