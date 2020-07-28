@extends('../layouts.layout')
@section('title')
    Products
@endsection
@section('styles')
    {{--    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/css/style.css?v=2020-07-05 09:22:07"/>--}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/jquery.tagsinput.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style type="text/css">
        .ck-content {
            min-height: 300px;
        };
        input[type=number]::-webkit-inner-spin-button {
            opacity: 1;
        };
        input[type="file"] {
            display: block;

        }
        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }
        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }
        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

    </style>
@endsection
@section('body')
    <main id="main-container">
        <div class="content content-full pt-3 pb-3">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h5 my-2">
                    Update Product
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3 mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="{{url('dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx"  href="{{url('products')}}">Products</a>
                        </li>
                        <li class="breadcrumb-item">Update New</li>
                    </ol>
                </nav>
            </div>
            @if(session()->has('message'))
                <div>
                    <p class="alert alert-info">{{session('message')}}</p>
                </div>
            @endif
            <form method="POST" enctype="multipart/form-data" action="{{url('update/'.$product->id)}}" >
                @csrf
                <div class="row">
                    <div class="col-sm-8">
                        <div class="block">
                            <div class="block-content block-content-full">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label for="product-name">Title</label>
                                        <input class="form-control" type="text" name="title"
                                               value="{{$product->Title}}"  placeholder="Short Sleeve Shirt" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 push-10">
                                        <div class="form-material form-material-primary">
                                            <label>Description</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                    <textarea class="summernote" name="descrip"
                                              placeholder="Please Enter Description here !">{{$product->Discription}}</textarea>
                                    </div>
                                    <span class="form-text  descrip_error" style="font-size: 16px;color: red;"></span>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="one-ecom-product-price">Price in USD ($)</label>
                                        <input type="text" class="form-control" name="price" placeholder="$ 0.00" value="{{$product->Price}}">

                                        <span class="form-text  price_error" style="font-size: 16px;color: red;"></span>
                                    </div>
                                    <div class="col">
                                        <label for="one-ecom-product-price">Compare at price</label>
                                        <input type="text" class="form-control" name="compare_price" placeholder="$ 0.00" value="{{$product->Compare_price}}">

                                        <span class="form-text  compare_price_error" style="font-size: 16px;color: red;"></span>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            Charge tax on this product
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">Images</h3>
                            </div>
                            <div class="block-content">
                                @if($product->has_image)
                                    <div class="row">
                                        @foreach ($product->has_image as $picture)

                                            <div class="col-lg-4">
                                                <div class="editable" id="image-sortable" data-product="98" >
                                                    <div class="col-lg-12 preview-image animated fadeIn" data-id="1040">
                                                        <div class="options-container fx-img-zoom-in fx-opt-slide-right">
                                                            <img src="{{ asset('images/'.$picture->src)}}" alt="not" style="height:150px; width:200px"/>

                                                            <div class="options-overlay bg-black-75">
                                                                <div class="options-overlay-content">
                                                                    <a class="btn btn-sm btn-light delete-file" data-type="existing-product-image-delete" data-token="3h6ti5vRxUHPbYA7v2JRjAsvt0kdrxjc2f0N0GOc" data-id="{{$picture->id}}" data-file="1040"><i class="fa fa-times"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                @endif
                                <hr>
                            </div>
                            <div class="dropzone">
                                <div class="field" align="left">
                                    <h3>Upload your images</h3>
                                    <label class="btn btn-light">Select Images
                                        <input type="file" id="files" name="files[]" multiple style="color: transparent;display: none" />
                                    </label>
                                    <div id="img_preview"></div>
                                    <span class="form-text  image_error" style="font-size: 16px;color: red;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Inventory</h3>
                            </div>
                            <div class="block-content block-content-full">

                                <div class="form-row">
                                    <div class="col">
                                        <label for="one-ecom-product-price">SKU (Stock Keeping Unit)</label>
                                        <input type="text" class="form-control" name="sku"  placeholder="$ 0.00" value="{{$product->SKU}}">

                                        <span class="form-text  sku_error" style="font-size: 16px;color: red;"></span>
                                    </div>
                                    <div class="col">
                                        <label for="one-ecom-product-price">Barcode (ISBN, UPC, GTIN, etc.)</label>
                                        <input type="text" class="form-control" name="barcode" placeholder="$ 0.00"value="{{$product->Barcode}}">

                                        <span class="form-text  barcode_error" style="font-size: 16px;color: red;"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="one-ecom-product-price">Quantity</label>
                                    <br>
                                    <small>Available</small>
                                    <input type="number" id="quantity" class="form-control col-sm-6"  name="quantity" value="{{$product->Quantity}}">

                                    <span class="form-text  quantity_error" style="font-size: 16px;color: red;"></span>
                                </div>

                            </div>
                        </div>

                        <div class="block">
                            <div class="block-header d-inline-flex" style="width: 100%" >
                                <h3 class="block-title">Variant</h3>
                                <div class="text-right d-inline-block">
                                    <a class="btn btn-sm btn-light add_varient" style="margin-right: 10px;" >Add Varient</a>
                                    <a class="btn btn-sm btn-light" style="margin-left: 10px;" data-toggle="modal" data-target="#edit_options">Edit Options</a>
                                </div>
                            </div>
                            <div class="modal fade" id="edit_options" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-popout" role="document">
                                    <div class="modal-content">
                                        <div class="block block-themed block-transparent mb-0">
                                            <div class="block-header bg-primary-dark">
                                                <h3 class="block-title">Edit Options</h3>
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option">
                                                        <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <form class="new-option-add col-md-7"  action="" method="post">
                                                <div class="block-content" style="padding: 20px !important;">
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" readonly value="Option1">
                                                                </div>

                                                                <div class="col-md-9">
                                                                    <span class="badge badge-info">
                                                                        <a><i data-option="option1" class="remove-option fa fa-times" style="color: white"></i></a>
                                                                    </span>
                                                                    <input type="text" class="form-control tags" value="" name="option1_value">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" style="margin-bottom: 10px">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" readonly value="Option2">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span class="badge badge-info">

                                                                        <a><i data-option="option1" class="remove-option fa fa-times" style="color: white"></i></a>
                                                                    </span>
                                                                    <input type="text" class="form-control tags" value="" name="option2_value">

                                                                </div>

                                                            </div>
                                                        </div>
                                                        @php

                                                            @endphp
                                                        @if(isset($opt[2]))
                                                            <div class="col-md-12" style="margin-bottom: 10px">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" readonly value="Option3">
                                                                    </div>

                                                                    <div class="col-md-9">
                                                                        <span class="badge badge-info">

                                                                            <a><i data-option="option1" class="remove-option fa fa-times" style="color: white"></i></a>
                                                                            <input type="hidden" value="" name="option3_value">
                                                                        </span>
                                                                        <input type="text" class="form-control tags" value="" name="option3_value">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-md-12" style="margin-bottom: 10px">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" readonly value="Option3">
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <span class="badge badge-info">
                                                                            <span >No option 3</span>
                                                                            <a><i data-option="option1" class="remove-option fa fa-times" style="color: white"></i></a>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="row" style="margin-top:10px ">
                                                            <div class="col-md-12 add-option-button" style="">
                                                                <a class="btn btn-light add-option-div">Add Other Option</a>
                                                            </div>
                                                            <div class="div2 row col-md-12" style="display: none">
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" readonly value="Option3">
                                                                </div>
                                                                <div class="">
                                                                    <input type="hidden" name="option" value="option3">
                                                                    <input type="text" class="form-control option-value" name="value" value="" placeholder="Enter Only One Option Value">
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <a class="btn btn-light delete-option-value"><i class="fa fa-times"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="deleted-data">
                                                    <form id="variant-options-update" action="https://phpstack-362288-1193299.cloudwaysapps.com/products/98/update" method="post">
                                                        <input type="hidden" name="_token" value="e5Hq4XUgI7RhxQ4WG8vIOwwOzxtc0ovzfShp3BmF">                                                <input type="hidden" name="type" value="variant-option-delete">
                                                    </form>
                                                </div>

                                                <div class="block-content block-content-full text-right border-top">
                                                    <button  type="submit" class="variant-options-update-save btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">
                                                        Discard
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content" style="padding-top: 0 !important;">
                                <table class="table  table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th style="vertical-align: top">Title</th>
                                        <th style="vertical-align: top">Image</th>
                                        <th style="vertical-align: top">Price</th>
                                        <th style="vertical-align: top">Quantity</th>
                                        <th style="vertical-align: top">SKU</th>
                                        <th style="vertical-align: top">Barcode</th>
                                        <th style="vertical-align: top;width: 100px">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody class="js-table-sections-header">
                                    @foreach ($product->varients as $varient)
                                        {{--                                            <input type="hidden" name="variants[]" value="{{ $varients->id }}">--}}
                                        <tr>
                                            {{--                                            <td>{{$varient->title}}</td>--}}

                                            <td class="variant_title">
                                                {{$varient->Title}}
                                                <input type="hidden" name="variant_title[]" value="{{ $varient->Title}}">
                                            </td>

                                            <td class="text-center image_select" data-id="{{$varient->id}}">
                                                {{--                                                                                                @php--}}
                                                {{--                                                                                                    $image =$varient->has_image-;--}}
                                                {{--                                                                                                @endphp--}}

                                                @if(isset($varient->has_image))
                                                    <img class="img-avatar " style="border: 1px solid whitesmoke"  data-input=".varaint_file_input" data-toggle="modal" data-target="#select_image_modal300"
                                                         src="{{ asset('images/'.$varient->has_image->src)}}" alt="not" style="height:120px; width:200px"/>
                                                @endif
                                                {{--                                                <div class="modal fade" id="select_image" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">--}}
                                                {{--                                                    <div class="modal-dialog modal-dialog-popout" role="document">--}}
                                                {{--                                                        <div class="modal-content">--}}
                                                {{--                                                            <div class="block block-themed block-transparent mb-0">--}}
                                                {{--                                                                <div class="block-header bg-primary-dark">--}}
                                                {{--                                                                    <h3 class="block-title">Select Image For Variant</h3>--}}
                                                {{--                                                                    <div class="block-options">--}}
                                                {{--                                                                        <button type="button" class="btn-block-option">--}}
                                                {{--                                                                            <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>--}}
                                                {{--                                                                        </button>--}}
                                                {{--                                                                    </div>--}}
                                                {{--                                                                </div>--}}
                                                {{--                                                                <div class="block-content font-size-sm">--}}
                                                {{--                                                                    @foreach (json_decode($product->Image) as $picture)--}}

                                                {{--                                                                        <div class="row">--}}
                                                {{--                                                                            <div class="col-md-4">--}}
                                                {{--                                                                                <img src="{{ asset('images/'.$picture)}}" alt="not" style="height:120px; width:200px"/>--}}
                                                {{--                                                                                <p style="color: #ffffff;cursor: pointer" data-image="1034" data-variant="300" data-type="product" class="rounded-bottom bg-info choose-variant-image text-center">Choose</p>--}}
                                                {{--                                                                            </div>--}}

                                                {{--                                                                        </div>--}}
                                                {{--                                                                    @endforeach--}}
                                                {{--                                                                    <p class="text-center font-weight-bold">OR</p>--}}
                                                {{--                                                                    <hr>--}}
                                                {{--                                                                    <a class="img-avatar-variant btn btn-sm btn-primary text-white mb2" data-form="#varaint_image_form_{{$product->id}}">Upload New Picture</a>--}}
                                                {{--                                                                </div>--}}
                                                {{--                                                            </div>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                            </td>
                                            <td>

                                                <input type="text" class="form-control" name="variant_price[{{$varient->id}}]" value=" {{$varient->Price}}" >
                                            </td>
                                            <td><input type="text" class="form-control" value=" {{$varient->Quantity}}"  name="variant_quantity[{{$varient->id}}]" placeholder="0"></td>
                                            <td><input type="text" class="form-control" name="variant_sku[{{$varient->id}}]" value=" {{$varient->SKU}}" ></td>
                                            <td><input type="text" class="form-control" name="variant_barcode[{{$varient->id}}]" value=" {{$varient->Barcode}}"  placeholder="">
                                            </td>
                                            <td>

                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip"  title="Edit"   onclick="window.location.href='{{route('edit_varient',['id'=>$varient->id,'product_id'=>$product->id])}}'"  >
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-primary delete-varient"  data-id="{{$varient->id}}" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>


                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody>
                                    <tr>
                                        {{--                                            <td style="vertical-align: middle">  Option1: </td>--}}
                                        {{--                                            <td>--}}
                                        {{--                                                <input type="text" class="form-control" name="option1" placeholder="$0.00" value="darkgrey">--}}
                                        {{--                                            </td>--}}
                                        {{--                                            <td style="vertical-align: middle"> Option2: </td>--}}
                                        {{--                                            <td>--}}
                                        {{--                                                <input type="text" class="form-control" name="option2" placeholder="$0.00" value="S">--}}
                                        {{--                                            </td>--}}
                                        {{--                                            <td style="vertical-align: middle"></td>--}}
                                        {{--                                            <td>--}}
                                        {{--                                            </td>
                                        {{--      --}}

                                    </tr>
                                    </tbody>
                                </table>

                                <div class="form-image-src" style="display: none">

                                    <input type="hidden" name="_token" value="7q3SjAC1frtf2xs968ilfB3b6dETCgFCOodKTphL">
                                    <input type="hidden" name="type" value="variant-image-update">
                                    <input type="hidden" name="variant_id" value="300">
                                    <input type="file" name="varaint_src" class="varaint_file_input" accept="image/*">

                                </div>
                            </div>

                        </div>
                        <button type="button" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#create_zone_modal">Create Shipping Zone</button>

                        <div class="block-content">

                        @if (count($zones) > 0)
                                <table class="js-table-sections table table-hover table-borderless table-vcenter">
                                    <thead>
                                    <tr>
                                        <th style="width: 30px;"></th>
                                        <th >Title</th>
                                        <th style="width: 25%;">Countries</th>
                                        <th></th>
                                        <th class="text-center" style="width: 15%;"></th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    @foreach($zones as $index => $zone)
                                        <tbody class="js-table-sections-header">
                                        <tr>
                                            <td class="text-center">
                                                <i class="fa fa-angle-right"></i>
                                            </td>
                                            <td class="font-w600">{{ $zone->name }}</td>
                                            <td>


                                                @foreach($zone->has_countries as $country)
                                                    <span class="badge badge-primary">{{$country->name}}</span>
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#create_rate_modal{{$index}}" type="button"> Add Rate</button>
                                            </td>
                                            <td></td>
                                            <td class="text-right btn-group" style="float: right">
                                                <button class="btn btn-sm btn-warning" type="button" data-toggle="modal"
                                                        data-target="#edit_zone_modal{{$index}}"><i
                                                        class="fa fa-edit"></i>
                                                </button>
                                                <a href="{{ route('zone.delete', $zone->id) }}"
                                                   class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" title=""
                                                   data-original-title="Delete Zone"><i class="fa fa-times"></i></a>
                                            </td>

                                        </tr>
                                        <div class="modal fade" id="edit_zone_modal{{$index}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-popout" role="document">
                                                <div class="modal-content">
                                                    <div class="block block-themed block-transparent mb-0">
                                                        <div class="block-header bg-primary-dark">
                                                            <h3 class="block-title">Edit "{{$zone->name}}"</h3>
                                                            <div class="block-options">
                                                                <button type="button" class="btn-block-option">
                                                                    <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <form action="{{route('zone.update',$zone->id)}}" method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{$zone->id}}" name="zone_id">
                                                            <div class="block-content font-size-sm">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-material">
                                                                            <label for="material-error">Title</label>

                                                                            <input required class="form-control" type="text" id="zone_title" name="name"
                                                                                   value="{{$zone->name}}"   placeholder="Enter Zone Title here">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for=""> Select Countries</label>
                                                                    </div>
                                                                </div>
                                                                <div class="countries-section">
                                                                    @foreach($countries1 as $country)
                                                                        <div class="col-md-12">
                                                                            <div class="custom-control custom-checkbox d-inline-block">
                                                                                <input type="checkbox" name="countries[]"  @if(in_array($country->id,$zone->has_countries->pluck('id')->toArray())) checked @endif value="{{$country->id}}" class="custom-control-input" id="row_edit_country_{{$zone->id}}_{{$index}}_{{$country->id}}">
                                                                                <label class="custom-control-label"  for="row_edit_country_{{$zone->id}}_{{$index}}_{{$country->id}}">{{$country->name}}</label>
                                                                            </div>
                                                                        </div>

                                                                    @endforeach
                                                                </div>

                                                            </div>

                                                            <div class="block-content block-content-full text-right border-top">
                                                                <button type="submit" class="btn btn-sm btn-primary" >Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="create_rate_modal{{$index}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-popout" role="document">
                                                <div class="modal-content">
                                                    <div class="block block-themed block-transparent mb-0">
                                                        <div class="block-header bg-primary-dark">
                                                            <h3 class="block-title">Add {{$zone->name}}'s Rate</h3>
                                                            <div class="block-options">
                                                                <button type="button" class="btn-block-option">
                                                                    <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <form action="{{route('zone.rate.create',$zone->id)}}" method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{$zone->id}}" name="zone_id">
                                                            <div class="block-content font-size-sm">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-material">
                                                                            <label for="material-error">Title</label>
                                                                            <input required class="form-control" type="hidden"  name="product_id"
                                                                                   value="{{$product->id}}">
                                                                            <input required class="form-control" type="text"  name="name"
                                                                                   placeholder="Enter Zone Title here">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="margin-top: 10px">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-material">
                                                                            <label for="material-error">Rate Type</label>
                                                                            <select required class="form-control rate_type_select" name="type">
                                                                                <option value="flat">Flat Rate</option>
{{--                                                                                <option value="order_price">Per Order Price</option>--}}
                                                                                <option value="weight">Per Weight</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-material">
                                                                            <label for="material-error">Price</label>
                                                                            <input required class="form-control" type="number" name="shipping_price"
                                                                            >

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row condition-div" style="display: none">
                                                                    {{--                                                                <div class="col-sm-6">--}}
                                                                    {{--                                                                    <div class="form-material">--}}
                                                                    {{--                                                                        <label for="material-error ">Max Condition</label>--}}
                                                                    {{--                                                                        <input class="form-control max-condtion" step="any" type="number" name="max">--}}

                                                                    {{--                                                                    </div>--}}
                                                                    {{--                                                                </div>--}}
                                                                    <div class="col-sm-12">
                                                                        <div class="form-material">
                                                                            <label for="material-error ">Unit Per Kg</label>
                                                                            <input class="form-control min-condtion " step="any" type="number" name="min">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row ">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-material">
                                                                            <label for="material-error ">Shipping Time (Days)</label>
                                                                            <input required class="form-control" type="text" name="shipping_time">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-material">
                                                                            <label for="material-error ">Processing Time (Days)</label>
                                                                            <input required class="form-control " type="text" name="processing_time">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="block-content block-content-full text-right border-top">
                                                                <button type="submit" class="btn btn-sm btn-primary" >Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </tbody>
                                        {{--Rates Tables--}}
                                        <tbody>
                                        @if (count($zone->has_rate) > 0)
                                            @foreach($zone->has_rate as $new_index => $rate)
                                                <tr>
                                                    <td class="text-center text-success" style="vertical-align: top">
                                                        {{ $rate->name }}
                                                    </td>
                                                    <td class="font-w600" style="vertical-align: top"> Type: {{ str_replace('_',' ',$rate->type)  }}</td>
                                                    <td style="vertical-align: top">
                                                        Condition: @if($rate->type == 'flat') None @elseif($rate->type == 'order_price') {{$rate->min}}  @else  {{$rate->min}}  Kgs @endif
                                                    </td>
                                                    <td style="width: 25%;vertical-align: top" >
                                                        <p>Shipping Time : {{$rate->shipping_time}}<br>
                                                            Processing Time : {{$rate->processing_time}}
                                                        </p>
                                                    </td>
                                                    <td
                                                        class="text-success text-center" style="vertical-align: top">${{number_format($rate->shipping_price,2)}}
                                                    </td>
                                                    <td class="text-center btn-group" style="float: right">
                                                        <button class="btn btn-sm btn-warning" type="button" data-toggle="modal"
                                                                data-target="#edit_rate_modal{{$rate->id}}{{$rate->shipping_price}}"><i
                                                                class="fa fa-edit"></i>
                                                        </button>
                                                        <a href="{{ route('zone.rate.delete', $rate->id) }}"
                                                           class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" title=""
                                                           data-original-title="Delete Rate"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="edit_rate_modal{{$rate->id}}{{$rate->shipping_price}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-popout" role="document">
                                                        <div class="modal-content">
                                                            <div class="block block-themed block-transparent mb-0">
                                                                <div class="block-header bg-primary-dark">
                                                                    <h3 class="block-title">Add {{$zone->name}}'s Rate</h3>
                                                                    <div class="block-options">
                                                                        <button type="button" class="btn-block-option">
                                                                            <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <form action="{{route('zone.rate.update',$rate->id)}}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$zone->id}}" name="zone_id">
                                                                    <div class="block-content font-size-sm">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-material">
                                                                                    <label for="material-error">Title</label>
                                                                                    <input required class="form-control" type="text"  name="name"
                                                                                           value="{{$rate->name}}"     placeholder="Enter Zone Title here">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row" style="margin-top: 10px">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-material">
                                                                                    <label for="material-error">Rate Type</label>

                                                                                    <select required class="form-control rate_type_select" name="type">
                                                                                        <option @if($rate->type == 'flat') selected @endif  value="flat">Flat Rate</option>
                                                                                        <option @if($rate->type == 'order_price') selected @endif value="order_price">Per Order Price</option>
                                                                                        <option @if($rate->type == 'weight') selected @endif value="weight">Per Weight</option>

                                                                                    </select>

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-material">
                                                                                    <label for="material-error">Price</label>
                                                                                    <input required class="form-control" type="number" name="shipping_price" value="{{$rate->shipping_price}}">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row condition-div" @if($rate->type == 'flat') style="display: none" @endif>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-material">
                                                                                    <label for="material-error ">Unit Per Kg</label>
                                                                                    <input class="form-control min-condtion " step="any" @if($rate->type != 'flat') required @endif value="{{$rate->min}}" type="number" name="min">

                                                                                </div>
                                                                            </div>
                                                                            {{--                                                                        <div class="col-sm-6">--}}
                                                                            {{--                                                                            <div class="form-material">--}}
                                                                            {{--                                                                                <label for="material-error ">Max Condition</label>--}}
                                                                            {{--                                                                                <input class="form-control max-condtion" step="any" @if($rate->type != 'flat') required @endif value="{{$rate->max}}" type="number" name="max">--}}

                                                                            {{--                                                                            </div>--}}
                                                                            {{--                                                                        </div>--}}
                                                                        </div>
                                                                        <div class="form-group row ">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-material">
                                                                                    <label for="material-error ">Shipping Time (Days)</label>
                                                                                    <input required class="form-control" type="text" name="shipping_time" value="{{$rate->shipping_time}}">

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-material">
                                                                                    <label for="material-error ">Processing Time (Days)</label>
                                                                                    <input required class="form-control " type="text" name="processing_time" value="{{$rate->processing_time}}">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="block-content block-content-full text-right border-top">
                                                                        <button type="submit" class="btn btn-sm btn-primary" >Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        @else
                                            <tr>
                                                <td>
                                                </td>
                                                <td class="font-w600 text-success">
                                                    <button class="btn btn-sm btn-info text-white" type="button" data-toggle="modal" data-target="#create_rate_modal{{$index}}"> Add Rate</button>
                                                </td>
                                                <td>
                                                    <small></small>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        @endif

                                        </tbody>

                                    @endforeach
                                </table>
                            @else
                                <p>No Shipping Zone Created</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <div class="block-title">
                                    Status
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="form-group">
                                    <div  class="custom-control custom-radio mb-1">
                                        <input class="custom-control-input" type="radio" name="status" id="exampleRadios" value="published" checked>
                                        <label class="custom-control-label" for="exampleRadios">
                                            Published
                                        </label>
                                    </div>
                                    <div  class="custom-control custom-radio mb-1">
                                        <input class="custom-control-input" type="radio" name="status" id="exampleRadios1" value="draft" >
                                        <label class="custom-control-label" for="exampleRadios1">
                                            Draft
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <!--end block content -->

                        </div>
                        <div class="block">
                            <div class="block-header block-header-default">
                                <div class="block-title">
                                    Product Category
                                </div>
                            </div>
                            <!--                            --><?php
                            $cat= json_decode($product->categories);
                            $sub_cat= json_decode($product->sub_categories)
                            //                                $ids = (isset($product->categories) && $product->categories->count() > 0 ) ? array_pluck($product->categories, 'id') : null;
                            //                            dd($ids);
                            //                            ?>
                            <div class="block-content">
                                @foreach($categories as $categorie)
                                    <div class="form-group product_category">
                                        <span class="category_down" data-value="0" style="margin-right: 5px;font-size: 16px;vertical-align: middle"><i class="fa fa-angle-right"></i></span>
                                        <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="category[]" @if(isset($cat) && in_array($categorie->name,$cat)) checked @endif value="{{$categorie->name}}"
                                                   class="custom-control-input category_checkbox" id="checkbox_{{$categorie->id}}">
                                            <label class="custom-control-label" for="checkbox_{{$categorie->id}}">{{$categorie->name}}</label>
                                        </div>

                                        <div class="row product_sub" style="display: none;margin-left: 40px">
                                            <div class="col-xs-12 col-xs-push-1">
                                                <div class="custom-control custom-checkbox d-inline-block">

                                                    @if(isset($categorie->subcategory))
                                                        @foreach($categorie->subcategory as $subcategory)
                                                            <input type="checkbox" name="sub_cat[]"   @if(isset($sub_cat) && in_array($subcategory->Subcategory_name,$sub_cat)) checked @endif value="{{$subcategory->Subcategory_name}}" class="custom-control-input sub_cat_checkbox" id="rowsub_Smart Wear_{{$subcategory->id}}">
                                                            <label class="custom-control-label" for="rowsub_Smart Wear_{{$subcategory->id}}">{{$subcategory->Subcategory_name}}</label>
                                                            <br>
                                                        @endforeach
                                                    @else
                                                        <span class="badge badge-danger">
                                                    {{'No subcategaory added'}}
                                                        </span>
                                                    @endif
                                                </div>
                                                <br>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">More Details</h3>
                            </div>

{{--                            <div class="block-content">--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="col-xs-12 push-10">--}}
{{--                                        <label>Shipping Countries</label>--}}
{{--                                        @if(isset($product->shipping))--}}
{{--                                            @foreach(json_decode($product->shipping->countries) as $country)--}}
{{--                                                <br>--}}
{{--                                                <span class="badge badge-primary"> {{$country}}--}}
{{--                                                    </span>--}}
{{--                                            @endforeach--}}
{{--                                        @else--}}
{{--                                            <br>--}}
{{--                                            <span class="badge badge-danger">{{'No Shipping countries added'}}--}}
{{--                                                </span>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="col-xs-12 push-10">--}}
{{--                                        <label>Processing Time </label>--}}

{{--                                        @if(isset($product->shipping))--}}
{{--                                            <br>--}}
{{--                                            <span class="badge badge-primary">{{$product->shipping->processing_time}}--}}
{{--                                           </span>--}}
{{--                                        @else--}}
{{--                                            <br>--}}
{{--                                            <span class="badge badge-danger">{{'No processing time added'}}--}}
{{--                                                </span>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="form-group">
                            <button type="submit"  class="btn btn-primary float-right">Save</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </main>

    <div class="modal fade" id="delete_image" tabindex="-1" role="dialog" aria-labelledby="approve" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Do you really want to Delete this Image?</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form action="{{ url('image/delete') }}" method="post">
                            @csrf()
                            <input type="hidden" name="id" id="id_image" class="form-control" />

                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-check mr-1"></i>ok</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="approve" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Do you really want to Delete this variant?</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form action="{{ url('varient/delete') }}" method="post">
                            @csrf()
                            <input type="hidden" name="id" id="p_id" class="form-control" />

                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-check mr-1"></i>ok</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_varient" tabindex="-1" role="dialog" aria-labelledby="approve" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Add Varient</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <?php

                    $options=json_decode($product->options,true);

                    $option1=0;
                    $option2=0;
                    $option3=0;

                    if(count($product->option1($product)) > 0)
                    {
                        $option1=1;
                    }

                    if(count($product->option2($product)) > 0)
                    {
                        $option2=1;
                    }

                    if(count($product->option3($product)) > 0)
                    {
                        $option3=1;
                    }
                    //                    foreach ($options as  $index => $option)
                    //                    {
                    //                        if($index ==0)
                    //                        {
                    //
                    //
                    //                        }
                    //                        if($index ==1) {
                    //                            if ($option != null)
                    //                            {
                    //                                $option2=1;
                    //
                    //                            }
                    //                        }
                    //                        if($index == 2) {
                    //                            if ($option != null)
                    //                              {
                    //                                  $option3=1;
                    //
                    //                              }
                    //                        }
                    //
                    //
                    //                    }
                    ?>
                    <div class="block-content font-size-sm">
                        <form action="{{ route('varient_add',['id'=>$product->id]) }}" method="post">
                            @csrf()
                            <div class="row">
                                @if($option1==1)
                                    <div class="col-lg-3">
                                        <!-- Form Labels on top - Default Style -->
                                        <div class="form-group">
                                            <label for="example-ltf-email">{{$product->option_name1}}</label>
                                            <input type="text" class="form-control"  name="Option1" placeholder=""
                                                   value="{{old('Option1')}}" required>
                                        </div>
                                    </div>
                                @endif
                                @if($option2==1)
                                    <div class="col-lg-3">
                                        <!-- Form Labels on top - Default Style -->
                                        <div class="form-group">
                                            <label for="example-ltf-email">{{$product->option_name2}}</label>
                                            <input type="text" class="form-control"  name="Option2" placeholder=""
                                                   value="{{old('Option2')}}"  required>
                                        </div>
                                    </div>
                                @endif
                                @if($option3==1)
                                    <div class="col-lg-3">
                                        <!-- Form Labels on top - Default Style -->
                                        <div class="form-group">
                                            <label for="example-ltf-email">{{$product->option_name3}}</label>
                                            <input type="text" class="form-control"  name="Option3" placeholder=""
                                                   value="{{old('Option3')}}" required>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-lg-3">
                                    <!-- Form Labels on top - Default Style -->
                                    <div class="form-group">
                                        <label for="example-ltf-email">Price</label>
                                        <input type="text" class="form-control"  name="Price" placeholder=""
                                               value="{{old('Price')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <!-- Form Labels on top - Default Style -->
                                    <div class="form-group">
                                        <label for="example-ltf-email">Quantity</label>
                                        <input type="number" class="form-control"  name="Quantity" placeholder=""
                                               value="{{old('Quantity')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Form Labels on top - Default Style -->
                                    <div class="form-group">
                                        <label for="example-ltf-email">SKU (Stock Keeping Unit)</label>
                                        <input type="number" class="form-control"  name="SKU" placeholder=""
                                               value="{{old('SKU')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Form Labels on top - Default Style -->
                                    <div class="form-group">
                                        <label for="example-ltf-email">Barcode </label>
                                        <input type="text" class="form-control"  name="Barcode" placeholder=""
                                               value="{{old('Barcode')}}" required>
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


    <div class="modal fade" id="image_model" tabindex="-1" role="dialog" aria-labelledby="image_model" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Images</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form action="{{ url('varient/image_add') }}" method="post">
                            @csrf()
                            <div class="row">
                                <input id="image_id" name="id" type="hidden">
                                <!-- Form Labels on top - Default Style -->
                                @if(count($product->has_image))
                                    @foreach($product->has_image as $image)
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="option">
                                                    <input type="radio" name="image" value="{{$image->id}}" id="color-green{{$image->id}}" />
                                                    <label for="color-green{{$image->id}}">
                                                        <img src="{{asset('images/'.$image->src)}}" width="100px" height="100px" alt="" />
                                                    </label>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif


                            </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-check mr-1"></i>Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create_zone_modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Shipping Zone</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{route('zone.create')}}" method="post">
                        @csrf
                        <div class="block-content font-size-sm">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-material">
                                        <label for="material-error">Title</label>
                                        <input required class="form-control" type="hidden"  name="id"
                                               value="{{$product->id }}">

                                        <input required class="form-control" type="text" id="zone_title" name="name"
                                               placeholder="Enter Zone Title here">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for=""> Select Countries</label>
                                </div>
                            </div>
                            <div class="countries-section">
                                @foreach($countries as $country)
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="countries[]" value="{{$country->id}}" class="custom-control-input" id="row_country{{$country->id}}">
                                            <label class="custom-control-label" for="row_country{{$country->id}}">{{$country->name}}</label>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                        </div>

                        <div class="block-content block-content-full text-right border-top">

                            <button type="submit" class="btn btn-sm btn-primary" >Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>

    {{--   <script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
    --}}
    <!-- Page JS Helpers (Select2 + CKEditor plugins) -->

    <script src="https://phpstack-362288-1193299.cloudwaysapps.com/assets/js/plugins/summernote/summernote-bs4.min.js"></script>
    <script>jQuery(function(){ One.helpers(['select2', 'maxlength','summernote']); });</script>
    <script>jQuery(function(){ One.helpers(['summernote','magnific-popup','table-tools-sections','core-bootstrap-tooltip','select2','flatpickr']); });</script>
    <script src="https://phpstack-362288-1193299.cloudwaysapps.com/js/admin.js?v=2020-07-05 09:22:07"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" ></script>
    <script src="{{asset('assets/jquery.tagsinput.js')}}"></script>
    <script>
        $(document).ready(function() {


            $('.summernote').summernote({
                placeholder: 'Enter discription',
                height: 300
            });

            $('.tags').tagsInput({
                height: '36px',
                width: '300px',
                defaultText: 'Add tag',
                removeWithBackspace: true,
                delimiter: [','],
            });

            $(document).on('click',".delete-varient",function() {

                var id = $(this).data("id");

                $('#p_id').val(id);
                // $('#insert').val("Update");
                $('#approve').modal('show');

            });

            $(document).on('click',".image_select",function() {
                var id = $(this).data("id");
                $('#image_id').val(id);

                // $('#insert').val("Update");
                $('#image_model').modal('show');

            });

            $(document).on('click',".add_varient",function() {

                // $('#insert').val("Update");
                $('#add_varient').modal('show');

            });
            $(document).on('click',".delete-file",function() {

                var id = $(this).data("id");
                $('#id_image').val(id);
                // $('#insert').val("Update");
                $('#delete_image').modal('show');


            });
        });





    </script>
@endsection
