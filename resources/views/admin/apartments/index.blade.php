{{-- @dump($apartments); --}}

@extends('layouts.app')

@section('page-name', 'Appartamenti')

@section('content')
    <section class="container">
        <h1 class="text-center mt-5">Lista Appartamenti</h1>
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <a type="button" href="{{ route('admin.apartments.create') }}" class="btn btn-outline-primary">
                    Create New Project
                </a>

            </div>
            <table class="table table-dark table-striped table-hover my-5">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Appartamento</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apartments as $apartment)
                        <tr>
                            <th scope="row">{{ $apartment->id }}</th>
                            <td>{{ $apartment->title }}</td>
                            <td>{{ $apartment->price }} €</td>
                            <td>{{ $apartment->address }}</td>
                            <td>
                                {{-- Dettaglio --}}
                                <a href="{{ route('admin.apartments.show', $apartment) }}">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                {{-- Messaggi --}}
                                <a href="{{ route('admin.messages.index', ['apartment_id' => $apartment->id]) }}"
                                    class="mx-2">
                                    <i class="bi bi-envelope-fill"></i>
                                </a>

                            </td>
                        </tr>
                    @empty
                        🤦‍♂️
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
