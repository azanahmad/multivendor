@extends('../layouts.layout')
@section('title')
    Products
@endsection
@section('styles')
@endsection
@section('body')
    <main id="main-container">

        <div class="bg-body-light">
            <div class="content content-full pt-2 pb-2">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h4 my-2">
                        Products
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">Products</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if(session()->has('message'))
            <div>
                <p class="alert alert-info">{{session('message')}}</p>
            </div>
        @endif

        <div class="content">
            <div class="row mb-3">
                <div class="col-sm-9">
                    <form action="" method="GET" class="d-flex">
                        <input type="search" class="form-control d-inline-block" value="" name="search" placeholder="Search By Keyword">
                        <input type="submit" value="Search" class="btn btn-primary btn-sm  d-inline-block" style="margin-left: 10px">
                    </form>
                </div>

                <div class="col-sm-3 text-right">
                    <a href="{{url('products')}}" class="btn btn-success btn-square ">Add New Product</a>
                </div>
            </div>

            <div class="block">
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter">
                            <thead>
                            <tr>
                                <th style="width:5% "></th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="text-center">
{{--                                    @php $images=json_decode($product->Image); @endphp--}}
{{--                                         @foreach (json_decode($product->Image) as $picture)--}}
                                    @if($product->has_image)
                                        @foreach($product->has_image as $image)

                                            <?php  $src1=$image->src;
                                            ?>

                                        @endforeach
                                        <img class="img-avatar2" style="max-width:100px;border: 1px solid whitesmoke" src="{{ asset('images/'.$src1 ?? '') }}" />
                                    @else
                                        <img class="img-avatar2" style="max-width:100px;max-height:100px;border: 1px solid whitesmoke" src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg" />
                                    @endif
{{--                                             @endforeach--}}
                                    </td>
                                <td class="font-w600" style="vertical-align: middle">
                                  {{$product->Title}}
                                </td>

                                <td style="vertical-align: middle">
                                    {{'$'.number_format($product->Price,2)}}
                                </td>
                                <td style="vertical-align: middle">{{$product->Quantity}}</td>
                                    <td style="vertical-align: middle">
                                        @if($product->vendor_status=='published')
                                            <div class="custom-control custom-switch custom-control-success mb-1">
                                                <input checked=""  data-csrf="iK23H2RiB04Ta9hmvmLJ7QwVHPX9fGN7Rwvod5CR" type="checkbox" class="custom-control-input status-switch" id="status_product_87" name="example-sw-success2">
                                                <label class="custom-control-label" for="status_product_87"> Published </label>
                                            </div>
                                        @else
                                            <div class="custom-control custom-switch custom-control-success mb-1">
                                                <input   data-csrf="iK23H2RiB04Ta9hmvmLJ7QwVHPX9fGN7Rwvod5CR" type="checkbox" class="custom-control-input status-switch" id="status_product_87" name="example-sw-success2">
                                                <label class="custom-control-label" for="status_product_87"> Draft </label>
                                            </div>
                                        @endif

                                    </td>
                                <td>
                                    @if($product->product_status->admin_status=='approved')
                                        <span class="badge badge-success">Approved</span>
                                    @elseif($product->product_status->admin_status=='rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @else
                                        <span class="badge badge-info">pending</span>
                                    @endif
                                </td>
                                @if($product->product_status->admin_status=='rejected')
                                    <td>{{$product->product_status->note}}</td>
                                @endif
                                <td class="text-right" style="vertical-align: middle">
                                    <div class="btn-group mr-2 mb-2" role="group" aria-label="Alternate Primary First group">
                                        <a class="btn btn-xs btn-sm btn-success" type="button"  data-toggle="tooltip" data-original-title="View Product" href="{{url('product/view/'.$product->id)}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @if($product->shopify_id=='')
                                        <a href="{{url('edit/'.$product->id)}}" class="btn btn-sm btn-warning"
                                           type="button" data-toggle="tooltip" title=""
                                           data-original-title="Edit Product"><i
                                                class="fa fa-edit"></i></a>
                                        @endif
                                        <a href="{{url('delete/'.$product->id)}}" class="btn btn-sm btn-danger"
                                           type="button" data-toggle="tooltip" title=""
                                           data-original-title="Delete Product"><i class="fa fa-times"></i></a>
{{--                                        @if($product->product_status->admin_status=='approved')--}}
{{--                                            <span class="badge badge-success">Approved</span>--}}
{{--                                        @elseif($product->product_status->admin_status=='rejected')--}}
{{--                                            <span class="badge badge-danger">Rejected</span>--}}
{{--                                        @endif--}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
