@extends('../layouts.layout')
@section('title')
    Pricing
@endsection
@section('body')
    <main id="main-container">
        <!-- Hero -->
    {{--        <div class="bg-body-light">--}}
    {{--            <div class="content content-full">--}}
    {{--                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">--}}
    {{--                    <h1 class="flex-sm-fill h3 my-2">--}}
    {{--                        Pricing Tables <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Clean and responsive pricing tables that will improve your conversions.</small>--}}
    {{--                    </h1>--}}
    {{--                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">--}}
    {{--                        <ol class="breadcrumb breadcrumb-alt">--}}
    {{--                            <li class="breadcrumb-item">Tables</li>--}}
    {{--                            <li class="breadcrumb-item" aria-current="page">--}}
    {{--                                <a class="link-fx" href="">Pricing</a>--}}
    {{--                            </li>--}}
    {{--                        </ol>--}}
    {{--                    </nav>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    <!-- END Hero -->
        <!-- Page Content -->
        <div class="content">
            <!-- Modern Design -->
            <h2 class="content-heading">Pricing <small></small></h2>
            @if(session('form_error'))
                <div class="alert alert-warning alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="mb-0">{{session('form_error')}}</p>
                </div>
            @endif
            <div class="row">
                @foreach($package as $package)
                    <div class="col-md-6 col-xl-3">
                        <!-- Developer Plan -->
                        <a class="block block-link-shadow text-center" href="javascript:void(0)">
                            <div class="block-header">
                                <h3 class="block-title">{{$package->plan_description}}</h3>
                            </div>
                            <div class="block-content bg-body-light">
                                <div class="py-2">
                                    <p class="h1 font-w700 mb-2">${{$package->rates}}</p>
                                    <p class="h6 text-muted">per {{$package->type}}</p>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="font-size-sm py-2">
                                    <p>
                                        <strong>{{$package->no_products_allow	}}</strong> Products
                                    </p>
                                    {{--                                <p>--}}
                                    {{--                                    <strong>10GB</strong> Storage--}}
                                    {{--                                </p>--}}
                                    {{--                                <p>--}}
                                    {{--                                    <strong>15</strong> Clients--}}
                                    {{--                                </p>--}}
                                    {{--                                <p>--}}
                                    {{--                                    <strong>Email</strong> Support--}}
                                    {{--                                </p>--}}
                                </div>
                            </div>
                            <div class="block-content block-content-full bg-body-light">

                                {{--                            <span class="btn btn-secondary px-4" onclick="window.location.href='{{route('create_agreement',['id'=>$package->paypal_plan_id])}}';">Subscribe</span>--}}
                                <span class="btn btn-secondary px-4" onclick="window.location.href='{{route('cart_page',['id'=>encrypt($package->id)])}}';">Subscribe</span>
                            </div>
                        </a>
                        <!-- END Developer Plan -->
                    </div>
                @endforeach
                {{--                <div class="col-md-6 col-xl-3">--}}
                {{--                    <!-- Business Plan -->--}}
                {{--                    <a class="block block-link-shadow block-themed block-fx-shadow text-center" href="javascript:void(0)">--}}
                {{--                        <div class="block-header">--}}
                {{--                            <h3 class="block-title">--}}
                {{--                                <i class="fa fa-thumbs-up mr-1"></i> Business--}}
                {{--                            </h3>--}}
                {{--                        </div>--}}
                {{--                        <div class="block-content bg-body-light">--}}
                {{--                            <div class="py-2">--}}
                {{--                                <p class="h1 font-w700 mb-2">$49</p>--}}
                {{--                                <p class="h6 text-muted">per month</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="block-content">--}}
                {{--                            <div class="font-size-sm py-2">--}}
                {{--                                <p>--}}
                {{--                                    <strong>50</strong> Projects--}}
                {{--                                </p>--}}
                {{--                                <p>--}}
                {{--                                    <strong>100GB</strong> Storage--}}
                {{--                                </p>--}}
                {{--                                <p>--}}
                {{--                                    <strong>1000</strong> Clients--}}
                {{--                                </p>--}}
                {{--                                <p>--}}
                {{--                                    <strong>FULL</strong> Support--}}
                {{--                                </p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="block-content block-content-full bg-body-light">--}}
                {{--                            <span class="btn btn-primary px-4">Sign Up</span>--}}
                {{--                        </div>--}}
                {{--                    </a>--}}
                {{--                    <!-- END Business Plan -->--}}
                {{--                </div>--}}

            </div>
        </div>
        <!-- END Page Content -->
    </main>

@endsection
