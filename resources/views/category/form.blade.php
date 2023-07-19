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
              <label for="nama_kategori" class="col-md-2 col-md-offset-1 control-label">Nama Kategori</label>
              <div class="col-md-6">
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required autofocus>
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