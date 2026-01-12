<?php 
// --- MANTRA SAKTI: MUNCULKAN ERROR ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// -------------------------------------

session_start();
include 'koneksi.php';

// Cek apakah user sudah login?
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlanMaster - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        .navbar { background: linear-gradient(45deg, #0d6efd, #0099ff); }
        .card-task {
            border: none; border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card-task:hover { transform: translateY(-5px); }
        .badge-priority-High { background-color: #ff4d4d; }
        .badge-priority-Medium { background-color: #ffc107; color: #000; }
        .badge-priority-Low { background-color: #28a745; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🚀 PlanMaster</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white">Halo, <?php echo $_SESSION['nama']; ?>!</span>
                <a href="logout.php" class="btn btn-sm btn-danger rounded-pill">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">Jadwal Kerja Saya</h2>
            <a href="tambah.php" class="btn btn-primary rounded-pill px-4 shadow">+ Tambah Tugas Baru</a>
        </div>

        <div class="row">
            <?php
            // Query ambil data tugas
            $query = "SELECT * FROM tasks ORDER BY deadline ASC";
            $result = mysqli_query($conn, $query);

            // Cek jika query error (misal tabel tasks belum dibuat)
            if (!$result) {
                die('<div class="alert alert-danger">❌ Error Query: '.mysqli_error($conn).' <br> <b>Solusi:</b> Pastikan tabel "tasks" sudah dibuat di database!</div>');
            }

            // Cek jika data masih kosong
            if (mysqli_num_rows($result) == 0) {
                echo '<div class="col-12"><div class="alert alert-info text-center">Belum ada tugas bray. Santuy dulu! ☕</div></div>';
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $priorityClass = 'badge-priority-' . $row['priority'];
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-task bg-white p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge <?php echo $priorityClass; ?> rounded-pill px-3">
                                <?php echo $row['priority']; ?>
                            </span>
                            <small class="text-muted"><?php echo $row['deadline']; ?></small>
                        </div>
                        <h5 class="fw-bold"><?php echo $row['task_name']; ?></h5>
                        <p class="text-secondary small mb-3">
                            <?php echo substr($row['description'], 0, 50) . '...'; ?>
                        </p>
                        <hr>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary w-50">Edit</a>
                            <a href="#" class="btn btn-sm btn-outline-danger w-50">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>