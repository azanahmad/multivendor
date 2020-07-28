@extends('../layouts.layout')
@section('title')
    Shipping zone
@endsection
@section('styles')
    <link rel="stylesheet" href="https://phpstack-362288-1193299.cloudwaysapps.com/css/style.css?v=2020-07-02 11:40:42"/>
@endsection
@section('body')
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-full pt-2 pb-2">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h4 my-2">
                        Shipping Zones
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">Shipping Zones</li>
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
            <div class="row mb2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#create_zone_modal">Create Shipping Zone</button>
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-md-12">
                    <div class="block">
                        <div class="block-content">
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
                                @foreach($shippings as $shipping)
                                    <tbody class="toggle">
                                    <tr>
                                        <td class="text-center">
                                            <i class="fa fa-angle-right"></i>
                                        </td>
                                        <td class="font-w600">{{$shipping->title}}</td>
                                        <td>
                                            @foreach(json_decode($shipping->countries) as $country)
                                                <span class="badge badge-primary">{{$country}}</span>
                                            @endforeach
                                        </td>
                                        <?php
                                        $check =$shipping->rate;
                                        ?>
                                        <td class="text-center">
                                            <input type="hidden" value="{{$shipping->id}}">
                                            @if(isset($shipping->rate) && $check->shipping_zone_id == $shipping->id)

                                            @else
                                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#create_rate_modal_{{$shipping->id}}"> Add Rate</button>
                                            @endif
                                        </td>

                                        <div class="modal fade" id="create_rate_modal_{{$shipping->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-popout" role="document">
                                                <div class="modal-content">
                                                    <div class="block block-themed block-transparent mb-0">
                                                        <div class="block-header bg-primary-dark">
                                                            <h3 class="block-title">{{$shipping->title}}</h3>
                                                            <div class="block-options">
                                                                <button type="button" class="btn-block-option">
                                                                    <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <form action="{{url('create_rate')}}" method="post">
                                                            @csrf
                                                            <div class="block-content font-size-sm">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-material">
                                                                            <label for="material-error">Title</label>
                                                                            <input required class="form-control" type="text"  name="title"
                                                                                   placeholder="Enter Zone Title here">
                                                                            <input type="hidden" value="{{$shipping->id}}" name="shipping_id">
                                                                            <input type="hidden" value="{{$shipping->product_id}}" name="product_id">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="margin-top: 10px">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-material">
                                                                            <label for="material-error">Rate Type</label>
                                                                            <select required class="form-control rate_type_select" name="type">
                                                                                <option value="flat">Flat Rate</option>
                                                                                <option value="order_price">Per Order Price</option>
                                                                                <option value="weight">Per Weight</option>

                                                                            </select>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-material">
                                                                            <label for="material-error">Price</label>
                                                                            <input required class="form-control" type="number" name="price"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row condition-div" style="display: none">
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
                                        <td class="text-right btn-group" style="float: right">
                                            <button class="btn btn-sm btn-warning" type="button" data-toggle="modal"
                                                    data-target="#edit_zone_modal_{{$shipping->id}}"><i
                                                    class="fa fa-edit"></i>
                                            </button>


                                            <a href="{{url('admin/delete_zones/'.$shipping->id)}}"
                                               class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" title=""
                                               data-original-title="Delete Zone"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit_zone_modal_{{$shipping->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-popout" role="document">
                                            <div class="modal-content">
                                                <div class="block block-themed block-transparent mb-0">
                                                    <div class="block-header bg-primary-dark">
                                                        <h3 class="block-title">Edit {{$shipping->title}}</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option">
                                                                <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <form action="{{url('update_zone/'.$shipping->id)}}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="49" name="zone_id">
                                                        <div class="block-content font-size-sm">
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <div class="form-material">
                                                                        <label for="material-error">Title</label>

                                                                        <input required class="form-control" type="text" id="zone_title" name="title"
                                                                               value="{{$shipping->title}}"   placeholder="Enter Zone Title here">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <label for=""> Select Product</label>
                                                                    <select name="product_id" class="form-control">
                                                                        <option>Choose..</option>
                                                                        @foreach($products as $product)
                                                                            <option @if($shipping->product_id == $product->id) selected  @endif value="{{$product->id}}">{{$product->Title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <label for=""> Select Countries</label>
                                                                </div>
                                                            </div>
                                                            <?php $countries=json_decode($shipping->countries,true);?>

                                                            <div class="countries-section">
                                                                @foreach($countries_name as $country)
                                                                    <div class="col-md-12">
                                                                        <div class="custom-control custom-checkbox d-inline-block">
                                                                            <input type="checkbox" name="countries[]"   @if(isset($countries) && in_array($country->country_name,$countries)) checked @endif   value="{{$country->country_name}}" class="custom-control-input" id="edit_country_{{$country->id}}">
                                                                            <label class="custom-control-label"  for="edit_country_{{$country->id}}">{{$country->country_name}}</label>
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

                                    </tbody>
                                    <tbody class="show_tbody">

                                    <tr>
                                        <td class="text-center text-success">
                                            @if(isset($shipping->rate))
                                                {{$shipping->rate->title}}
                                            @else
                                                {{'No Rate incuded'}}
                                            @endif
                                        </td>
                                        <input type="hidden" value="{{$shipping->id}}" id="shipping_id">
                                        <td class="font-w600" style="vertical-align: top"></td>
                                        <td style="vertical-align: top">
                                        @if(isset($shipping->rate))
                                            {{$shipping->rate->rate_type}}
                                        @else
                                            {{'No Rate incuded'}}
                                        @endif
                                        <td style="width: 25%;vertical-align: top" >
                                            <p>
                                                @if(isset($shipping->rate))
                                                    {{$shipping->rate->shipping_time}}
                                                @else
                                                    {{'No Rate incuded'}}
                                                @endif
                                                <br>
                                                @if(isset($shipping->rate))
                                                    {{$shipping->rate->processing_time}}
                                                @else
                                                    {{'No Rate incuded'}}
                                                @endif
                                            </p>
                                        </td>

                                        <td class="text-center btn-group" style="float: right">
                                            <button class="btn btn-sm btn-warning" type="button" data-toggle="modal"
                                                    data-target="#edit_rate_modal_{{$shipping->id}}"><i
                                                    class="fa fa-edit"></i>
                                            </button>

                                            <a href="@if(isset($shipping->rate)){{url('rate/delete/'.$shipping->rate->id)}} @else {{'No rate added'}} @endif"
                                               class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" title=""
                                               data-original-title="Delete Rate"><i class="fa fa-times"></i></a>
                                        </td>
                                        <div class="modal fade" id="edit_rate_modal_{{$shipping->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-popout" role="document">
                                                <div class="modal-content">
                                                    <div class="block block-themed block-transparent mb-0">
                                                        <div class="block-header bg-primary">

                                                            @if(isset($shipping->rate))
                                                                <h3 class="block-title">Edit {{$shipping->rate->title}}</h3>

                                                                <div class="block-options">

                                                                    <button type="button" class="btn-block-option">
                                                                        <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>
                                                                    </button>
                                                                </div>
                                                        </div>

                                                        <form action="{{url('rate/update')}}" method="post">
                                                            @csrf
                                                            <div class="block-content font-size-sm">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-material">
                                                                            <label for="material-error">Title</label>
                                                                            <input required class="form-control" type="text"  name="title"
                                                                                   value="{{$shipping->rate->title}}"     placeholder="Enter Zone Title here">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" value="{{$shipping->rate->id}}" name="rate_id">
                                                                <input type="hidden" value="{{$shipping->id}}" name="shipping_id">
                                                                <input type="hidden" value="{{$shipping->product_id}}" name="product_id">

                                                                <div class="form-group row" style="margin-top: 10px">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-material">
                                                                            <label for="material-error">Rate Type</label>
                                                                            <select required class="form-control rate_type_select " name="type">
                                                                                <option   value="flat"  @if(isset($shipping->rate) && $shipping->rate->rate_type == 'flat') {{'selected'}}  @endif>Flat Rate</option>
                                                                                <option  value="order_price" @if(isset($shipping->rate) && $shipping->rate->rate_type == 'order_price') selected  @endif>Per Order Price</option>
                                                                                <option  selected  value="weight"  @if(isset($shipping->rate) && $shipping->rate->rate_type == 'weight') selected  @endif>Per Weight</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-material">
                                                                            <label for="material-error">Price</label>
                                                                            <input required class="form-control" type="number" name="price" value="{{$shipping->rate->price}}">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row ">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-material">
                                                                            <label for="material-error ">Shipping Time (Days)</label>
                                                                            <input required class="form-control" type="text" name="shipping_time" value="{{$shipping->rate->shipping_time}}">

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-material">
                                                                            <label for="material-error ">Processing Time (Days)</label>
                                                                            <input required class="form-control " type="text" name="processing_time" value="{{$shipping->rate->processing_time}}">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="block-content block-content-full text-right border-top">
                                                                <button type="submit" class="btn btn-sm btn-primary" >Save</button>
                                                            </div>
                                                        </form>
                                                        @else
                                                            <div><h4>Please add shipping rate</h4></div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>

                                    </tbody>
                                @endforeach
                            </table>
                        </div>
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
                        <form action="{{url('create_zones')}}" method="post">
                            @csrf
                            <div class="block-content font-size-sm">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <label for="material-error">Title</label>
                                            <input required class="form-control" type="text" id="zone_title" name="title"
                                                   placeholder="Enter Zone Title here">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for=""> Select Product</label>
                                        <select name="product_id" class="form-control">
                                            <option>Choose..</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->Title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for=""> Select Countries</label>
                                    </div>

                                    <div class="countries-section">
                                        @foreach($countries_name as $country)
                                            <div class="col-md-12">
                                                <div class="custom-control custom-checkbox d-inline-block">
                                                    <input type="checkbox" name="countries[]"   value="Afghanistan" class="custom-control-input" id="row_edit_country_{{$country->id}}">
                                                    <label class="custom-control-label"  for="row_edit_country_{{$country->id}}">{{$country->country_name}}</label>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>

                                <div class="block-content block-content-full text-right border-top">

                                    <button type="submit" class="btn btn-sm btn-primary" >Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>jQuery(function(){ One.helpers(['table-tools-sections']); });</script>
    <script>
        $(document).ready(function(){

            $('.show_tbody').hide();
            $(function () {
                $('.toggle').on('click', function () {
                    $(this).next('.show_tbody').toggle();
                });
            });
        });
    </script>
@endsection
