<?php
include 'koneksi.php';

// Logika Simpan Data
if (isset($_POST['simpan'])) {
    $task_name = $_POST['task_name'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];
    $description = $_POST['description'];

    // Insert ke database
    $query = "INSERT INTO tasks (task_name, priority, deadline, description, status) 
              VALUES ('$task_name', '$priority', '$deadline', '$description', 'Pending')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Tugas berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas - PlanMaster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f0f2f5;">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h4 class="fw-bold">📝 Tambah Tugas Baru</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Tugas / Pekerjaan</label>
                                <input type="text" name="task_name" class="form-control" placeholder="Contoh: Laporan Keuangan" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Prioritas</label>
                                    <select name="priority" class="form-select" required>
                                        <option value="">Pilih Tingkat...</option>
                                        <option value="High">🔴 High (Sangat Penting)</option>
                                        <option value="Medium">🟡 Medium (Sedang)</option>
                                        <option value="Low">🟢 Low (Santai)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Deadline</label>
                                    <input type="date" name="deadline" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Detail Tugas</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Jelaskan detail pekerjaannya..."></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="simpan" class="btn btn-primary rounded-pill fw-bold">Simpan Jadwal</button>
                                <a href="index.php" class="btn btn-light rounded-pill text-muted">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>