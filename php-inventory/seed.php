<?php
include 'config.php';

// Create users table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff', 'guest') NOT NULL DEFAULT 'guest',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Sample users
$users = [
    ['name' => 'Administrator', 'email' => 'admin@example.com', 'password' => password_hash('admin123', PASSWORD_DEFAULT), 'role' => 'admin'],
    ['name' => 'Staff Member', 'email' => 'staff@example.com', 'password' => password_hash('staff123', PASSWORD_DEFAULT), 'role' => 'staff'],
    ['name' => 'Guest User', 'email' => 'guest@example.com', 'password' => password_hash('guest123', PASSWORD_DEFAULT), 'role' => 'guest']
];

// Insert users
foreach ($users as $user) {
    $stmt = $conn->prepare("INSERT IGNORE INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user['name'], $user['email'], $user['password'], $user['role']);
    $stmt->execute();
    $stmt->close();
}

// Sample data for categories
$categories = [
    ['name' => 'Elektronik', 'description' => 'Barang elektronik dan gadget'],
    ['name' => 'Pakaian', 'description' => 'Pakaian dan aksesoris'],
    ['name' => 'Makanan', 'description' => 'Makanan dan minuman'],
    ['name' => 'Furnitur', 'description' => 'Perabotan rumah tangga'],
    ['name' => 'Otomotif', 'description' => 'Suku cadang dan aksesoris kendaraan']
];

// Insert categories
foreach ($categories as $category) {
    $stmt = $conn->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $category['name'], $category['description']);
    $stmt->execute();
    $stmt->close();
}

// Sample data for suppliers
$suppliers = [
    ['name' => 'PT. Tech Solutions', 'contact_email' => 'contact@techsolutions.com', 'contact_phone' => '021-1234567', 'address' => 'Jl. Teknologi No. 123, Jakarta'],
    ['name' => 'CV. Fashion Store', 'contact_email' => 'info@fashionstore.com', 'contact_phone' => '021-2345678', 'address' => 'Jl. Mode No. 456, Bandung'],
    ['name' => 'UD. Food Corp', 'contact_email' => 'sales@foodcorp.com', 'contact_phone' => '021-3456789', 'address' => 'Jl. Kuliner No. 789, Surabaya'],
    ['name' => 'PT. Furniture Plus', 'contact_email' => 'admin@furnitureplus.com', 'contact_phone' => '021-4567890', 'address' => 'Jl. Kayu No. 101, Semarang'],
    ['name' => 'CV. Auto Parts', 'contact_email' => 'support@autoparts.com', 'contact_phone' => '021-5678901', 'address' => 'Jl. Otomotif No. 202, Yogyakarta']
];

// Insert suppliers
foreach ($suppliers as $supplier) {
    $stmt = $conn->prepare("INSERT INTO suppliers (name, contact_email, contact_phone, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $supplier['name'], $supplier['contact_email'], $supplier['contact_phone'], $supplier['address']);
    $stmt->execute();
    $stmt->close();
}

// Sample data for items
$items = [
    ['name' => 'Laptop Asus', 'description' => 'Laptop untuk kerja', 'stock_quantity' => 15, 'price' => 8500000, 'category_id' => 1, 'supplier_id' => 1],
    ['name' => 'Kaos Polos', 'description' => 'Kaos katun', 'stock_quantity' => 50, 'price' => 50000, 'category_id' => 2, 'supplier_id' => 2],
    ['name' => 'Nasi Goreng', 'description' => 'Makanan siap saji', 'stock_quantity' => 8, 'price' => 25000, 'category_id' => 3, 'supplier_id' => 3],
    ['name' => 'Meja Kayu', 'description' => 'Meja makan', 'stock_quantity' => 5, 'price' => 1500000, 'category_id' => 4, 'supplier_id' => 4],
    ['name' => 'Ban Mobil', 'description' => 'Ban untuk mobil', 'stock_quantity' => 20, 'price' => 800000, 'category_id' => 5, 'supplier_id' => 5],
    ['name' => 'Mouse Wireless', 'description' => 'Mouse nirkabel', 'stock_quantity' => 3, 'price' => 150000, 'category_id' => 1, 'supplier_id' => 1],
    ['name' => 'Celana Jeans', 'description' => 'Celana panjang', 'stock_quantity' => 25, 'price' => 200000, 'category_id' => 2, 'supplier_id' => 2],
    ['name' => 'Kursi Kantor', 'description' => 'Kursi ergonomis', 'stock_quantity' => 10, 'price' => 750000, 'category_id' => 4, 'supplier_id' => 4]
];

// Insert items
foreach ($items as $item) {
    $stmt = $conn->prepare("INSERT INTO items (name, description, stock_quantity, price, category_id, supplier_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiddi", $item['name'], $item['description'], $item['stock_quantity'], $item['price'], $item['category_id'], $item['supplier_id']);
    $stmt->execute();
    $stmt->close();
}

echo "Data sampel berhasil dimasukkan ke database!";
echo "<br><br>";
echo "<strong>Akun Test:</strong><br>";
echo "Admin: admin@example.com / admin123<br>";
echo "Staff: staff@example.com / staff123<br>";
echo "Guest: guest@example.com / guest123<br>";
echo "<br><a href='login.php'>Login</a> | <a href='register.php'>Register</a> | <a href='index.php'>Dashboard</a>";

$conn->close();
?>
