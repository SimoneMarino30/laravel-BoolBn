@extends('layouts.app')

@section('page-name', $apartment->title)

@section('content')
    {{-- @dump($project) --}}
    <section class="card clearfix">
        <div class="card-body">
            {{-- <figure class="float-end ms-5 mb-3">
      <img src="{{ $project->getImageUri() }}" alt="" class="img-fluid">
    </figure> --}}
            <div>{{ $apartment->id }}</div>
            <figcaption>
                <h3 class="my-5">{{ $apartment->description }}</h3>
                <p class="text-muted text-secondary m-0"> {{ $apartment->price }}</p>
                </figure>
        </div>
    </section>
    <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-primary my-5 mx-3">
        Back to list
    </a>
@endsection
