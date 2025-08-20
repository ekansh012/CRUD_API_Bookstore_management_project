// update.php

<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    // update.php (continued)

    $description = $_POST['description'];
    $author_name = $_POST['author_name'];
    $price = $_POST['price'];

    try {
        $stmt = $pdo->prepare("UPDATE books SET title = :title, description = :description, author_name = :author_name, price = :price WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':author_name', $author_name);
        $stmt->bindParam(':price', $price);
        $stmt->execute();

        echo 'Book updated successfully!';
    } catch (PDOException $e) {
        echo 'Error updating book: ' . $e->getMessage();
    }
}

// Display the book details to be updated
try {
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $book = $stmt->fetch();

    if (empty($book)) {
        echo 'Book not found!';
    } else {
        ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $book['title']; ?>"><br><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $book['description']; ?></textarea><br><br>
            <label for="author_name">Author Name:</label>
            <input type="text" id="author_name" name="author_name" value="<?php echo $book['author_name']; ?>"><br><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $book['price']; ?>" step="0.01"><br><br>
            <input type="submit" value="Update Book">
        </form>
        <?php
    }
} catch (PDOException $e) {
    echo 'Error reading book: ' . $e->getMessage();
}