@extends('users.app')
@section('title')
Users
@endsection
@section('header')
@endsection
@section('iconHeader')
<i class="ik ik-user bg-icon"></i>
@endsection
@section('titleHeader')
Users
@endsection
@section('subtitleHeader')

@endsection
@section('breadcrumb')
Users
@endsection
@section('content-wrapper')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @cannot('user')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><i class="ik ik-plus-square" onclick="addUserPage()" data-toggle="modal" data-target="#demoModal"></i>Tambah Data</div>
                    @can('admin')
                    <div id="text-pdf" class="col-md-3">
                    <a class="btn btn-danger" style="color:white;text-align: -webkit-center;" onclick="exportPDF()" target="_blank">
                        <span>Export PDF</span>
                    </a>
                    </div>
                    <div id="loader-pdf" class="col-md-3 d-none">
                        <a class="btn btn-danger" style="color:white;text-align: -webkit-center;">
                            <div class="export-pdf-loader"></div>
                        </a>
                    </div>
                    <div id="download-pdf" class="col-md-3 d-none">
                        <a id="download-link" class="btn btn-danger" style="color:white;text-align: -webkit-center;" target="_blank">
                            <span>Download</span>
                        </a>
                    </div>
                    <div class="col-md-3"><a class="btn btn-success" style="color:white">Export Excel</a></div>
                    @endcan
                </div>
            </div>
        </div>
    @endcannot

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table class="table table-bordered" id="data-table" style="width: 102%">
                                <thead>
                                    <tr>
                                        {{-- <th style="width: 3%"></th> --}}
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        {{-- <td style="width: 3%"></td> --}}
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="demoModalLabel">User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="form-user" class="text-left border border-light p-5" action="{{route('users.store')}}" method="POST"
                            enctype="multipart/form-data" style="padding-bottom: 50px;">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group" id="email-form">
                                <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                    </span>
                                    <input type="text" class="form-control  " placeholder="Email" id="email" name="email"
                                        required>
                                </div>
                            </div>

                            <div class="form-group" id="password-form">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                    </span>
                                    <input type="password" class="form-control  " placeholder="Password" id="password"
                                        name="password" required>
                                </div>
                            </div>

                            <div class="form-group" id="name-form">
                                <label>Name</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                    </span>
                                    <input type="text" class="form-control  " placeholder="Name" id="name" name="name"
                                        required>
                                </div>
                            </div>

                            <div class="form-group" id="name-form">
                                <label>Biodata</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                    </span>
                                    <input type="text" class="form-control  " placeholder="Biodata" id="biodata" name="biodata"
                                        required>
                                </div>
                            </div>

                            <div class="form-group" id="name-form">
                                <label>Role</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                    </span>
                                    <select class="form-control select2" id="select_role" name="role">
                                        <option value="user">User</option>
                                        <option value="mod">Moderator</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="footer-buttons">
                                <br>
                                <div id="btn-loader" class="loader d-none"></div>

                                <div id="action-btn">
                                    <button id="user-btn-add" type="button" class="btn btn-primary" onclick="addUser()">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="stats-loader" class="row d-none" style="text-align: -webkit-center;margin-top:20px">
                    <div class="col-md-12">
                        <div class="loader"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection
@section('footer')

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>


<script>
    $(document).ready(function (){
        checkPDF();
    })

</script>

<script type="text/javascript">
var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "initComplete": function (settings, json) {
                $("#data-table").wrap(
                    "<div class='scroll' style='overflow:auto; width:100%;position:relative;padding-left:20px;padding-bottom:20px'></div>"
                );
            },
            ajax: "{{ route('users.index') }}",
            columns: [
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'role',
                    name: 'role'
                },

            ]
        });

    $(document).ready(function () {
        $('#data-table tfoot th').each(function () {
            var title = $('#data-table thead th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title +
                '" />');
        });

        $('tfoot').each(function () {
            $(this).insertAfter($(this).siblings('thead'));
        });

        table.columns().eq(0).each(function (colIdx) {
            $('input', table.column(colIdx).footer()).on('keyup change', function () {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });

    });

</script>

<script>
    function addUserPage()
    {
        let html = `<button id="user-btn-add" type="button" class="btn btn-primary" onclick="addUser()">Tambah</button>`
        $('#action-btn').html(html)
        $('#password').prop('disabled', false)
        $('#email').val('')
        $('#email').prop('disabled', false)
        $('#name').val('')
        $('#name').prop('disabled', false)
        $('#biodata').val('')
        $('#biodata').prop('disabled', false)
        $('#select_role').prop('disabled', false)
        $('#select_role').val('user').change()
    }

    function editUserPage(id, email, name, biodata, role)
    {
        let html = `<button id="user-btn-edit" type="button" class="btn btn-success" onclick="updateUser()">Update</button>`
        $('#action-btn').html(html)
        $('#password').prop('disabled', false)
        $('#id').val(id)
        $('#email').val(email)
        $('#email').prop('disabled', false)
        $('#name').val(name)
        $('#name').prop('disabled', false)
        $('#biodata').val(biodata)
        $('#biodata').prop('disabled', false)
        $('#select_role').prop('disabled', false)
        $('#select_role').val(role).change()
    }

    function deleteUserPage(id, email, name, biodata, role)
    {
        let html = `<button id="user-btn-delete" type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>`
        $('#action-btn').html(html)
        $('#password').prop('disabled', true)
        $('#id').val(id)
        $('#email').val(email)
        $('#email').prop('disabled', true)
        $('#name').val(name)
        $('#name').prop('disabled', true)
        $('#biodata').val(biodata)
        $('#biodata').prop('disabled', true)
        $('#select_role').val(role).change()
        $('#select_role').prop('disabled', true)
    }

    function viewUserPage(id, email, name, biodata, role)
    {
        let html = `<button id="user-btn-edit" type="button" class="btn btn-success" onclick="updateUser()">Update</button>`
        $('#action-btn').html(html)
        $('#password').prop('disabled', false)
        $('#email').val(email)
        $('#email').prop('disabled', false)
        $('#name').val(name)
        $('#name').prop('disabled', false)
        $('#biodata').val(biodata)
        $('#biodata').prop('disabled', false)
        $('#select_role').prop('disabled', false)
        $('#select_role').val(role).change()
    }

</script>


<script>

    function addUser()
    {
        $('#btn-loader').removeClass('d-none')
        $('#user-btn-add').addClass('d-none')

        $.ajax({
            url : '{{route('users.store')}}',
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': `{{ csrf_token() }}`
            },
            data: {
                'email': $('#email').val(),
                'name': $('#name').val(),
                'password': $('#password').val(),
                'role': $('#select_role').val(),
                'biodata': $('#biodata').val(),
            },
            statusCode: {
                500: function(response) {
                    console.log(response)
                    $.toast({
                        heading: 'Error',
                        text: 'Pastikan data sudah diisi semua dan tidak ada yang kosong',
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'bottom-right'
                    })
                    $('#btn-loader').addClass('d-none')
                    $('#user-btn-add').removeClass('d-none')
                },
            },
            success: function(data) {
                $('#demoModal').modal('hide');
                $("#form-user")[0].reset()
                $('#btn-loader').addClass('d-none')
                $('#user-btn-add').removeClass('d-none')
                $.toast({
                    heading: 'User Ditambahkan',
                    text: 'Data user berhasil ditambahkan',
                    position: 'bottom-right',
                    icon: 'success',
                    stack: false,
                    loaderBg: '#f96868'
                })
                table.ajax.reload()
            }
        })
    }

    function updateUser()
    {
        $('#btn-loader').removeClass('d-none')
        $('#user-btn-edit').addClass('d-none')

        $.ajax({
            url : '{{route('users.update','"id"')}}',
            type: "PUT",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': `{{ csrf_token() }}`
            },
            data: {
                'id': $('#id').val(),
                'email': $('#email').val(),
                'name': $('#name').val(),
                'password': $('#password').val(),
                'role': $('#select_role').val(),
                'biodata': $('#biodata').val(),
            },
            statusCode: {
                500: function(response) {
                    console.log(response)
                    $.toast({
                        heading: 'Error',
                        text: 'Pastikan data sudah diisi semua dan tidak ada yang kosong',
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'bottom-right'
                    })
                    $('#btn-loader').addClass('d-none')
                    $('#user-btn-add').removeClass('d-none')
                },
            },
            success: function(data) {
                $('#demoModal').modal('hide');
                $("#form-user")[0].reset()
                $('#btn-loader').addClass('d-none')
                $('#user-btn-edit').removeClass('d-none')
                $.toast({
                    heading: 'User Diperbarui',
                    text: 'Data user berhasil diperbarui',
                    position: 'bottom-right',
                    icon: 'success',
                    stack: false,
                    loaderBg: '#f96868'
                })
                table.ajax.reload()
            }
        })
    }

    function deleteUser()
    {
        $('#btn-loader').removeClass('d-none')
        $('#user-btn-delete').addClass('d-none')

        $.ajax({
            url : '{{route('users.destroy','"id"')}}',
            type: "DELETE",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': `{{ csrf_token() }}`
            },
            data: {
                'id': $('#id').val(),
            },
            success: function(data) {
                $('#demoModal').modal('hide');
                $("#form-user")[0].reset()
                $('#btn-loader').addClass('d-none')
                $('#user-btn-delete').removeClass('d-none')
                $.toast({
                    heading: 'User Dihapus',
                    text: 'Data user berhasil dihapus',
                    position: 'bottom-right',
                    icon: 'success',
                    stack: false,
                    loaderBg: '#f96868'
                })
                table.ajax.reload()
            }
        })
    }
</script>

<script>
    function exportPDF(){
        $('#loader-pdf').removeClass('d-none')
        $('#text-pdf').addClass('d-none')
        $.ajax({
            url : '{{route('exportPDF')}}',
            type: "GET",
            dataType: "json",
            statusCode: {
                500: function(response) {
                    console.log(response)
                    $.toast({
                        heading: 'Error',
                        text: 'Data tidak dapat diexport',
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'bottom-right'
                    })
                    $('#loader-pdf').addClass('d-none')
                    $('#text-pdf').removeClass('d-none')
                },
            },
            success: function(data) {
                $('#loader-pdf').addClass('d-none')
                $('#text-pdf').removeClass('d-none')
                $.toast({
                    heading: 'PDF Exported',
                    text: 'Data user berhasil diexport sebagai PDF',
                    position: 'bottom-right',
                    icon: 'success',
                    stack: false,
                    loaderBg: '#f96868'
                })
            }
        })
    }

    function checkPDF(){
        $('#loader-pdf').removeClass('d-none')
        $('#text-pdf').addClass('d-none')
        $.ajax({
            url : '{{route('checkPDF')}}',
            type: "GET",
            dataType: "json",
            statusCode: {
                500: function(response) {
                    $('#loader-pdf').addClass('d-none')
                    $('#text-pdf').removeClass('d-none')
                },
            },
            success: function(data) {
                if(data.exist == true)
                {
                    $('#loader-pdf').addClass('d-none')
                    $('#text-pdf').addClass('d-none')
                    $('#download-pdf').removeClass('d-none')
                    $.toast({
                        heading: 'PDF Exported',
                        text: 'Data user berhasil diexport sebagai PDF',
                        position: 'bottom-right',
                        icon: 'success',
                        stack: false,
                        loaderBg: '#f96868'
                    })
                    var base_url = "{{ url('/') }}" + "/" + data.path;
                    console.log(base_url);
                    $('#download-link').attr("href", base_url)
                }else{
                    $('#loader-pdf').removeClass('d-none')
                    $('#text-pdf').addClass('d-none')
                }
            }
        })
    }
</script>

@endsection
