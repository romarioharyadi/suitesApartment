@extends('voyager::master')
@section('content')
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="page-title"><i class="voyager-documentation"></i> Data Banner</h3>
                <button type="button" data-toggle="modal" onclick="addData()" data-target="#modalData" class="btn btn-success"><i class="voyager-plus"></i> Tambah</button>
            </div>
            <div class="card-body table-responsive">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Banner</th>
                            <th>Gambar Banner</th>
                            <th>Actions</th>
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
                <form enctype="multipart/form-data" class="form-horizontal" id="form-data-upload" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Nama Merchant" class="col-sm-2 col-form-label">Nama Banner</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control nama_banner" name="nama_banner" id="nama_banner" placeholder="Nama Banner">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label" for="banner">Gambar Banner</label>
                            <div class="col-sm-10">
                                <input type="file" name="gambar_banner" class="form-control gambar_banner" id="gambar_banner" placeholder="Banner" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" id="close-button" class="btn btn-danger" data-dismiss="modal"><i class="voyager-x"></i>Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="voyager-tag"></i> Simpan</button>
                        </div>
                    </div>
                </form>
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
            url: '{{ route("admin.banner.apiData") }}',
            type: 'GET',
        },
        columns: [
            {data: null},
            {data: 'nama_banner', name: 'nama_banner', orderable: true, searchable: true, defaultContent: ''},
            {data: 'image', name: 'image', orderable: true, searchable: true, defaultContent: ''},
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
        $('#form-data-upload').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this); 
            $.ajax({
                type:'POST',
                url: "{{ route('admin.banner.save') }}",
                data: formData,
                contentType: false,
                processData: false,
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
        });
    });

    function addData() {
        $('#modalData').off('click');  
        $('.nama_banner').val('').attr('readonly', false);
        $('.gambar_banner').val('').attr('readonly', false);
        $('#modal-title').text('Form Banner');
        $('#update-iklan').hide();
        $('#close-button').show();
    }
    
    function deleteData(id) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Ingin menghapus data banner ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.banner.delete") }}',
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