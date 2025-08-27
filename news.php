<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>All News</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>All News</h1>
<?php
$result = $conn->query("SELECT a.*, c.name AS category 
                        FROM articles a 
                        JOIN categories c ON a.category_id = c.id 
                        ORDER BY published_at DESC");
while ($row = $result->fetch_assoc()) {
    echo "<div class='card'>
            <h2>{$row['title']}</h2>
            <p><strong>Category:</strong> {$row['category']}</p>
            <img src='uploads/{$row['image']}' width='300'><br>
            <p>" . substr($row['content'], 0, 200) . "...</p>
          </div><hr>";
}
?>
</body>
</html>
