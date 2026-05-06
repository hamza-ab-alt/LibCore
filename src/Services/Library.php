<?php
require "../config/database.php";
class Library {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    public function addBook($book) {
        $sql = "INSERT INTO books (title, author, isbn, is_available)
                VALUES (?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $book->getTitle(),
            $book->getAuthor(),
            $book->getIsbn(),
            $book->getAvialable()
        ]);
        return "Book added successfully";
    }
    public function addMember($member) {
    }
    public function displayBooks() {
        $sql = "SELECT * FROM books";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_OBJ);
        $text = "";
        foreach ($books as $book) {
            $text .=$book;
        }
        return $text;
    }
    public function deleteBook($isbn) {
        $sql = "DELETE FROM books WHERE isbn =?";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$isbn]);

        return "Book deleted successfully";
    }

}