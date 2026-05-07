<?php
class Membre extends User {
    private $type;
    private $borrowedBooks = []; 
    private $library;

    public function __construct( $name, $email, $type, $library) {
        parent::__construct($name,$email);
        $this->type = $type;
        $this->library = $library;
    }
    public function getName() {
        return $this->name;
    }
    public function findBook($title, $auteur) {
        return $this->library->findBook($title, $auteur);
    }

    public function getBorrowedBooks() {
        if (empty($this->borrowedBooks)) return "Aucun livre emprunté.\n";
        $text = "Mes Emprunts:\n";
        foreach ($this->borrowedBooks as $borrow) {
            $text .= $borrow . "\n";
        }
        return $text;
    }
    public function borrow($book) {
        $newBorrow = $this->library->addBorrowedBook($book, $this);
        if ($newBorrow) {
            $this->borrowedBooks[] = $newBorrow;
            return "Emprunt réussi!";
        }
        return "Livre indisponible.";
    }

    public function returnBook($isbn) {
        foreach ($this->borrowedBooks as $key => $borrow) {
            if ($borrow->getBook()->getIsbn() === $isbn) {
                if ($this->library->removeBorrowedBook($isbn)) {
                    unset($this->borrowedBooks[$key]);
                    return "Livre retourné.";
                }
            }
        }
        return "Livre non trouvé dans votre liste.";
    }
}