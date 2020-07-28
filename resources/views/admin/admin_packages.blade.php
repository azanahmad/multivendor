@extends('layouts.admin')
@section('content')
    <main id="main-container">
        <div class="content content-full pt-3 pb-3">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Add Membership
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3 mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx"href="{{url('admin/dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">Add Membership</li>
                    </ol>
                </nav>
            </div>
        </div>
<div class="content">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Membership Package</h3>
                    </div>
                    <div class="block-content block-content-full">

                        <form  id="package-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                            <div class="form-group">
                                    <label for="product-name">How many Days</label>
                                    <input class="form-control" type="text"  name="days"
                                    placeholder="Short Sleeve Shirt" >
                                    <span class="form-text  days_error" style="font-size: 16px;color: red;">
                                    </span>
                            </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group ">
                                <label>How many Products</label>
                                <input class="form-control" type="text" id="product-name" name="products"
                                    placeholder="Products" >
                                <span class="form-text  products_error" style="font-size: 16px;color: red;"></span>
                            </div>
                        </div>
                    </div>

                                <div class="form-group">
                                    <label for="one-ecom-product-price">Price in USD ($)</label>
                                    <input type="text" class="form-control" name="price"  placeholder="$ 0.00" value="{{old('price')}}">

                                    <span class="form-text  price_error" style="font-size: 16px;color: red;"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
    <!--end content div-->

</main>
<!-- END main -->
@endsection
@section('scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" ></script>


<script type="text/javascript">
$(document).ready(function(){

$('#package-form').submit(function(e){
e.preventDefault();
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
}
});
var myForm = document.getElementById('package-form');
var formData = new FormData(myForm);
$.ajax({
url: "{{ url('admin/post_membership') }}",
method : 'post',
data: formData,
contentType: false,
cache: false,
processData: false,
success: function(result){
if(result.success==0){
if(result.validation==0){
if(result.message.days)
{
$('.days_error').html(result.message.days[0]);
}else{
$('.name_error').html('');
}
if(result.message.products)
{
$('.products_error').html(result.message.products[0]);
}
if(result.message.price)
{
$('.price_error').html(result.message.price[0]);
}


}
}
else{
bootbox.alert({
title: "Message",
message:result.message,
callback: function(){
setTimeout(function(){ location.reload(); }, 1000);
// $("#product-form").trigger("reset");
// $('#editor').html('');
// $('#imgthumbnail').attr('src','');
// $('.ck-content p').html(' <br data-cke-filler="true">');
// $('.show_image').css('display','none');
}
});
}
}});
});
});

</script>

@endsection
