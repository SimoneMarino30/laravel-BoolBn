@extends('layouts.app')

@section('page-name', 'Dashboard')

@section('content')
    <div class="container pt-4">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard utente') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Pagina statistiche. Work in progress...') }}
                    </div>
                    {{-- @forelse($apartments as $apartment) --}}
                    {{-- <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div> --}}
                    {{-- @empty --}}
                    {{-- @endforelse --}}
                </div>
            </div>
        </div>
    </div>
@endsection
