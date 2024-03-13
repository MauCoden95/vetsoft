<?php
    require_once 'Models/Veterinary.php';

    class VeterinaryController{
        public function index(){
            $veterinary = new Veterinary();
            $count = $veterinary->count();
            $veterinaries = $veterinary->list();

            $data['count'] = $count;
            $data['veterinaries'] = $veterinaries;

            require_once('Views/Veterinary/Index.php');
        }


        public function delete(){
            $veterinary = new Veterinary();

            if ($_GET) {
                $url = explode('/',$_GET['url']);               
                $id = $url[2];

                $delete = $veterinary->delete($id);

                if ($delete) {
                    header('Location: http://localhost/VetSoft/Veterinary/index');
                }
                
            }
        }


        public function edit(){
            $veterinary = new Veterinary();
            if ($_GET) {
                $url = explode('/',$_GET['url']);
                $id = $url[2];

                //$data['id'] = $id;

                $data = $veterinary->data($id);

                require_once('Views/Veterinary/Edit.php');   
            }
        }


        public function update(){
            $veterinary = new Veterinary();
            $url = explode('/',$_GET['url']);
            $id = $url[2];

            

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $address = isset($_POST['address']) ? $_POST['address'] : '';
                $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                $phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : '';
                $license = isset($_POST['license']) ? $_POST['license'] : '';
                
                if ($name == '' || $address == '' || $phone == '' || $phone2 == '' || $license == '') {
                    $_SESSION['update_vet'] = false;
                }else{
                    $veterinary->setName($name);
                    $veterinary->setAddress($address);
                    $veterinary->setPhone($phone);
                    $veterinary->setPhone2($phone2);
                    $veterinary->setLicense($license);
    
                    $update = $veterinary->update($id);
    
                    if ($update) {
                        $_SESSION['update_vet'] = true;
                    }else{
                        $_SESSION['update_vet'] = false;
                    }
                }

                
            }

            
            header("Location: http://localhost/VetSoft/Veterinary/edit/".$id);
            exit();
        }

    }




?>