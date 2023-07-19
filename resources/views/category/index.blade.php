@extends('dashboard.layouts.main')

@section('title')
  Daftar Pembelian

@endsection

@section('breadcrumb')
    @parent
    <li class="active">Pembelian</li>
@endsection




{{-- table category --}}
@section('container')
{{-- <section class="content-header"> --}}
 
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <button onclick="addForm('{{ route('category.data') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-stiped table-bordered">
            <thead>
              <th width="5%">No</th>
              <th>Kategori</th>
              <th width="15%"><i class="fa fa-cog"></i></th>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div> 
{{-- endtable category --}}

    
  <!--end crud-->

  @includeIf('category.form')


  {{-- pus --}}

  @push('scripts')
      <script>
        let table;
        
    $(function() {
      table = $('.table').DataTable({
          processing: true,
          autoWidth: false,
          ajax: {
            url: '{{ route('category.data') }}',
          },
          columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'nama_kategori'},
            {data: 'aksi', searchable: false, sortable: false},
          ]
        });

        $('#modal-form').validator().on('submit', function (e) {
          if (! e.preventDefault()) {
              $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
              .done((response) => {
                $('#modal-form').modal('hide');
                table.ajax.reload();
              })
              .fail((errors) => {
                alert('Tidak dapat menyimpan data');
                return;
              });
          }
        })

        
    });

    function addForm(url) {
      $('#modal-form').modal('show');
      $('#modal-form .modal-title').text('Tambah Kategori');

      $('#modal-form form')[0].reset();
      $('#modal-form form').attr('action', url);
      $('#modal-form [name=_method]').val('post');
      $('#modal-form [name=nama_kategori]').focus();
    }


    function editForm(url) {
      $('#modal-form').modal('show');
      $('#modal-form .modal-title').text('Edit Kategori');

      $('#modal-form form')[0].reset();
      $('#modal-form form').attr('action', url);
      $('#modal-form [name=_method]').val('put');
      $('#modal-form [name=nama_kategori]').focus();

      $.get(url)
        .done((response) => {
            $('#modal-form [name=nama_kategori]').val(response.nama_kategori);
           
        })
        .fail((errors) => {
          alert('Tadak Dapat Menampilkan Data');
          return;
        });
    }

    function deleteData(url) {
      if (confirm('apakah yakin anda ingin menghapus data terpilih?')) {
        $.post(url, {
        '_token': $('[name=csrf-token]').attr('content'),
        '_method': 'delete'
      })
      .done((response) => {
        table.ajax.reload();
      })
      .fail((errors) => {
        alert('Tidak Dapat Menghapus Data');
        return;
      })
      }
    }
      </script>
  @endpush 
@endsection

