<?php
class Borrow {
    private $member;
    private $book;
    private $borrowDate;
    private $returnDate;

    public function __construct($member, $book, $borrowDate, $returnDate = null) {
        $this->member = $member;
        $this->book = $book;
        $this->borrowDate = $borrowDate;
        $this->returnDate = $returnDate;
    }

    public function getBook() { return $this->book; }
    
    public function returnBook() {
        $this->returnDate = date("Y-m-d");
        $this->book->setAvailable(true);
    }

    public function __toString() {
        $status = $this->returnDate ?? "Non retourné";
        return "Livre: " . $this->book->getTitle() . " | Emprunté le: " . $this->borrowDate . " | Retour: " . $status;
    }
}