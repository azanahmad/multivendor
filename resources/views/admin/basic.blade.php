
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"><script type="text/javascript">(window.NREUM||(NREUM={})).loader_config={licenseKey:"1aac60aeb9",applicationID:"476944629"};window.NREUM||(NREUM={}),__nr_require=function(e,n,t){function r(t){if(!n[t]){var i=n[t]={exports:{}};e[t][0].call(i.exports,function(n){var i=e[t][1][n];return r(i||n)},i,i.exports)}return n[t].exports}if("function"==typeof __nr_require)return __nr_require;for(var i=0;i<t.length;i++)r(t[i]);return r}({1:[function(e,n,t){function r(){}function i(e,n,t){return function(){return o(e,[u.now()].concat(f(arguments)),n?null:this,t),n?void 0:this}}var o=e("handle"),a=e(4),f=e(5),c=e("ee").get("tracer"),u=e("loader"),s=NREUM;"undefined"==typeof window.newrelic&&(newrelic=s);var p=["setPageViewName","setCustomAttribute","setErrorHandler","finished","addToTrace","inlineHit","addRelease"],l="api-",d=l+"ixn-";a(p,function(e,n){s[n]=i(l+n,!0,"api")}),s.addPageAction=i(l+"addPageAction",!0),s.setCurrentRouteName=i(l+"routeName",!0),n.exports=newrelic,s.interaction=function(){return(new r).get()};var m=r.prototype={createTracer:function(e,n){var t={},r=this,i="function"==typeof n;return o(d+"tracer",[u.now(),e,t],r),function(){if(c.emit((i?"":"no-")+"fn-start",[u.now(),r,i],t),i)try{return n.apply(this,arguments)}catch(e){throw c.emit("fn-err",[arguments,this,e],t),e}finally{c.emit("fn-end",[u.now()],t)}}}};a("actionText,setName,setAttribute,save,ignore,onEnd,getContext,end,get".split(","),function(e,n){m[n]=i(d+n)}),newrelic.noticeError=function(e,n){"string"==typeof e&&(e=new Error(e)),o("err",[e,u.now(),!1,n])}},{}],2:[function(e,n,t){function r(e,n){var t=e.getEntries();t.forEach(function(e){"first-paint"===e.name?c("timing",["fp",Math.floor(e.startTime)]):"first-contentful-paint"===e.name&&c("timing",["fcp",Math.floor(e.startTime)])})}function i(e,n){var t=e.getEntries();t.length>0&&c("lcp",[t[t.length-1]])}function o(e){if(e instanceof s&&!l){var n,t=Math.round(e.timeStamp);n=t>1e12?Date.now()-t:u.now()-t,l=!0,c("timing",["fi",t,{type:e.type,fid:n}])}}if(!("init"in NREUM&&"page_view_timing"in NREUM.init&&"enabled"in NREUM.init.page_view_timing&&NREUM.init.page_view_timing.enabled===!1)){var a,f,c=e("handle"),u=e("loader"),s=NREUM.o.EV;if("PerformanceObserver"in window&&"function"==typeof window.PerformanceObserver){a=new PerformanceObserver(r),f=new PerformanceObserver(i);try{a.observe({entryTypes:["paint"]}),f.observe({entryTypes:["largest-contentful-paint"]})}catch(p){}}if("addEventListener"in document){var l=!1,d=["click","keydown","mousedown","pointerdown","touchstart"];d.forEach(function(e){document.addEventListener(e,o,!1)})}}},{}],3:[function(e,n,t){function r(e,n){if(!i)return!1;if(e!==i)return!1;if(!n)return!0;if(!o)return!1;for(var t=o.split("."),r=n.split("."),a=0;a<r.length;a++)if(r[a]!==t[a])return!1;return!0}var i=null,o=null,a=/Version\/(\S+)\s+Safari/;if(navigator.userAgent){var f=navigator.userAgent,c=f.match(a);c&&f.indexOf("Chrome")===-1&&f.indexOf("Chromium")===-1&&(i="Safari",o=c[1])}n.exports={agent:i,version:o,match:r}},{}],4:[function(e,n,t){function r(e,n){var t=[],r="",o=0;for(r in e)i.call(e,r)&&(t[o]=n(r,e[r]),o+=1);return t}var i=Object.prototype.hasOwnProperty;n.exports=r},{}],5:[function(e,n,t){function r(e,n,t){n||(n=0),"undefined"==typeof t&&(t=e?e.length:0);for(var r=-1,i=t-n||0,o=Array(i<0?0:i);++r<i;)o[r]=e[n+r];return o}n.exports=r},{}],6:[function(e,n,t){n.exports={exists:"undefined"!=typeof window.performance&&window.performance.timing&&"undefined"!=typeof window.performance.timing.navigationStart}},{}],ee:[function(e,n,t){function r(){}function i(e){function n(e){return e&&e instanceof r?e:e?c(e,f,o):o()}function t(t,r,i,o){if(!l.aborted||o){e&&e(t,r,i);for(var a=n(i),f=v(t),c=f.length,u=0;u<c;u++)f[u].apply(a,r);var p=s[y[t]];return p&&p.push([b,t,r,a]),a}}function d(e,n){h[e]=v(e).concat(n)}function m(e,n){var t=h[e];if(t)for(var r=0;r<t.length;r++)t[r]===n&&t.splice(r,1)}function v(e){return h[e]||[]}function g(e){return p[e]=p[e]||i(t)}function w(e,n){u(e,function(e,t){n=n||"feature",y[t]=n,n in s||(s[n]=[])})}var h={},y={},b={on:d,addEventListener:d,removeEventListener:m,emit:t,get:g,listeners:v,context:n,buffer:w,abort:a,aborted:!1};return b}function o(){return new r}function a(){(s.api||s.feature)&&(l.aborted=!0,s=l.backlog={})}var f="nr@context",c=e("gos"),u=e(4),s={},p={},l=n.exports=i();l.backlog=s},{}],gos:[function(e,n,t){function r(e,n,t){if(i.call(e,n))return e[n];var r=t();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(e,n,{value:r,writable:!0,enumerable:!1}),r}catch(o){}return e[n]=r,r}var i=Object.prototype.hasOwnProperty;n.exports=r},{}],handle:[function(e,n,t){function r(e,n,t,r){i.buffer([e],r),i.emit(e,n,t)}var i=e("ee").get("handle");n.exports=r,r.ee=i},{}],id:[function(e,n,t){function r(e){var n=typeof e;return!e||"object"!==n&&"function"!==n?-1:e===window?0:a(e,o,function(){return i++})}var i=1,o="nr@id",a=e("gos");n.exports=r},{}],loader:[function(e,n,t){function r(){if(!x++){var e=E.info=NREUM.info,n=d.getElementsByTagName("script")[0];if(setTimeout(s.abort,3e4),!(e&&e.licenseKey&&e.applicationID&&n))return s.abort();u(y,function(n,t){e[n]||(e[n]=t)}),c("mark",["onload",a()+E.offset],null,"api");var t=d.createElement("script");t.src="https://"+e.agent,n.parentNode.insertBefore(t,n)}}function i(){"complete"===d.readyState&&o()}function o(){c("mark",["domContent",a()+E.offset],null,"api")}function a(){return O.exists&&performance.now?Math.round(performance.now()):(f=Math.max((new Date).getTime(),f))-E.offset}var f=(new Date).getTime(),c=e("handle"),u=e(4),s=e("ee"),p=e(3),l=window,d=l.document,m="addEventListener",v="attachEvent",g=l.XMLHttpRequest,w=g&&g.prototype;NREUM.o={ST:setTimeout,SI:l.setImmediate,CT:clearTimeout,XHR:g,REQ:l.Request,EV:l.Event,PR:l.Promise,MO:l.MutationObserver};var h=""+location,y={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net",agent:"js-agent.newrelic.com/nr-1169.min.js"},b=g&&w&&w[m]&&!/CriOS/.test(navigator.userAgent),E=n.exports={offset:f,now:a,origin:h,features:{},xhrWrappable:b,userAgent:p};e(1),e(2),d[m]?(d[m]("DOMContentLoaded",o,!1),l[m]("load",r,!1)):(d[v]("onreadystatechange",i),l[v]("onload",r)),c("mark",["firstbyte",f],null,"api");var x=0,O=e(6)},{}],"wrap-function":[function(e,n,t){function r(e){return!(e&&e instanceof Function&&e.apply&&!e[a])}var i=e("ee"),o=e(5),a="nr@original",f=Object.prototype.hasOwnProperty,c=!1;n.exports=function(e,n){function t(e,n,t,i){function nrWrapper(){var r,a,f,c;try{a=this,r=o(arguments),f="function"==typeof t?t(r,a):t||{}}catch(u){l([u,"",[r,a,i],f])}s(n+"start",[r,a,i],f);try{return c=e.apply(a,r)}catch(p){throw s(n+"err",[r,a,p],f),p}finally{s(n+"end",[r,a,c],f)}}return r(e)?e:(n||(n=""),nrWrapper[a]=e,p(e,nrWrapper),nrWrapper)}function u(e,n,i,o){i||(i="");var a,f,c,u="-"===i.charAt(0);for(c=0;c<n.length;c++)f=n[c],a=e[f],r(a)||(e[f]=t(a,u?f+i:i,o,f))}function s(t,r,i){if(!c||n){var o=c;c=!0;try{e.emit(t,r,i,n)}catch(a){l([a,t,r,i])}c=o}}function p(e,n){if(Object.defineProperty&&Object.keys)try{var t=Object.keys(e);return t.forEach(function(t){Object.defineProperty(n,t,{get:function(){return e[t]},set:function(n){return e[t]=n,n}})}),n}catch(r){l([r])}for(var i in e)f.call(e,i)&&(n[i]=e[i]);return n}function l(n){try{e.emit("internal-error",n)}catch(t){}}return e||(e=i),t.inPlace=u,t.flag=a,t}},{}]},{},["loader"]);</script>
    <title>WeFullfill</title>
    <meta name="description" content="WeFullfill 2020 created by TetraLogicx Pvt. Limited.">
    <meta name="author" content="tetralogicx">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    <link rel="shortcut icon" href="https://phpstack-362288-1193299.cloudwaysapps.com/assets/img/favicons/wefullfill.png">
    <link rel="icon" type="image/png" sizes="192x192" href="https://phpstack-362288-1193299.cloudwaysapps.com/assets/img/favicons/wefullfill.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://phpstack-362288-1193299.cloudwaysapps.com/assets/img/favicons/wefullfill.png">
    <meta property="og:title" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="OneUI">
    <meta property="og:description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <style>
    @font-face {
        font-family: Sofia_Pro_Light;
        src: url(https://phpstack-362288-1193299.cloudwaysapps.com/Sofia_Pro_Light.otf);
    }
</style>

{{--    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/summernote/summernote-bs4.css">--}}
    <link rel="stylesheet" id="css-main" href="https://phpstack-362288-1193299.cloudwaysapps.com/assets/css/oneui.min.css">

    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/dropzone/dist/dropzone.css">
    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.css">
    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/select2/css/select2.css">
{{--    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/flatpickr/flatpickr.css">--}}


    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/css/style.css?v=2020-07-05 09:22:07"/>
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />--}}


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<body>
<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
    <nav id="sidebar" aria-label="Main Navigation">
    <div class="content-header bg-white-5">
        <a class="font-w600 text-dual" href="https://phpstack-362288-1193299.cloudwaysapps.com">
            <i class="fa fa-circle-notch text-primary"></i>
            <span class="smini-hide">
                            <span class="font-w700 font-size-h5">WeFullFill</span>
                        </span>
        </a>
        <div>
            <a class="d-lg-none btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
        </div>
    </div>

    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link active" href="https://phpstack-362288-1193299.cloudwaysapps.com">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-layers"></i>
                    <span class="nav-main-link-name">Products</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/products/all">
                            <i class="nav-main-link-icon si si-bag"></i>
                            <span class="nav-main-link-name">All Products</span>
                        </a>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/products">
                            <i class="nav-main-link-icon si si-bag"></i>
                            <span class="nav-main-link-name">Add New Product</span>
                        </a>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/categories">
                            <i class="nav-main-link-icon si si-bag"></i>
                            <span class="nav-main-link-name">Categories</span>
                        </a>
                    </li>


                </ul>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/orders">
                    <i class="nav-main-link-icon si si-bag"></i>
                    <span class="nav-main-link-name">Orders</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/stores">
                    <i class="nav-main-link-icon si si-home"></i>
                    <span class="nav-main-link-name">Stores </span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/non-shopify-users">
                    <i class="nav-main-link-icon si si-user"></i>
                    <span class="nav-main-link-name">Non Shopify Users</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/sales-managers">
                    <i class="nav-main-link-icon si si-users"></i>
                    <span class="nav-main-link-name">Sales Managers</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/refunds">
                    <i class="nav-main-link-icon fa fa-receipt"></i>
                    <span class="nav-main-link-name">Refunds</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/tickets">
                    <i class="nav-main-link-icon fa fa-ticket-alt"></i>
                    <span class="nav-main-link-name">Tickets</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/wallets">
                    <i class="nav-main-link-icon fa fa-wallet"></i>
                    <span class="nav-main-link-name">Wallets</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/wishlists">
                    <i class="nav-main-link-icon fa fa-heart"></i>
                    <span class="nav-main-link-name">Wishlist</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/zones">
                    <i class="nav-main-link-icon si si-map"></i>
                    <span class="nav-main-link-name">Shipping Zones</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/default/settings">
                    <i class="nav-main-link-icon si si-support"></i>
                    <span class="nav-main-link-name">Settings</span>
                </a>
            </li>

        </ul>
    </div>
</nav>

<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>

            <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout" data-action="header_search_on">
                <i class="si si-magnifier"></i>
            </button>
            <form class="d-none d-sm-inline-block" action="" method="POST">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                    <div class="input-group-append">
                                    <span class="input-group-text bg-body border-0">
                                        <i class="si si-magnifier"></i>
                                    </span>
                    </div>
                </div>
            </form>
        </div>



        <div class="d-flex align-items-center">
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded" src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/media/avatars/avatar10.jpg" alt="Header Avatar" style="width: 18px;">
                    <span class="d-none d-sm-inline-block ml-1">Admin</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">



                    <div class="p-2">











                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="/logout">
                            <span>Log Out</span>
                            <i class="si si-logout ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>































        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-white">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-danger" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
        </div>
    </div>
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
</header>







































































































    <main id="main-container">
                    <div class="bg-body-light">
        <div class="content content-full pt-3 pb-3">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h5 my-2">
                    Add New Product
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Products</a>
                        </li>

                        <li class="breadcrumb-item">Add New</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <form id="create_product_form" action="https://phpstack-362288-1193299.cloudwaysapps.com/products/save" class="form-horizontal  push-30" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="Cz7q7ASgxWmtW5NNv4lnOyqYmtOYddoUnh7ybvV9">        <div class="content">
            <div class="row mb2">
                <div class="col-sm-12 text-right mb-3">
                    <a href="https://phpstack-362288-1193299.cloudwaysapps.com/products" class="btn btn-default btn-square ">Discard</a>
                    <button class="btn btn-success btn-square submit-button">Save</button>
                </div>
            </div>
            <!-- Info -->
            <div class="row">
                <div class="col-sm-8">
                    <div class="block">
                        <div class="block-content block-content-full">

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="product-name">Title</label>
                                    <input class="form-control" type="text" id="product-name" name="title"
                                           placeholder="Short Sleeve Shirt" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 push-10">
                                    <div class="form-material form-material-primary">
                                        <label>Description</label>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <textarea class="js-summernote" name="description"
                                              placeholder="Please Enter Description here !"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Images</h3>
                        </div>
                        <div class="block-content">
                            <div class="row" >
                                <div class=" col-md-12" style="padding-bottom: 13px;">
                                    <div class="dropzone dz-clickable">
                                        <div class="dz-default dz-message"><span>Click here to upload images.</span></div>
                                        <div class="row preview-drop"></div>
                                    </div>

                                    <input style="display: none" accept="image/*"  type="file"  name="images[]" class="push-30-t dz-hidden-input push-30 images-upload" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Pricing</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" class="form-control" name="price" placeholder="$ 0.00" required>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                    <label>Cost Per Item</label>
                                    <input type="text" class="form-control" name="cost"
                                           placeholder="$ 0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 ">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control" name="quantity" placeholder="0" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 ">
                                            <label>Weight</label>
                                            <input type="text" class="form-control" name="weight" placeholder="0.0Kg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 ">
                                            <label>SKU</label>
                                            <input type="text" class="form-control" name="sku" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <div class="col-xs-12 ">
                                            <label>Barcode</label>
                                            <input type="text" class="form-control" name="barcode">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Variant</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <div class="col-xs-12 push-10">
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" name="variants" class="custom-control-input" id="val-terms"  value="1">
                                        <label class="custom-control-label" for="val-terms">This product has multiple options, like
                                            different sizes or colors</label>
                                    </div>
                                </div>
                            </div>

                            <div class="variant_options" style="display: none;">
                                <hr>
                                <h3 class="font-w300">Options</h3>
                                <br>
                                <div class="form-group">
                                    <div class="col-xs-12 push-10">
                                        <h5>Option 1</h5>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" value="Size">
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="js-tags-options options-preview form-control" type="text"
                                                       id="product-meta-keywords" name="option1" value="">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-light btn-square option_btn_1 mt-2">
                                            Add another option
                                        </button>
                                    </div>
                                </div>
                                <div class="option_2" style="display: none;">
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-xs-12 push-10">
                                            <h5>Option 2</h5>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" value="Color">
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="js-tags-options options-preview form-control" type="text"
                                                           id="product-meta-keywords" name="option2">
                                                </div>
                                            </div>
                                            <button type="button"
                                                    class="btn btn-light btn-square option_btn_2 mt-2">Add another
                                                option
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="option_3" style="display: none;">
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-xs-12 push-10">
                                            <h5>Option 3</h5>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" value="Material">
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="js-tags-options options-preview form-control" type="text"
                                                           id="product-meta-keywords" name="option3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="variants_table" style="display: none;">
                                    <hr>
                                    <h3 class="block-title">Preview</h3>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-xs-12 push-10">
                                            <table class="table table-hover table-responsive">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10%;">Title</th>
                                                    <th style="width: 20%;">Price</th>
                                                    <th style="width: 23%;">Cost</th>
                                                    <th style="width: 10%;">Quantity</th>
                                                    <th style="width: 20%;">SKU</th>
                                                    <th style="width: 20%;">Barcode</th>
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
                </div>
                <div class="col-sm-4">
                    <div class="block">
                        <div class="block-header">
                            <div class="block-title">
                                Status
                            </div>
                        </div>
                        <div class="block-content pt-0">
                            <div class="form-group">
                                <div class="custom-control custom-radio mb-1">
                                    <input type="radio" class="custom-control-input" id="example-radio-customPublished" name="status" value="1" checked="">
                                    <label class="custom-control-label" for="example-radio-customPublished">Published</label>
                                </div>
                                <div class="custom-control custom-radio mb-1">
                                    <input type="radio" class="custom-control-input" id="example-radio-customDraft" name="status" value="0" >
                                    <label class="custom-control-label" for="example-radio-customDraft">Draft</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="block">
                        <div class="block-header">
                            <div class="block-title">
                                Mark as Fulfilled
                            </div>
                        </div>
                        <div class="block-content pt-0" >
                            <div class="form-group">
                            <div class="custom-control custom-radio mb-1">
                                <input type="radio" required class="custom-control-input" id="example-radio-customfulfilled" name="fulfilled-by" value="Fantasy" checked="">
                                <label class="custom-control-label" for="example-radio-customfulfilled">By WeFullFill</label>
                            </div>
                            <div class="custom-control custom-radio mb-1">
                                <input type="radio" required class="custom-control-input" id="example-radio-customAliExpress" name="fulfilled-by" value="AliExpress" >
                                <label class="custom-control-label" for="example-radio-customAliExpress">By AliExpress</label>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-header">
                            <div class="block-title">
                                <h3 class="block-title">Product Category</h3>
                            </div>
                        </div>
                            <div class="block-content" style="height: 300px;overflow-y: auto;overflow-x: hidden;">
                                <div class="form-group product_category">
                                                                            <span class="category_down" data-value="0" style="margin-right: 5px;font-size: 16px;vertical-align: middle"><i class="fa fa-angle-right"></i></span>
                                        <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="category[]" value="7" class="custom-control-input category_checkbox" id="rowcat_Computer &amp; Office">
                                            <label class="custom-control-label" for="rowcat_Computer &amp; Office">Computer &amp; Office</label>
                                        </div>
                                        <div class="row product_sub_cat" style="display: none">
                                            <div class="col-xs-12 col-xs-push-1">
                                                                                            </div>
                                        </div>
                                        <br>
                                                                            <span class="category_down" data-value="0" style="margin-right: 5px;font-size: 16px;vertical-align: middle"><i class="fa fa-angle-right"></i></span>
                                        <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="category[]" value="6" class="custom-control-input category_checkbox" id="rowcat_Home Improvement">
                                            <label class="custom-control-label" for="rowcat_Home Improvement">Home Improvement</label>
                                        </div>
                                        <div class="row product_sub_cat" style="display: none">
                                            <div class="col-xs-12 col-xs-push-1">
                                                                                            </div>
                                        </div>
                                        <br>
                                                                            <span class="category_down" data-value="0" style="margin-right: 5px;font-size: 16px;vertical-align: middle"><i class="fa fa-angle-right"></i></span>
                                        <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="category[]" value="5" class="custom-control-input category_checkbox" id="rowcat_Car Electronics">
                                            <label class="custom-control-label" for="rowcat_Car Electronics">Car Electronics</label>
                                        </div>
                                        <div class="row product_sub_cat" style="display: none">
                                            <div class="col-xs-12 col-xs-push-1">
                                                                                            </div>
                                        </div>
                                        <br>
                                                                            <span class="category_down" data-value="0" style="margin-right: 5px;font-size: 16px;vertical-align: middle"><i class="fa fa-angle-right"></i></span>
                                        <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="category[]" value="4" class="custom-control-input category_checkbox" id="rowcat_Health &amp; Personal Care">
                                            <label class="custom-control-label" for="rowcat_Health &amp; Personal Care">Health &amp; Personal Care</label>
                                        </div>
                                        <div class="row product_sub_cat" style="display: none">
                                            <div class="col-xs-12 col-xs-push-1">
                                                                                            </div>
                                        </div>
                                        <br>
                                                                            <span class="category_down" data-value="0" style="margin-right: 5px;font-size: 16px;vertical-align: middle"><i class="fa fa-angle-right"></i></span>
                                        <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="category[]" value="3" class="custom-control-input category_checkbox" id="rowcat_Consumer Electronic">
                                            <label class="custom-control-label" for="rowcat_Consumer Electronic">Consumer Electronic</label>
                                        </div>
                                        <div class="row product_sub_cat" style="display: none">
                                            <div class="col-xs-12 col-xs-push-1">
                                                                                                    <div class="custom-control custom-checkbox d-inline-block">
                                                        <input type="checkbox" name="sub_cat[]" value="8" class="custom-control-input sub_cat_checkbox" id="rowsub_Smart Wear">
                                                        <label class="custom-control-label" for="rowsub_Smart Wear">Smart Wear</label>
                                                    </div>
                                                    <br>
                                                                                                    <div class="custom-control custom-checkbox d-inline-block">
                                                        <input type="checkbox" name="sub_cat[]" value="9" class="custom-control-input sub_cat_checkbox" id="rowsub_Headphone&amp;Earphone">
                                                        <label class="custom-control-label" for="rowsub_Headphone&amp;Earphone">Headphone&amp;Earphone</label>
                                                    </div>
                                                    <br>
                                                                                                    <div class="custom-control custom-checkbox d-inline-block">
                                                        <input type="checkbox" name="sub_cat[]" value="10" class="custom-control-input sub_cat_checkbox" id="rowsub_Smart Home">
                                                        <label class="custom-control-label" for="rowsub_Smart Home">Smart Home</label>
                                                    </div>
                                                    <br>
                                                                                                    <div class="custom-control custom-checkbox d-inline-block">
                                                        <input type="checkbox" name="sub_cat[]" value="11" class="custom-control-input sub_cat_checkbox" id="rowsub_Action Camera&amp;DV">
                                                        <label class="custom-control-label" for="rowsub_Action Camera&amp;DV">Action Camera&amp;DV</label>
                                                    </div>
                                                    <br>
                                                                                                    <div class="custom-control custom-checkbox d-inline-block">
                                                        <input type="checkbox" name="sub_cat[]" value="14" class="custom-control-input sub_cat_checkbox" id="rowsub_Drones">
                                                        <label class="custom-control-label" for="rowsub_Drones">Drones</label>
                                                    </div>
                                                    <br>
                                                                                            </div>
                                        </div>
                                        <br>
                                                                            <span class="category_down" data-value="0" style="margin-right: 5px;font-size: 16px;vertical-align: middle"><i class="fa fa-angle-right"></i></span>
                                        <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="category[]" value="2" class="custom-control-input category_checkbox" id="rowcat_Mobile Accessories">
                                            <label class="custom-control-label" for="rowcat_Mobile Accessories">Mobile Accessories</label>
                                        </div>
                                        <div class="row product_sub_cat" style="display: none">
                                            <div class="col-xs-12 col-xs-push-1">
                                                                                                    <div class="custom-control custom-checkbox d-inline-block">
                                                        <input type="checkbox" name="sub_cat[]" value="6" class="custom-control-input sub_cat_checkbox" id="rowsub_Wireless Charger">
                                                        <label class="custom-control-label" for="rowsub_Wireless Charger">Wireless Charger</label>
                                                    </div>
                                                    <br>
                                                                                                    <div class="custom-control custom-checkbox d-inline-block">
                                                        <input type="checkbox" name="sub_cat[]" value="7" class="custom-control-input sub_cat_checkbox" id="rowsub_Cable&amp;Chargers&amp;Adapter">
                                                        <label class="custom-control-label" for="rowsub_Cable&amp;Chargers&amp;Adapter">Cable&amp;Chargers&amp;Adapter</label>
                                                    </div>
                                                    <br>
                                                                                                    <div class="custom-control custom-checkbox d-inline-block">
                                                        <input type="checkbox" name="sub_cat[]" value="13" class="custom-control-input sub_cat_checkbox" id="rowsub_Other Accessories">
                                                        <label class="custom-control-label" for="rowsub_Other Accessories">Other Accessories</label>
                                                    </div>
                                                    <br>
                                                                                            </div>
                                        </div>
                                        <br>
                                                                    </div>
                            </div>
                        <div class="block-footer" style="height: 15px"></div>
                    </div>
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Organization</h3>
                        </div>
                        <div class="block-content pt-0">
                            <div class="form-group">
                                <div class="col-xs-12 push-10">
                                    <label>Product Type</label>
                                    <input type="text" class="form-control" name="product_type"
                                           placeholder="eg. Shirts">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 push-10">
                                    <label>Vendor</label>
                                    <input type="text" class="form-control" name="vendor" placeholder="eg. Nike">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-primary">
                                        <label>Tags</label>
                                        <input class="js-tags-input form-control" type="text"
                                               id="product-meta-keywords" name="tags" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">More Details</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <div class="col-xs-12 push-10">
                                    <label>Processing Time</label>
                                    <input type="text" class="form-control" name="processing_time" placeholder="eg. 7 working days" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label>Warned Platform</label>
                                    <br>
                                                                            <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="platforms[]" value="3" class="custom-control-input" id="row_Aliexpress">
                                            <label class="custom-control-label" for="row_Aliexpress">Aliexpress</label>
                                        </div>
                                        <br>
                                                                                <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="platforms[]" value="4" class="custom-control-input" id="row_Amazon">
                                            <label class="custom-control-label" for="row_Amazon">Amazon</label>
                                        </div>
                                        <br>
                                                                                <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="platforms[]" value="7" class="custom-control-input" id="row_Ebay">
                                            <label class="custom-control-label" for="row_Ebay">Ebay</label>
                                        </div>
                                        <br>
                                                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Preferences</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <div class="custom-control custom-radio mb-1">
                                    <input type="radio" required class="custom-control-input preference-check" id="prefer-global" name="global" value="1" checked="">
                                    <label class="custom-control-label " for="prefer-global">Global</label>
                                </div>
                                <div class="custom-control custom-radio mb-1">
                                    <input type="radio" required class="custom-control-input preference-check" id="prefer-store" name="global" value="0" >
                                    <label class="custom-control-label" for="prefer-store">Selected Stores</label>
                                </div>
                            </div>
                            <div class="form-group" style="display: none">
                                <div class="form-material">
                                    <label for="material-error">Stores <i class="fa fa-question-circle"  title="Store where product you want to show."> </i></label>
                                    <select class="form-control shop-preference js-select2" style="width: 100%;" data-placeholder="Choose multiple markets.." name="shops[]"   multiple="">
                                        <option></option>
                                                                                    <option value="1">fantasy-supplier</option>
                                                                                    <option value="2">retailer-module</option>
                                                                                    <option value="3">smokedrop-retailer-testing-store</option>
                                                                                    <option value="4">the-dev-studio</option>
                                                                                    <option value="5">groupybuy</option>
                                                                                    <option value="6">fantasysupply</option>
                                                                                    <option value="8">test</option>
                                                                                    <option value="9">fantasysupply</option>
                                                                            </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="row ">
                        <div class="col-sm-12 text-right">
                            <hr>
                            <a href="https://phpstack-362288-1193299.cloudwaysapps.com/products" class="btn btn-default btn-square ">Discard</a>
                            <button class="btn btn-primary btn-square submit-button">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </main>

    <footer id="page-footer" class="bg-body-light">
    <div class="content py-3">
        <div class="row font-size-sm">
            <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                Developed for <i class="fa fa-bolt text-danger"></i> by <a class="font-w600" href="https://tetralogicx.com" target="_blank">Tetralogicx Pvt Ltd</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/oneui.core.min.js"></script>
<script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/oneui.app.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>]
<script src="https://phpstack-362288-1193299.cloudwaysapps.com/js/admin.js?v=2020-07-05 09:22:07"></script>
{{--<script src="https://phpstack-362288-1193299.cloudwaysapps.com/js/shopify-user.js?v=2020-07-05 09:22:07"></script>--}}
{{--<script src="https://phpstack-362288-1193299.cloudwaysapps.com/js/manager.js?v=2020-07-05 09:22:07"></script>--}}
<script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/summernote/summernote-bs4.min.js"></script>


<script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/dropzone/dist/dropzone.js"></script>
<script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/select2/js/select2.min.js"></script>
<script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/flatpickr/flatpickr.js"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/jquery-ui/jquery-ui.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>jQuery(function(){ One.helpers(['summernote','magnific-popup','table-tools-sections','core-bootstrap-tooltip','select2','flatpickr']); });</script>

    <div class="pre-loader">
        <div class="loader">
        </div>
    </div>
</div>

<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","licenseKey":"1aac60aeb9","applicationID":"476944629","transactionName":"NgQGbENSVkAHU0dYCg9OJVtFWlddSUBBXgEUAhAWUkFdUhJV","queueTime":0,"applicationTime":120,"atts":"GkMFGgtIRU4=","errorBeacon":"bam.nr-data.net","agent":""}</script></body>
</html>
