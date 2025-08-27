<?php
include 'db.php';
session_start();
 
// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    echo "Login required. <a href='login.php'>Login</a>";
    exit();
}
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $category_id = intval($_POST['category']);
 
    // Handle uploaded image
    $upload_dir = "uploads/";
    $original_filename = basename($_FILES["image"]["name"]);
    $unique_filename = time() . "_" . $original_filename;
    $target_file = $upload_dir . $unique_filename;
 
    // Validate file type
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $file_ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
 
    if (!in_array($file_ext, $allowed)) {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        exit();
    }
 
    // Upload the file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Save article in DB
        $sql = "INSERT INTO articles (title, content, image, category_id) 
                VALUES ('$title', '$content', '$unique_filename', $category_id)";
 
        if ($conn->query($sql)) {
            echo "✅ Article posted successfully. <a href='news.php'>View News</a>";
        } else {
            echo "❌ DB Error: " . $conn->error;
        }
    } else {
        echo "❌ Failed to upload image.";
    }
}
?>
 
<!-- HTML FORM -->
<h2>Create Article</h2>
<form method="post" enctype="multipart/form-data">
    Title: <input type="text" name="title" required><br><br>
    Content: <textarea name="content" rows="6" cols="50" required></textarea><br><br>
 
    Category:
    <select name="category" required>
        <?php
        $result = $conn->query("SELECT * FROM categories");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select><br><br>
 
    <!-- ✅ Choose File instead of URL -->
    Upload Image: <input type="file" name="image" accept="image/*" required><br><br>
 
    <button type="submit">Post Article</button>
</form> 
