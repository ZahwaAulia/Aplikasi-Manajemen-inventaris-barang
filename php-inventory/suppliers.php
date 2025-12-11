<?php
include 'config.php';

// Handle form submissions
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_supplier'])) {
        $name = $_POST['name'];
        $contact_email = $_POST['contact_email'];
        $contact_phone = $_POST['contact_phone'];
        $address = $_POST['address'];

        $stmt = $conn->prepare("INSERT INTO suppliers (name, contact_email, contact_phone, address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $contact_email, $contact_phone, $address);

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Supplier berhasil ditambahkan!</div>';
        } else {
            $message = '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    } elseif (isset($_POST['update_supplier'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $contact_email = $_POST['contact_email'];
        $contact_phone = $_POST['contact_phone'];
        $address = $_POST['address'];

        $stmt = $conn->prepare("UPDATE suppliers SET name=?, contact_email=?, contact_phone=?, address=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $contact_email, $contact_phone, $address, $id);

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Supplier berhasil diperbarui!</div>';
        } else {
            $message = '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    } elseif (isset($_POST['delete_supplier'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM suppliers WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Supplier berhasil dihapus!</div>';
        } else {
            $message = '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    }
}

// Get all suppliers
$suppliers = $conn->query("SELECT s.*, COUNT(i.id) as item_count FROM suppliers s LEFT JOIN items i ON s.id = i.supplier_id GROUP BY s.id ORDER BY s.name");

// Get supplier for editing if requested
$edit_supplier = null;
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM suppliers WHERE id=?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $edit_supplier = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Supplier - Sistem Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
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
                        <a class="nav-link" href="items.php">Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="suppliers.php">Supplier</a>
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
                        <i class="fas fa-truck me-2"></i>
                        Kelola Supplier
                    </h2>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Supplier
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
                                <th>Nama Supplier</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Jumlah Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($supplier = $suppliers->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $supplier['id']; ?></td>
                                <td><?php echo htmlspecialchars($supplier['name']); ?></td>
                                <td><?php echo htmlspecialchars($supplier['contact_email']); ?></td>
                                <td><?php echo htmlspecialchars($supplier['contact_phone']); ?></td>
                                <td><?php echo htmlspecialchars(substr($supplier['address'], 0, 30)) . (strlen($supplier['address']) > 30 ? '...' : ''); ?></td>
                                <td>
                                    <span class="badge bg-secondary"><?php echo $supplier['item_count']; ?> barang</span>
                                </td>
                                <td>
                                    <a href="?edit=<?php echo $supplier['id']; ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteSupplier(<?php echo $supplier['id']; ?>, '<?php echo htmlspecialchars($supplier['name']); ?>')">
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

    <!-- Add Supplier Modal -->
    <div class="modal fade" id="addSupplierModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Supplier Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Supplier *</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Kontak</label>
                                    <input type="email" class="form-control" name="contact_email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Telepon Kontak</label>
                                    <input type="text" class="form-control" name="contact_phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="address" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="add_supplier" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Supplier Modal -->
    <?php if ($edit_supplier): ?>
    <div class="modal fade show" id="editSupplierModal" tabindex="-1" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Supplier</h5>
                    <a href="suppliers.php" class="btn-close"></a>
                </div>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $edit_supplier['id']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Supplier *</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($edit_supplier['name']); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Kontak</label>
                                    <input type="email" class="form-control" name="contact_email" value="<?php echo htmlspecialchars($edit_supplier['contact_email']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Telepon Kontak</label>
                                    <input type="text" class="form-control" name="contact_phone" value="<?php echo htmlspecialchars($edit_supplier['contact_phone']); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="address" rows="2"><?php echo htmlspecialchars($edit_supplier['address']); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="suppliers.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update_supplier" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function deleteSupplier(id, name) {
        if (confirm('Apakah Anda yakin ingin menghapus supplier "' + name + '"? Semua barang dari supplier ini akan kehilangan referensi supplier.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = '<input type="hidden" name="id" value="' + id + '"><input type="hidden" name="delete_supplier" value="1">';
            document.body.appendChild(form);
            form.submit();
        }
    }
    </script>
</body>
</html>

<?php $conn->close(); ?>
