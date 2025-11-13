<?php
require "components/components.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head("Login") ?>
</head>

<body class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

  <div class="card p-4 p-md-5 shadow-lg bg-white rounded-4" style="max-width: 600px; width: 100%;">
    <?php
    if (isset($_GET['status'])) {
      listAlert($_GET['status']);
    }
    ?>

    <div class="card-body">
      <div class="text-center mb-4">
        <i class="bi bi-cloud-fill text-primary mb-3 fs-3"></i>
        <h4 class="fw-normal">Selamat Datang!</h4>
        <p class="text-muted small">Silahkan login, untuk mengakses fitur kami.</p>
      </div>

      <form action="logic/auth.php" method="POST">
        <div class="mb-3">
          <div class="input-group">
            <span for="username" class="input-group-text bg-white border-end-0 border-0 ps-0 pe-2">
              <i class="bi bi-person"></i>
            </span>
            <input type="text" id="username" name="username" class="form-control border-0 ps-0" placeholder="Username" required>
          </div>
          <hr class="mt-1 mb-0">
        </div>

        <div class="mb-4">
          <div class="input-group">
            <span for="password" class="input-group-text bg-white border-end-0 border-0 ps-0 pe-2">
              <i class="bi bi-lock text-muted"></i>
            </span>
            <input type="password" id="password" name="password" class="form-control border-0 ps-0" placeholder="Password" required>
          </div>
          <hr class="mt-1 mb-0">
        </div>

        <div class="d-grid gap-2 mb-3">
          <button type="submit" class="btn btn-primary rounded" name="login">Login</button>
        </div>

        <div class="text-center small">
          Belum Punya Akun?
          <a href="register.php" class="text-decoration-none text-primary fw-semibold">Daftar disini</a>
        </div>
      </form>
    </div>
  </div>
  <?= footer() ?>
</body>

</html>