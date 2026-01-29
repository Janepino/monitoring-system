<?php
require_once 'config.php';
checkLogin();

// Get statistics from database
$total_customers = $conn->query("SELECT COUNT(*) FROM customers")->fetchColumn();
$total_vehicles = $conn->query("SELECT COUNT(*) FROM vehicles")->fetchColumn();
$pending_repairs = $conn->query("SELECT COUNT(*) FROM vehicles WHERE status='Pending'")->fetchColumn();
$completed_repairs = $conn->query("SELECT COUNT(*) FROM vehicles WHERE status='Completed'")->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - DMA Garage System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container">
        <h1>Dashboard</h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Customers</h3>
                <p class="stat-number"><?php echo $total_customers; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Total Vehicles</h3>
                <p class="stat-number"><?php echo $total_vehicles; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Pending Repairs</h3>
                <p class="stat-number"><?php echo $pending_repairs; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Completed Repairs</h3>
                <p class="stat-number"><?php echo $completed_repairs; ?></p>
            </div>
        </div>
        
        <div class="welcome-box">
            <h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>
            <p>Role: <strong><?php echo $_SESSION['user_role']; ?></strong></p>
            <p>Use the navigation menu above to manage customers, vehicles, mechanics, spare parts, and view reports.</p>
        </div>
    </div>
</body>
</html>
