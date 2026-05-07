<?php
class User{
    private $name;
    private $email;
    function __construct($name,$email){
             $this->name=$name;
             $this->email=$email;
    }
    public function __toString(){
        return $this->name." ".$this->email;
    }
    public function getName(){
        return $this->name;
    }
}