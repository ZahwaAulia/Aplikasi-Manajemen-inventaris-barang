<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submissions
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_item'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $stock_quantity = $_POST['stock_quantity'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $supplier_id = $_POST['supplier_id'];

        $stmt = $conn->prepare("INSERT INTO items (name, description, stock_quantity, price, category_id, supplier_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiddi", $name, $description, $stock_quantity, $price, $category_id, $supplier_id);

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Barang berhasil ditambahkan!</div>';
        } else {
            $message = '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    } elseif (isset($_POST['update_item'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $stock_quantity = $_POST['stock_quantity'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $supplier_id = $_POST['supplier_id'];

        $stmt = $conn->prepare("UPDATE items SET name=?, description=?, stock_quantity=?, price=?, category_id=?, supplier_id=? WHERE id=?");
        $stmt->bind_param("ssiddii", $name, $description, $stock_quantity, $price, $category_id, $supplier_id, $id);

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Barang berhasil diperbarui!</div>';
        } else {
            $message = '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    } elseif (isset($_POST['delete_item'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM items WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Barang berhasil dihapus!</div>';
        } else {
            $message = '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    }
}

// Get all items with category and supplier info
$items = $conn->query("SELECT i.*, c.name as category_name, s.name as supplier_name FROM items i LEFT JOIN categories c ON i.category_id = c.id LEFT JOIN suppliers s ON i.supplier_id = s.id ORDER BY i.created_at DESC");

// Get categories and suppliers for dropdowns
$categories = $conn->query("SELECT * FROM categories ORDER BY name");
$suppliers = $conn->query("SELECT * FROM suppliers ORDER BY name");

// Get item for editing if requested
$edit_item = null;
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM items WHERE id=?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $edit_item = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Barang - Sistem Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-boxes me-2"></i>
                Sistem Inventaris
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="items.php">Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="suppliers.php">Supplier</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php echo $message; ?>

        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>
                        <i class="fas fa-box me-2"></i>
                        Kelola Barang
                    </h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Barang
                    </button>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Supplier</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($item = $items->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo htmlspecialchars(substr($item['description'], 0, 50)) . (strlen($item['description']) > 50 ? '...' : ''); ?></td>
                                <td><?php echo htmlspecialchars($item['category_name'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($item['supplier_name'] ?? 'N/A'); ?></td>
                                <td>
                                    <span class="badge <?php echo $item['stock_quantity'] < 10 ? 'bg-danger' : 'bg-success'; ?>">
                                        <?php echo $item['stock_quantity']; ?>
                                    </span>
                                </td>
                                <td>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="?edit=<?php echo $item['id']; ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteItem(<?php echo $item['id']; ?>, '<?php echo htmlspecialchars($item['name']); ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Barang Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Barang *</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select class="form-control" name="category_id">
                                        <option value="">Pilih Kategori</option>
                                        <?php
                                        $categories->data_seek(0);
                                        while($cat = $categories->fetch_assoc()): ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Stok *</label>
                                    <input type="number" class="form-control" name="stock_quantity" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Harga *</label>
                                    <input type="number" class="form-control" name="price" min="0" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Supplier</label>
                                    <select class="form-control" name="supplier_id">
                                        <option value="">Pilih Supplier</option>
                                        <?php
                                        $suppliers->data_seek(0);
                                        while($sup = $suppliers->fetch_assoc()): ?>
                                        <option value="<?php echo $sup['id']; ?>"><?php echo htmlspecialchars($sup['name']); ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="add_item" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Item Modal -->
    <?php if ($edit_item): ?>
    <div class="modal fade show" id="editItemModal" tabindex="-1" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Barang</h5>
                    <a href="items.php" class="btn-close"></a>
                </div>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $edit_item['id']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Barang *</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($edit_item['name']); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select class="form-control" name="category_id">
                                        <option value="">Pilih Kategori</option>
                                        <?php
                                        $categories->data_seek(0);
                                        while($cat = $categories->fetch_assoc()): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $edit_item['category_id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($cat['name']); ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3"><?php echo htmlspecialchars($edit_item['description']); ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Stok *</label>
                                    <input type="number" class="form-control" name="stock_quantity" value="<?php echo $edit_item['stock_quantity']; ?>" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Harga *</label>
                                    <input type="number" class="form-control" name="price" value="<?php echo $edit_item['price']; ?>" min="0" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Supplier</label>
                                    <select class="form-control" name="supplier_id">
                                        <option value="">Pilih Supplier</option>
                                        <?php
                                        $suppliers->data_seek(0);
                                        while($sup = $suppliers->fetch_assoc()): ?>
                                        <option value="<?php echo $sup['id']; ?>" <?php echo $sup['id'] == $edit_item['supplier_id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($sup['name']); ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="items.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update_item" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function deleteItem(id, name) {
        if (confirm('Apakah Anda yakin ingin menghapus barang "' + name + '"?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = '<input type="hidden" name="id" value="' + id + '"><input type="hidden" name="delete_item" value="1">';
            document.body.appendChild(form);
            form.submit();
        }
    }
    </script>
</body>
</html>

<?php $conn->close(); ?>
