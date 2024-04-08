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

    public function getHistory() {
        return $this->history;
    }

    public function getDate() {
        return $this->date;
    }


    //SETTERS
    public function setPatientId($patient_id) {
        $this->patient_id = $patient_id;
    }

    public function setHistory($history) {
        $this->history = $history;
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

    public function add($id){
        $sql = "INSERT INTO histories (patient_id,history,date) VALUES ({$this->getPatientId()},'{$this->getHistory()}','{$this->getDate()}')";
        $query = $this->db->query($sql);

        $result = false;

        if ($query) {
            $result = true;
        }

        return $result;
    }

    public function delete($id){
        $sql = "DELETE FROM histories WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
    
        $result = $stmt->execute();
        
        return $result;
    }

    public function update($id){
        $sql = "UPDATE histories SET history = '{$this->getHistory()}' WHERE id = {$id}";
        
        $query = $this->db->query($sql);

        $result = false;

        if ($query) {
            $result = true;
        }

        return $result;
    }

    public function data($id){
        $sql = "SELECT * FROM histories WHERE id = {$id}";
        $query = $this->db->query($sql);

        if ($query) {
            $result = $query->fetch_object();
        }

        return $result;
    }

}
?>
