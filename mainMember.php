<?php
require_once __DIR__ . '/src/config/database.php';
require_once __DIR__ . '/src/Entities/User.php';
require_once __DIR__ . '/src/Entities/Book.php';
require_once __DIR__ . '/src/Entities/Membre.php';
require_once __DIR__ . '/src/Entities/broow.php';
require_once __DIR__ . '/src/Services/Library.php';

$db = new Database();
$library = new Library();

echo "--- LOGIN LIBCORE ---\n";
$email = readline("Dakhel l-email dyalk: ");

// 1. Login Logic
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $db->getConnection()->prepare($sql);
$stmt->execute([$email]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userData) {
    // Cree l-objet Membre u setId mn la base
    $user = new Membre($userData['nom'], $userData['prenom'], $userData['email'], "Membre", $library);
    $user->setId($userData['id']); 
    echo "\nBienvenue " . $user->getName() . "! Connecté b naja7.\n";
} else {
    exit("Erreur: Had l-email ma-kayench f la base de données.\n");
}

while (true) {
    echo "\n--- MENU MEMBRE ---\n";
    echo "1. Rechercher un livre\n";
    echo "2. Emprunter un livre\n";
    echo "3. Mes livres empruntés\n";
    echo "4. Rendre un livre\n";
    echo "5. Quitter\n";
    
    $choix = readline("Ekhtar (1-5): ");
    
    switch ($choix) {
        case "1":
            $library->displayBooks();
            $titre = readline("Titre: ");
            $auteur = readline("Auteur: ");
            $book = $user->findBook($titre, $auteur);
            if ($book) echo "Trouvé: " . $book->getTitle() . "\n";
            else echo "Makayench.\n";
            break;

     case "2":
    $library->displayBooks();
    $titre = readline("Titre: ");
    $auteur = readline("Auteur: ");
    $book = $user->findBook($titre, $auteur);

    if ($book) {
        if ($book->getAvialable() == 1) { 
            echo $user->borrow($book) . "\n";
        } else {
            echo "Désolé, had l-ktab déjà m-sellef (Emprunté).\n";
        }
    } else {
        echo "Ktab non trouvé f l-catalogue.\n";
    }
    break;

        case "3":
            echo $user->getBorrowedBooks();
            break;

        case "4":
            $isbn = readline("ISBN: ");
            echo $user->returnBook($isbn) . "\n";
            break;

        case "5":
            exit("Bslama!\n");
    }
}