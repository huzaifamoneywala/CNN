<?php include '../includes/db.php'; ?>
<?php include 'includes/admin_header.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM articles WHERE id=$id";
$result = $conn->query($sql);
$article = $result->fetch_assoc();
?>

<h1>Edit Article</h1>
<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo $article['title']; ?>" required><br><br>
    
    <label>Content:</label><br>
    <textarea name="content" rows="10" cols="50" required><?php echo $article['content']; ?></textarea><br><br>
    
    <label>Thumbnail URL:</label><br>
    <input type="text" name="thumbnail" value="<?php echo $article['thumbnail']; ?>"><br><br>
    
    <label>Category:</label><br>
    <select name="category_id" required>
        <?php
        $catSql = "SELECT * FROM categories";
        $catResult = $conn->query($catSql);
        while($cat = $catResult->fetch_assoc()):
        ?>
        <option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $article['category_id']) echo 'selected'; ?>>
            <?php echo $cat['name']; ?>
        </option>
        <?php endwhile; ?>
    </select><br><br>
    
    <input type="submit" name="submit" value="Update Article">
</form>

<?php
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $thumbnail = $_POST['thumbnail'];
    $category_id = $_POST['category_id'];
    
    $updateSql = "UPDATE articles SET title='$title', content='$content', thumbnail='$thumbnail', category_id=$category_id 
                  WHERE id=$id";
    if($conn->query($updateSql)){
        echo "<p>Article Updated Successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

</body>
</html>
