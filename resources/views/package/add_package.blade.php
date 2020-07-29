@extends('../layouts.layout')
@section('title')
    Package
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
                                @if(isset($package))
                                @else
                                    <a class="link-fx" href="{{ route('package.index') }}">Create Package</a>

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
                    @if(isset($package))
                        <h3 class="block-title">Package Update</h3>
                    @else
                        <h3 class="block-title">New Package Create</h3>
                    @endif
                </div>
                <div class="block-content block-content-full">
                    <form class="mb-5" @if(isset($package))action="{{route('package.update',['id'=>$package->id])}}" @else action="{{route('package.store')}}"  @endif method="POST" >
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
                                    <label for="example-ltf-email">Plan Name</label>
                                    <input type="text" class="form-control"  name="package_name" placeholder=""
                                           value="{{old('package_name',$package->package_name	 ?? '')}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Form Labels on top - Default Style -->
                                <div class="form-group">
                                    <label for="example-ltf-email">Plan Description</label>
                                    <input type="text" class="form-control"  name="plan_description" placeholder=""
                                           value="{{old('plan_description',$package->plan_description	 ?? '')}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="example-ltf-email">Plan Type</label>

                                    <select class="js-select2 form-control" id="val-select2" name="type" style="width: 100%;"  >
                                        {{--                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->--}}
                                        <option value="Month" {{old('type',$package->type ?? '') == 'Month' ? "selected" : "" }}>Monthly</option>
                                        <option value="every 3 months" {{old('type',$package->type ?? '') == 'every 3 months' ? "selected" : "" }}>Every 3 months</option>
                                        <option value="every 6 months"{{old('type',$package->type ?? '') == 'every 6 months' ? "selected" : "" }}>Every 6 months</option>
                                        <option value="Year"{{old('type',$package->type ?? '') == 'Year' ? "selected" : "" }}>Yearly</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="example-ltf-password">No. of Products Allow</label>
                                    <input type="number" class="form-control"  name="no_products_allow" placeholder="" value="{{old('no_products_allow',$package->no_products_allow	 ?? '')}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="example-ltf-password">Price</label>
                                    <input type="number" class="form-control"  name="rates" placeholder="" value="{{old('rates',$package->rates	 ?? '')}}" required>

                                    @error('rates')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    @if(isset($package))
                                        <button type="submit" class="btn btn-primary">update</button>
                                    @else
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    @endif
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
