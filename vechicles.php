<?php
require_once 'config.php';
checkLogin();

// Handle add vehicle form submission
if(isset($_POST['add_vehicle'])) {
    $customer_id = $_POST['customer_id'];
    $plate_number = $_POST['plate_number'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $issue = $_POST['issue'];
    $status = $_POST['status'];
    $mechanic_id = $_POST['mechanic_id'];
    $estimated_cost = $_POST['estimated_cost'];
    
    $stmt = $conn->prepare("INSERT INTO vehicles (customer_id, plate_number, brand, model, year, issue, status, mechanic_id, estimated_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$customer_id, $plate_number, $brand, $model, $year, $issue, $status, $mechanic_id, $estimated_cost]);
    $success = "Vehicle added successfully!";
}

// Get all vehicles with customer and mechanic names
$vehicles = $conn->query("SELECT v.*, c.name as customer_name, u.full_name as mechanic_name FROM vehicles v LEFT JOIN customers c ON v.customer_id = c.id LEFT JOIN users u ON v.mechanic_id = u.id ORDER BY v.date_added DESC")->fetchAll();

// Get customers for dropdown
$customers = $conn->query("SELECT * FROM customers")->fetchAll();

// Get mechanics for dropdown
$mechanics = $conn->query("SELECT * FROM users WHERE role='Mechanic'")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vehicles - DMA Garage System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container">
        <h1>Vehicle & Repair Management</h1>
        
        <?php if(isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <div class="form-box">
            <h2>Add New Vehicle</h2>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label>Customer:</label>
                        <select name="customer_id" required>
                            <option value="">Select Customer</option>
                            <?php foreach($customers as $customer): ?>
                                <option value="<?php echo $customer['id']; ?>"><?php echo $customer['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Plate Number:</label>
                        <input type="text" name="plate_number" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Brand:</label>
                        <input type="text" name="brand" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Model:</label>
                        <input type="text" name="model" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Year:</label>
                        <input type="text" name="year" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Issue/Problem:</label>
                    <textarea name="issue" rows="3" required></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Status:</label>
                        <select name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Assign Mechanic:</label>
                        <select name="mechanic_id">
                            <option value="">Select Mechanic</option>
                            <?php foreach($mechanics as $mechanic): ?>
                                <option value="<?php echo $mechanic['id']; ?>"><?php echo $mechanic['full_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Estimated Cost:</label>
                        <input type="number" step="0.01" name="estimated_cost" required>
                    </div>
                </div>
                
                <button type="submit" name="add_vehicle">Add Vehicle</button>
            </form>
        </div>
        
        <div class="table-box">
            <h2>Vehicle List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Plate Number</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Issue</th>
                        <th>Status</th>
                        <th>Mechanic</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vehicles as $vehicle): ?>
                    <tr>
                        <td><?php echo $vehicle['id']; ?></td>
                        <td><?php echo $vehicle['customer_name']; ?></td>
                        <td><?php echo $vehicle['plate_number']; ?></td>
                        <td><?php echo $vehicle['brand']; ?></td>
                        <td><?php echo $vehicle['model']; ?></td>
                        <td><?php echo $vehicle['year']; ?></td>
                        <td><?php echo $vehicle['issue']; ?></td>
                        <td><span class="status-<?php echo strtolower(str_replace(' ', '-', $vehicle['status'])); ?>"><?php echo $vehicle['status']; ?></span></td>
                        <td><?php echo $vehicle['mechanic_name'] ?: 'Not Assigned'; ?></td>
                        <td>₱<?php echo number_format($vehicle['estimated_cost'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
