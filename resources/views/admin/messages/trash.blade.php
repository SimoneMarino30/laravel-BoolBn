@extends('layouts.app')

@section('page-name', 'Cestino messaggi')

@section('content')

    <section class="container pt-4">

        <div class="container pt-5">
            @include('layouts.partials._session-message')
        </div>

        <table id="trash-table"class="table table-striped">
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
                @forelse($trashed_messages as $message)
                    <tr>
                        <td scope="row">{{ $message->apartment->title }}</td>
                        <td class="d-none d-md-table-cell">{{ $message->name }}</td>
                        <td class="d-none d-md-table-cell">{{ $message->surname }}</td>
                        <td>{{ $message->email }}</td>
                        <td class="d-none d-md-table-cell">{{ $message->getAbstract() }}</td>
                        <td>{{ $message->created_at }}</td>
                        <td>
                            {{-- Ripristina --}}
                            <button class="bi bi-recycle btn-icon me-2 text-success" data-bs-toggle="modal"
                                data-bs-target="#restore-modal-{{ $message->id }}" title="Ripristina il progetto">
                            </button>

                            {{-- Elimina definitivamente --}}
                            <button class="bi bi-trash3-fill text-danger btn-icon" data-bs-toggle="modal"
                                data-bs-target="#delete-modal-{{ $message->id }}" title="Elimina definitivamente">
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" scope="row">Il cestino è vuoto.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="row justify-content-between align-items-center my-4">
            {{-- <div class="col">
            <h1>Cestino</h1>
        </div> --}}

            <div class="col-12 text-end">
                <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-primary text-end">
                    Torna alla lista
                </a>
            </div>
        </div>
        {{ $trashed_messages->links() }}

    </section>

@endsection

@section('modals')
    @foreach ($trashed_messages as $message)
        <!-- Modal restore -->
        <div class="modal fade" id="restore-modal-{{ $message->id }}" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="restore-modal-{{ $message->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="restore-modal-{{ $message->id }}-label">
                            Conferma Ripristino
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        Sei sicuro di voler ripristinare il messaggio da <strong>{{ $message->email }}</strong> con ID
                        <strong> {{ $message->id }}</strong>?
                        <br>
                        Il messaggio tornerà nella lista principale.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Annulla</button>

                        <!-- Form per il restore -->
                        <form action="{{ route('admin.messages.restore', $message->id) }}" method="POST" class="">
                            @method('put')
                            @csrf

                            <button type="submit" class="btn btn-outline-warning">Ripristina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal delete -->
        <div class="modal fade" id="delete-modal-{{ $message->id }}" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="delete-modal-{{ $message->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="delete-message-{{ $message->id }}">Attenzione!!!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare definitivamente il messaggio da <span
                            class="fw-semibold">{{ $message->email }}</span> dal dataBase?
                        <br>
                        L'operazione non è reversibile.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Annulla</button>

                        <!-- Form per il forceDelete -->
                        <form method="POST" action="{{ route('admin.messages.forcedelete', $message->id) }}">
                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-outline-danger">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
