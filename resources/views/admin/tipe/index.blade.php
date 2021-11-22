@extends('voyager::master')
@section('content')
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="page-title"><i class="voyager-documentation"></i> Data Tipe</h3>
                <button type="button" data-toggle="modal" onclick="addData()" data-target="#modalData" class="btn btn-success"><i class="voyager-plus"></i> Tambah</button>
            </div>
            <div class="card-body table-responsive">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tipe</th>
                            <th width="30%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalData">
        <div class="modal-dialog">
            <div class="modal-content">
                <div style="border-bottom:1px solid #e9ecef;" class="modal-header">
                    <h5 style="color:#000;opacity:.5;margin-bottom: 0;line-height: 1.5;font-size:1.25rem;font-weight:550;margin-top:0;" class="modal-title" id="modal-title"></h5>
                    <button style="margin-top:-22px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="idTipe" id="idTipe">
                        <label class="col-sm-2 col-form-label">Nama Tipe</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control nama_tipe" name="nama_tipe" id="nama_tipe" placeholder="Nama Tipe">
                        </div>
                    </div>
                    <div style="margin-top:5%;" class="modal-footer justify-content-between">
                        <button type="button" id="close-button" class="btn btn-danger" data-dismiss="modal"><i class="voyager-x"></i>Tutup</button>
                        <button type="button" id="save-tipe" class="btn btn-primary"><i class="voyager-tag"></i> Simpan</button>
                        <button type="button" id="update-tipe" class="btn btn-primary"><i class="voyager-tag"></i> Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    const table = $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ajax: {
            url: '{{ route("admin.tipe.apiData") }}',
            type: 'GET',
        },
        columns: [
            {data: null},
            {data: 'nama_tipe', name: 'nama_tipe', orderable: true, searchable: true, defaultContent: ''},
            {data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: ''},
        ],
        columnDefs: [
            {targets: 0, searchable: false, orderable: false},
        ],
    });

    table.on('draw.dt', function () {
        var PageInfo = $("#myTable").DataTable().page.info();

        table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    })

    $(document).ready(function() {
        $('#close-button').click(function() {
            $('.nama_tipe').val('').change();
        });

        $('#save-tipe').click(function() {
            $.ajax({
            type: 'POST',
            url: "{{ route('admin.tipe.save') }}",
            data: {
                _token: CSRF_TOKEN,
                nama_tipe: $('.nama_tipe').val(),
            },
            success: function(data) {
                // console.log(data);
                Swal.fire({
                    title: `${data.title}`,
                    icon: `${data.status}`,
                    html: `${data.message}`,
                    timer: `${data.timer}`,
                    showConfirmButton: false,
                });
                $('#modalData').modal('hide');
                table.ajax.reload();
            },
            error: function(data) {

            }
            });
        })

        // Aksi Untuk Update User
        $('#update-tipe').click(function() {
            $.ajax({
            type: 'POST',
            url: '{{route("admin.tipe.update")}}',
            data: {
                _token: CSRF_TOKEN,
                id: $('#idTipe').val(),
                nama_tipe: $('.nama_tipe').val(),
            },
            success: function(data) {
                console.log(data);
                Swal.fire({
                    title: `${data.title}`,
                    icon: `${data.status}`,
                    html: `${data.message}`,
                    timer: `${data.timer}`,
                    showConfirmButton: false,
                });
                $('#modalData').modal('hide');
                table.ajax.reload();
            },
            error: function(data) {

            }
            });
        })
    });

    function addData() {
        $('#modalData').off('click');
        $('.nama_tipe').val('').attr('readonly', false);
        $('#modal-title').text('Tambah Data Tipe');
        $('#update-tipe').hide();
        $('#save-tipe').show();
        $('#close-button').show();
    }

    function editData(id) {
        $.ajax({
            type: 'GET',
            url: '{{ route("admin.tipe.edit") }}',
            data: {
                id : id
            },
            success: function(data) {
                // console.log(data);
                $('#idTipe').val(id);
                $('.nama_tipe').attr('readonly', false).val(data.nama_tipe);
                $('#modalData').modal({backdrop: 'static', keyboard: false});
                $('#modal-title').text('Perbarui Data ' + data.nama_tipe);
                $('#update-tipe').show();
                $('#save-tipe').hide();
                $('#close-button').show();
            },
            error: function (data) {
                console.log(data);
            }
        })
    }

    function deleteData(id) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Ingin menghapus data tipe ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.tipe.delete") }}',
                data: {
                _token: CSRF_TOKEN,
                id : id
                },
                success: function(data) {
                    // console.log(data);
                    Swal.fire({
                        title: `${data.title}`,
                        icon: `${data.status}`,
                        text: `${data.message}`,
                        timer: `${data.timer}`,
                        showConfirmButton: false,
                    });
                    table.ajax.reload();
                },
                error: function (data) {
                    console.log(data);
                }
            })
            }
        })
    }
</script>
@endsection