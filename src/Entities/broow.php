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

    public function getBook() {
        return $this->book;
    }

    public function getReturnDate() {
        return $this->returnDate;
    }

    public function returnBook() {
        $this->returnDate = date("Y-m-d");
        $this->book->setAvailable(true);
    }

    public function __toString() {

        $return = $this->returnDate ?? "Non retourné";

        return "Membre : " . $this->member->getName() .
               " | Livre : " . $this->book->getTitle() .
               " | Date emprunt : " . $this->borrowDate .
               " | Date retour : " . $return;
    }
}