<?php
require_once 'config.php';
checkLogin();

// Get all repair records with customer and mechanic details
$repairs = $conn->query("SELECT v.*, c.name as customer_name, u.full_name as mechanic_name FROM vehicles v LEFT JOIN customers c ON v.customer_id = c.id LEFT JOIN users u ON v.mechanic_id = u.id ORDER BY v.date_added DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports - DMA Garage System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container">
        <h1>Repair Records Report</h1>
        
        <div class="table-box">
            <h2>All Repair Records</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Vehicle</th>
                        <th>Issue</th>
                        <th>Status</th>
                        <th>Mechanic</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($repairs) > 0): ?>
                        <?php foreach($repairs as $repair): ?>
                        <tr>
                            <td><?php echo $repair['id']; ?></td>
                            <td><?php echo date('M d, Y', strtotime($repair['date_added'])); ?></td>
                            <td><?php echo $repair['customer_name']; ?></td>
                            <td><?php echo $repair['brand'] . ' ' . $repair['model'] . ' (' . $repair['plate_number'] . ')'; ?></td>
                            <td><?php echo $repair['issue']; ?></td>
                            <td><span class="status-<?php echo strtolower(str_replace(' ', '-', $repair['status'])); ?>"><?php echo $repair['status']; ?></span></td>
                            <td><?php echo $repair['mechanic_name'] ?: 'Not Assigned'; ?></td>
                            <td>₱<?php echo number_format($repair['estimated_cost'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">No repair records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
