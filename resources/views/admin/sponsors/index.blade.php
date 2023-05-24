@extends('layouts.app')

@section('page-name', 'Sponsor')

@section('content')

    <section id="sponsors_list" class="container py-5">
        <h1 class="mt-5">Sponsorizzazioni</h1>

        <div class="row">
            @forelse($sponsors as $sponsor)
                <div class="col-12 col-md-4">
                    <a href="{{ route('admin.sponsors.show', [$sponsor->id, 'apartment_id' => $apartment_id]) }}">
                        <div class="my-sponsor-card">
                            <div
                                class="my-card-header d-flex align-items-center justify-content-between p-3 @if ($sponsor->type == 'Silver') silver @elseif ($sponsor->type == 'Gold') gold @elseif ($sponsor->type == 'Platinum') platinum @endif">
                                <h4>
                                    {{ $sponsor->type }}</h4>

                                <span class="sponsor-price fs-3">
                                    € {{ $sponsor->price }}
                                </span>
                            </div>
                            <div class="my-card-body">
                                <p>
                                    {{ $sponsor->description }}
                                </p>
                            </div>
                            <div class="my-card-footer text-end">
                                <p class="text-muted p-2">
                                    Sponsorizza per una durata di {{ $sponsor->duration }} ore
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <h2>Non ci sono sponsor</h2>
            @endforelse
        </div>
    </section>

@endsection
