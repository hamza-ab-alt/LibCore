<?php
require "user.php";
require "../Services/Library.php";
class Librarian extends User{
     private $Library;
     public addBook($book){
          $this-$Library->addBook($book);
     }
     public creeMembre($membre){
         $this-$Library->addMembre($membre);
     }
     public displaybooks(){
          $this-$Library->displayBooks();
     }
     public deleteBook($bookD){
          $this-$Library->deleteBook($bookD);
     }
     public function __toString(){
          return parent::__toString;
     }
}