 <!-- Modal -->
  <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
      <form action="" method="post" class="form-horizontal">
        @csrf
        @method('put')
       

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="nama" class="col-md-2 col-md-offset-1 control-label">Nama</label>
              <div class="col-md-6">
                <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                <span class="help-block with-errors"></span>
              </div>
            </div>

            <div class="form-group row">
              <label for="telephone" class="col-md-2 col-md-offset-1 control-label">Telephone</label>
              <div class="col-md-6">
                <input type="text" name="telephone" id="telephone" class="form-control" required>
                <span class="help-block with-errors"></span>
              </div>
            </div>

            <div class="form-group row">
              <label for="alamat" class="col-md-2 col-md-offset-1 control-label">Alamat</label>
              <div class="col-md-6">
                <textarea name="alamat" id="alamat"  rows="3" class="form-control" ></textarea>
                <span class="help-block with-errors"></span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
              <button class="btn btn-sm-flat btn-primary">simpan</button>
            <button type="button" class="btn btn-sm-flat btn-default" data-dismiss="modal">batal</button>
          </div>
        </div>
      </form>
    </div>
  </div>