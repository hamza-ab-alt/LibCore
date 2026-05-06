<?php
namespace LibeCore\entities;
class Membre extends User{
    private $type;
    private $borrowedBooks = [];
public function __construct($id,$name,$email,$type){
    parent::__construct($id,$name,$email);
    $this->type =$type;
}
public function getBorrowedBooks(){
    return $this->borrowedBooks;
}



}
