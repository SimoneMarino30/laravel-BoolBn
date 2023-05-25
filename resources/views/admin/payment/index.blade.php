@extends('layouts.app')

@section('page-name', 'Pagamento')

@section('head')
    <script src="https://js.braintreegateway.com/web/dropin/1.37.0/js/dropin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

@section('content')
    <section id="payment" class="container my-5">
        <h1>Pagamento:</h1>
        <div class="d-flex justify-content-center">
            <a href="{{ route('admin.sponsors.index') }}" class="btn btn-primary me-3">
                Torna agli sponsor
            </a>
        </div>
        <div id="dropin-container"></div>
        <button id="submit-button" class="button button--small button--green">Acquista</button>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        var button = document.querySelector('#submit-button');
        // Step two: create a dropin instance using that container (or a string
        //   that functions as a query selector such as `#dropin-container`)

        braintree.dropin.create({
            // container: document.getElementById('dropin-container'),

            authorization: '{{ $clientToken }}',
            selector: '#dropin-container'
        }, function(err, instance) {
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    $.get('{{ route('admin.payment.make') }}', {
                        payload
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
