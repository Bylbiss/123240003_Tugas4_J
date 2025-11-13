<?php
require "config/koneksi.php";
require "components/components.php";
require 'components/session_protected.php';

$id_user = intval($_SESSION['id_user']);
$username = $_SESSION['username'] ?? 'User';

$where = "WHERE id_user = $id_user";

if (isset($_GET['search']) && trim($_GET['search']) !== '') {
  $keyword = mysqli_real_escape_string($koneksi, $_GET['search']);
  $where .= " AND todo LIKE '%$keyword%'";
}

if (isset($_GET['filter']) && $_GET['filter'] === 'pending') {
  $where .= " AND status = 'pending'";
}

// Nampilin 
$sql = "SELECT * FROM todo $where ORDER BY id_todo DESC";
$result = mysqli_query($koneksi, $sql);
$data = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];

$total = count($data);
$selesai = count(array_filter($data, fn($t) => $t['status'] === 'selesai'));
$pending = count(array_filter($data, fn($t) => $t['status'] === 'pending'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head("Dashboard To Do") ?>
</head>

<body>
  <?= navbar() ?>

  <section class="container">
    <!-- Dashboard Header -->
    <?php
    if (isset($_GET['status'])) {
      listAlert($_GET['status']);
    }
    ?>

    <h3 class="mb-0 mt-3">Selamat Datang, <?= htmlspecialchars($username) ?></h3>

    <!-- Dashboard Data -->
    <div class="d-flex mt-4 gap-3 justify-content-between">
      <div class="card flex-grow-1 text-white bg-primary mb-3 shadow-sm">
        <div class="card-body d-flex align-items-center">
          <i class="bi bi-card-list me-3 fs-1"></i>
          <div>
            <p class="card-text m-0 opacity-75">Semua - To Do</p>
            <h3 class="card-title m-0"><?= $total ?></h3>
          </div>
        </div>
      </div>

      <div class="card flex-grow-1 text-white bg-success mb-3 shadow-sm">
        <div class="card-body d-flex align-items-center">
          <i class="bi bi-check2-circle me-3 fs-1"></i>
          <div>
            <p class="card-text m-0 opacity-75">Selesai - To Do</p>
            <h3 class="card-title m-0"><?= $selesai ?></h3>
          </div>
        </div>
      </div>

      <div class="card flex-grow-1 text-white bg-warning mb-3 shadow-sm">
        <div class="card-body d-flex align-items-center">
          <i class="bi bi-hourglass-split me-3 fs-1"></i>
          <div>
            <p class="card-text m-0 opacity-75">Pending - To Do</p>
            <h3 class="card-title m-0"><?= $pending ?></h3>
          </div>
        </div>
      </div>
    </div>

    <hr>
    <!-- Dashboard Funsilitas -->
    <div class="d-flex align-items-center gap-3 ">

      <form action="index.php" method="GET" class="input-group">
        <input type="text" class="form-control" placeholder="Cari To Do..." name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" aria-label="Search" aria-describedby="search-button">
        <button type="submit" class="btn btn-dark" id="search-button">
          <i class="bi bi-search"></i>
        </button>
      </form>

      <a href="index.php?filter=pending" class="text-decoration-none">
        <button class="btn btn-outline-dark d-flex align-items-center fw-bold shadow-sm" style="min-width: 120px;">
          <i class="bi bi-grid-fill me-2"></i>
          Pending
        </button>
      </a>

      <a href="tambah.php" class="text-decoration-none">
        <button class="btn btn-dark d-flex align-items-center fw-bold shadow-sm" style="min-width: 120px;">
          <i class="bi bi-plus-lg me-2"></i>
          Tambah
        </button>
      </a>
    </div>

    <hr>
    <!-- Dashboard Table -->
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr class="table-dark">
            <th scope="col" class="text-center" style="width: 5%;">No</th>
            <th scope="col" style="width: 40%;">Judul</th>
            <th scope="col" class="text-center" style="width: 15%;">Status</th>
            <th scope="col" style="width: 20%;">Tanggal</th>
            <th scope="col" class="text-center" style="width: 20%;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- LOOP -->
          <?php if ($total > 0): ?>
            <?php $no = 1;
            foreach ($data as $todo): ?>
              <tr>
                <td scope="row" class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($todo['todo']) ?></td>
                <td class="text-center">
                  <?php if ($todo['status'] === 'pending'): ?>
                    <span class='badge bg-warning rounded-pill'>Pending</span>
                  <?php else: ?>
                    <span class='badge bg-success rounded-pill'>Selesai</span>
                  <?php endif; ?>
                </td>
                <td><?= formatDate($todo['created_at']) ?></td>
                <td class="text-center">
                  <div class="d-flex justify-content-center gap-2">
                    <a href="edit.php?id=<?= $todo['id_todo'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="logic/delete_data.php?id=<?= $todo['id_todo'] ?>"
                      onclick="return confirm('Yakin ingin menghapus todo ini?')"
                      class="btn btn-sm btn-outline-danger" title="Hapus">
                      <i class="bi bi-trash"></i>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center">Belum ada To Do</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>
  <?= footer() ?>
</body>

</html>