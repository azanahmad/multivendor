@extends('../layouts.layout')
@section('title')
    Vendor List
@endsection
@section('body')
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h3 my-2">
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item">Vendor</li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{ route('vendor.show') }}">Vendors List</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Dynamic Table Full -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Vendors List </h3>
                </div>
                <div class="block-content block-content-full">
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
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                        <div class="table-responsive">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-center ">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px;">ID</th>
                                    <th style="width: 450px;">Store Name</th>
                                    <th  style="width: 300px;">Vendor Email</th>
                                    {{--                            <th style="width: 150px;">Subscription</th>--}}
                                    <th style="width: 150px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($vendor as $vendor)
                                    <tr>
                                        <td>{{$vendor->id}}</td>
                                        <td>{{$vendor->name}}</td>
                                        <td>{{$vendor->email}}</td>
                                        {{--                                @if($vendor->package=='0')<td><span class="badge badge-danger">un subscribe</span></td>@else <td><span class="badge badge-primary">subscribe</span></td>@endif--}}
                                        {{--                                <td class="text-center">--}}
                                        {{--                                    <div class="btn-group">--}}
                                        {{--                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit" onclick="window.location.href='{{route('package.edit',['id'=>$package->id])}}'">--}}
                                        {{--                                            <i class="fa fa-fw fa-pencil-alt"></i>--}}
                                        {{--                                        </button>--}}
                                        {{--                                        <button type="button" class="btn btn-sm btn-primary edit_data"  id="{{$package->id}}" data-toggle="tooltip" title="Delete">--}}
                                        {{--                                            <i class="fa fa-fw fa-times"></i>--}}
                                        {{--                                        </button>--}}
                                        {{--                                    </div>--}}
                                        {{--                                </td>--}}
                                        <td>
                                            
                                            <a href="{{route('vendor.edit',['id'=>$vendor->id])}}" class="btn btn-sm btn-warning"
                                               type="button" data-toggle="tooltip" title=""
                                               data-original-title="Edit Vendor"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-xs btn-sm btn-success" type="button" href="{{route('vendor.history',['id'=>$vendor->id])}}" data-toggle="tooltip" data-original-title="View Details">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a  class="btn btn-sm btn-danger edit_data" id="{{$vendor->id}}"
                                               type="button" data-toggle="tooltip" title=""
                                               data-original-title="Delete Vendor"><i class="fa fa-times"></i></a>



                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>

                            </table>
{{--                            <div class="float-right">--}}
{{--                                {{ $product->links() }}--}}
{{--                            </div>--}}

                        </div>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>
        <!-- END Page Content -->
    </main>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Are you sure!</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <form action="{{ route('vendor.delete') }}" method="post">
                        @csrf()
                        <input type="hidden" name="id" id="id" class="form-control" />
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-check mr-1"></i>Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
