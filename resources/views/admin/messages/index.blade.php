@extends('layouts.app')

@section('page-name', 'Lista messaggi')

@section('content')

    <section class="container pt-4">

        <div class="container pt-5">
            @include('layouts.partials._session-message')
        </div>

        <div class="row justify-content-between align-items-center my-4">
            <div class="col">
                <h1>Messaggi ricevuti</h1>
            </div>

            <div class="col text-end">
                <a href="{{ route('admin.messages.trash') }}" class="btn btn-danger">Cestino</a>
            </div>
        </div>

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Appartamento</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Testo</th>
                    <th scope="col">Ricevuto</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr>
                        <th scope="row">{{ $message->apartment->title }}</th>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->surname }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->getAbstract() }}</td>
                        <td>{{ $message->created_at }}</td>
                        <td>
                            {{-- Dettaglio --}}
                            <a href="{{ route('admin.messages.show', $message) }}" title="Mostra il messaggio">
                                <i class="bi bi-eye-fill me-2"></i>
                            </a>

                            {{-- Elimina --}}
                            <button class="bi bi-trash3-fill text-danger btn-icon" data-bs-toggle="modal"
                                data-bs-target="#delete-modal-{{ $message->id }}" title="Elimina">
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" scope="row">Nessun risultato</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $messages->links() }}

    </section>

@endsection

@section('modals')
    @foreach ($messages as $message)
        <!-- Modal -->
        <div class="modal fade" id="delete-modal-{{ $message->id }}" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal-bg">
                        <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Il messagio n°
                            {{ $message->id }} sta per essere cestinato</h1>
                        <a type="button" class="text-light" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </div>
                    <div class="modal-body modal-bg">
                        Sei sicuro di voler proseguire?
                    </div>
                    <div class="modal-footer modal-bg">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-file-arrow-down"></i>
                            Annulla
                        </button>

                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST">
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
