<?php
class Book{
    public $title;
    public $auteur;
    public $isbn;
    public $isAvialable;
    function __construct($title,$auteur,$isbn,$isAvialable){
        $this->title=$title;
        $this->auteur=$auteur;
        $this->isbn=$isbn;
        $this->isAvialable=$isAvialable;
    }
    public function getTitle(){
       return $this->title;
    }
    public function getAuthor(){
       return $this->auteur;
    }
    public function getIsbn(){
       return $this->isbn;
    }
    public function getAvialable(){
       return $this->isAvialable;
    }
    public function __toString(){
        return $this->title." ".$this->auteur." ".$this->isbn." Avialable".$this->isAvialable;
    }
}
