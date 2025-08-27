<?php
include '../includes/db.php';
$id = $_GET['id'];
$sql = "DELETE FROM categories WHERE id=$id";
if($conn->query($sql)){
    header("Location: categories.php");
} else {
    echo "Error deleting category";
}
?>
