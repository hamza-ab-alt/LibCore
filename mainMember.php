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
    echo "\nBienvenue " . $user->getName() . "! Connecté b naja7.\n";
} else {
    exit("Erreur: Had l-email ma-kayench f la base de données.\n");
}
while (true) {
    echo "\n--- MENU MEMBRE ---\n";
    echo "1. Rechercher un livre (US5)\n";
    echo "2. Emprunter un livre (US6)\n";
    echo "3. Mes livres empruntés (US8)\n";
    echo "4. Rendre un livre (US7)\n";
    echo "5. Quitter\n";
    $choix = readline("Ekhtar chi haja (1-5): ");
    switch ($choix) {
        case "1":
            $library->displayBooks();
            $titre = readline("Dakhel smit l-ktab: ");
            $auteur = readline("Dakhel smit l-auteur: ");
            $book = $user->findBook($titre, $auteur);
            if ($book) {
                echo "Livre trouvé: " . $book->getTitle() . " (ISBN: " . $book->getIsbn() . ")\n";
            } else {
                echo "Désolé, ktab makayench aw déjà m-salaf.\n";
            }
            break;

        case "2":
            $library->displayBooks();
            $titre = readline("Smit l-ktab li bghiti t-tsellef: ");
            $auteur = readline("Smit l-auteur: ");
            $book = $user->findBook($titre, $auteur);
            if ($book) {
                echo $user->borrow($book) . "\n";
            } else {
                echo "Ktab non trouvé.\n";
            }
            break;

        case "3":
            echo $user->getBorrowedBooks();
            break;

        case "4":
            $isbn = readline("Dakhel l-ISBN dyal l-ktab li at-rje3: ");
            echo $user->returnBook($isbn) . "\n";
            break;

        case "5":
            exit("Bslama! À la prochaine.\n");

        default:
            echo "Choix invalide, 3awed khtar.\n";
            break;
    }
}