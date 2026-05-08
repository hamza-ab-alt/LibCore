<?php
require_once __DIR__."/../config/database.php";
require_once __DIR__."/../Entities/book.php";
require_once __DIR__."/../Entities/broow.php";

use LibCore\Entities\Borrow;

class Library {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function findBook($title, $auteur) {
    $sql = "SELECT * FROM books WHERE titre = ? AND auteur = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$title, $auteur]);
    $data = $stmt->fetch(PDO::FETCH_OBJ);
    
    if ($data) {
        return new Book($data->titre, $data->auteur, $data->isbn, $data->is_available);
    }
    return null;
}

    public function addBorrowedBook($book, $member, $daysToKeep = 14) {
        try {
            $this->conn->beginTransaction(); // Start transaction

            $borrowDate = date("Y-m-d");
            $returnDate = date("Y-m-d", strtotime("+$daysToKeep days"));

            // 1. Update ktab
            $sql1 = "UPDATE books SET is_available = 0 WHERE isbn = ?";
            $stmt1 = $this->conn->prepare($sql1);
            $stmt1->execute([$book->getIsbn()]);

            // 2. Get ID dyal l-ktab mn la base
            $sql3 = "SELECT id FROM books WHERE isbn = ?";
            $stmt3 = $this->conn->prepare($sql3);
            $stmt3->execute([$book->getIsbn()]);
            $bookData = $stmt3->fetch(PDO::FETCH_OBJ);

            if ($bookData) {
                // 3. Insert f table borrowings
                $sql2 = "INSERT INTO borrowings (membre_id, book_id, borrowat, returnat) 
                        VALUES (?, ?, ?, ?)";
                $stmt2 = $this->conn->prepare($sql2);
                $stmt2->execute([
                    $member->getId(), 
                    $bookData->id, 
                    $borrowDate, 
                    $returnDate
                ]);

                $this->conn->commit();
                echo "L-ktab t-borrowa b naja7! Khass yrje3 f: " . $returnDate . "\n";
                return new Borrow($member, $book, $borrowDate, $returnDate);
            } else {
                $this->conn->rollBack();
                return null;
            }
        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) $this->conn->rollBack();
            echo "Erreur: " . $e->getMessage();
            return null;
        }
    }

    public function removeBorrowedBook($isbn) {
        try {
            $sql = "UPDATE books SET is_available = 1 WHERE isbn = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$isbn]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function displayBooks() {
        $sql = "SELECT * FROM books";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($rows as $row) {
            $status = $row->is_available ? "[Disponible]" : "[Emprunté]";
            echo "{$row->titre} - {$row->auteur} (ISBN: {$row->isbn}) $status\n";
        }
    }
}