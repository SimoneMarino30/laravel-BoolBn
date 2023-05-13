@extends('layouts.app')

@section('page-name', 'Lista messaggi')

@section('content')

<section class="container pt-4">

    @if (session('message_content'))
        <div class="alert alert-{{session('message_type') ? session('message_type') : 'success'}}">
            {{session('message_content')}}
        </div>
    @endif

    <div class="row justify-content-between align-items-center my-4">
        <div class="col">
            <h1>Messaggi ricevuti</h1>
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
            @forelse($messages as $message)
                <tr>
                    <th scope="row">{{$message->id}}</th>
                    <td>{{$message->name}}</td>
                    <td>{{$message->surname}}</td>
                    <td>{{$message->email}}</td>
                    <td>{{$message->getAbstract()}}</td>
                    <td>{{$message->created_at}}</td>
                    <td>
                        <a href="{{route('admin.messages.show', $message)}}" title="Mostra il messaggio">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" scope="row">Nessun risultato</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- {{ $messages->links() }} --}}

</section>

@endsection