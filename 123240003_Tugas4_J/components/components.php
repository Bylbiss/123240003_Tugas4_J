<?php
function head($title)
{ ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title) ?></title>
  <!-- CSS Boostrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <!-- ICON Boostrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <!-- CSS Custom -->
  <link rel="stylesheet" href="css/style.css">
<?php } ?>

<?php
function footer()
{ ?>
  <!-- JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <!-- Untuk UX menghapus status urlnya || Silahkan uncomment kalo mau make, gak usah biarain juga boleh -->
  <script>
    // Hapus ?status=... dari URL setelah toast tampil
    if (window.location.search.includes("status=")) {
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  </script>
<?php
}
?>

<?php
function listAlert($status)
{
  switch ($status) {
    case 'berhasil_mendaftar': ?>
      <div class="alert alert-success" role="alert">
        Success : Berhasil mendafatarkan akun
      </div>
    <?php break;
    case 'gagal_mendaftar': ?>
      <div class="alert alert-danger" role="alert">
        Error : Gagal mendafatarkan akun
      </div>
    <?php break;
    case 'gagal_login': ?>
      <div class="alert alert-danger" role="alert">
        Error : Gagal login
      </div>
    <?php break;
    case 'password_tidak_sama': ?>
      <div class="alert alert-danger" role="alert">
        Error : Password tidak sama
      </div>
    <?php break;
    case 'login_dulu': ?>
      <div class="alert alert-danger" role="alert">
        Error : Login terlebih dahulu
      </div>
    <?php break;
    case 'berhasil_logout': ?>
      <div class="alert alert-success" role="alert">
        Success : Berhasil Logout
      </div>
    <?php break;
    case 'hapus_berhasil': ?>
      <div class="alert alert-success" role="alert">
        Success : To Do berhasil dihapus
      </div>
    <?php break;
  }
}
?>

<?php
function navbar()
{ ?>
  <nav class="navbar bg-dark border-bottom">
    <div class="container d-flex justify-content-beetween">
      <a class="navbar-brand fw-bold fs-3 text-white" href="index.php">To Do List Saya</a>
      <a href="logic/logout.php?logout=true"><button class="btn btn-danger">Logout</button></a>
    </div>
  </nav>
<?php } ?>

<?php
function formatDate($date)
{
  if (!$date) return "-";
  return date('d F Y', strtotime($date));
} ?>