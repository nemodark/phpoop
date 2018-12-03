<?php
require("User.php");

class Profile extends User{
    
    public function test(){
        return $this->servername;
    }
}