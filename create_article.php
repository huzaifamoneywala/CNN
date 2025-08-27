<?php
session_start();
include 'db.php';

// Only allow logged-in users
if (!isset($_SESSION['user'])) {
    echo "Login required. <a href='login.php'>Login</a>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $category_id = intval($_POST['category']);

    // Insert into database (no image column)
    $sql = "INSERT INTO articles (title, content, category_id) 
            VALUES ('$title', '$content', $category_id)";

    if ($conn->query($sql)) {
        echo "✅ Article posted. <a href='news.php'>View News</a>";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>

<h2>Create Article</h2>
<form method="post">
    Title: <input type="text" name="title" required><br><br>
    Content: <textarea name="content" rows="5" cols="50" required></textarea><br><br>
    Category:
    <select name="category" required>
        <?php
        $result = $conn->query("SELECT * FROM categories");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select><br><br>
    <button type="submit">Post Article</button>
</form>
