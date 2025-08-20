// delete.php

<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo 'Book deleted successfully!';
    } catch (PDOException $e) {
        echo 'Error deleting book: ' . $e->getMessage();
    }
}

// Display the book details to be deleted
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
            <p>Are you sure you want to delete the book "<?php echo $book['title']; ?>"?</p>
            <input type="submit" value="Delete Book">
        </form>
        <?php
    }
} catch (PDOException $e) {
    echo 'Error reading book: ' . $e->getMessage();
}