<?php

require_once 'Config/Database.php';

class Owner
{
    private $id;
    private $name;
    private $dni;
    private $phone;
    private $phone2;
    private $mail;
    private $address;

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getPhone2()
    {
        return $this->phone2;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getAddress()
    {
        return $this->address;
    }




    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }



    //METODOS
    public function count(){
        $sql = "SELECT COUNT(*) AS cantidad_de_registros FROM owners;";
        $query = $this->db->query($sql);

        $count = $query->fetch_object();

        return $count;
    }

    public function list(){
        $sql = "SELECT * FROM owners;";
        $veterinaries = $this->db->query($sql);

     

        return $veterinaries;
    }

    public function delete($id){
        $sql = "DELETE FROM owners WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
    
        $result = $stmt->execute();
        
        return $result;
    }

    public function save(){
        $sql = "INSERT INTO owners (name,dni,phone,phone2,mail,address) VALUES('{$this->getName()}', '{$this->getDni()}', '{$this->getPhone()}', '{$this->getPhone2()}', '{$this->getMail()}', '{$this->getAddress()}')";
        $save = $this->db->query($sql);
        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function data($id){
        $sql = "SELECT * FROM owners WHERE id = {$id}";

       
        $query = $this->db->query($sql);
        
       
        
        return $query;
    }

    public function update($id){
        $sql = "UPDATE owners SET name = '{$this->getName()}', dni = '{$this->getDni()}', phone = {$this->getPhone()}, phone2 = {$this->getPhone2()}, mail = '{$this->getMail()}', address = '{$this->getAddress()}' WHERE id = {$id}";
        $query = $this->db->query($sql);

        $result = false;

        if ($query) {
            $result = true;
        }

        return $result;
    }
}
