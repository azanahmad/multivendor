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
                                Payment Section
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option">

                                </button>
                            </div>
                        </div>
                        {{--                        <input id="card-holder-name" type="text">--}}

                        {{--                        <!-- Stripe Elements Placeholder -->--}}
                        {{--                        <div id="card-element"></div>--}}

                        {{--                        <button id="card-button" data-secret="{{ $intent->client_secret }}">--}}
                        {{--                            Update Payment Method--}}
                        {{--                        </button>--}}
                        <div class="block-content">
                            @csrf()
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Form Labels on top - Default Style -->
                                    <div class="form-group">
                                        <label for="example-ltf-email">Card Holder Name</label>
                                        <input type="text" id="card-holder-name" class="form-control"  name="card_name" placeholder="" value="{{old('street')}}" required>
                                    </div>
                                    <div class="form-group">

                                    <input type="hidden" id="address" class="form-control"  name="card_name" placeholder="" value="{{$address}}" required>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="example-ltf-email">Credit Card Number</label>
                                        <div id="card-element" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button id="card-button" class="btn btn-primary" data-secret="{{ $intent->client_secret }}">
                                            Pay
                                        </button>
                                    </div>
                                </div>
                            </div>

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
        <div id='loader' style='display: none;
    position: absolute;
    width: 100%;
    height: 100%;
    text-align: center;
    color: #fff;
    background: rgba(0, 0, 0, 0.5);
    padding-top: 10%;
    padding-right: 20%;
    /*padding-left: 30px;*/
' >
            <img src='{{asset('loader.gif')}}'>
        </div>

{{--        <div class="pre-loader" id="loader">--}}
{{--            <div class="loader">--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- END Page Content -->
    </main>

    <script>
        window.addEventListener('load',function () {
            var style = {
                base: {
                    color: '#303238',
                    fontSize: '16px',
                    fontFamily: '"Open Sans", sans-serif',
                    fontSmoothing: 'antialiased',
                    '::placeholder': {
                        color: '#CFD7DF',
                    },
                },
                invalid: {
                    color: '#e5424d',
                    ':focus': {
                        color: '#303238',
                    },
                },
            };

            const stripe = Stripe('{{env('STRIPE_KEY')}}');

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            const address = document.getElementById('address').value;

            cardButton.addEventListener('click', async (e) => {
                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );

                if (error) {
                    // Display "error.message" to the user...
                }
                else {
                    //console.log('handling',setupIntent.payment_method);
                    {{--axios.post('/strip_subscribe',{--}}
                    {{--    payment_method:setupIntent.payment_method ,--}}
                    {{--    id: {{$package->id}},--}}
                    {{--    address:address--}}
                    {{--});--}}

                    $.ajax({
                        url:"{{ route('strip_subscribe') }}",
                        method:"GET",
                        data:{payment_method:setupIntent.payment_method, id:{{$package->id}},address:address},
                        beforeSend: function(){
                            // Show image container
                            $("#loader").show();
                        },
                        success:function(data){

                            if(data==='success')
                            {
                                window.location.href='{{route('success')}}';
                            }

                        },
                        complete:function(data){
                            // Hide image container
                            $("#loader").hide();
                        }
                });


                }
            });
        });

    </script>
@endsection
