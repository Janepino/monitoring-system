<?php
require_once 'config.php';

// If already logged in, redirect to dashboard
if(isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

// Handle login form submission
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();
    
    if($user) {
        // Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_role'] = $user['role'];
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - DMA Garage System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <h1>DMA AUTO GARAGE</h1>
        <h2>Monitoring System</h2>
        
        <?php if(isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            
            <button type="submit" name="login">Login</button>
        </form>
        
        <div class="register-link">
            Don't have an account? <a href="register.php">Register Here</a>
        </div>
    </div>
</body>
</html>
