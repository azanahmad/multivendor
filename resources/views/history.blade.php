@extends('../layouts.layout')
@section('title')
    Pricing
@endsection
@section('body')
    <main id="main-container">
        <!-- Hero -->
    {{--        <div class="bg-body-light">--}}
    {{--            <div class="content content-full">--}}
    {{--                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">--}}
    {{--                    <h1 class="flex-sm-fill h3 my-2">--}}
    {{--                        Pricing Tables <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Clean and responsive pricing tables that will improve your conversions.</small>--}}
    {{--                    </h1>--}}
    {{--                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">--}}
    {{--                        <ol class="breadcrumb breadcrumb-alt">--}}
    {{--                            <li class="breadcrumb-item">Tables</li>--}}
    {{--                            <li class="breadcrumb-item" aria-current="page">--}}
    {{--                                <a class="link-fx" href="">Pricing</a>--}}
    {{--                            </li>--}}
    {{--                        </ol>--}}
    {{--                    </nav>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    <!-- END Hero -->
        <!-- Page Content -->
        <div class="content">
            <!-- Modern Design -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">
                                Billing Address
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option">

                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form class="mb-5"  action="{{route('create_agreement',['id'=>encrypt($package->id)])}}"  method="POST" >
                                @csrf()
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Form Labels on top - Default Style -->
                                        <div class="form-group">
                                            <label for="example-ltf-email">Street Address</label>
                                            <input type="text" class="form-control"  name="street" placeholder="" value="{{old('street')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- Form Labels on top - Default Style -->
                                        <div class="form-group">
                                            <label for="example-ltf-email">City Name</label>
                                            <input type="text" class="form-control"  name="city" placeholder="" value="{{old('city')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="val-select2">Country Name</label>
                                            <select class="js-select2 form-control" id="val-select2" name="country" style="width: 100%;"  >
                                                <option value="" {{old('country')}}>Choose one...</option>
                                                {{--                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->--}}
                                                <?php
                                                $country_list = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania","Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","St. Lucia","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","Uruguay","Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
                                                foreach ( $country_list as $key)
                                                {
                                                ?>
                                                <option value="<?php echo $key;?>" {{old('country')}}><?php echo $key;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- Form Labels on top - Default Style -->
                                        <div class="form-group">
                                            <label for="example-ltf-email">Zip Code</label>
                                            <input type="number" class="form-control"  name="zip_code" placeholder=""
                                                   value="{{old('zip_code')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="d-block">Payment Method</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="example-radios-inline1" name="payment_method" value="paypal" checked>
                                                <label class="form-check-label" for="example-radios-inline1">Paypal</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="example-radios-inline2" name="payment_method" value="strip">
                                                <label class="form-check-label" for="example-radios-inline2">Strip</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Pay</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">
                                Plan Information
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option">

                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <p>Plan Name : {{$package->package_name}}</p>
                            <p>Products Allow : {{$package->no_products_allow}}</p>
                            <p>Amount : {{$package->rates.' $ / Per '.$package->type}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>

@endsection
