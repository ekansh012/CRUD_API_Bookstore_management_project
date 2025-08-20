// read.php

<?php
require_once 'config/db.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM books");
    $stmt->execute();
    $books = $stmt->fetchAll();

    if (empty($books)) {
        echo 'No books found!';
    } else {
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Title</th><th>Description</th><th>Author Name</th><th>Price</th></tr>';
        foreach ($books as $book) {
            echo '<tr>';
            echo '<td>' . $book['id'] . '</td>';
            echo '<td>' . $book['title'] . '</td>';
            echo '<td>' . $book['description'] . '</td>';
            echo '<td>' . $book['author_name'] . '</td>';
            echo '<td>' . $book['price'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
} catch (PDOException $e) {
    echo 'Error reading books: ' . $e->getMessage();
}