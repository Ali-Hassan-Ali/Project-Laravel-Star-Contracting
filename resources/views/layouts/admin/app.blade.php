<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <meta name="description" content="">

    <title>{{ config('app.name') }}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/main-teal.css') }}" media="all">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/font-awesome.min.css') }}">

    @if (app()->getLocale() == 'ar')

        {{--google font--}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo:400,600&display=swap">

        <style>
            body {
                font-family: 'cairo', 'sans-serif';
            }
            .breadcrumb-item + .breadcrumb-item {
                padding-left: .5rem;
            }

            .breadcrumb-item + .breadcrumb-item::before {
                padding-left: .5rem;
            }

            div.dataTables_wrapper div.dataTables_paginate ul.pagination {
                margin: 2px 2px;
            }
        </style>
    @endif

    {{--jquery--}}
    <script src="{{ asset('admin_assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery-ui.js') }}"></script>

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/noty/noty.css') }}">
    <script src="{{ asset('admin_assets/plugins/noty/noty.min.js') }}"></script>

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> --}}
  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    {{--datatable--}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('admin_assets/plugins/jquery.dataTables/jquery.dataTables.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('admin_assets/plugins/dataTables.bootstrap/dataTables.bootstrap.min.js') }}"></script>

    {{--magnific-popup--}}
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.2.0/css/rowGroup.dataTables.min.css">
    
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.2.0/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>

    <link rel="stylesheet" href="{{ asset('admin_assets/css/custom.css')}}">

    <style>
        @if (request()->segment(2) == 'reports')
            .dataTables_filter, .dataTables_info { display: none; }
        @endif
        .has-error .select2-selection {
            border-color: rgb(185, 74, 72) !important;
        }

        @if(request()->is('*report*'))
            /*.dataTables_info {
                display: none;
            }*/
        @endif

        .dataTables_filter {
            display: none;
        }
        .pb-2-1 {
            padding-bottom: 21px;
        }
        .app-sidebar::-webkit-scrollbar {
            width: 15px;
            height: 8px;
            background-color: #aaa; /* or add it to the track */
        }
        .bg-hover {
            background-color: #dee2e6;
        }

        .bg-danger-datatable {
            background-color: #e7081e33;
        }

        .table-bordered {
            border: 3px solid #dee2e6 !important;
        }
        td, th {
            text-align: center;
        }
        label, th, li {
            text-transform: capitalize;
        }

        .loader {
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        .loader-sm {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #009688;
            width: 40px;
            height: 40px;
        }

        .loader-md {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #009688;
            width: 90px;
            height: 90px;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="app sidebar-mini">

@include('layouts.admin._header')

@include('layouts.admin._aside')

<main class="app-content">

    @include('admin.partials._session')

    @yield('content')

    <div class="modal fade general-modal" id="add-brand" aria-labelledby="add-brand" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>

</main><!-- end of main -->

<!-- Essential javascripts for application to work-->
<script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>

{{-- font-awesome --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{--select 2--}}
<script type="text/javascript" src="{{ asset('admin_assets/plugins/select2/select2.min.js') }}"></script>

<script src="{{ asset('admin_assets/js/main.js') }}"></script>

{{--ckeditor--}}
<script src="{{ asset('admin_assets/plugins/ckeditor/ckeditor.js') }}"></script>

{{--magnific-popup--}}
<script src="{{ asset('admin_assets/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

{{--apex chart--}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

{{--custom--}}
<script src="{{ asset('admin_assets/js/custom/index.js?updated=20') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/js/custom/roles.js?updated=20') }}" type="text/javascript"></script>
{{--jquery number--}}
<script src="{{ asset('admin_assets/js/query.number.min.js') }}"></script>
{{-- <script src="{{ asset('admin_assets/js/custom/ajax.js?updated=20') }}" type="text/javascript"></script> --}}

<script>

    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('change', '#equipment-countrey', function(e) {
            e.preventDefault();
            
            var url    = $(this).find(':selected').data('url');
            var method = 'post';
            
            $.ajax({
                url: url,
                method: method,
                success: function (data) {
                    
                    $('#equipment-city').empty('');
                    $('#equipment-city').append(`<option selected disabled>Choose Site</option>`);

                    $.each(data, function(index,item) {

                        var html = `<option value="${item.id}">${item.name}</option>`;

                        $('#equipment-city').append(html);

                    });//end of each

                }//end of success
            });

        });//end of country


        $(document).on('change', '#equipment-city', function(e) {
            e.preventDefault();
            
            var id     = $(this).find(':selected').val();
            var url    = "/admin/ajax/city/"+id;
            var method = 'post';
            
            $.ajax({
                url: url,
                method: method,
                success: function (data) {
                    
                    $('#equipment-man').empty('');
                    $('#equipment-man').append(`<option disabled>Choose Equipment</option>`);

                    $.each(data, function(index,item) {
                        
                        var html = `<option value="${item.id}" data-type="${item.spec_name}">${item.make} ${item.name} ${item.plate_no}</option>`;

                        $('#equipment-man').append(html);

                    });//end of each

                }//end of success
            })

        });//end of countrey

        $(document).on('change', '.record__select', function () {
            $(this).closest('tr').toggleClass('bg-hover');
        });
    
        $('.app-menu__item, .treeview-item, .back-page').click(function(event) {
            event.preventDefault();
            
            var url = "{{ request()->segment(3) == 'create' || request()->segment(4) == 'edit' }}";
            var href = $(this).attr('href');
            if (url) {
                var n = new Noty({
                    text: "@lang('site.confirm')",
                    type: "alert",
                    killer: true,
                    buttons: [
                        Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                            document.location.href = href;
                            n.close();
                        }),
            
                        Noty.button("@lang('site.no')", 'btn btn-danger mr-2', function () {
                            n.close();
                        })
                    ]
                });
                n.show();
            } else {
                document.location.href = href;
            }//end of if
        });

        $(document).on('change', '.record__select-all', function () {
            $(this).closest('body').toggleClass('bg-hover');
        });

    });//end of ready

    $(document).ready(function () {

        //delete
        $(document).on('click', '.delete, #bulk-delete', function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "@lang('site.confirm_delete')",
                type: "alert",
                killer: true,
                buttons: [
                    Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                        let url = that.closest('form').attr('action');
                        let data = new FormData(that.closest('form').get(0));

                        let loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i>';
                        let originalText = that.html();
                        that.html(loadingText);

                        n.close();

                        $.ajax({
                            url: url,
                            data: data,
                            method: 'post',
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (response) {

                                $("#record__select-all").prop("checked", false);

                                $('.datatable').DataTable().ajax.reload();

                                new Noty({
                                    layout: 'topRight',
                                    type: 'alert',
                                    text: response,
                                    killer: true,
                                    timeout: 2000,
                                }).show();

                                that.html(originalText);
                            },

                        });//end of ajax call

                    }),

                    Noty.button("@lang('site.no')", 'btn btn-danger mr-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        });//end of delete

    });//end of document ready

    CKEDITOR.config.language = "{{ app()->getLocale() }}";

    //select 2
    $('.select2').select2({
        'width': '100%',
        'tags': true,
    });

    $('.select2-tags-false').select2({
        'width': '100%',
        'tags': false,
        'minimumResultsForSearch': Infinity
    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

</script>

@stack('scripts')

</body>
</html>