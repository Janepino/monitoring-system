<?php
require_once 'config.php';
checkLogin();

// Handle add customer form submission
if(isset($_POST['add_customer'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    
    $stmt = $conn->prepare("INSERT INTO customers (name, email, contact, address) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $contact, $address]);
    $success = "Customer added successfully!";
}

// Get all customers
$customers = $conn->query("SELECT * FROM customers ORDER BY date_added DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customers - DMA Garage System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container">
        <h1>Customer Management</h1>
        
        <?php if(isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <div class="form-box">
            <h2>Add New Customer</h2>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Contact:</label>
                        <input type="text" name="contact" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" name="address" required>
                    </div>
                </div>
                
                <button type="submit" name="add_customer">Add Customer</button>
            </form>
        </div>
        
        <div class="table-box">
            <h2>Customer List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Date Added</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($customers as $customer): ?>
                    <tr>
                        <td><?php echo $customer['id']; ?></td>
                        <td><?php echo $customer['name']; ?></td>
                        <td><?php echo $customer['email']; ?></td>
                        <td><?php echo $customer['contact']; ?></td>
                        <td><?php echo $customer['address']; ?></td>
                        <td><?php echo date('M d, Y', strtotime($customer['date_added'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
