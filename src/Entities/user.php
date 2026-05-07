<?php
class User{
    private $name;
    private $prenom;
    private $email;
    function __construct($name,$prenom,$email){
             $this->name=$name;
             $this->email=$email;
             $this->prenom=$prenom;
    }
    public function __toString(){
        return $this->prenom." ".$this->name." ".$this->email;
    }
    public function getName(){
        return $this->name;
    }
}