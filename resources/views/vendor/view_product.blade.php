@extends('../layouts.layout')
@section('title')
    Product
@endsection
@section('styles')
{{--    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/css/style.css?v=2020-07-02 11:40:42"/>--}}
@endsection
@section('body')
    <main id="main-container">
        <style>
            iframe{
                width: 100%;
            }
        </style>
        <div class="bg-body-light">
            <div class="content content-full pt-2 pb-2">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h4 my-2">
                        {{$product->Title}}
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="">Products</a>
                            </li>
                            <li class="breadcrumb-item">  {{$product->Title}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row mb2">
                <div class="col-sm-6">
                </div>
                {{--                <div class="col-sm-6 text-right">--}}
                {{--                    <a href="https://phpstack-362288-1193299.cloudwaysapps.com/products/98/edit" class="btn btn-primary btn-square ">Edit Product</a>--}}
                {{--                </div>--}}
            </div>
            <div class="block">
                <div class="block-content">
                    <div class="row items-push">
                        <div class="col-sm-6">
                            <!-- Images -->
<!--                            --><?php
//                            $images =json_decode($product->Image);
//                            ?>
                            <div class="row js-gallery" >

                                <div class="col-md-12 mb2">
{{--                                    <div class="img-link img-link-zoom-in img-lightbox">--}}
{{--                                        <img class="img-fluid" src="{{asset('images/'.$product->Image)}}" alt="">--}}
{{--                                    </div>--}}

                                </div>

                                    @if($product->has_image)
                                        @foreach ($product->has_image as $picture)
                                        <div class="col-md-4">
                                            <img src="{{ asset('images/'.$picture->src)}}" alt="not" style="height:120px; width:200px"/>
                                        </div>
                                            @endforeach
                                    @endif

                            </div>
                            <hr>
                            <div class="tags" style="margin-top: 5px">
                                <?php
                                $cat=json_decode($product->categories);
                                ?>

                                <h4 style="margin-bottom: 5px">Categories</h4>
                                @foreach($cat as $category)
                                    <span class="badge badge-primary">{{$category}}</span>
                                @endforeach

                            </div>
                            <hr>

                            <!-- END Images -->
                        </div>
                        <div class="col-sm-6">
                            <!-- Vital Info -->
                            <h2>
                                {{--                                <a href="https://phpstack-362288-1193299.cloudwaysapps.com/products/98/edit">--}}
                                {{$product->Title}}
                                {{--                                </a>--}}
                            </h2>
                            <div class="clearfix" style="margin-top: 5px;width: 100%">

                                                                                                <span class="h5">
                                        <span class="font-w600 text-success">IN STOCK</span><br><small>{{$product->Quantity}} Available in {{$product->varients->count()}} Variants</small>
                                    </span>
                                <div class="text-right d-inline-block" style="float: right">
                                    <span class="h3 font-w700 text-success">{{$product->Price}}$ </span>
                                </div>
                            </div>
                            <hr>
                            {{--                                                        <a href="https://phpstack-362288-1193299.cloudwaysapps.com/products/98/edit">--}}
                            {{--                                                                </a>--}}
                            <h3>
                                Discription
                            </h3>
                            <p><div>{!!$product->Discription!!}</div>                        <!-- END Vital Info -->
                        </div>
                        <div class="col-md-12">

                            <!-- Extra Info -->
                            <div class="block">
                                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#ecom-product-comments">Varaints</a>
                                    </li>
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane pull-r-l active" id="ecom-product-comments">
                                        <table class="table table-striped table-borderless remove-margin-b">
                                            <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Barcode</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($product->varients as $variant)
                                                <tr>
{{--                                                    @php--}}
{{--                                                       $image= $variant->has_image->src;--}}
{{--                                                    @endphp--}}
                                                    <td>
                                                        @if(isset($variant->has_image))
                                                            <img class="img-avatar " style="border: 1px solid whitesmoke"  data-input=".varaint_file_input" data-toggle="modal" data-target="#select_image_modal300"
                                                                 src="{{ asset('images/'.$variant->has_image->src)}}" alt="not" style="height:120px; width:200px"/>
                                                        @endif
                                                    </td>

                                                    <td class="variant_title">

                                                        {{$variant->Title}}
                                                    </td>
                                                    <td>
                                                        {{$variant->Quantity}}
                                                    </td>
                                                    <td>{{'$'.number_format($variant->Price ,2)}}</td>
                                                    <td> {{$variant->Barcode}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END Extra Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
