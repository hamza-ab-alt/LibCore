<?php
require_once "user.php";
require_once __DIR__ . "/../Services/Library.php";
class Librarian extends User {

    private $Library;

    public function __construct($name,$email,$library) {
        parent::__counstructor($name,$email);
        $this->Library = $library;
    }
    
    public function addBook($book) {
        $this->Library->addBook($book);
    }

    public function createMembre($membre) {
        $this->Library->addMembre($membre);
    }

    public function displayBooks() {
        $this->Library->displayBooks();
    }

    public function deleteBook($bookD) {
        $this->Library->deleteBook($bookD);
    }

    public function __toString() {
        return parent::__toString()." Librarian";
    }
}