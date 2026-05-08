<?php
require_once "user.php";
class Membre extends User {
    private $type;
    private $borrowedBooks;
    private $library;
    public function __construct($name, $prenom, $email, $type, $library) {
        parent::__construct($name, $prenom, $email);
        $this->type = $type;
        $this->library = $library;
        $this->borrowedBooks = [];
    }
        public function getType() {
        return $this->type;
    }
    public function getBorrowedBooks() {
        if (empty($this->borrowedBooks)) {
            return "Ma-3ndek hta ktab m-sellef dba.\n";
        }
        $text = "--- Vos livres empruntés ---\n";
        foreach ($this->borrowedBooks as $book) {
            $text .= $book . "\n";
        }
        return $text;
    }
    public function findBook($title, $author) {
        return $this->library->findBook($title, $author);
    }
    public function borrow($book) {
        $success = $this->library->addBorrowedBook($book, $this);
        if ($success) {
            $this->borrowedBooks[] = $book;
            return "Succès: '" . $book->getTitle() . "' t-borrowa b naja7!";
        }
        return "Erreur: Ma-qdernach n-kemlo l-opération f la base de données.";
    }
    public function returnBook($isbn) {
        $success = $this->library->removeBorrowedBook($isbn);   
        if ($success) {
            foreach ($this->borrowedBooks as $key => $book) {
                if ($book->getIsbn() == $isbn) {
                    unset($this->borrowedBooks[$key]);
                    return "Ktab (ISBN: $isbn) rje3 l-maktaba, chokran!";
                }
            }
            return "Ktab t-updata f la base, walakin ma-lqinahch f la liste dyalk.";
        }
        return "Erreur: Had l-ktab ma-lqinahch aw kayn mouchkil f l-update.";
    }
    public function addBorrowedBook($book, $dateApp, $dateRetour) {
        $this->library->addBorrowedBook($book, $this, $dateApp, $dateRetour);
    }
}