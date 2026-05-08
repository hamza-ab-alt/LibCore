<?php
require_once __DIR__ . '/src/config/database.php';
require_once __DIR__ . '/src/Entities/User.php';
require_once __DIR__ . '/src/Entities/Book.php';
require_once __DIR__ . '/src/Entities/Membre.php';
require_once __DIR__ . '/src/Entities/broow.php';
require_once __DIR__ . '/src/Services/Library.php';
$db=new Database();
$library=new Library();
echo "--- LOGIN LIBCORE ---\n";
$email = readline("Dakhel l-email dyalk: ");
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $db->getConnection()->prepare($sql);
$stmt->execute([$email]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
if ($userData) {
    $user = new Membre(
        $userData['nom'], 
        $userData['prenom'], 
        $userData['email'], 
        $userData['type'], 
        $library
    );
    $user->setId($userData['id']); 
    echo "\n welcome " . $user->getName() . "! connected.\n";
} else {
    exit("Error: Email not found in the database.\n");
}
while (true) {
    echo "\n--- MENU MEMBRE ---\n";
    echo "1. Rechercher un livre \n";
    echo "2. Emprunter un livre \n";
    echo "3. Mes livres empruntés \n";
    echo "4. Rendre un livre \n";
    echo "5. Quitter\n";
    $choix = readline("enter a choice (1-5): ");
    switch ($choix) {
        case "1":
            $library->displayBooks();
            $titre = readline("enter the book title: ");
            $auteur = readline("enter the author name: ");
            $book = $user->findBook($titre, $auteur);
            if ($book) {
                echo "Livre trouvé: " . $book->getTitle() . " (ISBN: " . $book->getIsbn() . ")\n";
            } else {
                echo "sorry, the book wad not fount already borrowed.\n";
            }
            break;

        case "2":
            $library->displayBooks();
            $titre = readline("title the book what do want to borrow: ");
            $auteur = readline("enter the author name: ");
            $book = $user->findBook($titre, $auteur);
            if ($book) {
                echo $user->borrow($book) . "\n";
            } else {
                echo "book not found.\n";
            }
            break;

        case "3":
            echo $user->getBorrowedBooks();
            break;

        case "4":
            $isbn = readline("enter the ISBN of the book you want to return: ");
            echo $user->returnBook($isbn) . "\n";
            break;

        case "5":
            exit("goodbye,another time.\n");

        default:
            echo "choice invalid ,try enter another choice.\n";
            break;
    }
}