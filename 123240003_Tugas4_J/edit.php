<?php
require "config/koneksi.php";
require "components/components.php";
require "components/session_protected.php";

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit();
}

$id_todo = intval($_GET['id']);
$id_user = intval($_SESSION['id_user']);

$query = "SELECT * FROM todo WHERE id_todo = $id_todo AND id_user = $id_user";
$result = mysqli_query($koneksi, $query);
$todo = $result ? mysqli_fetch_assoc($result) : null;

if (!$todo) {
  die("Data tidak ditemukan atau bukan milik anda!!");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head("Edit To Do") ?>
</head>

<body>
  <?= navbar() ?>

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">

        <div class="card shadow-lg border-0">
          <div class="card-header bg-dark text-white text-center">
            <h4 class="mb-0 py-1">Edit To Do</h4>
          </div>

          <div class="card-body p-4">
            <form action="logic/update_data.php" method="POST">
              <input type="hidden" name="id_todo" value="<?= $todo['id_todo'] ?>">

              <div class="mb-3">
                <label for="todo" class="form-label fw-bold">Judul To Do</label>
                <input type="text" class="form-control" id="todo" name="todo" placeholder="Contoh: Selesaikan tugas X" value="<?= htmlspecialchars($todo['todo']) ?>" required>
              </div>

              <div class="mb-4">
                <label for="status" class="form-label fw-bold">Status</label>
                <select class="form-select" id="status" name="status" required>
                  <option value="pending" <?= $todo['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                  <option value="selesai" <?= $todo['status'] === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                </select>
              </div>

              <div class="d-flex gap-2">
                <a href="index.php" class="btn btn-outline-dark w-25">Batal</a>
                <button type="submit" class="btn btn-dark fw-bold w-75">Perbarui To Do</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= footer() ?>
</body>

</html>