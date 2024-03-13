<?php

require_once 'Config/Database.php';

class Veterinary {
    private $id;
    private $name;
    private $address;
    private $phone;
    private $phone2;
    private $license;

    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPhone2() {
        return $this->phone2;
    }

    public function getLicense() {
        return $this->license;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setPhone2($phone2) {
        $this->phone2 = $phone2;
    }

    public function setLicense($license) {
        $this->license = $license;
    }





    //METODOS
    public function count(){
        $sql = "SELECT COUNT(*) AS cantidad_de_registros FROM veterinaries;";
        $query = $this->db->query($sql);

        $count = $query->fetch_object();

        return $count;
    }


    public function list(){
        $sql = "SELECT * FROM veterinaries;";
        $veterinaries = $this->db->query($sql);

     

        return $veterinaries;
    }


    public function delete($id){
        $sql = "DELETE FROM veterinaries WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
    
        $result = $stmt->execute();
        
        return $result;
    }

    public function data($id){
        $sql = "SELECT * FROM veterinaries WHERE id = {$id}";

        $query = $this->db->query($sql);
        $result = $query->fetch_object();
       
        
        return $result;
    }


    public function update($id){
        $sql = "UPDATE veterinaries SET name = '{$this->getName()}', address = '{$this->getAddress()}', phone = {$this->getPhone()}, phone2 = {$this->getPhone2()}, license = {$this->getLicense()} WHERE id = {$id}";
        $query = $this->db->query($sql);

        $result = false;

        if ($query) {
            $result = true;
        }

        return $result;
    }
}


?>