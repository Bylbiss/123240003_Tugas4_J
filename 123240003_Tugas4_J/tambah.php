<?php
require "components/components.php";
require "components/session_protected.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head("Tambah To Do") ?>
</head>

<body>
  <?= navbar() ?>

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">

        <div class="card shadow-lg border-0">
          <div class="card-header bg-dark text-white text-center">
            <h4 class="mb-0 py-1">Tambah To Do Baru</h4>
          </div>

          <div class="card-body p-4">
            <form action="logic/create_data.php" method="POST">

              <div class="mb-3">
                <label for="todo" class="form-label fw-bold">Judul To Do</label>
                <input type="text" class="form-control" id="todo" name="todo" placeholder="Contoh: Selesaikan tugas X" required>
              </div>

              <div class="mb-4">
                <label for="status" class="form-label fw-bold">Status</label>
                <select class="form-select" id="status" name="status" required>
                  <option value="pending" selected>Pending</option>
                  <option value="selesai" disabled>Selesai</option>
                </select>
              </div>

              <div class="d-flex gap-2">
                <a href="index.php" class="btn btn-outline-dark w-25">Batal</a>
                <button type="submit" class="btn btn-dark fw-bold w-75">Simpan To Do</button>
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