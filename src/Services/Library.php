<?php
class Library{
    private $books=[];
    private $membres=[];
    public function addBook($book){
         $this->$books[]=$book
    }
    public function addMembre($membre){
        $this->$membres[]=$membre;
    }
    public function displayBooks(){
        $text="";
        foreach ($books as $book) {
            $text.=" ".$book;
        }
        return $text;
    }
    public function deleteBook($bookD){
         foreach ($books as $key => $book) {
           if($book->getTitle()==$bookD->getTitle()){
            unset($this->$books[$key]);
            return "delete success"
           }
         }
         return "book doessnt exist";

    }  
}<?php
class Library{
    private $books=[];
    private $membres=[];
    public function addBook($book){
         $this->$books[]=$book
    }
    public function addMembre($membre){
        $this->$membres[]=$membre;
    }
    public function displayBooks(){
        $text="";
        foreach ($books as $book) {
            $text.=" ".$book;
        }
        return $text;
    }
    public function deleteBook($bookD){
         foreach ($books as $key => $book) {
           if($book->getTitle()==$bookD->getTitle()){
            unset($this->$books[$key]);
            return "delete success"
           }
         }
         return "book doessnt exist";

    }  
}