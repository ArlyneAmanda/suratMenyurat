<?php
$_SESSION['login'] = true;
include 'config/koneksi.php';
$failed_message = "";

if (isset($_POST['btn_login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM user WHERE username = '$username'";
  $result = mysqli_query($link, $sql);

  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_array($result);
    $user_password = $data['password'];

    if (password_verify($password, $user_password)) {
      $_SESSION["login"] = true;
      $_SESSION["user_id"] = $data['user_id'];
      $_SESSION["username"] = $data['username'];
      $_SESSION["namalengkap"] = $data['namalengkap'];
      echo
        "<script> 
      alert ('Login berhasil');
      location.href='suratmasuk.php';
      </script>";
    } else {
      echo "<script>alert('Email atau password Anda salah. Silakan coba lagi!')</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Login Page</title>
  <style>
    body {
      height: 100vh;
      background-color: #070F2B;
    }

    .card-login {
      max-width: 400px;
      width: 100%;
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-login .card-header {
      background-color: white;
      color: #1B1A55;
      border-radius: 15px 15px 0 0;
      text-align: center;
    }

    .card-login .card-body {
      padding: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn-login {
      background-color: #1B1A55;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
    }

    .btn-register {
      background-color: #070F2B;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      /* cursor: pointer; */
    }

    .btn-register:hover {
      background-color: #1B1A55;
      color: white;
    }

    .btn-login:hover {
      background-color: #070F2B;
      color: white;
    }

    .forgot-password {
      text-align: right;
      color: #1B1A55;
    }
  </style>
</head>

<body class="d-flex align-items-center justify-content-center">
  <div class="container">
    <div class="card card-login m-auto">
      <div class="card-header">
        <h2 class="mb-0">Login</h2>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
              required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"
              required>
          </div>
          <button type="submit" name="btn_login" class="btn btn-login mb-3 w-100">Login</button>
          <div class="text-center">
            <p>
              Belum punya akun?
              <a href="registrasi.php" class="text-decoration-none">Register</a>
            </p>
            <!-- <a href="index.php" class="forgot-password text-decoration-none">Masuk tanpa Login</a> -->
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>