@extends('../layouts.layout')
@section('title')
    History
@endsection
@section('body')
    <main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full pt-2 pb-2">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h4 my-2">
                    {{$user->name}}
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx active" href="">Stores</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx active" href=""> {{$user->name}}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
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
        <div class="block">
            <ul class="nav nav-tabs nav-justified nav-tabs-block " data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#orders">Orders</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link " href="#tickets">Tickets</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="#products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#customers">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#payments">Payments</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#wallet">Wallet</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#settings">Settings</a>--}}
{{--                </li>--}}
            </ul>
            <div class="block-content tab-content">
                <div class="tab-pane active" id="orders" role="tabpanel">
                    <div class="block">
                        <p class=""><span class="badge badge-danger" style="font-size: medium">Total Payable: {{$total_amount}}
                           </span>&nbsp;
                            @if($total_amount > 0)
                                <button type="button" class="btn btn-primary add_paypal" >Pay with Paypal</button>
                                &nbsp; &nbsp;
                                <button type="button" class="btn btn-secondary add_stripe" >Pay with Stripe</button>
                                @endif
                            </p>
                        <div class="block-content">
                            @if (count($orders) > 0)
                                <table class="table table-hover table-borderless table-striped table-vcenter">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Source</th>
                                        <th>Order Date</th>
                                        <th>Price</th>
                                        <th>Payment Status</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    @foreach( $orders as $index => $order)
                                        <tbody class="">
                                        <tr>
                                            <td class="font-w600"><a href="{{route('order_details',$order->id)}}">{{ $order->name }}</a></td>
                                            <td>
                                                <span class="badge badge-warning" style="font-size: 12px"> Shopify </span>
                                            </td>
                                            <td>
                                                {{date_create($order->shopify_created_at)->format('D m, Y h:i a') }}
                                            </td>

                                            <td>
                                        @foreach($payments as $payment)
                                            @if($payment->order_id == $order->id)
                                                        {{number_format($payment->total,2)}} {{$order->currency}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>

                                                    @foreach($status_payment as $pay)

                                                        @if($pay->order_id == $order->id)
                                                        @if($pay->payment_status == '0')
                                                            <span class="badge badge-warning" style="font-size: small"> Unpaid </span>
                                                        @elseif($pay->payment_status == '1')
                                                            <span class="badge badge-success" style="font-size: small"> Paid </span>
                                                        @elseif($pay->payment_status  == '2')
                                                            <span class="badge badge-danger" style="font-size: small;"> Refunded</span>
                                                        @endif
                                                        @endif
                                                    @endforeach


                                            </td>
                                            <td>
                                                @foreach($status as $status1)

                                                    @if($status1->order_id == $order->id)

                                                    @if($status1->fulfillment_status =='fulfilled')
                                                            <span class="badge badge-success" style="font-size: small">  {{$status1->fulfillment_status}} </span>

                                                        @else
                                                            <span class="badge badge-warning" style="font-size: small"> Draft </span>

                                                        @endif

                                                    @endif
                                                @endforeach

{{--                                                @if($order->status == 'Paid')--}}
{{--                                                    <span class="badge badge-primary" style="font-size: small"> Pending</span>--}}
{{--                                                @elseif($order->status == 'unfulfilled')--}}
{{--                                                    <span class="badge badge-warning" style="font-size: small"> {{ucfirst($order->status)}}</span>--}}
{{--                                                @elseif($order->status == 'partially-shipped')--}}
{{--                                                    <span class="badge " style="font-size: small;background: darkolivegreen;color: white;"> {{ucfirst($order->status)}}</span>--}}
{{--                                                @elseif($order->status == 'shipped')--}}
{{--                                                    <span class="badge " style="font-size: small;background: orange;color: white;"> {{ucfirst($order->status)}}</span>--}}
{{--                                                @elseif($order->status == 'delivered')--}}
{{--                                                    <span class="badge " style="font-size: small;background: deeppink;color: white;"> {{ucfirst($order->status)}}</span>--}}
{{--                                                @elseif($order->status == 'completed')--}}
{{--                                                    <span class="badge " style="font-size: small;background: darkslategray;color: white;"> {{ucfirst($order->status)}}</span>--}}
{{--                                                @elseif($order->status == 'new')--}}
{{--                                                    <span class="badge badge-warning" style="font-size: small"> Draft </span>--}}
{{--                                                @elseif($order->status == 'cancelled')--}}
{{--                                                    <span class="badge badge-warning" style="font-size: small"> {{ucfirst($order->status)}} </span>--}}
{{--                                                @else--}}
{{--                                                    <span class="badge badge-success" style="font-size: small">  {{ucfirst($order->status)}} </span>--}}
{{--                                                @endif--}}



                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <a href="{{route('order_details',$order->id)}}"
                                                       class="btn btn-sm btn-success" type="button" data-toggle="tooltip" title=""
                                                       data-original-title="View Order"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </td>

                                            <td></td>
                                        </tr>
                                        </tbody>
                                    @endforeach

                                </table>

                            @else
                                <p class="text-center"> No Orders Available</p>
                            @endif
                        </div>
                    </div>
                </div>
{{--                <div class="tab-pane" id="tickets" role="tabpanel">--}}
{{--                    <div class="block">--}}
{{--                        <div class="block-content">--}}
{{--                            @if(count($store->has_tickets) > 0)--}}
{{--                                <table class="table table-hover table-borderless table-striped table-vcenter">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Title</th>--}}
{{--                                        <th>Priority</th>--}}
{{--                                        <th>Category</th>--}}
{{--                                        <th>Status</th>--}}
{{--                                        <th>Last Reply at</th>--}}
{{--                                        <th style="text-align: right">--}}
{{--                                        </th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}

{{--                                    @foreach($store->has_tickets()->orderBy('updated_at','DESC')->get() as $index => $ticket)--}}
{{--                                        <tbody class="">--}}
{{--                                        <tr>--}}
{{--                                            <td class="font-w600"><a href="">{{ $ticket->title }}</a></td>--}}
{{--                                            <td>--}}
{{--                                                <span class="badge @if($ticket->priority == 'low') badge-primary @elseif($ticket->priority == 'medium') badge-warning @else badge-danger @endif" >{{$ticket->priority}}</span>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                @if($ticket->category == 'default')--}}
{{--                                                    <span class="badge badge-light">{{$ticket->category}}</span>--}}
{{--                                                @else--}}
{{--                                                    <span class="badge" style="background: {{$ticket->has_category->color}};color: white">{{$ticket->category}}</span>--}}

{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                @if($ticket->has_status != null)--}}
{{--                                                    <span class="badge " style="background: {{$ticket->has_status->color}};color: white;"> {{$ticket->has_status->status}}</span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}

{{--                                            <td>{{\Carbon\Carbon::parse($ticket->last_reply_at)->diffForHumans()}}</td>--}}
{{--                                            <td class="">--}}
{{--                                                <div class="btn-group">--}}
{{--                                                    <a href="{{route('tickets.view',$ticket->id)}}"--}}
{{--                                                       class="btn btn-sm btn-success" type="button" data-toggle="tooltip" title=""--}}
{{--                                                       data-original-title="View Ticket"><i class="fa fa-eye"></i></a>--}}
{{--                                                    <a href=""--}}
{{--                                                       class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" title=""--}}
{{--                                                       data-original-title="Delete Ticket"><i class="fa fa-times"></i></a>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}

{{--                                        </tr>--}}
{{--                                        </tbody>--}}

{{--                                    @endforeach--}}
{{--                                </table>--}}

{{--                            @else--}}
{{--                                <p class="text-center">No Tickets Found.</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="tab-pane" id="products" role="tabpanel">
                    <div class="block">
                        <div class="block-content">
                            @if(count($products) > 0)
                                <table class="table table-bordered table-striped table-vcenter ">
                                    <thead>
                                    <tr>
                                        <th style="width:5% ">Image</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $products)
                                        <tr>
                                            <td class="text-center">

                                                @if($products->has_image)
                                                    @foreach($products->has_image as $image)
                                                        <?php  $src=$image->src?>
                                                    @endforeach
                                                    <img class="img-avatar2" style="max-width:100px;border: 1px solid whitesmoke" src="{{ asset('images/'. $src) }}" />

                                                @else
                                                    <img class="img-avatar2" style="max-width:100px;max-height:100px;border: 1px solid whitesmoke" src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg" />
                                                @endif
                                            </td>
                                            <td class="font-w600" style="vertical-align: middle">
                                                <a href="{{url('admin/product/view/'.$products->id)}}" >
                                                    {{$products->Title}}
                                                </a>
                                            </td>
                                            <td style="vertical-align: middle">
                                                {{'$'.number_format($products->Price,2)}}
                                            </td>
                                            <td style="vertical-align: middle">  {{$products->Quantity}}</td>
                                            <td style="vertical-align: middle">
                                                @if($products->vendor_status=='published')
                                                    <div class="custom-control custom-switch custom-control-success mb-1">
                                                        <input checked=""  data-route="https://phpstack-362288-1193299.cloudwaysapps.com/products/87/update" data-csrf="iK23H2RiB04Ta9hmvmLJ7QwVHPX9fGN7Rwvod5CR" type="checkbox" class="custom-control-input status-switch" id="status_product_87" name="example-sw-success2">
                                                        <label class="custom-control-label" for="status_product_87"> Published </label>
                                                    </div>
                                                @else
                                                    <div class="custom-control custom-switch custom-control-success mb-1">
                                                        <input   data-route="https://phpstack-362288-1193299.cloudwaysapps.com/products/87/update" data-csrf="iK23H2RiB04Ta9hmvmLJ7QwVHPX9fGN7Rwvod5CR" type="checkbox" class="custom-control-input status-switch" id="status_product_87" name="example-sw-success2">
                                                        <label class="custom-control-label" for="status_product_87"> Draft </label>
                                                    </div>
                                                @endif

                                            </td><td class="text-center" style="vertical-align: middle">

                                                <div class="btn-group mr-2 mb-2" role="group" aria-label="Alternate Primary First group">
                                                    <a class="btn btn-xs btn-sm btn-success" type="button" href="{{url('admin/product/view/'.$products->id)}}" data-toggle="tooltip" data-original-title="View Product">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    @if($products->product_status->admin_status=='approved')
                                                    @elseif($products->product_status->admin_status=='rejected')
                                                    @else
                                                        <button  class="btn btn-sm btn-warning approve"
                                                                 type="button" data-toggle="tooltip" title=""
                                                                 data-original-title="Approve Product" data-id="{{$products->id}}"><i class="fa fa-check-circle"></i></button>
                                                        <button  class="btn btn-sm btn-warning rejected"
                                                                 type="button" data-toggle="tooltip" title=""
                                                                 data-original-title="Rejected Product" data-id="{{$products->id}}"><i class="fa fa-ban" ></i></button>
                                                </div>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle">

                                                @if($products->product_status->admin_status=='approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif($products->product_status->admin_status=='rejected')
                                                    <span class="badge badge-danger">Rejected</span>
                                                @else
                                                    <span class="badge badge-danger">pending</span>

                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                            @else

                                <p class="text-center"> No Product Found !</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="customers" role="tabpanel">
                    <div class="block">
                        <div class="block-content">
                            @if (count($customer) > 0)
                                <table class="table table-hover table-borderless table-striped table-vcenter">
                                    <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Total Orders</th>
                                        <th>Total Spends</th>
                                        <th style="text-align: right">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="">
                                    @foreach($customer as $index => $customer)
                                        <tr>
                                            <td class="font-w600"><a href="">{{ $customer->first_name }} {{$customer->last_name}}</a></td>
                                            <td>
                                                {{$customer->email}}

                                            </td>
                                            <td>
                                                {{count($customer->has_orders)}}
                                            </td>
                                            <td>
                                                {{number_format($customer->total_spent,2)}} USD
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
{{--                                                    <a href="{{route('customers.view',$customer->id)}}"--}}
{{--                                                       class="btn btn-sm btn-success" type="button" data-toggle="tooltip" title=""--}}
{{--                                                       data-original-title="View Customer"><i class="fa fa-eye"></i></a>--}}
                                                </div>

                                            </td>

                                        </tr>


                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center"> No Customers Found </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="payments" role="tabpanel">
                    <div class="block">
                        <div class="block-content">
                            @if (count($order_payments) > 0)
                                <table class="table table-hover table-borderless table-striped table-vcenter">
                                    <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th style="width: 10%">Vendor</th>
                                        <th>Amount</th>
                                        <th>Source</th>
                                        <th>Transaction Date</th>
                                    </tr>
                                    </thead>

                                    @foreach($order_payments as $index => $payment)
                                        <tbody class="">
                                        <tr>

                                            <td class="font-w600"> @if($payment->has_order)<a href="{{route('order_details',['id'=>$payment->has_order->id])}}">{{ $payment->has_order->name }}</a> @else Order Details Deleted @endif</td>
                                            <td>
                                                {{$payment->has_vendor->name}}
                                            </td>

                                            <td>
                                                {{number_format($payment->payment,2)}} USD
                                            </td>
                                            <td>
                                                @if($payment->stripe == 1)
                                                    <span class="badge badge-warning"> <i class="fa fa-credit-card"></i> Stripe </span>
                                                @elseif($payment->paypal == 1)
                                                    <span class="badge badge-success"> <i class="fab fa-paypal"></i> PAYPAL </span>
{{--                                                @else--}}
{{--                                                    <span class="badge badge-primary"> <i class="fa fa-wallet"></i> WALLET </span>--}}
                                                @endif

                                            </td>
                                            <td>

                                                @if($payment->date=='')
                                                {{date_create($payment->created_at)->format('d-m-Y h:i a') }}
                                                @else
                                                    {{$payment->date}}
                                                @endif
                                            </td>

                                        </tr>
                                        </tbody>

                                    @endforeach
                                </table>
                            @else
                                <div class="block">
                                    <div class="block-content">
                                        <p class="text-center">No Payments Founds</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
{{--                <div class="tab-pane" id="wallet" role="tabpanel">--}}
{{--                    <div class="block">--}}
{{--                        <div class="block-content">--}}
{{--                            @if($wallet != null)--}}
{{--                                <table class="table table-hover table-borderless table-striped table-vcenter">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th style="width: 10%">Wallet Token #</th>--}}
{{--                                        <th>Owner</th>--}}
{{--                                        <th>Available</th>--}}
{{--                                        <th>Pending</th>--}}
{{--                                        <th>Used</th>--}}
{{--                                        <th>Top-up Requests</th>--}}
{{--                                        <th></th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$wallet->wallet_token}}</td>--}}
{{--                                        <td>{{$wallet->owner->name}}</td>--}}

{{--                                        <td>{{number_format($wallet->available,2)}} USD</td>--}}
{{--                                        <td>{{number_format($wallet->pending,2)}} USD</td>--}}
{{--                                        <td>{{number_format($wallet->used,2)}} USD</td>--}}
{{--                                        <td>{{count($wallet->requests)}}</td>--}}
{{--                                        <td class="text-center">--}}
{{--                                            <a href="{{route('admin.wallets.detail',$wallet->id)}}"--}}
{{--                                               class="btn btn-sm btn-success" type="button" data-toggle="tooltip" title=""--}}
{{--                                               data-original-title="View Wallet"><i class="fa fa-eye"></i></a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}

{{--                                </table>--}}
{{--                            @else--}}
{{--                                <p class="text-center">No Wallet Information Found!</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="tab-pane" id="settings" role="tabpanel">--}}
{{--                    <div class="block">--}}
{{--                        <div class="block-content">--}}
{{--                            <p class="text-center"> Coming Soon ... </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    </main>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Generate Payout</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form action="{{route('stripe_payment',['id'=>$user->id,'total'=>$total_amount])}}" method="post">
                            @csrf()
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Form Labels on top - Default Style -->
                                    <div class="form-group">
                                        <label for="example-ltf-email">Amount</label>
                                        <input type="text" class="form-control"  name="amount" placeholder="{{$total_amount}}" value="{{$total_amount}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="example-ltf-email">Payment Method</label>
                                    <input type="text" class="form-control"  name="stripe" placeholder="Stripe" value="" readonly>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="example-ltf-email">Tracking Information</label>
                                    <input type="text" class="form-control"  name="tracking" placeholder="Tracking Information" value="" >
                                </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="example-ltf-email">Notes</label>
                                        <input type="text" class="form-control"  name="notes" placeholder="Notes" value="" >
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="example-ltf-email">Payout Date</label>
                                        <input type="date" class="form-control"  name="date" value="" >
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-check mr-1"></i>Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paypal" tabindex="-1" role="dialog" aria-labelledby="approve" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Do you really want to proceed this action</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form method="Post" action="{{route('paypal_payments',['id'=>$user->id,'total'=>$total_amount])}}">
                            @csrf()
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="example-ltf-email">Email</label>
                                    <input type="text" class="form-control"  name="email" placeholder="Enter Email..." value="" >
                                </div>
                            </div>
                            </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-check mr-1"></i>Send</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click','.add_stripe',function(){


                // $('#insert').val("Update");
                $('#myModal').modal('show');

            });

            $(document).on('click','.add_paypal',function(){


                // $('#insert').val("Update");
                $('#paypal').modal('show');

            });

        });

    </script>
@endsection
