@extends('../layouts.layout')
@section('title')
    Product
@endsection
@section('styles')

    <style>
        .file {
            visibility: hidden;
            position: absolute;
        }
    </style>
@endsection
@section('body')

    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h3 my-2">
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item">Variant</li>
                            <li class="breadcrumb-item" aria-current="page">
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->
        <!-- Page Content -->
        <div class="content">
            <!-- Labels on top -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Variant Update</h3>
                </div>
                <div class="block-content block-content-full">
                    <form class="mb-5" action="{{route('edit_varient_save',['id'=>$varient->id,'product_id'=>$product->id])}}" method="POST" >
                        @csrf()
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
                        <div class="row">
                            @if(isset($varient->Option1))
                                <div class="col-lg-3">
                                    <!-- Form Labels on top - Default Style -->
                                    <div class="form-group">
                                        <label for="example-ltf-email">{{$product->option_name1}}</label>
                                        <input type="text" class="form-control"  name="Option1" placeholder=""
                                               value="{{old('Option1',$varient->Option1	 ?? '')}}" required>
                                    </div>
                                </div>
                            @endif
                            @if(isset($varient->Option2))
                                <div class="col-lg-3">
                                    <!-- Form Labels on top - Default Style -->
                                    <div class="form-group">
                                        <label for="example-ltf-email">{{$product->option_name2}}</label>
                                        <input type="text" class="form-control"  name="Option2" placeholder=""
                                               value="{{old('Option2',$varient->Option2	 ?? '')}}"  required>
                                    </div>
                                </div>
                            @endif
                            @if(isset($varient->Option3))
                                <div class="col-lg-3">
                                    <!-- Form Labels on top - Default Style -->
                                    <div class="form-group">
                                        <label for="example-ltf-email">{{$product->option_name3}}</label>
                                        <input type="text" class="form-control"  name="Option3" placeholder=""
                                               value="{{old('Option3',$varient->Option3	 ?? '')}}" required>
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="block-header">
                    <h3 class="block-title">Variant Details Update</h3>
                </div>
                <div class="block-content block-content-full">
                    <form class="mb-5" action="{{route('edit_varient_details',['id'=>$varient->id,'product_id'=>$product->id])}}" method="POST" >
                        @csrf()
                        @if(session('varient_success'))
                            <div class="alert alert-success alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="mb-0">{{session('varient_success')}}</p>
                            </div>
                        @endif
                        @if(session('varient_form_error'))
                            <div class="alert alert-warning alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="mb-0">{{session('varient_form_error')}}</p>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-3">
                                <!-- Form Labels on top - Default Style -->
                                <div class="form-group">
                                    <label for="example-ltf-email">Price</label>
                                    <input type="text" class="form-control"  name="Price" placeholder=""
                                           value="{{old('Price',$varient->Price	 ?? '')}}" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <!-- Form Labels on top - Default Style -->
                                <div class="form-group">
                                    <label for="example-ltf-email">Quantity</label>
                                    <input type="number" class="form-control"  name="Quantity" placeholder=""
                                           value="{{old('Quantity',$varient->Quantity	 ?? '')}}" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <!-- Form Labels on top - Default Style -->
                                <div class="form-group">
                                    <label for="example-ltf-email">SKU (Stock Keeping Unit)</label>
                                    <input type="number" class="form-control"  name="SKU" placeholder=""
                                           value="{{old('SKU',$varient->SKU	 ?? '')}}" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <!-- Form Labels on top - Default Style -->
                                <div class="form-group">
                                    <label for="example-ltf-email">Barcode </label>
                                    <input type="text" class="form-control"  name="Barcode" placeholder=""
                                           value="{{old('Barcode',$varient->Barcode	 ?? '')}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="block-header">
                    <h3 class="block-title">Variant Image Update</h3>
                </div>
                <div class="block-content block-content-full">
                    <form class="mb-5" action="{{route('varient_update',['id'=>$varient->id,'product_id'=>$product->id])}}" enctype="multipart/form-data" method="POST" >
                        @csrf()
                        @if(session('varient_image_success'))
                            <div class="alert alert-success alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="mb-0">{{session('varient_image_success')}}</p>
                            </div>
                        @endif
                        @if(session('varient_image_form_error'))
                            <div class="alert alert-warning alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="mb-0">{{session('varient_image_form_error')}}</p>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-3">
                                <!-- Form Labels on top - Default Style -->
                                <div class="form-group">
                                    <input type="file" name="file" class="file">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file" name="file" required>
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary">Browse...</button>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($varient->has_image))
                                    <div class="form-group">
                                        <img
                                            src="{{ asset('images/'.$varient->has_image->src)}}" alt="not" style="height:120px; width:200px"/>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail">
                                    </div>
                                @endif

                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-secondary image_select">Choose Exsisting Image</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Labels on top -->
        </div>
        <!-- END Page Content -->
    </main>
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

                                <!-- Form Labels on top - Default Style -->
                                <input id="image_id" name="id" type="hidden" value="{{$varient->id}}">


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



    <!-- END main -->
@endsection

@section('scripts')
    <script>
        $(document).on("click", ".browse", function() {
            var file = $(this)
                .parent()
                .parent()
                .parent()
                .find(".file");
            file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
        $(document).on('click',".image_select",function() {

            // $('#insert').val("Update");
            $('#image_model').modal('show');

        });

    </script>
@endsection

