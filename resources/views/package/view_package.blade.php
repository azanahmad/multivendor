@extends('../layouts.layout')
@section('title')
    View Package
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
                            <li class="breadcrumb-item">Package</li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{ route('package.show') }}">Packages List</a>
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
                    <h3 class="block-title">Packages List </h3>
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
                    <table class="table table-bordered table-striped  js-dataTable-full table-responsive" >
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 20px;">ID</th>
                            <th style="width: 450px;">Package Name</th>
                            <th style="width: 450px;">Package Description</th>
                            <th  style="width: 300px;">No of Products Allow</th>
                            <th style="width: 150px;">Prices</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 150px;" class="text-center">Action</th>
                        </tr>
                        </thead>
                     <tbody>
                     @foreach($package as $package)
                         <tr>
                         <td>{{$package->id}}</td>
                         <td>{{$package->package_name}}</td>
                         <td>{{$package->plan_description}}</td>
                         <td>{{$package->no_products_allow}}</td>
                         <td>{{$package->rates}} $</td>
                             @if($package->status==1)
                                 <td><span class="badge badge-primary">Active</span></td>@else <td><span class="badge badge-danger">In Active</span></td>@endif

                             <td class="text-center">
                             <div class="btn-group">
{{--                                 <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" @if($package->status=='1') title="Plan is active" @else title="Edit"  @endif onclick="window.location.href='{{route('package.edit',['id'=>$package->id])}}'"  @if($package->status=='1') style="display: none" @endif >--}}
{{--                                     <i class="fa fa-fw fa-pencil-alt"></i>--}}
{{--                                 </button>--}}
                                 <button type="button" class="btn btn-sm btn-primary edit_data"  id="{{$package->id}}" data-toggle="tooltip" title="Delete">
                                     <i class="fa fa-fw fa-times"></i>
                                 </button>
                                 @if($package->status=='0')
                                 <button type="button" class="btn btn-sm btn-primary"  onclick="window.location.href='{{route('package.activate',['id'=>$package->id])}}'" data-toggle="tooltip" title="Activate">
                                     <i class="fa fa-fw fa-power-off"></i>
                                 </button>
                                     @endif
                             </div>
                         </td>
                         </tr>
                     @endforeach

                     </tbody>
                    </table>
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
                    <form action="{{ route('package.delete') }}" method="post">
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
