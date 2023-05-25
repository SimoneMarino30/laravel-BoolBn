@extends('layouts.app')

@section('page-name', 'Pagamento')

@section('head')
    {{-- BRAINTREE --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.37.0/js/dropin.min.js"></script>

    {{-- JQUERY --}}
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

        {{-- div fornito da Braintree per il layout --}}
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
        let instance;

        // Recuperiamo stringa url
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        // Salviamo i valori dei parametri nell'url
        let sponsor = urlParams.get('sponsor_id');
        let apartment = urlParams.get('apartment_id');

        // Script Braintree
        braintree.dropin.create({
            authorization: '{{ $token }}',
            selector: '#dropin-container'
        }, function(err, dropinInstance) {
            if (err) {
                console.error(err);
                return;
            }
            instance = dropinInstance;
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    // API alla funzione make del PaymentController passando i parametri payload, sponsor e apartment
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
        });
    </script>
@endsection
