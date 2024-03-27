<?php
require_once 'Models/Patient.php';

class PatientController
{
    public function index()
    {
        $patient = new Patient();
        $count = $patient->count();
        $patients = $patient->data();

        //$data['count'] = $count;

        //unset($_SESSION['update_vet']);

        require_once('Views/Patient/Index.php');
    }




   
}
