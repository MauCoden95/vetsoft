<?php

require_once 'Config/Database.php';

class User{
    private $id;
    private $role_id;
    private $name;
    private $phone;
    private $mail;
    private $password;

    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }



    // Getters
    public function getId() {
        return $this->id;
    }

    public function getRoleId() {
        return $this->role_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getPassword() {
        return $this->password;
    }

    

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setRoleId($role_id) {
        $this->role_id = $role_id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
    }



    //Metodos
   public function register() {
        $sql = "INSERT INTO users (role_id, name, phone, mail, password) 
                VALUES ({$this->getRoleId()}, '{$this->getName()}', {$this->getPhone()}, '{$this->getMail()}', '{$this->getPassword()}')";

        $query = $this->db->query($sql);

        $result = false;

        if ($query) {
            $result = true;
        }

        return $result;
    }



    public function login($mail,$password){
        $sql = "SELECT users.*, roles.role AS user_type FROM users INNER JOIN roles ON users.role_id = roles.id WHERE mail = '$mail'";
        $query = $this->db->query($sql);

        $result = false;

        if ($query && $query->num_rows == 1) {
            $user = $query->fetch_object();

            $verify = password_verify($password,$user->password);

            if ($verify) {
                $result = $user;
            }

        }

        return $result;
    }


    public function changePassword($id){
        $sql = "UPDATE users SET password = '{$this->getPassword()}' WHERE id = {$id}";
        $update = $this->db->query($sql);
        

        $result = false;

        if ($update) {
            $result = true;
        }

        
        return $result;
    }

    public function count(){
        $sql = "SELECT count(*) AS cantidad_de_registros FROM users";
        $query = $this->db->query($sql);

        $count = $query->fetch_object();

        return $count;       
    }

    public function list(){
        $sql = "SELECT u.id AS id , u.role_id, u.name AS name, r.role, u.mail AS email
        FROM users u
        JOIN roles r ON u.role_id = r.id;
        ";
        $query = $this->db->query($sql);

        if ($query) {
            $result = $query;
        }

        return $result;
    }

    public function delete($id){
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
    
        $result = $stmt->execute();
        
        return $result;
    }

    
    public function save(){
        $sql = "INSERT INTO users (role_id,name,mail,password) VALUES({$this->getRoleId()},'{$this->getName()}','{$this->getMail()}','{$this->getPassword()}')";

        
        $save = $this->db->query($sql);
        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function data($id){
        $sql = "SELECT users.id AS id, roles.id As role_id, roles.role AS role_name, users.name AS name, users.mail AS mail
        FROM users
        JOIN roles ON users.role_id = roles.id
        WHERE users.id = {$id};";
        $query = $this->db->query($sql);

        if ($query) {
            $result = $query->fetch_object();
        }

        return $result;
    }

    public function update($id){
        $sql = "UPDATE users SET role_id = {$this->getRoleId()}, name = '{$this->getName()}', mail = '{$this->getMail()}' WHERE id = {$id}";
        
        $query = $this->db->query($sql);

        $result = false;

        if ($query) {
            $result = true;
        }

        return $result;
    }
}



?>