<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Te Sanandum, The Ibiza Boho Lifestyle</title>
    <meta name="description" content="Te Sanandum, The Ibiza Boho Lifestyle is a Spain based Spiritual and etnical Marketplace were people can buy and sell physical and digital goods all over the world. Yoga, Boho, Jewelry, Services, Meditation, Reiki, Crystals, Gongs, Incense and much more. Join us and take your business to a new level">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
{{--    <meta property="og:title" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework">--}}
{{--    <meta property="og:site_name" content="OneUI">--}}
{{--    <meta property="og:description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">--}}
{{--    <meta property="og:type" content="website">--}}
{{--    <meta property="og:url" content="">--}}
{{--    <meta property="og:image" content="">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{asset('assets/media/favicons/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/media/favicons/apple-touch-icon-180x180.png')}}">
    <!-- END Icons -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
    <!-- Stylesheets -->
    <!-- Fonts and OneUI framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
    <link rel="stylesheet" id="css-main" href="{{asset('assets/css/oneui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/select2/css/select2.min.css')}}">
    <script src="https://js.stripe.com/v3/"></script>

    <link rel="stylesheet" href="{{asset('dropzone-5.7.0/dist/dropzone.css')}}">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{asset('assets/js/plugins/flatpickr/flatpickr.css')}}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@yield('styles')
    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
    <!-- END Stylesheets -->

    <!-- GTranslate: https://gtranslate.io/ -->
    <style type="text/css">
        .switcher {font-family:Arial;font-size:10pt;text-align:left;cursor:pointer;overflow:hidden;width:163px;line-height:17px;}
        .switcher a {text-decoration:none;display:block;font-size:10pt;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;}
        .switcher a img {vertical-align:middle;display:inline;border:0;padding:0;margin:0;opacity:0.8;}
        .switcher a:hover img {opacity:1;}
        .switcher .selected {background:#FFFFFF url(//gtranslate.io/shopify/assets/switcher.png) repeat-x;position:relative;z-index:9999;}
        .switcher .selected a {border:1px solid #CCCCCC;background:url(//gtranslate.io/shopify/assets/arrow_down.png) 146px center no-repeat;color:#666666;padding:3px 5px;width:151px;}
        .switcher .selected a.open {background-image:url(//gtranslate.io/shopify/assets/arrow_up.png)}
        .switcher .selected a:hover {background:#F0F0F0 url(//gtranslate.io/shopify/assets/arrow_down.png) 146px center no-repeat;}
        .switcher .option {position:relative;z-index:9998;border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;background-color:#EEEEEE;display:none;width:161px;max-height:198px;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;overflow-y:auto;overflow-x:hidden;}
        .switcher .option a {color:#000;padding:3px 5px;}
        .switcher .option a:hover {background:#FFC;}
        .switcher .option a.selected {background:#FFC;}
        #selected_lang_name {float: none;}
        .l_name {float: none !important;margin: 0;}
        .switcher .option::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 3px rgba(0,0,0,0.3);border-radius:5px;background-color:#F5F5F5;}
        .switcher .option::-webkit-scrollbar {width:5px;}
        .switcher .option::-webkit-scrollbar-thumb {border-radius:5px;-webkit-box-shadow: inset 0 0 3px rgba(0,0,0,.3);background-color:#888;}
    </style>
</head>

<body>
<!-- Page Container -->
<!--
    Available classes for #page-container:

GENERIC

    'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

SIDEBAR & SIDE OVERLAY

    'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
    'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
    'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
    'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
    'sidebar-dark'                              Dark themed sidebar

    'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
    'side-overlay-o'                            Visible Side Overlay by default

    'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

    'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

HEADER

    ''                                          Static Header if no class is added
    'page-header-fixed'                         Fixed Header

HEADER STYLE

    ''                                          Light themed Header
    'page-header-dark'                          Dark themed Header

MAIN CONTENT LAYOUT

    ''                                          Full width Main Content if no class is added
    'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
    'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
-->
<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">

@section('header')
    <!-- Side Overlay-->
        <aside id="side-overlay" class="font-size-sm">
            <!-- Side Header -->
            <div class="content-header border-bottom">
                <!-- User Avatar -->
                <a class="img-link mr-1" href="javascript:void(0)">
                    <img class="img-avatar img-avatar32" src="{{ asset('assets/media/avatars/avatar10.jpg') }}" alt="">
                </a>
                <!-- END User Avatar -->

                <!-- User Info -->
                <div class="ml-2">
                    <a class="link-fx text-dark font-w600" href="javascript:void(0)">Adam McCoy</a>
                </div>
                <!-- END User Info -->

                <!-- Close Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="ml-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                    <i class="fa fa-fw fa-times text-danger"></i>
                </a>
                <!-- END Close Side Overlay -->
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="content-side">
                <!-- Side Overlay Tabs -->
                <div class="block block-transparent pull-x pull-t">
                    <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#so-overview">
                                <i class="fa fa-fw fa-coffee text-gray mr-1"></i> Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#so-sales">
                                <i class="fa fa-fw fa-chart-line text-gray mr-1"></i> Sales
                            </a>
                        </li>
                    </ul>
                    <div class="block-content tab-content overflow-hidden">
                        <!-- Overview Tab -->
                        <div class="tab-pane pull-x fade fade-left show active" id="so-overview" role="tabpanel">
                            <!-- Activity -->
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Recent Activity</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <!-- Activity List -->
                                    <ul class="nav-items mb-0">
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="si si-wallet text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">New sale ($15)</div>
                                                    <div class="text-success">Admin Template</div>
                                                    <small class="text-muted">3 min ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="si si-pencil text-info"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">You edited the file</div>
                                                    <div class="text-info">
                                                        <i class="fa fa-file-text"></i> Documentation.doc
                                                    </div>
                                                    <small class="text-muted">15 min ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="si si-close text-danger"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">Project deleted</div>
                                                    <div class="text-danger">Line Icon Set</div>
                                                    <small class="text-muted">4 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- END Activity List -->
                                </div>
                            </div>
                            <!-- END Activity -->

                            <!-- Online Friends -->
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Online Friends</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <!-- Users Navigation -->
                                    <ul class="nav-items mb-0">
                                        <li>
                                            <a class="media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar7.jpg" alt="">
                                                    <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">Marie Duncan</div>
                                                    <div class="font-w400 text-muted">Copywriter</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar14.jpg" alt="">
                                                    <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">Adam McCoy</div>
                                                    <div class="font-w400 text-muted">Web Developer</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar6.jpg" alt="">
                                                    <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">Betty Kelley</div>
                                                    <div class="font-w400 text-muted">Web Designer</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar4.jpg" alt="">
                                                    <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-warning"></span>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">Marie Duncan</div>
                                                    <div class="font-w400 text-muted">Photographer</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar9.jpg" alt="">
                                                    <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-warning"></span>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">Jesse Fisher</div>
                                                    <div class="font-w400 text-muted">Graphic Designer</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- END Users Navigation -->
                                </div>
                            </div>
                            <!-- END Online Friends -->

                            <!-- Quick Settings -->
                            <div class="block mb-0">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Quick Settings</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <!-- Quick Settings Form -->
                                    <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                                        <div class="form-group">
                                            <p class="font-w600 mb-2">
                                                Online Status
                                            </p>
                                            <div class="custom-control custom-switch mb-1">
                                                <input type="checkbox" class="custom-control-input" id="so-settings-check1" name="so-settings-check1" checked>
                                                <label class="custom-control-label" for="so-settings-check1">Show your status to all</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <p class="font-w600 mb-2">
                                                Auto Updates
                                            </p>
                                            <div class="custom-control custom-switch mb-1">
                                                <input type="checkbox" class="custom-control-input" id="so-settings-check2" name="so-settings-check2" checked>
                                                <label class="custom-control-label" for="so-settings-check2">Keep up to date</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <p class="font-w600 mb-1">
                                                Application Alerts
                                            </p>
                                            <div class="custom-control custom-switch mb-1">
                                                <input type="checkbox" class="custom-control-input" id="so-settings-check3" name="so-settings-check3" checked>
                                                <label class="custom-control-label" for="so-settings-check3">Email Notifications</label>
                                            </div>
                                            <div class="custom-control custom-switch mb-1">
                                                <input type="checkbox" class="custom-control-input" id="so-settings-check4" name="so-settings-check4" checked>
                                                <label class="custom-control-label" for="so-settings-check4">SMS Notifications</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <p class="font-w600 mb-1">
                                                API
                                            </p>
                                            <div class="custom-control custom-switch mb-1">
                                                <input type="checkbox" class="custom-control-input" id="so-settings-check5" name="so-settings-check5" checked>
                                                <label class="custom-control-label" for="so-settings-check5">Enable access</label>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END Quick Settings Form -->
                                </div>
                            </div>
                            <!-- END Quick Settings -->
                        </div>
                        <!-- END Overview Tab -->

                        <!-- Sales Tab -->
                        <div class="tab-pane pull-x fade fade-right" id="so-sales" role="tabpanel">
                            <div class="block mb-0">
                                <!-- Stats -->
                                <div class="block-content">
                                    <div class="row items-push pull-t">
                                        <div class="col-6">
                                            <div class="font-w700 text-uppercase">Sales</div>
                                            <a class="link-fx font-size-h3 font-w300" href="javascript:void(0)">22.030</a>
                                        </div>
                                        <div class="col-6">
                                            <div class="font-w700 text-uppercase">Balance</div>
                                            <a class="link-fx font-size-h3 font-w300" href="javascript:void(0)">$4.589,00</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Stats -->

                                <!-- Today -->
                                <div class="block-content block-content-full block-content-sm bg-body-light">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="font-w600 text-uppercase">Today</span>
                                        </div>
                                        <div class="col-6 text-right">
                                            <span class="ext-muted">$996</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <ul class="nav-items push">
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">New sale! + $249</div>
                                                    <small class="text-muted">3 min ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">New sale! + $129</div>
                                                    <small class="text-muted">50 min ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">New sale! + $119</div>
                                                    <small class="text-muted">2 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">New sale! + $499</div>
                                                    <small class="text-muted">3 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END Today -->

                                <!-- Yesterday -->
                                <div class="block-content block-content-full block-content-sm bg-body-light">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="font-w600 text-uppercase">Yesterday</span>
                                        </div>
                                        <div class="col-6 text-right">
                                            <span class="text-muted">$765</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <ul class="nav-items push">
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">New sale! + $249</div>
                                                    <small class="text-muted">26 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-danger"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">Product Purchase - $50</div>
                                                    <small class="text-muted">28 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">New sale! + $119</div>
                                                    <small class="text-muted">29 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-danger"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">Paypal Withdrawal - $300</div>
                                                    <small class="text-muted">37 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">New sale! + $129</div>
                                                    <small class="text-muted">39 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">New sale! + $119</div>
                                                    <small class="text-muted">45 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">
                                                    <i class="fa fa-fw fa-circle text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">New sale! + $499</div>
                                                    <small class="text-muted">46 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- More -->
                                    <div class="text-center">
                                        <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                            <i class="fa fa-arrow-down mr-1"></i> Load More..
                                        </a>
                                    </div>
                                    <!-- END More -->
                                </div>
                                <!-- END Yesterday -->
                            </div>
                        </div>
                        <!-- END Sales Tab -->
                    </div>
                </div>
                <!-- END Side Overlay Tabs -->
            </div>
            <!-- END Side Content -->
        </aside>
        <!-- END Side Overlay -->

        <!-- Sidebar -->
        <!--
            Sidebar Mini Mode - Display Helper classes

            Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
            Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

            Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
            Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
            Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
        -->
        <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header -->
            <div class="content-header bg-white-5">
                <!-- Logo -->
                <a class="font-w600 text-dual" href="{{url('/')}}">
{{--                    <i class="fa fa-circle-notch text-primary"></i>--}}
{{--                    <span class="smini-hide">--}}
                        <center>
        <img src="{{asset('logosite.png')}}" width="100px" height="50px"/>
{{--                            <span class="font-w700 font-size-h5"></span>--}}
                    </center>
{{--                    </span>--}}
                </a>
                <!-- END Logo -->

                <!-- Extra -->
                <div>
                    <!-- Options -->
{{--                    <div class="dropdown d-inline-block ml-2">--}}
{{--                        <a class="btn btn-sm btn-dual" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">--}}
{{--                            <i class="si si-drop"></i>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-right font-size-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">--}}
{{--                            <!-- Color Themes -->--}}
{{--                            <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->--}}
{{--                            <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="default" href="#">--}}
{{--                                <span>Default</span>--}}
{{--                                <i class="fa fa-circle text-default"></i>--}}
{{--                            </a>--}}
{{--                            <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="assets/css/themes/amethyst.min.css" href="#">--}}
{{--                                <span>Amethyst</span>--}}
{{--                                <i class="fa fa-circle text-amethyst"></i>--}}
{{--                            </a>--}}
{{--                            <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="assets/css/themes/city.min.css" href="#">--}}
{{--                                <span>City</span>--}}
{{--                                <i class="fa fa-circle text-city"></i>--}}
{{--                            </a>--}}
{{--                            <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="assets/css/themes/flat.min.css" href="#">--}}
{{--                                <span>Flat</span>--}}
{{--                                <i class="fa fa-circle text-flat"></i>--}}
{{--                            </a>--}}
{{--                            <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="assets/css/themes/modern.min.css" href="#">--}}
{{--                                <span>Modern</span>--}}
{{--                                <i class="fa fa-circle text-modern"></i>--}}
{{--                            </a>--}}
{{--                            <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="assets/css/themes/smooth.min.css" href="#">--}}
{{--                                <span>Smooth</span>--}}
{{--                                <i class="fa fa-circle text-smooth"></i>--}}
{{--                            </a>--}}
{{--                            <!-- END Color Themes -->--}}

{{--                            <div class="dropdown-divider"></div>--}}

{{--                            <!-- Sidebar Styles -->--}}
{{--                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->--}}
{{--                            <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_light" href="#">--}}
{{--                                <span>Sidebar Light</span>--}}
{{--                            </a>--}}
{{--                            <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_dark" href="#">--}}
{{--                                <span>Sidebar Dark</span>--}}
{{--                            </a>--}}
{{--                            <!-- Sidebar Styles -->--}}

{{--                            <div class="dropdown-divider"></div>--}}

{{--                            <!-- Header Styles -->--}}
{{--                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->--}}
{{--                            <a class="dropdown-item" data-toggle="layout" data-action="header_style_light" href="#">--}}
{{--                                <span>Header Light</span>--}}
{{--                            </a>--}}
{{--                            <a class="dropdown-item" data-toggle="layout" data-action="header_style_dark" href="#">--}}
{{--                                <span>Header Dark</span>--}}
{{--                            </a>--}}
{{--                            <!-- Header Styles -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- END Options -->

                    <!-- Close Sidebar, Visible only on mobile screens -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="d-lg-none btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times"></i>
                    </a>
                    <!-- END Close Sidebar -->
                </div>
                <!-- END Extra -->
            </div>
            <!-- END Side Header -->

            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <li class="nav-main-item">
                        <a class="nav-main-link active" href="{{url('/')}}">
                            <i class="nav-main-link-icon si si-speedometer"></i>
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>
                    <?php
                    $role = auth()->user()->roles()->pluck('role_id');
                    if($role[0]=='1')
                        {
                    ?>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-file"></i>
                            <span class="nav-main-link-name">Packages</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('package.index')}}">
                                    <span class="nav-main-link-name">Create Package</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('package.show')}}">
                                    <span class="nav-main-link-name">Packages List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link " href="{{url('admin/all_products')}}">
                            <i class="nav-main-link-icon si si-bag"></i>
                            <span class="nav-main-link-name">Products</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link " href="{{url('admin/add_categories')}}">
                            <i class="nav-main-link-icon si si-layers"></i>
                            <span class="nav-main-link-name">Categories</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link " href="{{route('vendor.show')}}">
                            <i class="nav-main-link-icon fa fa-store"></i>
                            <span class="nav-main-link-name">Vendors</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link " href="{{route('orders.index')}}">
                            <i class="nav-main-link-icon si si-layers"></i>
                            <span class="nav-main-link-name">Orders</span>
                        </a>
                    </li>
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="{{url('admin/shipping_zone')}}">--}}
{{--                            <i class="nav-main-link-icon si si-map"></i>--}}
{{--                            <span class="nav-main-link-name">Shipping Zones</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">--}}
{{--                            <i class="nav-main-link-icon si si-layers"></i>--}}
{{--                            <span class="nav-main-link-name">Orders</span>--}}
{{--                        </a>--}}
{{--                        <ul class="nav-main-submenu">--}}
{{--                            <li class="nav-main-item">--}}
{{--                                <a class="nav-main-link" href="">--}}
{{--                                    <i class="nav-main-link-icon si si-bag"></i>--}}
{{--                                    <span class="nav-main-link-name">All Orders</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
                <?php
                        }
                    if($role[0]==2)
                        {
                ?>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon si si-pencil"></i>
                            <span class="nav-main-link-name">Products</span>
                        </a>
                        <ul class="nav-main-submenu">

                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{url('products')}}">
                                    <span class="nav-main-link-name">Add Products</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{url('all_products')}}">
                                    <span class="nav-main-link-name">All Products</span>
                                </a>
                            </li>
                        </ul>
                    </li>
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">--}}
{{--                            <i class="nav-main-link-icon si si-layers"></i>--}}
{{--                            <span class="nav-main-link-name">Orders</span>--}}
{{--                        </a>--}}
{{--                        <ul class="nav-main-submenu">--}}
{{--                            <li class="nav-main-item">--}}
{{--                                <a class="nav-main-link" href="{{route('orders.vendor.index')}}">--}}
{{--                                    <i class="nav-main-link-icon si si-bag"></i>--}}
{{--                                    <span class="nav-main-link-name">All Orders</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
                    <li class="nav-main-item">
                        <a class="nav-main-link " href="{{route('orders.vendor.index')}}">
                            <i class="nav-main-link-icon si si-layers"></i>
                            <span class="nav-main-link-name">Orders</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link " href="{{url('/')}}">
                            <i class="nav-main-link-icon si si-list"></i>
                            <span class="nav-main-link-name">Transaction History</span>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <!-- END Side Navigation -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                    <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- END Toggle Sidebar -->

                    <!-- Toggle Mini Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                    <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                        <i class="fa fa-fw fa-ellipsis-v"></i>
                    </button>
                    <!-- END Toggle Mini Sidebar -->

                    <!-- Apps Modal -->
                    <!-- Opens the Apps modal found at the bottom of the page, after footer’s markup -->
{{--                    <button type="button" class="btn btn-sm btn-dual mr-2" data-toggle="modal" data-target="#one-modal-apps">--}}
{{--                        <i class="si si-grid"></i>--}}
{{--                    </button>--}}
                    <!-- END Apps Modal -->

                    <!-- Open Search Section (visible on smaller screens) -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
{{--                    <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout" data-action="header_search_on">--}}
{{--                        <i class="si si-magnifier"></i>--}}
{{--                    </button>--}}
                    <!-- END Open Search Section -->

                    <!-- Search Form (visible on larger screens) -->
                {{--                <form class="d-none d-sm-inline-block" action="be_pages_generic_search.html" method="POST">--}}
                {{--                    <div class="input-group input-group-sm">--}}
                {{--                        <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">--}}
                {{--                        <div class="input-group-append">--}}
                {{--                                    <span class="input-group-text bg-body border-0">--}}
                {{--                                        <i class="si si-magnifier"></i>--}}
                {{--                                    </span>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </form>--}}
                <!-- END Search Form -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="d-flex align-items-center">

                    <div class="switcher notranslate">
                        <div class="selected">
                            <a href="#" onclick="return false;"><img src="//gtranslate.io/shopify/assets/flags/16/en.png" height="16" width="16" alt="en" /> English</a>
                        </div>
                        <div class="option">
                            <a href="https://tesanandum.com" onclick="doGTranslate('en|en');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="English" class="nturl selected"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/en.png" height="16" width="16" alt="en" /> English</a><a href="https://es.tesanandum.com" onclick="doGTranslate('en|es');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Español" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/es.png" height="16" width="16" alt="es" /> Español</a><a href="https://fr.tesanandum.com" onclick="doGTranslate('en|fr');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Français" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/fr.png" height="16" width="16" alt="fr" /> Français</a><a href="https://de.tesanandum.com" onclick="doGTranslate('en|de');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Deutsch" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/de.png" height="16" width="16" alt="de" /> Deutsch</a><a href="https://it.tesanandum.com" onclick="doGTranslate('en|it');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Italiano" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/it.png" height="16" width="16" alt="it" /> Italiano</a><a href="https://pt.tesanandum.com" onclick="doGTranslate('en|pt');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Português" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/pt.png" height="16" width="16" alt="pt" /> Português</a><a href="https://ru.tesanandum.com" onclick="doGTranslate('en|ru');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="???????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ru.png" height="16" width="16" alt="ru" /> ???????</a><a href="https://no.tesanandum.com" onclick="doGTranslate('en|no');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Norsk bokmål" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/no.png" height="16" width="16" alt="no" /> Norsk bokmål</a><a href="https://cs.tesanandum.com" onclick="doGTranslate('en|cs');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Ceština?" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/cs.png" height="16" width="16" alt="cs" /> Ceština?</a><a href="https://nl.tesanandum.com" onclick="doGTranslate('en|nl');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Nederlands" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/nl.png" height="16" width="16" alt="nl" /> Nederlands</a><a href="https://da.tesanandum.com" onclick="doGTranslate('en|da');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Dansk" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/da.png" height="16" width="16" alt="da" /> Dansk</a><a href="https://fi.tesanandum.com" onclick="doGTranslate('en|fi');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Suomi" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/fi.png" height="16" width="16" alt="fi" /> Suomi</a><a href="https://ja.tesanandum.com" onclick="doGTranslate('en|ja');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="???" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ja.png" height="16" width="16" alt="ja" /> ???</a><a href="https://af.tesanandum.com" onclick="doGTranslate('en|af');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Afrikaans" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/af.png" height="16" width="16" alt="af" /> Afrikaans</a><a href="https://sq.tesanandum.com" onclick="doGTranslate('en|sq');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Shqip" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/sq.png" height="16" width="16" alt="sq" /> Shqip</a><a href="https://am.tesanandum.com" onclick="doGTranslate('en|am');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/am.png" height="16" width="16" alt="am" /> ????</a><a href="https://ar.tesanandum.com" onclick="doGTranslate('en|ar');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="???????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ar.png" height="16" width="16" alt="ar" /> ???????</a><a href="https://hy.tesanandum.com" onclick="doGTranslate('en|hy');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="???????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/hy.png" height="16" width="16" alt="hy" /> ???????</a><a href="https://az.tesanandum.com" onclick="doGTranslate('en|az');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Az?rbaycan dili" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/az.png" height="16" width="16" alt="az" /> Az?rbaycan dili</a><a href="https://eu.tesanandum.com" onclick="doGTranslate('en|eu');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Euskara" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/eu.png" height="16" width="16" alt="eu" /> Euskara</a><a href="https://be.tesanandum.com" onclick="doGTranslate('en|be');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????????? ????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/be.png" height="16" width="16" alt="be" /> ?????????? ????</a><a href="https://bn.tesanandum.com" onclick="doGTranslate('en|bn');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/bn.png" height="16" width="16" alt="bn" /> ?????</a><a href="https://bs.tesanandum.com" onclick="doGTranslate('en|bs');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Bosanski" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/bs.png" height="16" width="16" alt="bs" /> Bosanski</a><a href="https://bg.tesanandum.com" onclick="doGTranslate('en|bg');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/bg.png" height="16" width="16" alt="bg" /> ?????????</a><a href="https://ca.tesanandum.com" onclick="doGTranslate('en|ca');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Català" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ca.png" height="16" width="16" alt="ca" /> Català</a><a href="https://ceb.tesanandum.com" onclick="doGTranslate('en|ceb');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Cebuano" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ceb.png" height="16" width="16" alt="ceb" /> Cebuano</a><a href="https://ny.tesanandum.com" onclick="doGTranslate('en|ny');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Chichewa" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ny.png" height="16" width="16" alt="ny" /> Chichewa</a><a href="https://zh-CN.tesanandum.com" onclick="doGTranslate('en|zh-CN');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/zh-CN.png" height="16" width="16" alt="zh-cn" /> ????</a><a href="https://zh-TW.tesanandum.com" onclick="doGTranslate('en|zh-TW');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/zh-TW.png" height="16" width="16" alt="zh-tw" /> ????</a><a href="https://co.tesanandum.com" onclick="doGTranslate('en|co');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Corsu" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/co.png" height="16" width="16" alt="co" /> Corsu</a><a href="https://hr.tesanandum.com" onclick="doGTranslate('en|hr');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Hrvatski" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/hr.png" height="16" width="16" alt="hr" /> Hrvatski</a><a href="https://eo.tesanandum.com" onclick="doGTranslate('en|eo');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Esperanto" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/eo.png" height="16" width="16" alt="eo" /> Esperanto</a><a href="https://et.tesanandum.com" onclick="doGTranslate('en|et');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Eesti" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/et.png" height="16" width="16" alt="et" /> Eesti</a><a href="https://tl.tesanandum.com" onclick="doGTranslate('en|tl');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Filipino" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/tl.png" height="16" width="16" alt="tl" /> Filipino</a><a href="https://fy.tesanandum.com" onclick="doGTranslate('en|fy');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Frysk" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/fy.png" height="16" width="16" alt="fy" /> Frysk</a><a href="https://gl.tesanandum.com" onclick="doGTranslate('en|gl');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Galego" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/gl.png" height="16" width="16" alt="gl" /> Galego</a><a href="https://ka.tesanandum.com" onclick="doGTranslate('en|ka');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="???????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ka.png" height="16" width="16" alt="ka" /> ???????</a><a href="https://el.tesanandum.com" onclick="doGTranslate('en|el');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="????????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/el.png" height="16" width="16" alt="el" /> ????????</a><a href="https://gu.tesanandum.com" onclick="doGTranslate('en|gu');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="???????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/gu.png" height="16" width="16" alt="gu" /> ???????</a><a href="https://ht.tesanandum.com" onclick="doGTranslate('en|ht');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Kreyol ayisyen" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ht.png" height="16" width="16" alt="ht" /> Kreyol ayisyen</a><a href="https://ha.tesanandum.com" onclick="doGTranslate('en|ha');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Harshen Hausa" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ha.png" height="16" width="16" alt="ha" /> Harshen Hausa</a><a href="https://haw.tesanandum.com" onclick="doGTranslate('en|haw');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Olelo Hawai?i" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/haw.png" height="16" width="16" alt="haw" /> Olelo Hawai?i</a><a href="https://iw.tesanandum.com" onclick="doGTranslate('en|iw');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="????????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/iw.png" height="16" width="16" alt="iw" /> ????????</a><a href="https://hi.tesanandum.com" onclick="doGTranslate('en|hi');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="??????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/hi.png" height="16" width="16" alt="hi" /> ??????</a><a href="https://hmn.tesanandum.com" onclick="doGTranslate('en|hmn');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Hmong" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/hmn.png" height="16" width="16" alt="hmn" /> Hmong</a><a href="https://hu.tesanandum.com" onclick="doGTranslate('en|hu');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Magyar" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/hu.png" height="16" width="16" alt="hu" /> Magyar</a><a href="https://is.tesanandum.com" onclick="doGTranslate('en|is');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Íslenska" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/is.png" height="16" width="16" alt="is" /> Íslenska</a><a href="https://ig.tesanandum.com" onclick="doGTranslate('en|ig');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Igbo" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ig.png" height="16" width="16" alt="ig" /> Igbo</a><a href="https://id.tesanandum.com" onclick="doGTranslate('en|id');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Bahasa Indonesia" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/id.png" height="16" width="16" alt="id" /> Bahasa Indonesia</a><a href="https://ga.tesanandum.com" onclick="doGTranslate('en|ga');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Gaelige" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ga.png" height="16" width="16" alt="ga" /> Gaelige</a><a href="https://jw.tesanandum.com" onclick="doGTranslate('en|jw');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Basa Jawa" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/jw.png" height="16" width="16" alt="jw" /> Basa Jawa</a><a href="https://kn.tesanandum.com" onclick="doGTranslate('en|kn');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/kn.png" height="16" width="16" alt="kn" /> ?????</a><a href="https://kk.tesanandum.com" onclick="doGTranslate('en|kk');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="????? ????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/kk.png" height="16" width="16" alt="kk" /> ????? ????</a><a href="https://km.tesanandum.com" onclick="doGTranslate('en|km');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/km.png" height="16" width="16" alt="km" /> ?????????</a><a href="https://ko.tesanandum.com" onclick="doGTranslate('en|ko');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="???" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ko.png" height="16" width="16" alt="ko" /> ???</a><a href="https://ku.tesanandum.com" onclick="doGTranslate('en|ku');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="??????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ku.png" height="16" width="16" alt="ku" /> ??????</a><a href="https://ky.tesanandum.com" onclick="doGTranslate('en|ky');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="????????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ky.png" height="16" width="16" alt="ky" /> ????????</a><a href="https://lo.tesanandum.com" onclick="doGTranslate('en|lo');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="???????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/lo.png" height="16" width="16" alt="lo" /> ???????</a><a href="https://la.tesanandum.com" onclick="doGTranslate('en|la');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Latin" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/la.png" height="16" width="16" alt="la" /> Latin</a><a href="https://lv.tesanandum.com" onclick="doGTranslate('en|lv');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Latviešu valoda" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/lv.png" height="16" width="16" alt="lv" /> Latviešu valoda</a><a href="https://lt.tesanandum.com" onclick="doGTranslate('en|lt');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Lietuviu kalba" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/lt.png" height="16" width="16" alt="lt" /> Lietuviu kalba</a><a href="https://lb.tesanandum.com" onclick="doGTranslate('en|lb');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Lëtzebuergesch" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/lb.png" height="16" width="16" alt="lb" /> Lëtzebuergesch</a><a href="https://mk.tesanandum.com" onclick="doGTranslate('en|mk');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????????? ?????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/mk.png" height="16" width="16" alt="mk" /> ?????????? ?????</a><a href="https://mg.tesanandum.com" onclick="doGTranslate('en|mg');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Malagasy" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/mg.png" height="16" width="16" alt="mg" /> Malagasy</a><a href="https://ms.tesanandum.com" onclick="doGTranslate('en|ms');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Bahasa Melayu" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ms.png" height="16" width="16" alt="ms" /> Bahasa Melayu</a><a href="https://ml.tesanandum.com" onclick="doGTranslate('en|ml');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="??????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ml.png" height="16" width="16" alt="ml" /> ??????</a><a href="https://mt.tesanandum.com" onclick="doGTranslate('en|mt');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Maltese" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/mt.png" height="16" width="16" alt="mt" /> Maltese</a><a href="https://mi.tesanandum.com" onclick="doGTranslate('en|mi');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Te Reo Maori" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/mi.png" height="16" width="16" alt="mi" /> Te Reo Maori</a><a href="https://mr.tesanandum.com" onclick="doGTranslate('en|mr');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/mr.png" height="16" width="16" alt="mr" /> ?????</a><a href="https://mn.tesanandum.com" onclick="doGTranslate('en|mn');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="??????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/mn.png" height="16" width="16" alt="mn" /> ??????</a><a href="https://my.tesanandum.com" onclick="doGTranslate('en|my');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/my.png" height="16" width="16" alt="my" /> ?????</a><a href="https://ne.tesanandum.com" onclick="doGTranslate('en|ne');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="??????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ne.png" height="16" width="16" alt="ne" /> ??????</a><a href="https://ps.tesanandum.com" onclick="doGTranslate('en|ps');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ps.png" height="16" width="16" alt="ps" /> ????</a><a href="https://fa.tesanandum.com" onclick="doGTranslate('en|fa');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/fa.png" height="16" width="16" alt="fa" /> ?????</a><a href="https://pl.tesanandum.com" onclick="doGTranslate('en|pl');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Polski" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/pl.png" height="16" width="16" alt="pl" /> Polski</a><a href="https://pa.tesanandum.com" onclick="doGTranslate('en|pa');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="??????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/pa.png" height="16" width="16" alt="pa" /> ??????</a><a href="https://ro.tesanandum.com" onclick="doGTranslate('en|ro');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Româna" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ro.png" height="16" width="16" alt="ro" /> Româna</a><a href="https://sm.tesanandum.com" onclick="doGTranslate('en|sm');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Samoan" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/sm.png" height="16" width="16" alt="sm" /> Samoan</a><a href="https://gd.tesanandum.com" onclick="doGTranslate('en|gd');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Gàidhlig" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/gd.png" height="16" width="16" alt="gd" /> Gàidhlig</a><a href="https://sr.tesanandum.com" onclick="doGTranslate('en|sr');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????? ?????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/sr.png" height="16" width="16" alt="sr" /> ?????? ?????</a><a href="https://st.tesanandum.com" onclick="doGTranslate('en|st');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Sesotho" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/st.png" height="16" width="16" alt="st" /> Sesotho</a><a href="https://sn.tesanandum.com" onclick="doGTranslate('en|sn');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Shona" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/sn.png" height="16" width="16" alt="sn" /> Shona</a><a href="https://sd.tesanandum.com" onclick="doGTranslate('en|sd');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/sd.png" height="16" width="16" alt="sd" /> ????</a><a href="https://si.tesanandum.com" onclick="doGTranslate('en|si');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/si.png" height="16" width="16" alt="si" /> ?????</a><a href="https://sk.tesanandum.com" onclick="doGTranslate('en|sk');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Slovencina" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/sk.png" height="16" width="16" alt="sk" /> Slovencina</a><a href="https://sl.tesanandum.com" onclick="doGTranslate('en|sl');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Slovenšcina" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/sl.png" height="16" width="16" alt="sl" /> Slovenšcina</a><a href="https://so.tesanandum.com" onclick="doGTranslate('en|so');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Afsoomaali" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/so.png" height="16" width="16" alt="so" /> Afsoomaali</a><a href="https://su.tesanandum.com" onclick="doGTranslate('en|su');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Basa Sunda" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/su.png" height="16" width="16" alt="su" /> Basa Sunda</a><a href="https://sw.tesanandum.com" onclick="doGTranslate('en|sw');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Kiswahili" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/sw.png" height="16" width="16" alt="sw" /> Kiswahili</a><a href="https://sv.tesanandum.com" onclick="doGTranslate('en|sv');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Svenska" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/sv.png" height="16" width="16" alt="sv" /> Svenska</a><a href="https://tg.tesanandum.com" onclick="doGTranslate('en|tg');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="??????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/tg.png" height="16" width="16" alt="tg" /> ??????</a><a href="https://ta.tesanandum.com" onclick="doGTranslate('en|ta');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ta.png" height="16" width="16" alt="ta" /> ?????</a><a href="https://te.tesanandum.com" onclick="doGTranslate('en|te');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="??????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/te.png" height="16" width="16" alt="te" /> ??????</a><a href="https://th.tesanandum.com" onclick="doGTranslate('en|th');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="???" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/th.png" height="16" width="16" alt="th" /> ???</a><a href="https://tr.tesanandum.com" onclick="doGTranslate('en|tr');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Türkçe" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/tr.png" height="16" width="16" alt="tr" /> Türkçe</a><a href="https://uk.tesanandum.com" onclick="doGTranslate('en|uk');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="??????????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/uk.png" height="16" width="16" alt="uk" /> ??????????</a><a href="https://ur.tesanandum.com" onclick="doGTranslate('en|ur');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/ur.png" height="16" width="16" alt="ur" /> ????</a><a href="https://uz.tesanandum.com" onclick="doGTranslate('en|uz');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="O‘zbekcha" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/uz.png" height="16" width="16" alt="uz" /> O‘zbekcha</a><a href="https://vi.tesanandum.com" onclick="doGTranslate('en|vi');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Ti?ng Vi?t" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/vi.png" height="16" width="16" alt="vi" /> Ti?ng Vi?t</a><a href="https://cy.tesanandum.com" onclick="doGTranslate('en|cy');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Cymraeg" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/cy.png" height="16" width="16" alt="cy" /> Cymraeg</a><a href="https://xh.tesanandum.com" onclick="doGTranslate('en|xh');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="isiXhosa" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/xh.png" height="16" width="16" alt="xh" /> isiXhosa</a><a href="https://yi.tesanandum.com" onclick="doGTranslate('en|yi');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="?????" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/yi.png" height="16" width="16" alt="yi" /> ?????</a><a href="https://yo.tesanandum.com" onclick="doGTranslate('en|yo');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Yorùbá" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/yo.png" height="16" width="16" alt="yo" /> Yorùbá</a><a href="https://zu.tesanandum.com" onclick="doGTranslate('en|zu');jQuery('div.switcher div.selected a').html(jQuery(this).html());return false;" title="Zulu" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/zu.png" height="16" width="16" alt="zu" /> Zulu</a></div>
                    </div>
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block ml-2">
                        <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded" src="{{asset('assets/media/avatars/avatar10.jpg')}}" alt="Header Avatar" style="width: 18px;">
                            <span class="d-none d-sm-inline-block ml-1">{{ Auth::user()->name }}</span>
                            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">
                            <div class="p-3 text-center bg-primary">
                                <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{asset('assets/media/avatars/avatar10.jpg')}}" alt="">
                            </div>
                            <div class="p-2">
                                {{--                            <h5 class="dropdown-header text-uppercase">User Options</h5>--}}
                                {{--                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="be_pages_generic_inbox.html">--}}
                                {{--                                <span>Inbox</span>--}}
                                {{--                                <span>--}}
                                {{--                                            <span class="badge badge-pill badge-primary">3</span>--}}
                                {{--                                            <i class="si si-envelope-open ml-1"></i>--}}
                                {{--                                        </span>--}}
                                {{--                            </a>--}}
                                {{--                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="be_pages_generic_profile.html">--}}
                                {{--                                <span>Profile</span>--}}
                                {{--                                <span>--}}
                                {{--                                            <span class="badge badge-pill badge-success">1</span>--}}
                                {{--                                            <i class="si si-user ml-1"></i>--}}
                                {{--                                        </span>--}}
                                {{--                            </a>--}}
{{--                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">--}}
{{--                                    <span>Settings</span>--}}
{{--                                    <i class="si si-settings"></i>--}}
{{--                                </a>--}}
                                <div role="separator" class="dropdown-divider"></div>
                                <h5 class="dropdown-header text-uppercase">Actions</h5>
                                {{--                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="op_auth_lock.html">--}}
                                {{--                                <span>Lock Account</span>--}}
                                {{--                                <i class="si si-lock ml-1"></i>--}}
                                {{--                            </a>--}}
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span>Log Out</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END User Dropdown -->

                    <!-- Notifications Dropdown -->
{{--                    <div class="dropdown d-inline-block ml-2">--}}
{{--                        <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            <i class="si si-bell"></i>--}}
{{--                            <span class="badge badge-primary badge-pill">6</span>--}}
{{--                        </button>--}}
{{--                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">--}}
{{--                            <div class="p-2 bg-primary text-center">--}}
{{--                                <h5 class="dropdown-header text-uppercase text-white">Notifications</h5>--}}
{{--                            </div>--}}
{{--                            <ul class="nav-items mb-0">--}}
{{--                                <li>--}}
{{--                                    <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                        <div class="mr-2 ml-3">--}}
{{--                                            <i class="fa fa-fw fa-check-circle text-success"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body pr-2">--}}
{{--                                            <div class="font-w600">You have a new follower</div>--}}
{{--                                            <small class="text-muted">15 min ago</small>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                        <div class="mr-2 ml-3">--}}
{{--                                            <i class="fa fa-fw fa-plus-circle text-info"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body pr-2">--}}
{{--                                            <div class="font-w600">1 new sale, keep it up</div>--}}
{{--                                            <small class="text-muted">22 min ago</small>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                        <div class="mr-2 ml-3">--}}
{{--                                            <i class="fa fa-fw fa-times-circle text-danger"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body pr-2">--}}
{{--                                            <div class="font-w600">Update failed, restart server</div>--}}
{{--                                            <small class="text-muted">26 min ago</small>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                        <div class="mr-2 ml-3">--}}
{{--                                            <i class="fa fa-fw fa-plus-circle text-info"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body pr-2">--}}
{{--                                            <div class="font-w600">2 new sales, keep it up</div>--}}
{{--                                            <small class="text-muted">33 min ago</small>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                        <div class="mr-2 ml-3">--}}
{{--                                            <i class="fa fa-fw fa-user-plus text-success"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body pr-2">--}}
{{--                                            <div class="font-w600">You have a new subscriber</div>--}}
{{--                                            <small class="text-muted">41 min ago</small>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                        <div class="mr-2 ml-3">--}}
{{--                                            <i class="fa fa-fw fa-check-circle text-success"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body pr-2">--}}
{{--                                            <div class="font-w600">You have a new follower</div>--}}
{{--                                            <small class="text-muted">42 min ago</small>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <div class="p-2 border-top">--}}
{{--                                <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">--}}
{{--                                    <i class="fa fa-fw fa-arrow-down mr-1"></i> Load More..--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- END Notifications Dropdown -->

                    <!-- Toggle Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                {{--                <button type="button" class="btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="side_overlay_toggle">--}}
                {{--                    <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>--}}
                {{--                </button>--}}
                <!-- END Toggle Side Overlay -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
        {{--        <div id="page-header-search" class="overlay-header bg-white">--}}
        {{--            <div class="content-header">--}}
        {{--                <form class="w-100" action="be_pages_generic_search.html" method="POST">--}}
        {{--                    <div class="input-group input-group-sm">--}}
        {{--                        <div class="input-group-prepend">--}}
        {{--                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->--}}
        {{--                            <button type="button" class="btn btn-danger" data-toggle="layout" data-action="header_search_off">--}}
        {{--                                <i class="fa fa-fw fa-times-circle"></i>--}}
        {{--                            </button>--}}
        {{--                        </div>--}}
        {{--                        <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">--}}
        {{--                    </div>--}}
        {{--                </form>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-white">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->
@show
<!-- Main Container -->

@section('body')

    <!-- END Main Container -->
@show

<!-- Footer -->

    @section('footer')
        <footer id="page-footer" class="bg-body-light">
            <div class="content py-3">
                <div class="row font-size-sm">

                    <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                        Developed <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="" target="_blank">Tetralogicx</a>
                    </div>

                </div>
            </div>
        </footer>
        <!-- END Footer -->
@show
<!-- Apps Modal -->
    <!-- Opens from the modal toggle button in the header -->
    <div class="modal fade" id="one-modal-apps" tabindex="-1" role="dialog" aria-labelledby="one-modal-apps" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top modal-sm" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Apps</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row gutters-tiny">
                            <div class="col-6">
                                <!-- CRM -->
                                <a class="block block-rounded block-themed bg-default" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-speedometer fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            CRM
                                        </p>
                                    </div>
                                </a>
                                <!-- END CRM -->
                            </div>
                            <div class="col-6">
                                <!-- Products -->
                                <a class="block block-rounded block-themed bg-danger" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-rocket fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            Products
                                        </p>
                                    </div>
                                </a>
                                <!-- END Products -->
                            </div>
                            <div class="col-6">
                                <!-- Sales -->
                                <a class="block block-rounded block-themed bg-success mb-0" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-plane fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            Sales
                                        </p>
                                    </div>
                                </a>
                                <!-- END Sales -->
                            </div>
                            <div class="col-6">
                                <!-- Payments -->
                                <a class="block block-rounded block-themed bg-warning mb-0" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-wallet fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            Payments
                                        </p>
                                    </div>
                                </a>
                                <!-- END Payments -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Apps Modal -->
</div>
<!-- END Page Container -->

<!--
    OneUI JS Core

    Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
    to handle those dependencies through webpack. Please check out assets/_es6/main/bootstrap.js for more info.

    If you like, you could also include them separately directly from the assets/js/core folder in the following
    order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

    assets/js/core/jquery.min.js
    assets/js/core/bootstrap.bundle.min.js
    assets/js/core/simplebar.min.js
    assets/js/core/jquery-scrollLock.min.js
    assets/js/core/jquery.appear.min.js
    assets/js/core/js.cookie.min.js
-->
<script src="{{asset('assets/js/oneui.core.min.js')}}"></script>

<!--
    OneUI JS

    Custom functionality including Blocks/Layout API as well as other vital and optional helpers
    webpack is putting everything together at assets/_es6/main/app.js
-->
<script src="{{asset('assets/js/oneui.app.min.js')}}"></script>

<!-- Page JS Plugins -->
<script src="{{asset('assets/js/plugins/chart.js/Chart.bundle.min.js')}}"></script>


<!-- Page JS Code -->
<script src="{{asset('assets/js/pages/be_pages_dashboard.min.js')}}"></script>
<!-- Page JS Plugins -->
<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.js') }}"></script>

<!-- Page JS Code -->
<script src="{{asset('assets/js/pages/be_tables_datatables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{asset('dropzone-5.7.0/dist/dropzone.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>]
<script src="{{asset('assets/js/plugins/flatpickr/flatpickr.js')}}"></script>

<script>jQuery(function(){ One.helpers('select2'); });</script>

<script>
    $(document).on('click', '.edit_data', function(){
        var id = $(this).attr("id");
        $('#id').val(id);
        // $('#insert').val("Update");
        $('#myModal').modal('show');


    });
</script>
<script type="text/javascript">
    function GTranslateGetCurrentLang() {if(typeof document.getElementsByTagName('html')[0] != 'undefined')return document.getElementsByTagName('html')[0].getAttribute('lang');return null;}
    function gt_loadScript(url,callback){var script=document.createElement("script");script.type="text/javascript";if(script.readyState){script.onreadystatechange=function(){if(script.readyState=="loaded"||script.readyState=="complete"){script.onreadystatechange=null;callback()}}}else{script.onload=function(){callback()}}script.src=url;document.getElementsByTagName("head")[0].appendChild(script)}
    var gtSwitcherJS = function($){/*{auto_detect_code}*/
        $('.switcher .selected').click(function() {$('.switcher .option a img').each(function() {if(!$(this)[0].hasAttribute('src'))$(this).attr('src', $(this).attr('data-gt-lazy-src'))});if(!($('.switcher .option').is(':visible'))) {$('.switcher .option').stop(true,true).delay(100).slideDown(500);$('.switcher .selected a').toggleClass('open')}});
        $('.switcher .option').bind('mousewheel', function(e) {var options = $('.switcher .option');if(options.is(':visible'))options.scrollTop(options.scrollTop() - e.originalEvent.wheelDelta);return false;});
        $('body').not('.switcher').bind('click', function(e) {if($('.switcher .option').is(':visible') && e.target != $('.switcher .option').get(0)) {$('.switcher .option').stop(true,true).delay(100).slideUp(500);$('.switcher .selected a').toggleClass('open')}});
        if(typeof GTranslateGetCurrentLang == 'function')if(GTranslateGetCurrentLang() != null)$(document).ready(function() {var lang_html = $('div.switcher div.option').find('img[alt="'+GTranslateGetCurrentLang()+'"]').parent().html();if(typeof lang_html != 'undefined')$('div.switcher div.selected a').html(lang_html.replace('data-gt-lazy-', ''));});
    };
    gt_loadScript("//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js", function(){jQuery_gtranslate = jQuery.noConflict(true);gtSwitcherJS(jQuery_gtranslate);});
</script>


<script type="text/javascript">
    var gt_request_uri = location.pathname+location.search;
    function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];if(typeof _gaq!='undefined'){_gaq.push(['_trackEvent', 'GTranslate', lang, location.hostname+location.pathname+location.search]);}else {if(typeof ga == 'function')ga('send', 'event', 'GTranslate', lang, location.hostname+location.pathname+location.search);}var plang=location.hostname.split('.')[0];if(plang.length !=2 && plang.toLowerCase() != 'zh-cn' && plang.toLowerCase() != 'zh-tw' && plang != 'hmn' && plang != 'haw' && plang != 'ceb')plang='en';location.href=location.protocol+'//'+(lang == 'en' ? '' : lang+'.')+location.hostname.replace('www.', '').replace(RegExp('^' + plang + '[.]'), '')+(typeof gt_request_uri != 'undefined' ? gt_request_uri : location.pathname+location.search);}
</script>
@yield('scripts')
</body>
</html>
