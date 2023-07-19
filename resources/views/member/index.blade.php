@extends('dashboard.layouts.main')

@section('title')
  Daftar Member

@endsection

@section('breadcrumb')
    @parent
    <li class="active">Member</li>
@endsection




{{-- table category --}}
@section('container')
{{-- <section class="content-header"> --}}
 
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <button onclick="addForm('{{ route('member.store') }}')" class="btn btn-success btn-xs btn-flat">
            <i class="fa fa-plus-circle"></i> Tambah</button>
            <button type="button" onclick="cetakMember('{{ route('member.cetak_member') }}')" class="btn btn-info btn-xs btn-flat">
              <i class="fa fa-id-card"></i>Cetak Member</button>
        </div>
        <div class="box-body table-responsive">
          <form action="" method="post" class="form-member">
            @csrf
              <table class="table table-stiped table-bordered">
                <thead>
                  <th width="5%">
                    <input type="checkbox" name="select_all" id="select_all">
                  </th>
                  <th width="5%">No</th>
                  <th>Kode Member</th>
                  <th>Nama Member</th>
                  <th>Telephone</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                  <th width="15%"><i class="fa fa-cog"></i></th>
                </thead>
              </table>
          </form>
        </div>
      </div>
    </div>
  </div> 
{{-- endtable member--}}

    
  <!--end crud-->

  @includeIf('member.form')


  {{-- pus --}}

  @push('scripts')
      <script>
        let table;
        
    $(function() {
      table = $('.table').DataTable({
          processing: true,
          autoWidth: false,
          ajax: {
            url: '{{ route('member.data') }}',
          },
          columns: [
            {data: 'select_all',  searchable: false, sortable: false},
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'kode_member'},
            {data: 'nama'},
            {data: 'telephone'},
            {data: 'alamat'},
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

        $('[name=select_all]').on('click', function() {
          $(':checkbox').prop('checked', this.checked);
        });

        
    });

    function addForm(url) {
      $('#modal-form').modal('show');
      $('#modal-form .modal-title').text('Tambah Member');

      $('#modal-form form')[0].reset();
      $('#modal-form form').attr('action', url);
      $('#modal-form [name=_method]').val('post');
      $('#modal-form [name=nama]').focus();
    }


    function editForm(url) {
      $('#modal-form').modal('show');
      $('#modal-form .modal-title').text('Edit Member');

      $('#modal-form form')[0].reset();
      $('#modal-form form').attr('action', url);
      $('#modal-form [name=_method]').val('put');
      $('#modal-form [name=nama]').focus();

      $.get(url)
        .done((response) => {
            $('#modal-form [name=nama]').val(response.nama);
            $('#modal-form [name=telephone]').val(response.telephone);
            $('#modal-form [name=alamat]').val(response.alamat);
           
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
      });
      }
    }

    function cetakMember(url) {
        if ($('input:checked').length < 1) {
        alert('Pilih data yang akan dicetak');
        return;
      } else {
          $('.form-member')
              .attr('action', url)
              .attr('target', '_blank')
              .submit();
      }
    }
      </script>
  @endpush 
@endsection

