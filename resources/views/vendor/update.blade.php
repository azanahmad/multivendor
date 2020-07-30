@extends('../layouts.layout')
@section('title')
    Vendor
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
                                @if(isset($user))
                                @else
                                    <a class="link-fx" href="{{ route('vendor.show') }}">Vendors List</a>

                                @endif
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
                    <h3 class="block-title">Vendor Update</h3>
                </div>
                <div class="block-content block-content-full">
                    <form class="mb-5" action="{{route('vendor.update',['id'=>$user->id])}}" method="POST" >
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
                            <div class="col-lg-6">
                                <!-- Form Labels on top - Default Style -->
                                <div class="form-group">
                                    <label for="example-ltf-email">Store Name</label>
                                    <input type="text" class="form-control"  name="name" placeholder=""
                                           value="{{old('name',$user->name	 ?? '')}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Form Labels on top - Default Style -->
                                <div class="form-group">
                                    <label for="example-ltf-email">Email</label>
                                    <input type="text" class="form-control"  name="email" placeholder=""
                                           value="{{old('email',$user->email	 ?? '')}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary">update</button>

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
@endsection
