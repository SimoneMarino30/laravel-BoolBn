@extends('layouts.app')

@section('page-name', 'Cestino messaggi')

@section('content')

<section class="container pt-4">

    <div class="container pt-5">
        @include('layouts.partials._session-message')
    </div>

    <div class="row justify-content-between align-items-center my-4">
        <div class="col">
            <h1>Cestino</h1>
        </div>

        <div class="col-3 text-end">
            <a href="{{route('admin.messages.index')}}" class="btn btn-primary ms-auto">
                Torna alla lista
            </a>
        </div>
    </div>
    
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col">Testo</th>
                <th scope="col">Ricevuto</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trashed_messages as $message)
                <tr>
                    <th scope="row">{{$message->id}}</th>
                    <td>{{$message->name}}</td>
                    <td>{{$message->surname}}</td>
                    <td>{{$message->email}}</td>
                    <td>{{$message->getAbstract()}}</td>
                    <td>{{$message->created_at}}</td>
                    <td>
                        {{-- Ripristina --}}
                        <button class="bi bi-recycle btn-icon me-2 text-success" data-bs-toggle="modal"
                        data-bs-target="#restore-modal-{{ $message->id }}" title="Ripristina il progetto">
                        </button>

                        {{-- Elimina definitivamente--}}
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

    {{ $trashed_messages->links() }}

</section>

@endsection

@section('modals')
    @foreach ($trashed_messages as $message)
        <!-- Modal restore -->
        <div class="modal fade" id="restore-modal-{{ $message->id }}" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="restore-modal-{{ $message->id }}-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5 text-success" id="restore-modal-{{ $message->id }}-label">Conferma Ripristino</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                Sei sicuro di voler ripristinare il messaggio da <strong>{{ $message->email }}</strong> con ID
                <strong> {{ $message->id }}</strong>?
                <br>
                Il messaggio tornerà nella lista principale.
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                <!-- Form per il restore -->
                <form action="{{ route('admin.messages.restore', $message->id) }}" method="POST" class="">
                    @method('put')
                    @csrf

                    <button type="submit" class="btn btn-success">Ripristina</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal delete -->
        <div class="modal fade" id="delete-modal-{{ $message->id }}" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="delete-modal-{{ $message->id }}-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="delete-message-{{$message->id}}">Attenzione!!!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare definitivamente il messaggio da <span class="fw-semibold">{{$message->email}}</span> dal DataBase?
                        <br>
                        L'operazione non è reversibile.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                        <!-- Form per il forceDelete -->
                        <form method="POST" action="{{route('admin.messages.forcedelete', $message->id)}}">
                        @csrf
                        @method('delete')
                        
                        <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection