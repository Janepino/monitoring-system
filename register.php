<?php
require_once 'config.php';

// Handle registration form submission
if(isset($_POST['register'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    
    // Check if passwords match
    if($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if($stmt->fetch()) {
            $error = "Username already exists!";
        } else {
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (full_name, username, email, contact, age, gender, address, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$full_name, $username, $email, $contact, $age, $gender, $address, $password, $role]);
            
            $success = "Registration successful! You can now login.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - DMA Garage System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <div class="register-container">
        <h1>Register Account</h1>
        
        <?php if(isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if(isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="full_name" required>
            </div>
            
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            
            <div class="form-group">
                <label>Email Address:</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label>Contact Number:</label>
                <input type="text" name="contact" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Age:</label>
                    <input type="number" name="age" required>
                </div>
                
                <div class="form-group">
                    <label>Gender:</label>
                    <select name="gender" required>
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label>Address / Location:</label>
                <textarea name="address" rows="3" required></textarea>
            </div>
            
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" required>
            </div>
            
            <div class="form-group">
                <label>Role:</label>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                    <option value="Mechanic">Mechanic</option>
                </select>
            </div>
            
            <button type="submit" name="register">Register</button>
        </form>
        
        <div class="register-link">
            Already have an account? <a href="login.php">Login Here</a>
        </div>
    </div>
</body>
</html>
