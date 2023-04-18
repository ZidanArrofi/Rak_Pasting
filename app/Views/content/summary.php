<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">
  <div class="col">
    <div class="row">
      <div class="col-12">
        <div class="card m-b-30">
          <div class="card-body">

            <table class="table table-stripped table-hover" id="summary">
              <thead>
                <tr>
                  <td>Tanggal</td>
                  <td>Jumlah Rak</td>
                  <td>Gedung Asal</td>
                  <td>Gedung Tujuan</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $rak = array();
                foreach ($pasting as $data_pasting) {
                  $kode_tgl = date('d F Y', strtotime($data_pasting['created_at']));
                  $kode_gedung = $data_pasting['gedung_asal'];
                  if (!isset($rak[$kode_tgl][$kode_gedung])) {
                    $rak[$kode_tgl][$kode_gedung] = 1;
                  } else {
                    $rak[$kode_tgl][$kode_gedung]++;
                  }
                }

                $isExist = array();
                foreach ($pasting as $data_pasting) {
                  $created_at = date('d F Y', strtotime($data_pasting['created_at']));
                  if (!array_key_exists($created_at, $isExist)) {
                    $isExist[$created_at] = array();
                  }
                  if (!array_key_exists($data_pasting['gedung_asal'], $isExist[$created_at])) {
                    $isExist[$created_at][$data_pasting['gedung_asal']] = true;
                ?>
                    <tr>
                      <td><?= $created_at ?></td>
                      <td><?= $rak[$created_at][$data_pasting['gedung_asal']] ?></td>
                      <td><?= $data_pasting['gedung_asal'] ?></td>
                      <td><?= $data_pasting['gedung_tujuan'] ?></td>
                      <td>
                        <button type="button" class="btn btn-primary" onclick="showDetails('<?= $created_at ?>' , '<?= $data_pasting['gedung_asal'] ?>')">
                          Details
                        </button>
                      </td>
                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>

            </table>

            <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table" id="table">
                      <thead>
                        <tr>
                          <th>Jam</th>
                          <th>Kode Rak</th>
                          <th>Gedung Asal</th>
                          <th>Gedung Tujuan</th>
                        </tr>
                      </thead>
                      <tbody id="detailsTableBody">
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function showDetails(created_at, g_a) {
    var detailsTableBody = document.getElementById('detailsTableBody');
    detailsTableBody.innerHTML = '';
    var g_asal = g_a;
    var pasting = <?php echo json_encode($pasting); ?>;
    pasting.forEach((data_pasting) => {
      // console.log(g_asal)
      const formattedDate = new Date(data_pasting.created_at).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
      });
      if (formattedDate === created_at && data_pasting.gedung_asal === g_asal) {
        var row = document.createElement('tr');
        var jam = document.createElement('td');
        jam.innerHTML = new Date(data_pasting.created_at).toLocaleTimeString();
        var kode_rak = document.createElement('td');
        kode_rak.innerHTML = data_pasting.kode_rak;
        var gedung_asal = document.createElement('td');
        gedung_asal.innerHTML = data_pasting.gedung_asal;
        var gedung_tujuan = document.createElement('td');
        gedung_tujuan.innerHTML = data_pasting.gedung_tujuan;
        row.appendChild(jam);
        row.appendChild(kode_rak);
        row.appendChild(gedung_asal);
        row.appendChild(gedung_tujuan);
        detailsTableBody.appendChild(row);
      }
    });
    $('#detailsModal').modal('show');
  }
</script>



<?= $this->endSection() ?>