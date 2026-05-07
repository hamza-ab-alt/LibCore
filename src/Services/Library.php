<?php
require_once __DIR__."/../config/database.php";
require __DIR__."/../Entities/book.php";
require __DIR__."/../Entities/borrow.php";
class Library {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    public function findBook ($title,$auteur){
        $sql = "SELECT * FROM books WHERE title = ? AND author = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$title, $auteur]);
        $book = $stmt->fetch(PDO::FETCH_OBJ);
        if ($book) {
            return new Book($book->title, $book->auteur);
        } else {
            return null;
        }
    }
    public function addBook($book) {
       try {
         $sql = "INSERT INTO books (titre, auteur, isbn, is_available)
                VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $book->getTitle(),
            $book->getAuthor(),
            $book->getIsbn(),
            $book->getAvialable()
        ]);
        return "Book added successfully";
       } catch (PDOException $e) {
        return $e->getMessage();
       }
    }
    public function addMember($member) {
    }
    public function displayBooks() {
        $sql = "SELECT * FROM books";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        $books=[];
        foreach ($rows as $row) {
           $books[] = new Book(
            $row->titre,
            $row->auteur,
            $row->isbn,
            $row->is_available
        );
        }

        $text = " ";
        foreach ($books as $book) {
           $text.=$book."\n";
        }
        echo $text;
    }
    public function deleteBook($isbn) {
       try {
         $sql = "DELETE FROM books WHERE isbn =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$isbn]);
        echo "Book deleted successfully";
       } catch (PDOException $e) {
           echo $e->getMessage();
       }
    }
    public function addBorrowedBook($book,$borrowedBooks,$member,$dateApp,$dateRetour){
       $borrowedBooks[]=new Borrow($member,$book,$dateApp,$dateRetour);
       $book->setAvialable(false);
    }
    public function removeBorrowedBook($isbn,$borrowedBooks){
        foreach($borrowedBooks as $key=>$book){
            if($book->getIsbn()==$isbn){
                unset($borrowedBooks[$key]);
                $book->setAvialable(true);
                return true;
            }
        }
        return false;
    }
}