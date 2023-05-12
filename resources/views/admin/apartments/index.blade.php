{{-- @dump($apartments); --}}

@extends('layouts.app')

@section('page-name', 'Appartamenti')

@section('content')
  <section class="container">
    <h1 class="text-center">Lista Appartamenti</h1>
    <div class="row">
      @forelse ($apartments as $apartment)
      <div class="col-4">
        <div class="card">
          <div class="card-header">
            {{ $apartment-> title }}
          </div>
        </div>
      </div>
      @empty
         🤦‍♂️   
      @endforelse
    </div>
  </section>
@endsection
