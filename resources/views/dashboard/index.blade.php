@extends('../layouts.layout')
@section('title')
    Dashboard
@endsection

@section('body')
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-image overflow-hidden" style="background-image: url('{{asset('assets/media/photos/photo3@2x.jpg')}}');">
            <div class="bg-primary-dark-op">
                <div class="content content-narrow content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-left">
                        <div class="flex-sm-fill">
                            <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">Dashboard</h1>
                            <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">Welcome
                                {{ Auth::user()->name }}</h2>
                        </div>
                        <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                                    <span class="d-inline-block invisible" data-toggle="appear" data-timeout="350">
                                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content content-narrow">
            <!-- Stats -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">{{session('success')}}</p>
                    </div>
                @endif
                @if(session('form_error'))
                    <div class="alert alert-warning alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">{{session('form_error')}}</p>
                    </div>
                @endif
            <!-- END Customers and Latest Orders -->
        </div>

        <?php
        $role = auth()->user()->roles()->pluck('role_id');
        if($role[0]=='1')
        {
            ?>
        <div class="content">
            <div class="row mb-2" style="padding-bottom:1.875rem">
                <div class="col-md-4 d-flex">
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span>{{$date_range}}</span> <i class="fa fa-caret-down"></i>
                    </div>
                    <button class="btn btn-primary filter_by_date" data-url="{{route('admin.dashboard')}}" style="margin-left: 10px"> Filter </button>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Orders</div>
                            <div class="font-size-h2 font-w400 text-dark">{{$orders}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Sales</div>
                            <div class="font-size-h2 font-w400 text-dark">${{number_format($sales,2)}}</div>
                        </div>
                    </a>
                </div>
{{--                <div class="col-6 col-md-3 col-lg-6 col-xl-3">--}}
{{--                    <a class="block block-rounded block-link-pop" href="javascript:void(0)">--}}
{{--                        <div class="block-content block-content-full">--}}
{{--                            <div class="font-size-sm font-w600 text-uppercase text-muted">Refunds</div>--}}
{{--                            <div class="font-size-h2 font-w400 text-dark">${{number_format($refunds,2)}}</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">New Vendors</div>
                            <div class="font-size-h2 font-w400 text-dark">{{$stores}}</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="block block-rounded block-link-pop">
                        <div class="block-content block-content-full">
                            <canvas id="canvas-graph-one" data-labels="{{json_encode($graph_one_labels)}}" data-values="{{json_encode($graph_one_values)}}"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block block-rounded block-link-pop">
                        <div class="block-content block-content-full">
                            <canvas id="canvas-graph-two" data-labels="{{json_encode($graph_one_labels)}}" data-values="{{json_encode($graph_two_values)}}"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="block block-rounded block-link-pop">
                        <div class="block-content block-content-full">
                            <canvas id="canvas-graph-three" data-labels="{{json_encode($graph_three_labels)}}" data-values="{{json_encode($graph_three_values)}}"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block block-rounded block-link-pop">
                        <div class="block-content block-content-full">
                            <canvas id="canvas-graph-four" data-labels="{{json_encode($graph_four_labels)}}" data-values="{{json_encode($graph_four_values)}}"></canvas>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="block block-rounded">--}}
{{--                        <div class="block-header block-header-default">--}}
{{--                            <h3 class="block-title">Top Selling Products - Stores</h3>--}}
{{--                        </div>--}}
{{--                        <div class="block-content ">--}}
{{--                            @if(count($top_products_stores) > 0)--}}
{{--                                <table class="table table-striped table-hover table-borderless table-vcenter">--}}
{{--                                    <thead>--}}
{{--                                    <tr class="text-uppercase">--}}
{{--                                        <th class="font-w700">Product</th>--}}
{{--                                        <th class="d-none d-sm-table-cell font-w700 text-center" style="width: 80px;">Quantity</th>--}}
{{--                                        <th class="font-w700 text-center" style="width: 60px;">Sales</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}

{{--                                    @foreach($top_products_stores as $product)--}}
{{--                                        <tr>--}}
{{--                                            <td class="font-w600">--}}
{{--                                                @foreach($product->has_images()->orderBy('position')->get() as $index => $image)--}}
{{--                                                    @if($index == 0)--}}
{{--                                                        @if($image->isV == 0)--}}
{{--                                                            <img class="img-avatar img-avatar32" style="margin-right: 5px" src="{{asset('images')}}/{{$image->image}}" alt="">--}}
{{--                                                        @else--}}
{{--                                                            <img class="img-avatar img-avatar32" style="margin-right: 5px" src="{{asset('images/variants')}}/{{$image->image}}" alt="">--}}
{{--                                                        @endif--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                                {{$product->title}}--}}
{{--                                            </td>--}}
{{--                                            <td class="d-none d-sm-table-cell text-center">--}}
{{--                                                {{$product->sold}}--}}
{{--                                            </td>--}}
{{--                                            <td class="">--}}
{{--                                                ${{number_format($product->selling_cost,2)}}--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}

{{--                                    </tbody>--}}
{{--                                    @else--}}
{{--                                        <p  class="text-center"> No Top Products Based on Stores Found </p>--}}
{{--                                    @endif--}}
{{--                                </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Top Selling Products</h3>
                        </div>
                        <div class="block-content ">
                            @if(count($top_products_users) > 0)
                                <table class="table table-striped table-hover table-borderless table-vcenter">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th class="font-w700">Product</th>
                                        <th class="d-none d-sm-table-cell font-w700 text-center" style="width: 80px;">Quantity</th>
                                        <th class="font-w700 text-center" style="width: 60px;">Sales</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($top_products_users as $product)
                                        <tr>
                                            <td class="font-w600">
                                                @if($product->has_image)
                                                @foreach($product->has_image as $index => $image)
                                                    @if($index==0)
                                                            <img class="img-avatar img-avatar32" style="margin-right: 5px" src="{{asset('images')}}/{{$image->src}}" alt="">
                                                    @endif
                                                @endforeach
                                                @else
                                                    <img class="img-avatar img-avatar32" style="margin-right: 5px" src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg" alt="">

                                                    @endif
                                                {{$product->Title}}
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center">
                                                {{$product->sold}}
                                            </td>
                                            <td class="">
                                                ${{number_format($product->selling_cost,2)}}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    @else
                                        <p  class="text-center"> No Top Products Based on Users Found </p>
                                    @endif
                                </table>
                        </div>
                    </div>
                </div>
{{--                <div class="col-md-6">--}}
{{--                    <div class="block block-rounded">--}}
{{--                        <div class="block-header block-header-default">--}}
{{--                            <h3 class="block-title">Top Stores</h3>--}}
{{--                        </div>--}}
{{--                        <div class="block-content ">--}}
{{--                            @if(count($top_stores) > 0)--}}
{{--                                <table class="table table-striped table-hover table-borderless table-vcenter">--}}
{{--                                    <thead>--}}
{{--                                    <tr class="text-uppercase">--}}
{{--                                        <th class="font-w700">Store</th>--}}
{{--                                        <th class="d-none d-sm-table-cell font-w700 text-center" style="width: 80px;">Orders</th>--}}
{{--                                        <th class="font-w700 text-center" style="width: 60px;">Sales</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}

{{--                                    @foreach($top_stores as $store)--}}
{{--                                        <tr>--}}
{{--                                            <td class="font-w600">--}}
{{--                                                {{explode('.',$store->shopify_domain)[0]}}--}}
{{--                                            </td>--}}
{{--                                            <td class="d-none d-sm-table-cell text-center">--}}
{{--                                                {{$store->sold}}--}}
{{--                                            </td>--}}
{{--                                            <td class="">--}}
{{--                                                ${{number_format($store->selling_cost,2)}}--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}

{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            @else--}}
{{--                                <p  class="text-center"> No Top Stores Found </p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="block block-rounded">--}}
{{--                        <div class="block-header block-header-default">--}}
{{--                            <h3 class="block-title">Top Non Shopify Users</h3>--}}
{{--                        </div>--}}
{{--                        <div class="block-content ">--}}
{{--                            @if(count($top_users) > 0)--}}
{{--                                <table class="table table-striped table-hover table-borderless table-vcenter">--}}
{{--                                    <thead>--}}
{{--                                    <tr class="text-uppercase">--}}
{{--                                        <th class="font-w700">User</th>--}}
{{--                                        <th class="font-w700">Email</th>--}}
{{--                                        <th class="d-none d-sm-table-cell font-w700 text-center" style="width: 80px;">Orders</th>--}}
{{--                                        <th class="font-w700 text-center" style="width: 60px;">Sales</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}

{{--                                    @foreach($top_users as $user)--}}
{{--                                        <tr>--}}
{{--                                            <td class="font-w600">--}}
{{--                                                {{$user->name}} {{$user->last_name}}--}}
{{--                                            </td>--}}
{{--                                            <td class="font-w600">--}}
{{--                                                {{$user->email}}--}}
{{--                                            </td>--}}
{{--                                            <td class="d-none d-sm-table-cell text-center">--}}
{{--                                                {{$user->sold}}--}}
{{--                                            </td>--}}
{{--                                            <td class="">--}}
{{--                                                ${{number_format($user->selling_cost,2)}}--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            @else--}}
{{--                                <p  class="text-center"> No Top Users Found </p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
        <!-- END Page Content -->

        <?php
         }
         ?>
    </main>
@endsection
@section('scripts')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        if($('body').find('#reportrange').length > 0){
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            if($('#reportrange span').text() === ''){
                $('#reportrange span').html('Select Date Range');
            }


            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            // cb(start, end);
        }

        $('body').on('click','.filter_by_date', function() {
            let daterange_string = $('#reportrange').find('span').text();
            if(daterange_string !== '' && daterange_string !== 'Select Date Range'){
                window.location.href = $(this).data('url')+'?date-range='+daterange_string;
            }
            else{
                alertify.error('Please Select Range');
            }
        });


        $(document).ready(function () {
            if ($('body').find('#canvas-graph-one').length > 0) {
                console.log('ok');
                var config = {
                    type: 'bar',
                    data: {
                        labels: JSON.parse($('#canvas-graph-one').attr('data-labels')),
                        datasets: [{
                            label: 'Order Count',
                            backgroundColor: '#00e2ff',
                            borderColor: '#00e2ff',
                            data: JSON.parse($('#canvas-graph-one').attr('data-values')),
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Summary Orders Count'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Date'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Value'
                                }
                            }]
                        }
                    }
                };

                var ctx = document.getElementById('canvas-graph-one').getContext('2d');
                window.myBar = new Chart(ctx, config);
            }

            if ($('body').find('#canvas-graph-two').length > 0) {
                console.log('ok');
                var config = {
                    type: 'line',
                    data: {
                        labels: JSON.parse($('#canvas-graph-two').attr('data-labels')),
                        datasets: [{
                            label: 'Orders Sales',
                            backgroundColor: '#5c80d1',
                            borderColor: '#5c80d1',
                            data: JSON.parse($('#canvas-graph-two').attr('data-values')),
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Summary Orders Sales'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Date'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Sales'
                                }
                            }]
                        }
                    }
                };

                var ctx_2 = document.getElementById('canvas-graph-two').getContext('2d');
                window.myLine = new Chart(ctx_2, config);
            }

            if ($('body').find('#canvas-graph-three').length > 0) {
                console.log('ok');
                var config = {
                    type: 'line',
                    data: {
                        labels: JSON.parse($('#canvas-graph-three').attr('data-labels')),
                        datasets: [{
                            label: 'Refunds',
                            backgroundColor: '#d18386',
                            borderColor: '#d14d48',
                            data: JSON.parse($('#canvas-graph-three').attr('data-values')),
                            fill: 'start',
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Summary Orders Refunds'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Date'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Refunds'
                                }
                            }]
                        }
                    }
                };

                var ctx_3 = document.getElementById('canvas-graph-three').getContext('2d');
                window.myLine = new Chart(ctx_3, config);
            }

            if ($('body').find('#canvas-graph-four').length > 0) {
                console.log('ok');
                var config = {
                    type: 'line',
                    data: {
                        labels: JSON.parse($('#canvas-graph-four').attr('data-labels')),
                        datasets: [{
                            label: 'Stores',
                            backgroundColor: '#61d154',
                            borderColor: '#61d154',
                            data: JSON.parse($('#canvas-graph-four').attr('data-values')),
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Summary New Stores'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Date'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Stores'
                                }
                            }]
                        }
                    }
                };

                var ctx_4 = document.getElementById('canvas-graph-four').getContext('2d');
                window.myLine = new Chart(ctx_4, config);
            }

        });
    </script>


@endsection
