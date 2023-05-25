@extends('layouts.app')

@section('page-name', 'Pagamento')

@section('head')
    <script src="https://js.braintreegateway.com/web/dropin/1.37.0/js/dropin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
@endsection

@section('content')
    <section id="payment" class="container my-5">
        <h1>Pagamento:</h1>
        <div class="d-flex justify-content-center">
            <a href="{{ route('admin.sponsors.index') }}" class="btn btn-primary me-3">
                Torna agli sponsor
            </a>
        </div>

        <div>
            @csrf
            <div id="dropin-container"></div>
            <button id="submit-button" class="button button--small button--green">Acquista</button>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        var button = document.querySelector('#submit-button');

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        let sponsor = urlParams.get('sponsor_id');
        let apartment = urlParams.get('apartment_id');
        let instance;


        braintree.dropin.create({
            authorization: '{{ $token }}',
            selector: '#dropin-container'
        }, function(err, dropinInstance) {
            if (err) {
                // Handle any errors that might've occurred when creating Drop-in
                console.error(err);
                return;
            }
            instance = dropinInstance;
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    $.get('{{ route('admin.payment.make') }}', {
                        payload,
                        sponsor,
                        apartment,
                    }, function(response) {
                        if (response.success) {
                            alert("Payment successfull!");
                        } else {
                            alert("Payment failed");
                        }
                    }, "json");
                });
            })

            // Use `dropinInstance` here
            // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
        });
    </script>
@endsection
