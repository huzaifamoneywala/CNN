<?php include '../includes/db.php'; ?>
<?php include 'includes/admin_header.php'; ?>

<h1>Add New Category</h1>
<form method="POST" action="">
    <label>Category Name:</label><br>
    <input type="text" name="name" required><br><br>
    <input type="submit" name="submit" value="Add Category">
</form>

<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $sql = "INSERT INTO categories (name) VALUES ('$name')";
    if($conn->query($sql)){
        echo "<p>Category Added!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

</body>
</html>
