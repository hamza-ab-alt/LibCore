<?php
class User{
    private $name;
    private $email;
    function __counstructor($name,$email){
             $this->name=$name;
             $this->email=$email;
    }
    public function __toString(){
        return $this->name." ".$this->email;
    }
}