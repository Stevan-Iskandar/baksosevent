<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $menu_; ?></h1>
  <div class="row">
    <div class="col-lg-6 overflow-auto">
      <?= $this->session->flashdata("message"); ?>
      <h3 class="h3 mb-4 text-gray-800"><?= $event["nama"]; ?></h3>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody class="scroll-table-y">
          <?php $i = 1;
          $jml = 0;
          foreach ($peserta as $p) : ?>
            <tr>
              <th scope="row"><?= $i; ?></th>
              <td><?= $p["username"]; ?></td>
              <td><?php if ($p["is_registered"] == 1) {
                      $jml++;
                      echo "Daftar";
                    } else {
                      echo "Batal";
                    } ?>
              </td>
            </tr>
          <?php $i++;
          endforeach; ?>
          <tr>
            <td class="text-center" colspan="3">Jumlah peserta = <?= $jml ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>