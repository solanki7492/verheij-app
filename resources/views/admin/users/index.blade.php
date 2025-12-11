@extends('admin.layout.app')

@section('pageTitle', __('web.pricingManagement'))

@section('styles')
    <!-- Datatable -->
    <link href="{{ asset('dash/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Summernote -->
    <link href="{{ asset('dash/vendor/summernote/summernote.css') }}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    {{-- <link href="{{ asset('dash/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('dash/vendor/toastr/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dash/css/style.css') }}" rel="stylesheet">
    <style>
        .custom{
            border-radius: 22px;
        }
        .arrow-image{
            width: 300px;
            position: absolute;
            right: 110px;
            top: -40px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col-6 pe-3 mb-md-0 mb-3">
                            <h2 class="title-num text-black font-w600">{{ __('web.users') }}</h2>
                        </div>
                        <ul class="col-6">
                            <a href="{{ route('users.index') }}" data-bs-toggle="modal" data-bs-target="#addUser" class="btn btn-primary rounded me-3 mb-sm-0 mb-2 pull-right"><i class="fa fa-plus me-3 scale5" aria-hidden="true"></i>{{ __('web.addUser') }}</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div style="width: 100%; padding-left: -10px;">
                        <div class="table-responsive">
                            <table id="datatable" class="display" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>{{ __('web.id') }}</th>
                                    <th>{{ __('web.name') }}</th>
                                    <th>{{ __('web.email') }}</th>
                                    <th>{{ __('web.role') }}</th>
                                    <th>{{ __('web.createdAt') }}</th>
                                    <th>{{ __('web.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addUser">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('web.newUser') }}</h5>
                    <button type="button" onclick="document.getElementById('linkForm').reset();" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="linkForm">
                        <div class="form-group">
                            <label class="text-black font-w500">{{ __('web.name') }}</label>
                            <input type="text" class="form-control" id="name" placeholder="{{ __('web.name') }}">
                            <small class="text-danger" id="nameError"></small>
                        </div>
                        <div class="form-group">
                           <label class="text-black font-w500">{{ __('web.email') }}</label>
                            <input type="email" class="form-control" id="email" placeholder="{{ __('web.email') }}">
                            <small class="text-danger" id="emailError"></small>
                        </div>
                        <small class="text-danger" id="emailError"></small>
                        <div class="form-group">
                            <label class="text-black font-w500">{{ __('web.password') }}</label>
                            <input type="password" class="form-control" id="password" placeholder="{{ __('web.password') }}">
                            <small class="text-danger" id="passwordError"></small>
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">{{ __('web.role') }}</label>
                            <select class="form-control" id="role">
                                <option value="1">Admin</option>
                                <option value="2">API User</option>
                            </select>
                            <small class="text-danger" id="roleError"></small>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="storeUser">{{ __('web.save') }}</button>
                            <button type="reset" id="resetForm" class="btn btn-default" data-bs-dismiss="modal">{{ __('web.back') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editUser">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('web.editUser') }}</h5>
                    <button type="button" onclick="document.getElementById('editUserForm').reset();" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <div class="form-group">
                            <label class="text-black font-w500">{{ __('web.name') }}</label>
                            <input type="text" class="form-control" id="nameEdit" placeholder="{{ __('web.name') }}">
                            <small class="text-danger" id="nameEditError"></small>
                        </div>
                        <div class="form-group">
                           <label class="text-black font-w500">{{ __('web.email') }}</label>
                            <input type="email" class="form-control" id="emailEdit" placeholder="{{ __('web.email') }}">
                            <small class="text-danger" id="emailEditError"></small>
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">{{ __('web.password') }}</label>
                            <input type="password" class="form-control" id="passwordEdit" placeholder="{{ __('web.password') }}">
                            <small class="text-danger" id="passwordEditError"></small>
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">{{ __('web.role') }}</label>
                            <select class="form-control" id="roleEdit">
                                <option value="1">Admin</option>
                                <option value="2">API User</option>
                            </select>
                            <small class="text-danger" id="roleEditError"></small>
                        </div>
                        <small class="text-danger" id="priceEditError"></small>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="updateUser">{{ __('web.edit') }}</button>
                            <button type="reset" id="resetEditForm" class="btn btn-default" data-bs-dismiss="modal">{{ __('web.back') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="successCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('web.successTitle') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('web.close') }}"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0" id="successCreateMessage">{{ __('web.successMessage') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('web.ok') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Datatable -->
    <script src="{{ asset('dash/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dash/vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/super-build/ckeditor.js"></script>

    <script>

        $(document).on('click','.editUser', function () {
            editId = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let password = $(this).data('password');
            let role = $(this).data('role');

            $('#nameEdit').val(name);
            $('#emailEdit').val(email);
            $('#passwordEdit').val(password);
            // set select value and trigger change (handles string/number)
            // set select value and trigger change (handles string/number and missing option)
            var selVal = (role === 'Admin') ? 1 : 2;
            if ($('#roleEdit option[value="' + selVal + '"]').length) {
                $('#roleEdit').val(selVal).trigger('change');
            } else {
                // fallback to first option if provided value doesn't exist
                $('#roleEdit').val($('#roleEdit option:first').val()).trigger('change');
            }
            $('#editUser').modal('show');
        });

        var table;
        $(document).ready(function () {
            table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.list') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: null,
                        responsivePriority: 100,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return  '<div class="d-flex">'+
                                        '<a class="btn btn-primary shadow btn-xs sharp me-1 editUser" data-bs-toggle="modal" data-bs-target="#editUser" data-id="'+row.id+'" data-name="'+row.name+'" data-email="'+row.email+'" data-role="'+row.role+'" href="javascript:void(0);"><span class="fa fa-pencil"></span></a>'+
                                        '<a class="btn btn-danger shadow btn-xs sharp deleteUser" data-id="'+row.id+'" href="javascript:void(0);"><span class="fa fa-trash"></span></a>' +
                                    '</div>';
                        },
                    }
                    
                ]
            });
        });
        $(document).on('click','#storeUser', function () {
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let role = $('#role').val();

            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('role', role);
            formData.append('_token', "{{ csrf_token() }}");
            sendRequest("{{ route('users.store') }}", 'POST', loadDatatable, formData);
        });

        function loadDatatable(data) {
            resetForm();
            table.ajax.reload();
        }

        function resetForm() {
            $('#nameError').html('');
            $('#emailError').html('');
            $('#nameEditError').html('');
            $('#emailEditError').html('');
        }

        function sendRequest(url,method,callback, formData = new FormData) {
            let xhr = new XMLHttpRequest();
            xhr.open(method, url+'?ajax=true', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200 || xhr.status === 201) {
                        let data = JSON.parse(xhr.responseText);
                        if (callback && typeof callback === 'function') {
                            // Call the provided callback function with the parsed data
                            callback(data);
                            $('#addUser').modal('hide');
                            $('#editUser').modal('hide');
                            $('#successCreateModal').modal('show');
                        }
                    } else {
                        $('#nameError').html('');
                        $('#emailError').html('');
                        $('#passwordError').html('');
                        $('#roleError').html('');
                        $('#nameEditError').html('');
                        $('#emailEditError').html('');
                        $('#passwordEditError').html('');
                        $('#roleEditError').html('');
                        let data = JSON.parse(xhr.responseText);
                        $.each(data.errors, function (i, v) {
                            $.each(data.errors, function (i, v) {
                                $('#'+i+'Error').html(v);
                                $('#'+i+'EditError').html(v);
                                $('#notification'+i+'Error').html(v);
                            });
                        });
                    }
                }
            };
            xhr.send(formData);
        }

        $(document).on('click','#updateUser', function () {
            let name = $('#nameEdit').val();
            let email = $('#emailEdit').val();
            let role = $('#roleEdit').val();
            let password = $('#passwordEdit').val();

            const formData = new FormData();
            formData.append('name', name);
            formData.append('_method', 'POST');
            formData.append('email', email);
            formData.append('role', role);
            formData.append('password', password);
            formData.append('_token', "{{ csrf_token() }}");

            let url = "{{ route('users.update', ":id") }}";
            url = url.replace(':id', editId);
            sendRequest(url, 'POST', loadDatatable, formData);
        });

        $(document).on('click', '.deleteUser', function () {
            let deleteId = $(this).data('id');
            Swal.fire({
                title: '{{ __('web.areYouSure') }}',
                text: "{{ __('web.revert') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('web.deleteIt') }}',
                cancelButtonText: '{{ __('web.back') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('_method', 'DELETE');
                    formData.append('_token', "{{ csrf_token() }}");

                    let url = "{{ route('users.destroy', ":id") }}";
                    url = url.replace(':id', deleteId);
                    sendRequest(url, 'POST', loadDatatable, formData);
                }
            })
        });

        $('#addUser').on('hidden.bs.modal', function (e) {
            resetForm();
        });
    </script>
@endsection
