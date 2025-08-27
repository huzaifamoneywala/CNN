<?php include '../includes/db.php'; ?>
<?php include 'includes/admin_header.php'; ?>

<h1>Categories</h1>
<a href="add_category.php">+ Add New Category</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    <?php
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td>
            <a href="delete_category.php?id=<?php echo $row['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
