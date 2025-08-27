<?php include '../includes/db.php'; ?>
<?php include 'includes/admin_header.php'; ?>

<h1>Articles</h1>
<a href="add_article.php">+ Add New Article</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    <?php
    $sql = "SELECT articles.id, articles.title, categories.name AS category FROM articles 
            LEFT JOIN categories ON articles.category_id = categories.id";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['category']; ?></td>
        <td>
            <a href="edit_article.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete_article.php?id=<?php echo $row['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
