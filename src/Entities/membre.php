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
public function addBorrowedBook($book){
    $this->borrowedBooks[]=$book;
}
public function removeBorrowedBook($isbn){
    foreach($this->borrowedBooks as $key=>$book){
        if($book->getIsbn()==$isbn){
            unset($this->borrowedBooks[$key]);
            return true;
        }
    }
    return false;
}
public function getType(){
    return $this->type;
}
}
