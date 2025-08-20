// create.php

<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author_name = $_POST['author_name'];
    $price = $_POST['price'];

    try {
        $stmt = $pdo->prepare("INSERT INTO books (title, description, author_name, price) VALUES (:title, :description, :author_name, :price)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':author_name', $author_name);
        $stmt->bindParam(':price', $price);
        $stmt->execute();

        echo 'Book created successfully!';
    } catch (PDOException $e) {
        echo 'Error creating book: ' . $e->getMessage();
    }
}

?>

<form action="" method="post">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title"><br><br>
    <label for="description">Description:</label>
    <textarea id="description" name="description"></textarea><br><br>
    <label for="author_name">Author Name:</label>
    <input type="text" id="author_name" name="author_name"><br><br>
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01"><br><br>
    <input type="submit" value="Create Book">
</form>