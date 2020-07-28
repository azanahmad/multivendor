@extends('../layouts.layout')
@section('title')
    Products
@endsection
@section('styles')
    {{--    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/css/style.css?v=2020-07-05 09:22:07"/>--}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/jquery.tagsinput.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.css"> --}}
@endsection
@section('body')

    <!-- Main Container -->
    <main id="main-container">
        <div class="content content-full pt-3 pb-3">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h5 my-2">
                    Add New Product
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3 mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="{{url('dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx"  href="{{url('products')}}">Products</a>
                        </li>
                        <li class="breadcrumb-item">Add New</li>
                    </ol>
                </nav>
            </div>
            <!-- Quick Overview + Actions -->
            <!-- END Quick Overview + Actions -->
            <!-- Info -->
            @if(session()->has('message'))
                <div>
                    <p class="alert alert-info">{{session('message')}}</p>
                </div>
            @endif
            <form  id="product-form"  method="POST" enctype="multipart/form-data" action="{{url('post_product')}}" >
                <div class="row">
                    <div class="col-sm-8">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Info</h3>
                            </div>
                            <div class="block-content block-content-full">
                                @csrf
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label for="product-name">Title</label>
                                        <input class="form-control" type="text" id="product-name" name="title"
                                               placeholder="Short Sleeve Shirt" required >
                                        <span class="form-text  title_error" style="font-size: 16px;color: red;"></span>
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
                                              placeholder="Please Enter Description here !" required></textarea>
                                    </div>
                                    <span class="form-text  descrip_error" style="font-size: 16px;color: red;"></span>
                                </div>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="one-ecom-product-price">Price in USD ($)</label>
                                        <input type="text" class="form-control" name="price" placeholder="$ 0.00" required value="{{old('price')}}">

                                        <span class="form-text  price_error" style="font-size: 16px;color: red;"></span>
                                    </div>
                                    <div class="col">
                                        <label for="one-ecom-product-price">Compare at price</label>
                                        <input type="text" class="form-control" name="compare_price" required placeholder="$ 0.00" value="{{old('compare_price')}}">

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
                        <!-- END Info -->
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Media</h3>
                            </div>
                            <div class="dropzone">
                                <div class="field" align="left">
                                    <h3>Upload your images</h3>
                                    <label class="btn btn-light">Select Images
                                        <input type="file" id="files" name="files[]" multiple style="color: transparent;display: none" required />
                                    </label>
                                    <div id="img_preview"></div>
                                    <span class="form-text  image_error" style="font-size: 16px;color: red;"></span>
                                </div>
                            </div>
                        </div>
                        <!-- END Media -->

                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Inventory</h3>
                            </div>
                            <div class="block-content block-content-full">

                                <div class="form-row">
                                    <div class="col">
                                        <label for="one-ecom-product-price">SKU (Stock Keeping Unit)</label>
                                        <input type="text" class="form-control" name="sku"  placeholder="$ 0.00" required value="{{old('sku')}}">

                                        <span class="form-text  sku_error" style="font-size: 16px;color: red;"></span>
                                    </div>
                                    <div class="col">
                                        <label for="one-ecom-product-price">Barcode (ISBN, UPC, GTIN, etc.)</label>
                                        <input type="text" class="form-control" name="barcode" placeholder="$ 0.00" required value="{{old('barcode')}}">

                                        <span class="form-text  barcode_error" style="font-size: 16px;color: red;"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="one-ecom-product-price">Quantity</label>
                                    <br>
                                    <small>Available</small>
                                    <input type="number" id="quantity" class="form-control col-sm-6"  required name="quantity" value="{{old('quantity')}}">

                                    <span class="form-text  quantity_error" style="font-size: 16px;color: red;"></span>
                                </div>

                            </div>
                        </div>

{{--                        <div class="block">--}}
{{--                            <div class="block-header block-header-default">--}}
{{--                                <h3 class="block-title">Shippping</h3>--}}
{{--                            </div>--}}
{{--                            <div class="form-group mt-2">--}}
{{--                                <div class="form-check ml-5 mt-2">--}}
{{--                                    <input class="form-check-input" type="checkbox" id="shipping">--}}
{{--                                    <label class="form-check-label" for="gridCheck">--}}
{{--                                        This is a physical product--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <hr>--}}
{{--                            <div id="content">--}}
{{--                                <div class="block-content block-content-full" >--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="one-ecom-product-price">Countries</label>--}}
{{--                                        <br>--}}
{{--                                        <div class="form-group col-sm-10">--}}
{{--                                            --}}{{--                                            <select class="custom-select " name="countries[]" multiple="multiple" id="select2" style="width: 100%">--}}
{{--                                            --}}{{--                                                @foreach($countries as $country)--}}
{{--                                            --}}{{--                                                    <option value="{{$country->country_name}}">{{$country->country_name}}</option>--}}
{{--                                            --}}{{--                                                @endforeach--}}
{{--                                            --}}{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Shipping Rate</label>--}}
{{--                                        <input type="text" class="form-control" name="shipping_rate"  placeholder="Enter shipping rate">--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="form-group col-sm-6">--}}
{{--                                            <label>Shipping time</label>--}}
{{--                                            <input type="text" class="form-control"  name="shipping_time" placeholder="Enter shipping time">--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-sm-6">--}}
{{--                                            <label>Processing time</label>--}}
{{--                                            <input type="text" class="form-control"  name="processing_time" placeholder="Enter processing time">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}



{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <!-- Meta Data -->
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Varients</h3>
                            </div>
                            <div class="form-group mt-2">
                                <div class="form-check ml-5 mt-2">
                                    <input class="form-check-input" type="checkbox"  id="varients">
                                    <label class="form-check-label" for="gridCheck">
                                        This product has multiple options, like different sizes or colors
                                    </label>
                                </div>
                            </div>
                            <hr>

                            <div class="block-content block-content-full ml-4">

                                <div id="content1">
                                    <h3 class="font-w300">Options</h3>
                                    <br>
                                    <h5> Option 1</h5>
                                    <div class="form-group">

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" value="Size" name="option_title1">
                                            </div>

                                            <div class="col-sm-9">
                                                <input class="form-control tags " type="text"
                                                       id="option1" name="option1_value"  >
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group mt-2">
                                        <button type="button" class="btn btn-light btn-square" id="button" >Add another option</button>
                                    </div>
                                </div>
                                <div id="option2">
                                    <h5> Option 2</h5>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" value="Color" name="option_title2">
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control tags " type="text" name="option2_value"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="button" class="btn btn-light btn-square" id="button1" >Add another option</button>
                                    </div>
                                </div>
                                <div id="option3">
                                    <h5> Option 3</h5>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" value="Material" name="option_title3">
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control tags" type="text"
                                                       name="option3_value" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="variants_table" style="display: none;">
                            <hr>
                            <h3 class="block-title ml-3">Preview</h3>
                            <br>
                            <div class="form-group">
                                <div class="col-xs-12 push-10">
                                    <table class="table table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th style="width: 15%;">Title</th>
                                            <th style="width: 20%;">Price</th>
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
                        <!-- end block -->
                        <div class="block">
                            <div class="block-header block-header-default">
                                <div class="block-title">
                                    Product Category
                                </div>
                            </div>
                            <div class="block-content">
                                @if(isset($categories))
                                    @foreach($categories as $categorie)
                                        <div class="form-group product_category">
                                            <span class="category_down" data-value="0" style="margin-right: 5px;font-size: 16px;vertical-align: middle"><i class="fa fa-angle-right"></i></span>
                                            <div class="custom-control custom-checkbox d-inline-block">
                                                <input type="checkbox" name="category[]" value="{{$categorie->name}}" class="custom-control-input category_checkbox" id="checkbox_{{$categorie->id}}">
                                                <label class="custom-control-label" for="checkbox_{{$categorie->id}}">{{$categorie->name}}</label>
                                            </div>
                                            <div class="row product_sub" style="display: none;margin-left: 40px">
                                                <div class="col-xs-12 col-xs-push-1">
                                                    <div class="custom-control custom-checkbox d-inline-block">
                                                        @if(isset($categorie->subcategory))
                                                            @foreach($categorie->subcategory as $subcategory)
                                                                <input type="checkbox" name="sub_cat[]"  class="custom-control-input sub_cat_checkbox"  value="{{$subcategory->Subcategory_name}}" id="sub_category_{{$subcategory->id}}">
                                                                <label class="custom-control-label" for="sub_category_{{$subcategory->id}}">{{$subcategory->Subcategory_name}} </label>
                                                                <br>
                                                            @endforeach
                                                        @else
                                                            <input type="checkbox" name="sub_cat[]" class="custom-control-input sub_cat_checkbox" id="sub_category">
                                                            <label class="custom-control-label" for="sub_category">No subcategory</label>
                                                        @endif
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                            </div>
                            @endif

                        </div>


                        <div class="form-group">
                            <button type="submit" id="butt" class="btn btn-primary float-right">Save</button>

                        </div>
                        <!-- end block -->
                    </div>
                </div>
            </form>
        </div>
    </main>





    <!-- END main -->
@endsection
@section('scripts')
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
            $("#select2").select2({
                placeholder:'select multiple countries'
            });

        });
    </script>
@endsection

