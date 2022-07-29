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
                <i class="ik ik-plus-square" onclick="addUserPage()" data-toggle="modal" data-target="#demoModal"></i>Tambah Data
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
                                        <th style="width: 3%"></th>
                                        <th>Email</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td style="width: 3%"></td>
                                        <th>Email</th>
                                        <th>Nama</th>
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
                                <label>Nama</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                    </span>
                                    <input type="text" class="form-control  " placeholder="Nama" id="name" name="name"
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
<script src="{{ url('assets/admin/dynamictable/dynamitable.jquery.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

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
            columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'name',
                    name: 'name'
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
        let html = `<button id="user-btn-edit" type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>`
        $('#action-btn').html(html)
        $('#password').prop('disabled', true)
        $('#email').val(email)
        $('#email').prop('disabled', true)
        $('#name').val(name)
        $('#name').prop('disabled', true)
        $('#biodata').val(biodata)
        $('#biodata').prop('disabled', true)
        $('#select_role').val(role).change()
        $('#select_role').prop('disabled', true)
    }

</script>

@endsection