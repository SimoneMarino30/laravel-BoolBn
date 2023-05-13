{{-- @dump($apartments); --}}

@extends('layouts.app')

@section('page-name', 'Appartamenti')

@section('content')
    <section class="container">
        <h1 class="text-center mt-5">Lista Appartamenti</h1>
        <div class="row">
            <table class="table table-dark table-striped table-hover my-5">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Appartamento</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Pubblicato</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apartments as $apartment)
                        <tr>
                            <th scope="row">{{ $apartment->id }}</th>
                            <td>{{ $apartment->title }}</td>
                            <td>{{ $apartment->price }} €</td>
                            <td>{{ $apartment->visibility }}</td>
                            <td>
                                <a href="{{ route('admin.apartments.show', $apartment) }}">
                                    <i class="bi bi-eye-fill me-3">button</i>
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
