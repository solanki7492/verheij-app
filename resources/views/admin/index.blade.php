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
                            <h2 class="title-num text-black font-w600">{{ __('web.pricingManagement') }}</h2>
                            <span class="fs-14">{{ __('web.description') }}</span>
                        </div>
                        <ul class="col-6">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#settings" class="btn rounded me-3 mb-sm-0 mb-2 pull-right mt-0 mt-md-2" style="background:#6C757D; color:#fff;"><i class="flaticon-381-settings-1 scale5" aria-hidden="true"></i></a>
                            <a href="{{ route('users.index') }}" class="btn btn-dark rounded me-3 mb-sm-0 mb-2 pull-right mt-0 mt-md-2"><i class="fa fa-user me-3 scale5" aria-hidden="true"></i>{{ __('web.users') }}</a>
                            <!-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#aboutUsDetail" class="btn btn-info rounded me-3 mb-sm-0 mb-2 pull-right mt-0 mt-md-2"><i class="fa fa-plus me-3 scale5" aria-hidden="true"></i>{{ __('web.aboutUsDetail') }}</a> -->
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#aboutUs" class="btn btn-secondary rounded me-3 mb-sm-0 mb-2 pull-right mt-0 mt-md-2"><i class="fa fa-plus me-3 scale5" aria-hidden="true"></i>{{ __('web.aboutUs') }}</a>
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addProduct" class="btn btn-primary rounded me-3 mb-sm-0 mb-2 pull-right mt-0 mt-md-2"><i class="fa fa-plus me-3 scale5" aria-hidden="true"></i>{{ __('web.newProduct') }}</a>
                        </ul>
                    </div>
                    <div class="row">
                        <!-- Add Order -->
                        <div class="modal modal-lg fade" id="aboutUs">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('web.aboutUs') }}</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body custom-ekeditor">
                                        <div id="aboutUsEditor"></div>
                                        <div class="form-group mt-3">
                                            <button type="button" class="btn btn-primary" id="updateAboutUs">{{ __('web.save') }}</button>
                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('web.back') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="modal modal-lg fade" id="aboutUsDetail">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('web.aboutUsDetail') }}</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body custom-ekeditor">
                                        <div id="aboutUsDetailEditor"></div>
                                        <div class="form-group mt-3">
                                            <button type="button" class="btn btn-primary" id="updateAboutUsDetail">{{ __('web.save') }}</button>
                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('web.back') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="modal fade" id="addProduct">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('web.newProduct') }}</h5>
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
                                            <label class="text-black font-w500">{{ __('web.price') }}</label>
                                            <div class="input-group input-info">
                                                <div class="input-group-prepend" style="margin: 15px 0px 15px 0px;">
                                                    <span class="input-group-text" style="font-size: 25px;padding: 0;">&euro;</span>
                                                </div>
                                                <input type="number" step=".01" class="form-control" id="price" placeholder="{{ __('web.price') }}">
                                            </div>
                                            <small class="text-danger" id="priceError"></small>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary" id="storeProduct">{{ __('web.save') }}</button>
                                                <button type="reset" id="resetForm" class="btn btn-default" data-bs-dismiss="modal">{{ __('web.back') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="settings">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('web.settings') }}</h5>
                                        <button type="button" onclick="document.getElementById('settingForm').reset();" class="close" data-bs-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="settingForm">
                                            <div class="form-group">
                                                <label class="text-black font-w500">{{ __('web.phone') }}</label>
                                                <input type="text" class="form-control" id="contactPhone" placeholder="{{ __('web.phone') }}" value="{{ optional($settings)->phone }}">
                                                <small class="text-danger" id="contactPhoneError"></small>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-black font-w500">{{ __('web.whatsapp') }}</label>
                                                <input type="text" class="form-control" id="whatsapp" placeholder="{{ __('web.whatsapp') }}" value="{{ optional($settings)->whatsapp }}">
                                                <small class="text-danger" id="whatsappError"></small>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-black font-w500">{{ __('web.communicationEmail') }}</label>
                                                <input type="email" class="form-control" id="contactEmail" placeholder="{{ __('web.communicationEmail') }}" value="{{ optional($settings)->email }}">
                                                <small class="text-danger" id="contactEmailError"></small>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label class="text-black font-w500">{{ __('web.latitude') }}</label>
                                                    <input type="number" step=".01" class="form-control" id="latitude" placeholder="{{ __('web.latitude') }}" value="{{ optional($settings)->latitude }}">
                                                    <small class="text-danger" id="latitudeError"></small>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="text-black font-w500">{{ __('web.longitude') }}</label>
                                                    <input type="number" step=".01" class="form-control" id="longitude" placeholder="{{ __('web.longitude') }}" value="{{ optional($settings)->longitude }}">
                                                    <small class="text-danger" id="longitudeError"></small>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary" id="updateSettings">{{ __('web.saveSettings') }}</button>
                                                <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('web.back') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editProduct">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('web.editProduct') }}</h5>
                                        <button type="button" onclick="document.getElementById('editLinkForm').reset();" class="close" data-bs-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editLinkForm">
                                            <div class="form-group">
                                                <label class="text-black font-w500">{{ __('web.name') }}</label>
                                                <input type="text" class="form-control" id="nameEdit" placeholder="{{ __('web.name') }}">
                                                <small class="text-danger" id="nameEditError"></small>
                                            </div>
                                            <label class="text-black font-w500">{{ __('web.price') }}</label>
                                            <div class="input-group input-info">
                                                <div class="input-group-prepend" style="margin: 15px 0px 15px 0px;">
                                                    <span class="input-group-text" style="font-size: 25px;padding: 0;">&euro;</span>
                                                </div>
                                                <input type="number" step=".01" class="form-control" id="priceEdit" placeholder="{{ __('web.price') }}">
                                            </div>
                                            <small class="text-danger" id="priceEditError"></small>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary" id="updateLink">{{ __('web.edit') }}</button>
                                                <button type="reset" id="resetEditForm" class="btn btn-default" data-bs-dismiss="modal">{{ __('web.back') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div style="width: 100%; padding-left: -10px;">
                        <div class="table-responsive">
                            <table id="datatable" class="display" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>{{ __('web.name') }}</th>
                                    <th>{{ __('web.price') }}</th>
                                    <th>{{ __('web.updated') }}</th>
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
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3"><span class="fa fa-bell-o"></span> {{ __('web.sendNotification') }}</h3>
                    <form id="editLinkForm">
                        <div class="form-group">
                            <label class="text-black font-w500">{{ __('web.title') }}</label>
                            <input type="text" class="form-control" id="notificationTitle" placeholder="{{ __('web.titlePlaceholder') }}" value="{{ env('NOTIFICATION_TITLE') }}">
                            <small class="text-danger" id="notificationtitleError"></small>
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">{{ __('web.body') }}</label>
                            <textarea rows="10" class="form-control" id="notificationBody" placeholder="{{__("web.bodyPlaceholder")}}">{{ env('NOTIFICATION_BODY') }}</textarea>
                            <small class="text-danger" id="notificationbodyError"></small>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" style="min-width: 130px;" id="sendNotification">{{ __('web.send') }}</button>
                        </div>
                    </form>
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
        let editId = null;
        var aboutUsEditor, aboutUsDetailEditor;
        let sendText = "{{ __('web.send') }}";
        let loader = "<span class='fa fa-circle-o-notch fa-spin'></span>";
        $(document).on('click','.editProduct', function () {
            editId = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');
            price = price.replace(',', '.');

            $('#nameEdit').val(name);
            $('#priceEdit').val(price);
            $('#editProduct').modal('show');
        });

        function initializeCkeditor(selectorId, editorContent) {
            if(jQuery("#" + selectorId).length>0) {
                CKEDITOR.ClassicEditor.create(document.getElementById(selectorId), {
                    // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                    toolbar: {
                        items: [
                            'undo', 'redo',
                            'heading', '|',
                            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                            'bold', 'italic', 'strikethrough', 'underline', 'code', '|',
                            'findAndReplace', 'selectAll', '|',
                            'bulletedList', 'numberedList', 'todoList', '|',
                            'outdent', 'indent', '|',
                            'alignment', '|',
                            'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', '|',
                            'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                            'sourceEditing'
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    // Changing the language of the interface requires loading the language file using the <script> tag.
                    // language: 'es',
                    list: {
                        properties: {
                            styles: true,
                            startIndex: true,
                            reversed: true
                        }
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                        ]
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                    placeholder: '{{ __('web.aboutUs') }}',
                    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                    fontFamily: {
                        options: [
                            'default',
                            'Arial, Helvetica, sans-serif',
                            'Courier New, Courier, monospace',
                            'Georgia, serif',
                            'Lucida Sans Unicode, Lucida Grande, sans-serif',
                            'Tahoma, Geneva, sans-serif',
                            'Times New Roman, Times, serif',
                            'Trebuchet MS, Helvetica, sans-serif',
                            'Verdana, Geneva, sans-serif'
                        ],
                        supportAllValues: true
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                    fontSize: {
                        options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                        supportAllValues: true
                    },
                    // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                    htmlSupport: {
                        allow: [
                            {
                                name: /.*/,
                                attributes: true,
                                classes: true,
                                styles: true
                            }
                        ]
                    },
                    // Be careful with enabling previews
                    // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                    htmlEmbed: {
                        showPreviews: true
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                    link: {
                        decorators: {
                            addTargetToExternalLinks: true,
                            defaultProtocol: 'https://',
                            toggleDownloadable: {
                                mode: 'manual',
                                label: 'Downloadable',
                                attributes: {
                                    download: 'file'
                                }
                            }
                        }
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                    mention: {
                        feeds: [
                            {
                                marker: '@',
                                feed: [
                                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                    '@sugar', '@sweet', '@topping', '@wafer'
                                ],
                                minimumCharacters: 1
                            }
                        ]
                    },
                    // The "super-build" contains more premium features that require additional configuration, disable them below.
                    // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                    removePlugins: [
                        // These two are commercial, but you can try them out without registering to a trial.
                        // 'ExportPdf',
                        // 'ExportWord',
                        'AIAssistant',
                        'CKBox',
                        'CKFinder',
                        'EasyImage',
                        // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                        // Storing images as Base64 is usually a very bad idea.
                        // Replace it on production website with other solutions:
                        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                        // 'Base64UploadAdapter',
                        'RealTimeCollaborativeComments',
                        'RealTimeCollaborativeTrackChanges',
                        'RealTimeCollaborativeRevisionHistory',
                        'PresenceList',
                        'Comments',
                        'TrackChanges',
                        'TrackChangesData',
                        'RevisionHistory',
                        'Pagination',
                        'WProofreader',
                        // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                        // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                        'MathType',
                        // The following features are part of the Productivity Pack and require additional license.
                        'SlashCommand',
                        'Template',
                        'DocumentOutline',
                        'FormatPainter',
                        'TableOfContents',
                        'PasteFromOfficeEnhanced'
                    ]
                })
                .then( myEditor => {
                    if (selectorId == "aboutUsEditor") {
                        aboutUsEditor = myEditor; // Save for later use.
                        aboutUsEditor.setData(editorContent);
                    } else {
                        aboutUsDetailEditor = myEditor; // Save for later use.
                        aboutUsDetailEditor.setData(editorContent);
                    }

                })
                .catch( error => {
                    console.error( error );
                });
            }
        }

        initializeCkeditor('aboutUsEditor', '{!! $aboutText !!}');
        initializeCkeditor('aboutUsDetailEditor', '{!! $aboutDetailText !!}');

        $(document).on('click','#updateAboutUs', function () {
            const formData = new FormData();
            formData.append('text', aboutUsEditor.getData());
            formData.append('_token', "{{ csrf_token() }}");
            sendRequest("{{ route('aboutUs') }}", 'POST', aboutUsSuccess, formData);
        });

        $(document).on('click','#updateAboutUsDetail', function () {
            const formData = new FormData();
            formData.append('text', aboutUsDetailEditor.getData());
            formData.append('_token', "{{ csrf_token() }}");
            sendRequest("{{ route('aboutUsDetail') }}", 'POST', aboutUsDetailSuccess, formData);
        });

        function aboutUsSuccess(data) {
            $('#aboutUs').modal('hide');
        }

        function aboutUsDetailSuccess(data) {
            $('#aboutUsDetail').modal('hide');
        }

        $(document).on('click','#updateLink', function () {
            let name = $('#nameEdit').val();
            let price = $('#priceEdit').val();

            const formData = new FormData();
            formData.append('name', name);
            formData.append('_method', 'PATCH');
            formData.append('price', price);
            formData.append('_token', "{{ csrf_token() }}");

            let url = "{{ route('products.update', ":id") }}";
            url = url.replace(':id', editId);
            sendRequest(url, 'POST', loadDatatable, formData);
        });

        $(document).on('click','#storeProduct', function () {
            let name = $('#name').val();
            let price = $('#price').val();

            const formData = new FormData();
            formData.append('name', name);
            formData.append('price', price);
            formData.append('_token', "{{ csrf_token() }}");
            sendRequest("{{ route('products.store') }}", 'POST', loadDatatable, formData);
        });

        $(document).on('click','#updateSettings', function () {
            let contactPhone = $('#contactPhone').val();
            let whatsapp = $('#whatsapp').val();
            let contactEmail = $('#contactEmail').val();
            let latitude = $('#latitude').val();
            let longitude = $('#longitude').val();

            const formData = new FormData();
            formData.append('contactPhone', contactPhone);
            formData.append('whatsapp', whatsapp);
            formData.append('contactEmail', contactEmail);
            formData.append('latitude', latitude);
            formData.append('longitude', longitude);
            formData.append('_token', "{{ csrf_token() }}");
            sendRequest("{{ route('settings') }}", 'POST', resetForm, formData);
        });

        $(document).on('click','#sendNotification', function () {
            $(this).attr('disabled', true);
            $(this).html(loader);
            let title = $('#notificationTitle').val();
            let body = $('#notificationBody').val();

            const formData = new FormData();
            formData.append('title', title);
            formData.append('body', body);
            formData.append('_token', "{{ csrf_token() }}");
            sendRequest("{{ route('notify') }}", 'POST', notificationSent, formData);
        });

        function notificationSent(data) {
            toastr.success("{{ __('web.notifySuccessMessage') }}", "{{ __('web.notifySuccessTitle') }}", {
                timeOut: 500000000,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                positionClass: "toast-top-right",
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            });
            $('#sendNotification').attr('disabled', false);
            $('#sendNotification').html(sendText);
        }

        function loadDatatable(data) {
            resetForm();
            table.ajax.reload();
        }

        $(document).ready(function () {
            resetForm();
        });

        function resetForm() {
            $('#nameError').html('');
            $('#priceError').html('');
            $('#nameEditError').html('');
            $('#priceEditError').html('');
            $('#contactPhoneError').html('');
            $('#whatsappError').html('');
            $('#contactEmailError').html('');
            $('#latitudeError').html('');
            $('#longitudeError').html('');
            $('#resetForm').trigger('click');
            $('#resetEditForm').trigger('click');
            $('#settings').modal('hide');
        }

        "use strict";
        var table;
        // Hide alerts and errors of datatable
        $.fn.dataTable.ext.errMode = 'none';
        var KTDatatablesDataSourceAjaxServer = function () {

            var length = 100;
            var api_route = '{{ route('products.index') }}';

            var initTable1 = function () {

                table = $('#datatable').DataTable({
                    responsive: false,
                    searchDelay: 1000,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: api_route,
                        type: 'GET',
                        error: function (data) {
                            let message = data.responseJSON.message;
                            if (message) {
                                console.log(message);
                            }
                        }
                    },
                    columns: [
                        {data: 'name'},
                        {data: 'display_price', name: 'price'},
                        {data: 'updated_at'},
                        {
                            data: null,
                            responsivePriority: 100,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                return  '<div class="d-flex">'+
                                            '<a class="btn btn-primary shadow btn-xs sharp me-1 editProduct" data-bs-toggle="modal" data-bs-target="#editProduct" data-id="'+row.id+'" data-name="'+row.name+'" data-price="'+row.price+'" href="javascript:void(0);"><span class="fa fa-pencil"></span></a>'+
                                            '<a class="btn btn-danger shadow btn-xs sharp deleteProduct" data-id="'+row.id+'" href="javascript:void(0);"><span class="fa fa-trash"></span></a>' +
                                        '</div>';
                            },
                        }
                    ],
                    "aaSorting": [],
                    pageLength: length,
                    language: {
                        "lengthMenu": "{{ __('web.display') }} _MENU_ {{ __('web.entries') }}",
                        "zeroRecords": "{{ __('web.noProducts') }}",
                        "info": "{{ __('web.showingPage') }} _PAGE_ {{ __('web.of') }} _PAGES_",
                        "infoEmpty": "{{ __('web.noProducts') }}",
                        "infoFiltered": "({{ __('web.filterFrom') }} _MAX_ {{ __('web.entries') }})",
                        "search": "{{ __('web.search') }}",
                        "paginate": {
                            "first": "{{ __('web.first') }}",
                            "last": "{{ __('web.last') }}",
                            "next": "{{ __('web.next') }}",
                            "previous": "{{ __('web.previous') }}"
                        }
                    }
                });

                $('#searchContact').on('keyup', function () {
                    table.search($('#searchContact').val()).draw();
                });

            };

            return {

                //main function to initiate the module
                init: function () {
                    initTable1();
                }
            };
        }();

        jQuery(document).ready(function () {
            KTDatatablesDataSourceAjaxServer.init();
        });

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
                        }
                    } else {
                        $('#nameError').html('');
                        $('#priceError').html('');
                        $('#nameEditError').html('');
                        $('#priceEditError').html('');
                        $('#notificationtitleError').html('');
                        $('#notificationbodyError').html('');
                        $('#contactPhoneError').html('');
                        $('#whatsappError').html('');
                        $('#contactEmailError').html('');
                        $('#latitudeError').html('');
                        $('#longitudeError').html('');
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

        $(document).on('click', '.deleteProduct', function () {
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

                    let url = "{{ route('products.destroy', ":id") }}";
                    url = url.replace(':id', deleteId);
                    sendRequest(url, 'POST', loadDatatable, formData);
                }
            })
        });

        $('#addProduct').on('hidden.bs.modal', function (e) {
            resetForm();
        });

        $('#editProduct').on('hidden.bs.modal', function (e) {
            resetForm();
        });
    </script>
@endsection
