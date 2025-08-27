<?php
// Start session before any output
session_start();

// Include database connection
include 'db.php';

// Show errors (optional for debugging; remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($username) || empty($password)) {
        echo "⚠️ Please fill in both fields.";
        exit;
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "⚠️ Username already taken. <a href='signup.php'>Try again</a>";
        exit;
    }
    $stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "✅ Signup successful! <a href='login.php'>Login here</a>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!-- HTML Signup Form -->
<h2>Signup</h2>
<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Signup</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>

