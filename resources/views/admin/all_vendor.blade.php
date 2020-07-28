@extends('../layouts.layout')
@section('title')
    Package
@endsection
@section('body')
    <main id="main-container">

        <div class="bg-body-light">
            <div class="content content-full pt-2 pb-2">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h4 my-2">
                        All Vendors
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{url('admin/dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">All Vendors</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row mb-3">
                <div class="col-sm-9">
                    {{--                    <form action="" method="GET" class="d-flex">--}}
                    {{--                        <input type="search" class="form-control d-inline-block" value="" name="search" placeholder="Search By Keyword">--}}
                    {{--                        <input type="submit" value="Search" class="btn btn-primary btn-sm  d-inline-block" style="margin-left: 10px">--}}
                    {{--                    </form>--}}
                </div>

            </div>
            <div class="block">
                <div class="block-content">
                    <div class="table-responsive">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                              <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count=1;
                            @endphp
                            @foreach($vendor as $products)
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td class="font-w600" style="vertical-align: middle">
                                      <b>
                                            {{$products->name}}
                                      </b>
                                    </td>

                                    <td style="vertical-align: middle">
                                        {{$products->email}}
                                    </td>
                                    <td style="vertical-align: middle">
                                        {{$products->created_at}}
                                    </td>
                                    <td style="vertical-align: middle">
                                        {{$products->updated_at}}
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" ></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click','.approve',function(){

                var id = $(this).data("id");

                bootbox.confirm("Do you really want to approve this product?", function(getresult) {
                    if(getresult){
                        $.ajax({
                            url:"{{url('admin/approve')}}/"+id,
                            method : 'get',

                            success: function(result){

                                if(result.status == 0){
                                    bootbox.alert({
                                        title: "Message",
                                        message:result.message,
                                        callback: function(){
                                            window.setTimeout(function(){location.reload()},1000);

                                        }
                                    });
                                }
                                else{

                                    bootbox.alert({
                                        title: "Message",
                                        message:result.message,
                                        callback: function(){
                                            //window.setTimeout(function(){location.reload()},1000)
                                        }
                                    });
                                }
                            }});
                    }
                });
            });
            $(document).on('click','.rejected',function(){

                var id = $(this).data("id");

                bootbox.confirm("Do you really want to rejected this product?", function(getresult) {
                    if(getresult){
                        $.ajax({
                            url:"{{url('admin/rejected')}}/"+id,
                            method : 'get',

                            success: function(result){

                                if(result.status == 0){
                                    bootbox.alert({
                                        title: "Message",
                                        message:result.message,
                                        callback: function(){
                                            window.setTimeout(function(){location.reload()},1000);

                                        }
                                    });
                                }
                                else{

                                    bootbox.alert({
                                        title: "Message",
                                        message:result.message,
                                        callback: function(){
                                            //window.setTimeout(function(){location.reload()},1000)
                                        }
                                    });
                                }
                            }});
                    }
                });
            });
        });

    </script>
@endsection
