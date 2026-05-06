<?php
require_once "src/Entities/book.php";
require_once "src/Entities/librarian.php";
require_once "src/Entities/user.php";
require_once "src/Services/Library.php";
$library1=new Library();
$librarian=new Librarian("salah","salahtabit12@gmail.com",$library1);
echo $librarian;
// $book=new Book("www","salah","98958-hjh-6777",true);
// $librarian->addBook($book);
// $librarian->displayBooks();
// $librarian->deleteBook("98958-hjh-6777");

while (true) {
    echo("############Welcome In our Programme ################");
    echo("1:Display Books");
    echo("2:add Book");
    echo("3:delete Book");
    echo("4:add Membre");
    echo ("0:exist");
    // echo("1:Display Books");
    $answer=readLine();
    switch ($answer) {
        case 1:
           $librarian->displayBooks();
            break;
        case 2:
            echo ("write the name of the book\n");
            $nameB=readLine();
            echo ("write the name of auther of  the book\n");
            $nameA=readLine();
            echo ("write the isbn of  the book\n");
            $isbn=readLine();
            echo ("write 1 if available and 0 if is inavialable of the book\n");
            $avai=readLine();
            if($avai==1){
              $book=new Book($nameB,$nameA,$isbn,true);
              $librarian->addBook($book);
            }elseif($avai==0){
              $book=new Book($nameB,$nameA,$isbn,false);
              $librarian->addBook($book);
            }else{
                echo "you should chose beetween 0 and 1\n";
            }
            break;
        case 0:
           echo("see you later");
            exit;
        case 4:
            # code...
            break;
        
        default:
            echo("number doesnt exist in the menu\n");
    }
}