<?php
class User{
    private $name;
    private $prenom;
    private $email;
    private $id;
    function __construct($name,$prenom,$email){
             $this->name=$name;
             $this->email=$email;
             $this->prenom=$prenom;
    }
    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }   
    public function __toString(){
        return $this->prenom." ".$this->name." ".$this->email;
    }
    public function getName(){
        return $this->name;
    }
}