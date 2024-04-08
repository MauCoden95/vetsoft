<?php

require_once 'Config/Database.php';

class History{
    private $patient_id;
    private $history;
    private $date;

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }


    //GETTERS
    public function getPatientId() {
        return $this->patient_id;
    }

    public function setPatientId($patient_id) {
        $this->patient_id = $patient_id;
    }

    public function getHistory() {
        return $this->history;
    }



    //SETTERS
    public function setHistory($history) {
        $this->history = $history;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }



    //METODOS
    public function getHistoryByPatient($id){
        $sql = "SELECT histories.id, histories.history, patients.name AS patient_name, histories.date
        FROM histories
        JOIN patients ON histories.patient_id = patients.id
        WHERE histories.patient_id = {$id}";
        $query = $this->db->query($sql);

        if ($query) {
            $result = $query;
        }

        return $result;
    }

    public function getNamePatient($id){
        $sql = "SELECT patients.name AS patient_name
        FROM histories
        JOIN patients ON histories.patient_id = patients.id
        WHERE histories.patient_id = {$id}";
        $query = $this->db->query($sql);

        if ($query) {
            $result = $query->fetch_object();
        }

        return $result;
    }
}
?>
