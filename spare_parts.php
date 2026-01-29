<?php
require_once 'config.php';
checkLogin();

// Handle add spare part form submission
if(isset($_POST['add_part'])) {
    $vehicle_id = $_POST['vehicle_id'];
    $part_name = $_POST['part_name'];
    $quantity = $_POST['quantity'];
    $cost = $_POST['cost'];
    
    $stmt = $conn->prepare("INSERT INTO spare_parts (vehicle_id, part_name, quantity, cost) VALUES (?, ?, ?, ?)");
    $stmt->execute([$vehicle_id, $part_name, $quantity, $cost]);
    $success = "Spare part added successfully!";
}

// Get all spare parts with vehicle and customer info
$spare_parts = $conn->query("SELECT sp.*, v.plate_number, c.name as customer_name FROM spare_parts sp LEFT JOIN vehicles v ON sp.vehicle_id = v.id LEFT JOIN customers c ON v.customer_id = c.id ORDER BY sp.date_used DESC")->fetchAll();

// Get vehicles for dropdown
$vehicles = $conn->query("SELECT v.id, v.plate_number, c.name as customer_name FROM vehicles v LEFT JOIN customers c ON v.customer_id = c.id")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Spare Parts - DMA Garage System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container">
        <h1>Spare Parts Monitoring</h1>
        
        <?php if(isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <div class="form-box">
            <h2>Record Spare Part Used</h2>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label>Vehicle:</label>
                        <select name="vehicle_id" required>
                            <option value="">Select Vehicle</option>
                            <?php foreach($vehicles as $vehicle): ?>
                                <option value="<?php echo $vehicle['id']; ?>"><?php echo $vehicle['plate_number'] . ' - ' . $vehicle['customer_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Part Name:</label>
                        <input type="text" name="part_name" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Quantity:</label>
                        <input type="number" name="quantity" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Cost:</label>
                        <input type="number" step="0.01" name="cost" required>
                    </div>
                </div>
                
                <button type="submit" name="add_part">Add Spare Part</button>
            </form>
        </div>
        
        <div class="table-box">
            <h2>Spare Parts Used</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vehicle</th>
                        <th>Customer</th>
                        <th>Part Name</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Date Used</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($spare_parts as $part): ?>
                    <tr>
                        <td><?php echo $part['id']; ?></td>
                        <td><?php echo $part['plate_number']; ?></td>
                        <td><?php echo $part['customer_name']; ?></td>
                        <td><?php echo $part['part_name']; ?></td>
                        <td><?php echo $part['quantity']; ?></td>
                        <td>₱<?php echo number_format($part['cost'], 2); ?></td>
                        <td><?php echo date('M d, Y', strtotime($part['date_used'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
