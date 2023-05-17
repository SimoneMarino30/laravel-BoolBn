{{-- @dump($apartments); --}}

@extends('layouts.app')

@section('page-name', 'Appartamenti')

@section('content')

    <div class="container pt-5">
        @include('layouts.partials._session-message')
    </div>

    <section class="container">
        <h1 class="text-center mt-5">Lista Appartamenti</h1>
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <a type="button" href="{{ route('admin.apartments.create') }}" class="btn btn-outline-primary">
                    Aggiungi un nuovo appartamento
                </a>

            </div>
            <table class="table table-dark table-striped table-hover align-middle my-5">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Anteprima</th>
                        <th scope="col">Appartamento</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Visibile</th>
                        <th scope="col">Creato</th>
                        <th scope="col">Ultima modifica</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apartments as $apartment)
                        <tr>
                            <th scope="row">{{ $apartment->id }}</th>
                            <td>
                                <img src="{{ $apartment->getImageUri() }}" alt="" class="table-image">
                            </td>
                            <td>{{ $apartment->title }}</td>
                            <td>{{ $apartment->price }} €</td>
                            <td>{{ $apartment->address }}</td>
                            <td>
                                <span class="{{ $apartment->visibility ? 'text-success' : 'text-danger' }}">
                                    {!! $apartment->getIconHTML() !!}
                                </span>
                            </td>
                            <td>{{$apartment->created_at}}</td>
                            <td>{{$apartment->updated_at}}</td>
                            <td>
                                {{-- Dettaglio --}}
                                <a href="{{ route('admin.apartments.show', $apartment) }}" title="Dettaglio">
                                    <i class="bi bi-eye-fill"></i>
                                </a>

                                {{-- ? PER L'ICONA DEL SINGOLO MESSAGGIO ASPETTARE DI SVILUPPARE LE API Message --}}
                                {{-- Messaggi
                                <a href="{{ route('admin.messages.index', ['apartment_id' => $apartment->id]) }}" title="Messaggi"
                                    class="mx-2">
                                    <i class="bi bi-envelope-fill"></i>
                                </a> --}}


                                {{-- Modifica --}}
                                <a href="{{ route('admin.apartments.edit', $apartment) }}" title="Modifica">
                                    <i class="bi bi-pencil-square mx-2"></i>
                                </a>
                                <button class="bi bi-trash3-fill text-danger btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#delete-modal-{{ $apartment->id }}" title="Elimina"></button>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="9" scope="row">Nessun risultato 🤦‍♂️</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $apartments->links() }}
        </div>
    </section>
@endsection

@section('modals')
    @foreach ($apartments as $apartment)
        <!-- Modal -->
        <div class="modal fade" id="delete-modal-{{ $apartment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-bg">
                        <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">L'appartamento n°
                            {{ $apartment->id }} sta per essere eliminato</h1>
                        <a type="button" class="text-light" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </div>
                    <div class="modal-body modal-bg">
                        Vuoi eliminare definitivamente l'appartamento? <br>
                        La risorsa non potrà essere recuperata
                    </div>
                    <div class="modal-footer modal-bg">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-file-arrow-down"></i>
                            Annulla
                        </button>

                        <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
                            @csrf
                            @method('delete')

                            <button class="btn btn-danger">
                                <i class="bi bi-trash3-fill"></i>
                                Elimina
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
