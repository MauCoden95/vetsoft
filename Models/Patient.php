<?php

require_once 'Config/Database.php';

class Patient
{
    private $owner_id;
    private $name;
    private $animal;
    private $breed;
    private $birth;
    private $gender;

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }


    
    // Getters
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAnimal()
    {
        return $this->animal;
    }

    public function getBreed()
    {
        return $this->breed;
    }

    public function getBirth()
    {
        return $this->birth;
    }

    public function getGender()
    {
        return $this->gender;
    }



    // Setters
    public function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAnimal($animal)
    {
        $this->animal = $animal;
    }

    public function setBreed($breed)
    {
        $this->breed = $breed;
    }

    public function setBirth($birth)
    {
        $this->birth = $birth;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }


    //Metodos
    public function count(){
        $sql = "SELECT count(*) AS cantidad_de_registros FROM patients";
        $query = $this->db->query($sql);

        $count = $query->fetch_object();

        return $count;       
    }

    public function data(){
        $sql = "SELECT * FROM patients";
        $query = $this->db->query($sql);

        return $query;       
    }

    public function dataById($id){
        $sql = "SELECT * FROM patients WHERE id = {$id}";
        $query = $this->db->query($sql);

        return $query;       
    }

    public function add(){
        $result = false;
        $sql = "INSERT INTO patients (owner_id,name,animal,breed,birth,gender) VALUES({$this->getOwnerId()}, '{$this->getName()}', '{$this->getAnimal()}', '{$this->getBreed()}', '{$this->getBirth()}', '{$this->getGender()}')";
        $query = $this->db->query($sql);

        if ($query) {
            $result = true;
        }

        return $result;
    }

    public function delete($id){
        $sql = "DELETE FROM patients WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
    
        $result = $stmt->execute();
        
        return $result;
    }


    public function update($id){
        $sql = "UPDATE patients SET owner_id = {$this->getOwnerId()}, name = '{$this->getName()}', animal = '{$this->getAnimal()}', breed = '{$this->getBreed()}', birth = '{$this->getBirth()}', gender = '{$this->getGender()}' WHERE id = {$id}";
        $query = $this->db->query($sql);

        $result = false;

        if ($query) {
            $result = true;
        }

        return $result;
    }

    public function patientsByOwner($id){
        $sql = "SELECT p.id, p.name, p.animal, p.breed, p.birth, p.gender FROM patients p JOIN owners o ON p.owner_id = o.id WHERE o.id = {$id};";
        $query = $this->db->query($sql);

        $result = false;

        if ($query) {
            $result = $query;
        }

        return $result;
    }

    public function addPatientByOwnerId(){
        $result = false;
        $sql = "INSERT INTO patients (owner_id,name,animal,breed,birth,gender) VALUES({$this->getOwnerId()}, '{$this->getName()}', '{$this->getAnimal()}', '{$this->getBreed()}', '{$this->getBirth()}', '{$this->getGender()}')";
        $query = $this->db->query($sql);

        if ($query) {
            $result = true;
        }

        return $result;
    }
}
