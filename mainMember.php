<?php
require_once __DIR__ . '/src/config/database.php';
require_once __DIR__ . '/src/Entities/User.php';
require_once __DIR__ . '/src/Entities/Book.php';
require_once __DIR__ . '/src/Entities/Membre.php';
require_once __DIR__ . '/src/Entities/broow.php';
require_once __DIR__ . '/src/Services/Library.php';

$db = (new Database())->getConnection();
$library = new Library();
$user = new Membre("Ahmed", "ahmed@email.com", "Étudiant", $library);
echo "Bienvenue " . $user->getName() . " f LibCore CLI\n";
while (true) {
    echo "\n--- MENU MEMBRE ---\n";
    echo "1. Rechercher un livre (US5)\n";
    echo "2. Emprunter un livre (US6)\n";
    echo "3. Mes livres empruntés (US8)\n";
    echo "4. Rendre un livre (US7)\n";
    echo "5. Quitter\n";
    $choix = readline("enter your choice (1-5): ");
    switch ($choix) {
        case "1":
            $titre = readline("enter the book title: ");
            $auteur = readline("enter the auteur name: ");
            $book = $user->findBook($titre, $auteur);
            if ($book) {
                echo "Livre trouvé: " . $book->getTitle() . " (ISBN: " . $book->getIsbn() . ")\n";
            } else {
                echo "sorry, book not found.\n";
            }
            break;

        case "2":
            $titre = readline("enter the book title what you want to borrow: ");
            $auteur = readline("enter the auteur name: ");
            $book = $user->findBook($titre, $auteur);
            
            if ($book) {
                echo $user->borrow($book) . "\n";
            } else {
                echo "sorry, book not found.\n";
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
            exit("goodbye , another time.\n");

        default:
            echo "choice invalid, tray another choice.\n";
            break;
    }
}