<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" direction="rtl" dir="rtl" style="direction: rtl">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Advice') . (isset($pageTitle) ? " - $pageTitle" : '') }}</title>
    <meta name="description" content="{{config('app.desc', 'advice')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    @yield('styles')
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <style>
        .m-alert button {
            right: auto !important;
            left: 10px !important;
        }

        .m-bootstrap-select-table {
            position: absolute;
            width: 146px !important;
            margin-top: -12px;
        }

        input[type=number] {
            direction: ltr;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }

        /* webkit solution */
        ::-webkit-input-placeholder {
            text-align: right;
            direction: rtl;
        }

        /* mozilla solution */
        input:-moz-placeholder {
            text-align: right;
            direction: rtl;
        }

        .table-responsive {
            overflow-y: visible !important;
        }

        table.media-table td {
            padding: 3px
        }
        table.media-table th {
            padding: 3px;
            color: #000000 !important;
            background-color: #efefef
        }

        .hide-media .uploadMedia {
            display: none
        }

        .hide-resource .uploadResource {
            display: none
        }

        .table.table-vertical-center th, .table.table-vertical-center td {
            text-align: center;
        }

        .dropzone-img {
            height: 50px;
            max-width: 30px;
        }
        .dropzone-img:hover {
            position: absolute;
            transform: scale(10);
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<!--begin::Body-->

<body id="kt_body"
    class="header-mobile-fixed subheader-enabled aside-enabled aside-fixed aside-secondary-disabled page-loading">

    @include('layouts.partial.quickUser')
    <!--begin::Main-->


    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile ">

        <!--begin::Logo-->
        <a href="index.html">
            <img alt="Logo" src="{{asset('assets/media/logos/logo-letter-2.png')}}" class="logo-default max-h-30px" />
        </a>

        <!--end::Logo-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
        </div>

        <!--end::Toolbar-->
    </div>

    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">

        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">

            @include('layouts.partial.aside')

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                <!--begin::Content-->
                <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                    @include('layouts.partial.subheader')

                    @include('layouts.partial.content')
                </div>

                <!--end::Content-->

                {{--  @include('layouts.partial.footer')  --}}
            </div>

            <!--end::Wrapper-->
        </div>

        <!--end::Page-->
    </div>

    <!--end::Main-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">

            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path
                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                        fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>

            <!--end::Svg Icon--></span></div>

    <!--end::Scrolltop-->

    <div class="modal fade" id="uploadModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('admin.global.upload')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        function makeid(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
               result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
         }
        function openDropZoneModal(thisObj) {
            var type = $(thisObj).attr('data-type');
            var id = $(thisObj).attr('data-id');
            console.log(thisObj);
            if(id === 'noid') {
                id = makeid(30);
                id = new Date().getTime() + id;
                $(thisObj).next('input[type=hidden]').val(id);
                $(thisObj).attr('data-id', id);
            }
            var url = "{{route('admin.dropzone.index',['type'=>'__type__', 'id'=>'__id__'])}}";
            url = url.replace('__type__', type).replace('__id__', id);
            $.ajax({
                url: url,
                type: 'get',
                success: function(response){
                    // Add response in Modal body
                    $('.modal-body').html(response);

                    // Display Modal
                    $('#uploadModal').modal('show');
                }
            });
        }
        var KTAppSettings = {
				"breakpoints": {
					"sm": 576,
					"md": 768,
					"lg": 992,
					"xl": 1200,
					"xxl": 1200
				},
				"colors": {
					"theme": {
						"base": {
							"white": "#ffffff",
							"primary": "#1BC5BD",
							"secondary": "#E5EAEE",
							"success": "#1BC5BD",
							"info": "#6993FF",
							"warning": "#FFA800",
							"danger": "#F64E60",
							"light": "#F3F6F9",
							"dark": "#212121"
						},
						"light": {
							"white": "#ffffff",
							"primary": "#1BC5BD",
							"secondary": "#ECF0F3",
							"success": "#C9F7F5",
							"info": "#E1E9FF",
							"warning": "#FFF4DE",
							"danger": "#FFE2E5",
							"light": "#F3F6F9",
							"dark": "#D6D6E0"
						},
						"inverse": {
							"white": "#ffffff",
							"primary": "#ffffff",
							"secondary": "#212121",
							"success": "#ffffff",
							"info": "#ffffff",
							"warning": "#ffffff",
							"danger": "#ffffff",
							"light": "#464E5F",
							"dark": "#ffffff"
						}
					},
					"gray": {
						"gray-100": "#F3F6F9",
						"gray-200": "#ECF0F3",
						"gray-300": "#E5EAEE",
						"gray-400": "#D6D6E0",
						"gray-500": "#B5B5C3",
						"gray-600": "#80808F",
						"gray-700": "#464E5F",
						"gray-800": "#1B283F",
						"gray-900": "#212121"
					}
				},
				"font-family": "IRANSans"
			};
    </script>

    <!--end::Global Config-->

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>

    <!--end::Global Theme Bundle-->

    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>

    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="{{asset('assets/js/pages/widgets.js')}}"></script>


    @yield('scripts')

    @if(session('success'))
    <script>
        jQuery(document).ready(function () {
                $.notify({
                    message: "{{ session()->get('success') }}",
                }, {
                    timer: 500,
                    type: 'success',
                    delay: 5000,
                    placement: {
                        from: 'bottom',
                        align: 'left',
                    },
                    animate: {
                        enter: "animated " + 'bounceInRight',
                    },
                    allow_dismiss: true,
                    newest_on_top: true,
                    mouse_over: true,
                });
            });
    </script>
    @endif
    <!--end::Page Scripts-->
</body>

<!--end::Body-->

</html>
