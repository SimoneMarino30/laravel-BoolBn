@extends('layouts.app')

@section('page-name', 'Lista messaggi')

@section('content')

    <section class="container pt-4">

        <div class="container pt-5">
            @include('layouts.partials._session-message')
        </div>
        <div class="table-responsive">
            <table id="message-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Appartamento</th>
                        <th scope="col" class="d-none d-md-table-cell">Nome</th>
                        <th scope="col" class="d-none d-md-table-cell">Cognome</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="d-none d-md-table-cell">Testo</th>
                        <th scope="col">Ricevuto</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                        <tr>
                            <td scope="row">{{ $message->apartment->title }}</td>
                            <td class="d-none d-md-table-cell">{{ $message->name }}</td>
                            <td class="d-none d-md-table-cell">{{ $message->surname }}</td>
                            <td>{{ $message->email }}</td>
                            <td class="d-none d-md-table-cell">{{ $message->getAbstract() }}</td>
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
        </div>

        <div class="row justify-content-between align-items-center my-4">
            <div class="col text-end">
                <a href="{{ route('admin.messages.trash') }}" class="btn btn-outline-warning">
                    <span>Ripristina i messaggi eliminati</span>
                    <i class="fa-solid fa-recycle"></i>
                </a>
            </div>
        </div>
        {{ $messages->links() }}

    </section>

@endsection

@section('modals')
    @foreach ($messages as $message)
        <!-- Modal -->
        <div class="modal fade" id="delete-modal-{{ $message->id }}" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-bg">
                        <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Il messaggio n°
                            {{ $message->id }} sta per essere cestinato</h1>
                        <a type="button" class="text-light" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </div>
                    <div class="modal-body modal-bg">
                        Sei sicuro di voler proseguire?
                    </div>
                    <div class="modal-footer modal-bg">

                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">
                            <i class="bi bi-file-arrow-down"></i>
                            Annulla
                        </button>

                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST">
                            @csrf
                            @method('delete')

                            <button class="btn btn-outline-danger">
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
