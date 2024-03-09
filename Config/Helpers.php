<?php 

    function isLogged($user){
        if(isset($user)){
            return true;
        }else{
            return false;
        }
    }

?>