@extends('layouts.app')

@section('page-name', $apartment->title)

@section('content')
    {{-- @dump($project) --}}
    <section class="container mt-5" style="border: 2px dashed blue">
        <div class="card mt-5">
            <div class="card-body">
                {{-- <figure class="ms-5 mb-3">
                <img src="{{ $apartment->getImageUri() }}" alt="" class="img-fluid">
            </figure> --}}
                <div>{{ $apartment->id }}</div>
                <div>{{ $apartment->title }}</div>
                <figcaption>
                    <h5 class="my-5">{{ $apartment->description }}</h5>
                    <p class="text-muted text-secondary m-0"> {{ $apartment->price }} €</p>
                    </figure>
            </div>
        </div>
    </section>
    <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-primary my-5 mx-3">
        Back to list
    </a>
@endsection
