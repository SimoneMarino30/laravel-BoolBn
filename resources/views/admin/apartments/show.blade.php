@extends('layouts.app')

@section('page-name', $apartment->title)

@section('content')

    <div class="container pt-5">
        @include('layouts.partials._session-message')
    </div>

    <section class="container text-center pt-4">

        <h1 class="my-4">Dettaglio - {{ $apartment->id }}</h1>

        <div class="d-flex justify-content-center">
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary me-3">
                Torna alla lista
            </a>

            <a href="{{ route('admin.apartments.edit', $apartment) }}" class="btn btn-primary ms-3">
                Modifica appartamento
            </a>

            @if ($apartment->sponsored == false)
                <div>
                    <a href="{{ route('admin.sponsors.index', ['apartment_id' => $apartment->id]) }}"
                        class="btn btn-success ms-3">
                        Sponsorizza
                    </a>
                </div>
            @else
                <span class="ms-3 fs-4 fw-bold text-success">
                    SPONSORIZZATO
                </span>
            @endif
        </div>

        <div class="card clearfix my-4">
            <div class="card-header">
                <strong>
                    {{ $apartment->title }}
                </strong>
            </div>

            <div class="card-body">
                <figure class="float-end ms-5 mb-3">
                    <img src="{{ $apartment->getImageUri() }}" alt="{{ $apartment->title }}" width="300">
                    <figcaption>
                        <p class="text-muted text-secondary m-0">
                            <strong>Stato:</strong>
                            <span class="{{ $apartment->visibility ? 'text-success' : 'text-danger' }}">
                                {{ $apartment->visibility ? 'Pubblicato' : 'Da pubblicare' }}
                            </span>
                        </p>
                    </figcaption>
                </figure>

                <div class="row">
                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Camere:</strong>
                            <br>
                            <span>{{ $apartment->rooms }}</span>
                        </p>
                    </div>

                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Letti:</strong>
                            <br>
                            <span>{{ $apartment->beds }}</span>
                        </p>
                    </div>

                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Bagni:</strong>
                            <br>
                            <span>{{ $apartment->bathrooms }}</span>
                        </p>
                    </div>

                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Prezzo:</strong>
                            <br>
                            <span>€ {{ $apartment->price }}</span>
                        </p>
                    </div>

                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Superficie:</strong>
                            <br>
                            <span>{{ $apartment->mq }} mq</span>
                        </p>
                    </div>

                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Indirizzo:</strong>
                            <br>
                            <span>{{ $apartment->address }}</span>
                        </p>
                    </div>
                </div>

                <p class="my-5">
                    <strong class="text-center">Descrizione:</strong>
                    <br>
                    {{ $apartment->description }}
                </p>
            </div>

            <div>
                <p>
                    <strong>Servizi:</strong>
                </p>
                <ul>
                    @forelse ($apartment->services as $service)
                        <li class="d-inline-block me-3 my-1">
                            <i class="{{ $service->icon }}"></i>
                            {{ $service->name }}
                        </li>
                    @empty
                        Nessun servizio specificato
                    @endforelse
                </ul>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <span>
                    <strong>Creato il:</strong>
                    {{ $apartment->created_at }}
                </span>

                <span>
                    <strong>Ultima modifica:</strong>
                    {{ $apartment->updated_at }}
                </span>
            </div>
        </div>
    </section>

@endsection
