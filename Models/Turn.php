<?php

require_once 'Config/Database.php';

class Turn {
    private $id;
    private $patient_id;
    private $date;
    private $hour;
    private $appointment;

    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getPatientId() {
        return $this->patient_id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getHour() {
        return $this->hour;
    }

    public function getAppointment() {
        return $this->appointment;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setPatientId($patient_id) {
        $this->patient_id = $patient_id;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setHour($hour) {
        $this->hour = $hour;
    }

    public function setAppointment($appointment) {
        $this->appointment = $appointment;
    }





    //Metodos
    public function save(){
        $sql = "INSERT INTO turns (patient_id,date,hour,appointment) VALUES ({$this->getPatientId()},'{$this->getDate()}','{$this->getHour()}','{$this->getAppointment()}')";
        $query = $this->db->query($sql);
        
        $result = false;

        if ($query) {
            $result = true;
        }

        return $result;
    }



    public function turnByDay($date){
        $sql = "SELECT t.id AS turno_id, p.name AS nombre_paciente, t.date AS fecha, t.hour AS hora, t.appointment AS cita
                FROM turns t
                JOIN patients p ON t.patient_id = p.id
                WHERE t.date = ?";
        
        $query = $this->db->prepare($sql);
        $query->bind_param("s", $date);
        $query->execute();
        $result = $query->get_result();
    
        $turns = array();
        while ($row = $result->fetch_object()) {
            $turns[] = $row;
        }
    
        return $turns;
    }
    
    
}

?>
