<?php
    include 'dbb.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        echo "ID tidak ditemukan.";
        exit();
    }

    $sql = "SELECT * FROM user WHERE id = $id";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Diri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mali:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: "Mali", cursive; }
        .custom-form { width: 50%; min-height: 400px; border: 2px solid; border-color: #E90074 !important; }
        .btn-pink { background-color: black; border-width: 0; }
        .btn-pink:hover { background-color: #d41273; color: white; }
    </style>

    <script>
        function enableEditing() {
            //ini untuk menghapus atribut 'disabled' dari setiap elemen input
            document.querySelectorAll('.form-control, .form-check-input, .form-select').forEach(element => {
                element.removeAttribute('disabled');
            });
        }
    </script>
</head>
<body>
    <div class="container-fluid">
        <h1>Data Diri</h1>
        <p>Berikut adalah data diri yang telah anda input.</p>

        <form action="update.php" method="post" class="p-4 mb-3 rounded custom-form">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="email" value="<?php echo str_replace('@gmail.com', '', $row['email']); ?>" required disabled>
                    <span class="input-group-text">@gmail.com</span>
                </div>
            </div>
            <div class="mb-3">
                <label for="hp" class="form-label">No. Handphone:</label>
                <input type="text" class="form-control" id="hp" name="hp" value="<?php echo $row['hp']; ?>" required disabled>
            </div>
            <div class="mb-3">
                <label for="Alamat" class="form-label">Alamat:</label>
                <textarea class="form-control" rows="3" id="Alamat" name="alamat" required disabled><?php echo $row['alamat']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="job" class="form-label">Pekerjaan:</label>
                <input type="text" class="form-control" id="job" name="job" value="<?php echo $row['job']; ?>" required disabled>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin:</label><br>
                <input type="radio" class="form-check-input" name="gender" value="perempuan" <?php echo ($row['gender'] == 'perempuan') ? 'checked' : ''; ?> disabled> Perempuan
                <input type="radio" class="form-check-input" name="gender" value="Laki-laki" <?php echo ($row['gender'] == 'Laki-laki') ? 'checked' : ''; ?> disabled> Laki-laki
            </div>
            <div class="mb-3">
                <label for="hobby" class="form-label">Hobby:</label>
                <textarea class="form-control" rows="2" id="hobby" name="hobby" required disabled><?php echo $row['hobby']; ?></textarea>
            </div>
            <div class="mb-5">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" name="status" required disabled>
                    <option value="Belum menikah" <?php echo ($row['status'] == 'Belum menikah') ? 'selected' : ''; ?>>Belum menikah</option>
                    <option value="Sudah menikah" <?php echo ($row['status'] == 'Sudah menikah') ? 'selected' : ''; ?>>Sudah menikah</option>
                    <option value="Sudah menikah tapi cerai" <?php echo ($row['status'] == 'Sudah menikah tapi cerai') ? 'selected' : ''; ?>>Sudah menikah tapi cerai</option>
                    <option value="Tidak mau menikah" <?php echo ($row['status'] == 'Tidak mau menikah') ? 'selected' : ''; ?>>Tidak mau menikah</option>
                </select>
            </div>
            <div class="mb-1">
                <button type="button" class="btn btn-primary btn-pink" onclick="window.location.href='form_insert.html'">Add New</button>
                <button type="button" class="btn btn-primary btn-pink" onclick="window.location.href='update.php?id=<?php echo $row['id']; ?>'">Update</button>
                <button type="button" class="btn btn-primary btn-pink" onclick="confirmDelete()">Delete</button>
            </div>
        </form>
    </div>

    <script>
        function confirmDelete() {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = 'delete.php?id=<?php echo $row['id']; ?>';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>