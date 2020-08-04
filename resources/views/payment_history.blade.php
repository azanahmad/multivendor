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
            <div class="row">
                <div class="col-lg-6">
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">
                               Active Plan Information
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option">
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            @if(isset($agreement))
                            <p><b>Plan Name : </b>{{$agreement->description}}</p>
                            <p><b>Products Allow : </b>{{$package->no_products_allow}}</p>
{{--                            <p><b>Amount : </b>{{$package->rates.' $ / Per '.$package->type}}</p>--}}
                            <p><b>Plan Status : </b>{{$agreement->state}}</p>
                            <p><b>Start Date : </b>{{date_create($agreement->start_date)->format('D m, Y h:i a') }}</p>
                            <p><b>Last Payment Date : </b>{{date_create($agreement_details->last_payment_date)->format('D m, Y h:i a') }}</p>
                            <p><b>Last Payment Amount : </b>{{'$' .$agreement_details->last_payment_amount->value}}</p>
                            <p><b>Next Payment Date : </b>{{date_create($agreement_details->next_billing_date)->format('D m, Y h:i a') }}</p>
                        @endif

                                @if(isset($details))
{{--                                    <p><b>Plan Name : </b>{{$package->package_name}}</p>--}}
{{--                                    <p><b>Products Allow : </b>{{$package->no_products_allow}}</p>--}}
                                    <p><b>Plan Status : </b>{{$details->status}}</p>
                                    <p><b>Start Date : </b>{{date("m/d/Y h:i:s A T",$details->start_date)}}</p>
                                    <p><b>Next Payment Date : </b>{{date("m/d/Y h:i:s A T",$details->current_period_end)}}</p>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>

@endsection
