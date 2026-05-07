<?php
require_once __DIR__."/../config/database.php";
require_once __DIR__."/../Entities/book.php";
require_once __DIR__."/../Entities/broow.php";
class Library {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
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
    public function addMembre($name,$prenom,$email,$role){
        try {
            $sql ="INSERT INTO users (nom,prenom,email,dateC) values(?,?,?,now())";
            $stm=$this->conn->prepare($sql);
            $stm->execute([$name,$prenom,$email]);
            $lastId=$this->conn->lastInsertId();
            if($role='S'){
                $sql="INSERT INTO membres (role_id,user_id) values (2,?)";
                $stm=$this->conn->prepare($sql);
                $stm->execute([$lastId]);
            }elseif ($role=="P") {
                $sql="INSERT INTO membres (role_id,user_id) values (1,?)";
                $stm=$this->conn->prepare($sql);
                $stm->execute([$lastId]);
            }
            echo "add with success";
            }catch (PDOException $e) {
            echo $e->getMessage();
             }
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
    public function findBook($title, $auteur) {
        $sql = "SELECT * FROM books WHERE titre = ? AND auteur = ? AND is_available = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$title, $auteur]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($data) {
            return new Book($data->titre, $data->auteur, $data->isbn, $data->is_available);
        }
        return null;
    }

    public function addBorrowedBook($book, $member) {
        try {
            $sql = "UPDATE books SET is_available = 0 WHERE isbn = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$book->getIsbn()]);
            return new Borrow($member, $book, date("Y-m-d"));
        } catch (\Exception $e) {
            return null;
        }
    }

    public function removeBorrowedBook($isbn) {
        try {
            $sql = "UPDATE books SET is_available = 1 WHERE isbn = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$isbn]);
        } catch (\Exception $e) {
            return false;
        }
    }
}