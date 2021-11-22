@extends('voyager::master')
@section('content')
    <style>
        span{
            width:100%;
        }
    </style>

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
                            <th>Tipe</th>
                            <th>Nama</th>
                            <th width="80px;">Harga</th>
                            <th>Alamat</th>
                            <th>Gambar</th>
                            <th width="100px;">Ukuran</th>
                            <th>Kamar Tidur</th>
                            <th>Kamar Mandi</th>
                            <th width="100px;">Actions</th>
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
                            <input type="hidden" name="idRoom" id="idRoom">
                            <label class="col-sm-2 col-form-label">Nama Apartment</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control nama_apartment" name="nama_apartment" id="nama_apartment" placeholder="Nama Apartment">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label">Tipe</label>
                            <div class="col-sm-10">
                                <select style="width:100%;" class="form-control tipe" name="tipe" id="tipe">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="number" name="harga" class="form-control harga" id="harga" placeholder="Rp." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" class="form-control alamat" id="alamat"></textarea>
                            </div>
                        </div>
                        <div class="form-group" id="imgLama">
                            <label class="col-sm-2 col-form-label">Gambar Lama</label>
                            <div class="col-sm-10" id="imgLama2">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" name="image" class="form-control image" id="image" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label">Ukuran</label>
                            <div class="col-sm-10">
                                <input type="number" name="ukuran" class="form-control ukuran" id="ukuran" placeholder="Contoh : XXX meter" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label">Kamar Tidur</label>
                            <div class="col-sm-10">
                                <input type="number" name="kamar_tidur" class="form-control kamar_tidur" id="kamar_tidur" placeholder="Contoh : 2 tempat" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label">Kamar Mandi</label>
                            <div class="col-sm-10">
                                <input type="number" name="kamar_mandi" class="form-control kamar_mandi" id="kamar_mandi" placeholder="Contoh : 3 tempat" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" id="close-button" class="btn btn-danger" data-dismiss="modal"><i class="voyager-x"></i>Tutup</button>
                            <button type="submit" id="save-room" class="btn btn-primary"><i class="voyager-tag"></i> Simpan</button>
                            <button type="submit" id="update-room" class="btn btn-primary"><i class="voyager-tag"></i> Update</button>
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
            url: '{{ route("admin.room.apiData") }}',
            type: 'GET',
        },
        columns: [
            {data: null},
            {data: 'tipe', name: 'tipe', orderable: true, searchable: true, defaultContent: ''},
            {data: 'nama_apartment', name: 'nama_apartment', orderable: true, searchable: true, defaultContent: ''},
            {data: 'harga', name: 'harga', orderable: true, searchable: true, defaultContent: ''},
            {data: 'alamat', name: 'alamat', orderable: true, searchable: true, defaultContent: ''},
            {data: 'image', name: 'image', orderable: true, searchable: true, defaultContent: ''},
            {data: 'ukuran', name: 'ukuran', orderable: true, searchable: true, defaultContent: ''},
            {data: 'kamar_tidur', name: 'kamar_tidur', orderable: true, searchable: true, defaultContent: ''},
            {data: 'kamar_mandi', name: 'kamar_mandi', orderable: true, searchable: true, defaultContent: ''},
            {data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: ''},
        ],
        columnDefs: [
            {targets: 0, searchable: false, orderable: false},
        ],
    })

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
            var id = $('#idRoom').val();
                
            if (id == null || id == '') {
                var url = "{{ route('admin.room.save') }}";
            } else {
                var url = "{{ route('admin.room.update') }}";
            }

            $.ajax({
                type:'POST',
                url: url,
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
                    $('#nama_apartment').val();
                    $('#tipe').val();
                    $('#harga').val();
                    $('#alamat').val();
                    $('#image').val();
                    $('#ukuran').val();
                    $('#kamar_tidur').val();
                    $('#kamar_mandi').val();
                    table.ajax.reload();
                },
                error: function(data) {
                    Swal.fire({
                        title: `${data.title}`,
                        icon: `${data.status}`,
                        html: `${data.message}`,
                        timer: `${data.timer}`,
                        showConfirmButton: false,
                    });
                    $('#modalData').modal('hide');
                    table.ajax.reload();
                }
            });
        });

        $('.tipe').select2({
            ajax: {
                url: "{{ route('admin.room.apiTipe') }}",
                type: "GET",
                dataType: 'json',
                delay: 100,
                data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term,
                        };
                },
                processResults: function (response) {
                        return {
                            results: response
                        };
                },
                cache: true
            },
            placeholder: 'Pilih Tipe',
            allowClear: false
        });
    });

    function addData() {
        $('#modalData').off('click');  
        $('.nama_apartment').val('').attr('readonly', false);
        $('.tipe').html('').attr('disabled', false);
        $('.harga').val('').attr('readonly', false);
        $('.alamat').val('').attr('readonly', false);
        $('.image').val('').attr('readonly', false);
        $('.ukuran').val('').attr('readonly', false);
        $('.kamar_tidur').val('').attr('readonly', false);
        $('.kamar_mandi').val('').attr('readonly', false);
        $('#modal-title').text('Tambah Data Room');
        $('#save-room').show();
        $('#update-room').hide();
        $('#close-button').show();
    }

    function editData(id) {
        $('#imgLama2').html('');
        $.ajax({
            type: 'GET',
            url: '{{ route("admin.room.edit") }}',
            data: {
                id : id
            },
            success: function(data) {
                // console.log(data);
                $('#imgLama').show();
                $('#imgLama2').prepend(
                    `<img src='${data.dataRoom.image}' style='width:100px;'>`
                );
                $('#idRoom').val(id);
                $('.nama_apartment').attr('readonly', false).val(data.dataRoom.nama_apartment);
                $('.tipe').append($('<option>').val(data.dataRoom.tipe_id).text(data.dataTipe.nama_tipe)).attr('disabled', false).change();
                $('.harga').attr('readonly', false).val(data.dataRoom.harga);
                $('.alamat').attr('readonly', false).val(data.dataRoom.alamat);
                $('.ukuran').attr('readonly', false).val(data.dataRoom.ukuran);
                $('.kamar_tidur').attr('readonly', false).val(data.dataRoom.kamar_tidur);
                $('.kamar_mandi').attr('readonly', false).val(data.dataRoom.kamar_mandi);
                $('#modalData').modal({backdrop: 'static', keyboard: false});
                $('#modal-title').text('Perbarui Data Room ' + data.dataRoom.nama_apartment);
                $('#update-room').show();
                $('#save-room').hide();
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
            text: "Ingin menghapus data Room ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.room.delete") }}',
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