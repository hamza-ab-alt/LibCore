<?php
namespace LibeCore\entities;
class Membre extends User{
    private $type;
    private $borrowedBooks;
    private $library;
    public function __construct($id,$name,$email,$type,$library){
        parent::__construct($id,$name,$email);
        $this->type =$type;
        $this->library = $library;
        $this->borrowedBooks = [];
    }
    
    public function findBook ($title,$auteur){
        $this->library->findBook($title,$auteur);
    }
    public function getBorrowedBooks(){
        $text="";
        foreach ($this->borrowedBooks as $book) {
            $text.=$book."\n";
        }
      return $text;
    }
    public function addBorrowedBook($book,$this->borrowedBooks){
        $this->library->addBorrowedBook($book,$this->borrowedBooks);
    }
    public function removeBorrowedBook($isbn,$this->borrowedBooks){
        $this->library->removeBorrowedBook($isbn,$this->borrowedBooks);
        
    }


}
