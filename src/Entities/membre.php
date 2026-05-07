<?php

namespace LibeCore\Entities;

class Membre extends User {

    private $type;
    private $borrowedBooks;
    private $library;

    public function __construct($id, $name, $email, $type, $library) {

        parent::__construct($id, $name, $email);

        $this->type = $type;
        $this->library = $library;
        $this->borrowedBooks = [];
    }

    public function getType() {
        return $this->type;
    }

    public function getBorrowedBooks() {

        $text = "";

        foreach ($this->borrowedBooks as $book) {
            $text .= $book . "\n";
        }

        return $text;
    }

    public function findBook($title, $author) {

        return $this->library->findBook($title, $author);
    }

    public function addBorrowedBook($book, $dateApp, $dateRetour) {

        $this->library->addBorrowedBook(
            $book,
            $this,
            $dateApp,
            $dateRetour
        );
    }

    public function removeBorrowedBook($isbn) {

        $this->library->removeBorrowedBook(
            $isbn,
            $this
        );
    }
}