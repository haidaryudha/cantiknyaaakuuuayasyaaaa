<?php
// --- MANTRA: MUNCULKAN SEMUA ERROR ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// -------------------------------------

session_start();

// Cek apakah file koneksi benar-benar ada?
if (!file_exists('koneksi.php')) {
    die("<b>ERROR PARAH:</b> File 'koneksi.php' gak ketemu bray! Cek lagi nama filenya atau foldernya.");
}

include 'koneksi.php';

// Logika Login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); 

    // Cek koneksi database dulu
    if (!$conn) {
        die("Koneksi database GAGAL: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    // Cek apakah query error (misal salah nama tabel)
    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama_lengkap'];
        $_SESSION['status'] = "login";
        header("Location: index.php"); 
        exit();
    } else {
        $error = "Username atau Password salah bray!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PlanMaster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-login {
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 400px;
        }
    </style>
</head>
<body>

    <div class="card card-login bg-white p-4">
        <h3 class="text-center fw-bold mb-4">🚀 PlanMaster</h3>
        
        <?php if(isset($error)) { ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukan username" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukan password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100 rounded-pill fw-bold">Masuk Sekarang</button>
        </form>
        <div class="text-center mt-3">
            <small class="text-muted">Gunakan akun: admin / admin123</small>
        </div>
    </div>

</body>
</html>