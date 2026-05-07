<?php
class Borrow{
    private $membre;
    private $book;
    private $borrowDate;
    private $returnDate;

    public function __construct( $membre, $book, $borrowDate, $returnDate){
        $this->membre = $membre;
        $this->book = $book;
        $this->borrowDate = $borrowDate;
        $this->returnDate = $returnDate;
    }

    public function getMembre(){
        return $this->membre;
    }

    public function getBook(){
        return $this->book;
    }

    public function getBorrowDate(){
        return $this->borrowDate;
    }

    public function getReturnDate(){
        return $this->returnDate;
    }
}