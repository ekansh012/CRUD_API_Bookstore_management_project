// index.php

<?php
require_once 'config/db.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM books");
    $stmt->execute();
    $books = $stmt->fetchAll();

    if (empty($books)) {
        echo 'No books found!';
    } else {
        echo '<h1>Book List</h1>';
        echo '<p><a href="create.php">Create a new book</a></p>';
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Title</th><th>Description</th><th>Author Name</th><th>Price</th><th>Actions</th></tr>';
        foreach ($books as $book) {
            echo '<tr>';
            echo '<td>' . $book['id'] . '</td>';
            echo '<td>' . $book['title'] . '</td>';
            echo '<td>' . $book['description'] . '</td>';
            echo '<td>' . $book['author_name'] . '</td>';
            echo '<td>' . $book['price'] . '</td>';
            echo '<td>';
            echo '<a href="update.php?id=' . $book['id'] . '">Update</a> | ';
            echo '<a href="delete.php?id=' . $book['id'] . '">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
} catch (PDOException $e) {
    echo 'Error reading books: ' . $e->getMessage();
}