<?php

require_once 'Config/Database.php';

class Patient
{
    private $owner_id;
    private $name;
    private $animal;
    private $breed;
    private $birth;

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




    //Metodos
    public function count(){
        $sql = "SELECT count(*) AS cantidad_de_registros FROM patients";
        $query = $this->db->query($sql);

        $count = $query->fetch_object();

        return $count;       
    }

}
