<?php 

require_once 'Models/History.php';
require_once 'Models/Patient.php';

class HistoryController{
    public function index(){
        $url = explode('/', $_GET['url']);
        $id = $url[2];

        $history = new History();
        $patient = new Patient();
        $patient_history = $history->getHistoryByPatient($id);
        $name_patient = $patient->getNameById($id);
        
       
        require_once('Views/History/Index.php');
    }

}