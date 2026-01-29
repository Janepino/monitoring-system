<?php
require_once 'config.php';
checkLogin();

// Get all mechanics from users table
$mechanics = $conn->query("SELECT * FROM users WHERE role='Mechanic'")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mechanics - DMA Garage System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container">
        <h1>Mechanic Management</h1>
        
        <div class="table-box">
            <h2>Mechanic List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($mechanics) > 0): ?>
                        <?php foreach($mechanics as $mechanic): ?>
                        <tr>
                            <td><?php echo $mechanic['id']; ?></td>
                            <td><?php echo $mechanic['full_name']; ?></td>
                            <td><?php echo $mechanic['username']; ?></td>
                            <td><?php echo $mechanic['email']; ?></td>
                            <td><?php echo $mechanic['contact']; ?></td>
                            <td><?php echo $mechanic['address']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No mechanics registered yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="info-box">
            <p><strong>Note:</strong> To add new mechanics, use the <a href="register.php">Register</a> page and select "Mechanic" as the role.</p>
        </div>
    </div>
</body>
</html>
