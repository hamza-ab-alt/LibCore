<?php
class Book{
    public $title;
    public $auteur;
    public $isnd;
    public $isAvialable;
    function __counstructor($isnd,$title,$isAvialable,$auteur){
             $this->isnd=$isnd;
             $this->title=$title;
             $this->isAvialable=$isAvialable;
             $this->auteur=$auteur;
    }
    public function getTitle(){
       return $this->$title;
    }
    public function __toString(){
        return $this->$title." ".$this->$auteur." ".$this->$isnd." ".$this->$isAvialable;
    }
}
