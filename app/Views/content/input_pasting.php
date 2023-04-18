<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">
  <div class="row">
    <div class="col">

      <div class="box">
        <div class="box-header">
          <h4>Detail Rak</h4>

          <div class="col-6">
            <button type="button" class="btn btn-primary" id="add-btn">Add</button>
          </div>
          <form action="/save" method="post">
            <?= csrf_field() ?>

            <div class="row">
              <div class="col-6" id="input">
                <div class="input-group">
                  <input type="text" name="kode_rak[]" class="form-control my-2" id="kode_rak_0" placeholder="Kode Rak">
                  <button type="button" class="btn btn-danger delete-btn mx-3 my-2">Delete</button>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <select class="select2 form-select mb-3 custom-select" style="width: 100%; height:36px;">
                  <option>Gedung Asal</option>
                  <option value="Gedung B">Gedung B</option>
                  <option value="Gedung E">Gedung E</option>
                </select>
              </div>
              <div class="col-6">
                <select class="select2 form-select mb-3 custom-select" style="width: 100%; height:36px;">
                  <option>Gedung Tujuan</option>
                  <option value="Gedung B">Gedung B</option>
                  <option value="Gedung E">Gedung E</option>
                </select>
              </div>
            </div>



            <div class="row">
              <div class="col-4"></div>
              <div class="col-4" style="text-align:center;"><input type="submit" class="btn btn-success mt-3" value="Save"></div>
              <div class="col-4"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  const input = document.getElementById('input');
  const addButton = document.getElementById('add-btn');

  addButton.addEventListener('click', function() {
    const lastInput = input.lastElementChild.cloneNode(true);
    let lastId = lastInput.querySelector('input').id;
    let newId = lastId.replace(/(\d+)/, function(match, p1) {
      return parseInt(p1) + 1;
    });
    lastInput.querySelector('input').id = newId;
    lastInput.querySelector('input').value = '';
    input.appendChild(lastInput);
    lastInput.querySelector('input').focus();
  });

  input.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-btn')) {
      event.target.parentNode.remove();
    }
  });

  input.addEventListener('keydown', function(event) {
    if (event.keyCode === 9) { // Tombol Tab
      event.preventDefault();
      addButton.click();
    }
  });
</script>
<?= $this->endSection() ?>