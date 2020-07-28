@extends('../layouts.layout')
@section('title')
    Products
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
                                <a class="link-fx" href="{{url('admin/dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">Products</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row mb-3">
                <div class="col-sm-9">
                    <form action="" method="GET" class="d-flex">
                        <input type="search" class="form-control d-inline-block" value="" name="search" placeholder="Search By Keyword">
                        <input type="submit" value="Search" class="btn btn-primary btn-sm  d-inline-block" style="margin-left: 10px">
                    </form>
                </div>

            </div>
            <div class="block">
                <div class="block-content">
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
                    <div class="table-responsive">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                        <table class="table table-bordered table-striped table-center ">
                            <thead>
                            <tr>
                                <th style="width:5% ">Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Vendor Name</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $products)
                                <tr>
                                    <td class="text-center">
                                        @if($products->has_image)
                                            @foreach($products->has_image as $image)
                                                <?php  $src=$image->src; ?>
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
                                    <td style="vertical-align: middle">{{$products->Quantity}}</td>
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
                                    </td>
                                    <td><a href="{{route('vendor.history',['id'=>$products->vendor_id])}}">{{$products->vendor->name}}</a></td>
                                    <td style="vertical-align: middle">

                                        @if($products->product_status->admin_status=='approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($products->product_status->admin_status=='rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-danger">pending</span>

                                        @endif
                                    </td>

                                    <td class="text-center" style="vertical-align: middle">

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


                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        <div class="float-right">
                            {{ $product->links() }}
                        </div>

                    </div>
                    {{--                    <div class="row">--}}
                    {{--                        <div class="col-md-12 text-center" style="font-size: 17px">--}}
                    {{--                            <nav>--}}
                    {{--                                <ul class="pagination">--}}

                    {{--                                    <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">--}}
                    {{--                                        <span class="page-link" aria-hidden="true">&lsaquo;</span>--}}
                    {{--                                    </li>--}}





                    {{--                                    <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>--}}
                    {{--                                    <li class="page-item"><a class="page-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/products/all?page=2">2</a></li>--}}
                    {{--                                    <li class="page-item"><a class="page-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/products/all?page=3">3</a></li>--}}


                    {{--                                    <li class="page-item">--}}
                    {{--                                        <a class="page-link" href="https://phpstack-362288-1193299.cloudwaysapps.com/products/all?page=2" rel="next" aria-label="Next &raquo;">&rsaquo;</a>--}}
                    {{--                                    </li>--}}
                    {{--                                </ul>--}}
                    {{--                            </nav>--}}

                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Do you really want to rejected this product?</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form action="{{ url('admin/rejected') }}" method="post">
                            @csrf()
                            <input type="hidden" name="id" id="id" class="form-control" />
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Form Labels on top - Default Style -->
                                    <div class="form-group">
                                        <label for="example-ltf-email">Write Note</label>
                                        <input type="text" class="form-control"  name="note" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>
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
                        <h3 class="block-title">Do you really want to approve this product?</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form action="{{ url('admin/approve') }}" method="post">
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

@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" ></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click','.approve',function(){

                var id = $(this).data("id");
                $('#p_id').val(id);
                // $('#insert').val("Update");
                $('#approve').modal('show');
                {{--bootbox.confirm("Do you really want to approve this product?", function(getresult) {--}}
                {{--    if(getresult){--}}
                {{--        $.ajax({--}}
                {{--            url:"{{url('admin/approve')}}/"+id,--}}
                {{--            method : 'get',--}}

                {{--            success: function(result){--}}

                {{--                if(result.status == 0){--}}
                {{--                    bootbox.alert({--}}
                {{--                        title: "Message",--}}
                {{--                        message:result.message,--}}
                {{--                        callback: function(){--}}
                {{--                            window.setTimeout(function(){location.reload()},1000);--}}

                {{--                        }--}}
                {{--                    });--}}
                {{--                }--}}
                {{--                else{--}}

                {{--                    bootbox.alert({--}}
                {{--                        title: "Message",--}}
                {{--                        message:result.message,--}}
                {{--                        callback: function(){--}}
                {{--                            //window.setTimeout(function(){location.reload()},1000)--}}
                {{--                        }--}}
                {{--                    });--}}
                {{--                }--}}
                {{--            }});--}}
                {{--    }--}}
                {{--});--}}
            });
            $(document).on('click','.rejected',function(){

                var id = $(this).data("id");

                $('#id').val(id);
                // $('#insert').val("Update");
                $('#myModal').modal('show');
                {{--bootbox.confirm("Do you really want to rejected this product?", function(getresult) {--}}
                {{--    if(getresult){--}}
                {{--        $.ajax({--}}
                {{--            url:"{{url('admin/rejected')}}/"+id,--}}
                {{--            method : 'get',--}}

                {{--            success: function(result){--}}

                {{--                if(result.status == 0){--}}
                {{--                    bootbox.alert({--}}
                {{--                        title: "Message",--}}
                {{--                        message:result.message,--}}
                {{--                        callback: function(){--}}
                {{--                            window.setTimeout(function(){location.reload()},1000);--}}

                {{--                        }--}}
                {{--                    });--}}
                {{--                }--}}
                {{--                else{--}}

                {{--                    bootbox.alert({--}}
                {{--                        title: "Message",--}}
                {{--                        message:result.message,--}}
                {{--                        callback: function(){--}}
                {{--                            //window.setTimeout(function(){location.reload()},1000)--}}
                {{--                        }--}}
                {{--                    });--}}
                {{--                }--}}
                {{--            }});--}}
                {{--    }--}}
                {{--});--}}
            });
        });

    </script>
@endsection
