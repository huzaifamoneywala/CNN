<?php
include '../includes/db.php';
$id = $_GET['id'];
$sql = "DELETE FROM articles WHERE id=$id";
if($conn->query($sql)){
    header("Location: articles.php");
} else {
    echo "Error deleting article";
}
?>
