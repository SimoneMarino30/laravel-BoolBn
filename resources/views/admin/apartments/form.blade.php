@extends('layouts.app')

@section('page-name', 'Modifica DB')

@section('content')
    <div class="container py-3">
        @include('layouts.partials._validation')
    </div>
    <section class="container">
        <div class="text-center">
            <h1 class="my-4">
                {{ $apartment->id ? 'Modifica appartamento - ' . $apartment->title : 'Aggiungi un nuovo appartamento' }}
            </h1>

            <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary">
                Torna alla lista
            </a>

            @if (session('message_content'))
                <div class="alert alert-{{ session('message_type') ? session('message_type') : 'success' }} mt-4">
                    {{ session('message_content') }}
                </div>
            @endif
        </div>

        @if ($apartment->id)
            <form action="{{ route('admin.apartments.update', $apartment) }}" enctype="multipart/form-data" method="POST"
                class="row gy-3">
                @method('put')
            @else
                <form id="myForm" action="{{ route('admin.apartments.store') }}" enctype="multipart/form-data"
                    method="POST" class="gy-3">
        @endif
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title" class="form-label">Nome appartamento</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') ?? $apartment->title }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ old('address') ?? $apartment->address }}">
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="rooms" class="form-label">Stanze da letto</label>
                        <input type="text" class="form-control @error('rooms') is-invalid @enderror" id="rooms"
                            name="rooms" value="{{ old('rooms') ?? $apartment->rooms }}">
                        @error('rooms')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="beds" class="form-label">Numero letti</label>
                        <input type="text" class="form-control @error('beds') is-invalid @enderror" id="beds"
                            name="beds" value="{{ old('beds') ?? $apartment->beds }}">
                        @error('beds')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="bathrooms" class="form-label">Numero bagni</label>
                        <input type="text" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms"
                            name="bathrooms" value="{{ old('bathrooms') ?? $apartment->bathrooms }}">
                        @error('bathrooms')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="mq" class="form-label">Numero mq</label>
                        <input type="text" class="form-control @error('mq') is-invalid @enderror" id="mq"
                            name="mq" value="{{ old('mq') ?? $apartment->mq }}">
                        @error('mq')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="price" class="form-label">Prezzo per notte</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{ old('price') ?? $apartment->price }}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-2">
                            <label for="visibility" class="form-label">Pubblicato</label>
                        </div>
                        <div class="col-md-12 d-flex flex-row">
                            <input type="checkbox" name="visibility" id="visibility"
                                class="form-check-control @error('visibility') is-invalid @enderror"
                                @checked(old('visibility', $apartment->visibility)) value="1" />
                            @error('visibility')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            {{-- MODAL TRIGGER BUTTON --}}
                            <button type="button" class="ms-auto btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#add-modal">
                                Aggiungi servizi
                            </button>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control @error('title') is-invalid @enderror" id="description" name="description">
                            {{ old('description') ?? $apartment->description }}
                        </textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- COLONNA 2 --}}
            <div class="col-md-6">
                <div class="mb-3 form-group">
                    <label for="image">Immagine</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image" value="{{ old('image', $apartment->image) }}">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- IMG PREVIEW --}}
                <img src="{{ $apartment->getImageUri() }}" alt="" class="img-fluid mb-2" id="image-preview">
                <div>
                    @foreach ($services as $service)
                        <input type="checkbox" id="service-{{ $service->id }}" value="{{ $service->id }}"
                            name="services[]" class="services"
                            class="form-check-control @if (in_array($service->id, old('services', $apartment_services ?? []))) checked @endif">
                        <label for="service-{{ $service->id }}">
                            <i class="{{ $service->icon }}"></i>
                            <span>{{ $service->name }}</span>
                        </label>
                        <br>
                    @endforeach
                </div>

            </div>

        </div>

        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Invia</button>
        </div>


        </form>
    </section>
@endsection

@section('scripts')
    <script>
        const imageInputEl = document.getElementById('image');
        const imagePreviewEl = document.getElementById('image-preview');
        const placeholder = imagePreviewEl.src;

        imageInputEl.addEventListener('change', () => {
            if (imageInputEl.files && imageInputEl.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(imageInputEl.files[0]);

                reader.onload = e => {
                    imagePreviewEl.src = e.target.result;
                }
            }
        })
    </script>

    <script>
        var checkboxes = document.querySelectorAll('.services');
        var valoriSelezionati = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                valoriSelezionati.push(checkboxes[i].value);
            }
        }
        console.log(valoriSelezionati);
    </script>

@endsection

@section('modals')
    @foreach ($services as $service)
        <div class="modal fade" id="add-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Scegli i servizi aggiuntivi da aggiungere
                            alla
                            tua struttura</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($services as $service)
                            <input type="checkbox" id="service-{{ $service->id }}" value="{{ $service->id }}"
                                name="services[]" class="services"
                                class="form-check-control @if (in_array($service->id, old('services', $apartment_services ?? []))) checked @endif">
                            <label for="service-{{ $service->id }}">
                                <i class="{{ $service->icon }}"></i>
                                <span>{{ $service->name }}</span>
                            </label>
                            <br>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <button id="saveModalButton" type="submit" class="btn btn-primary">Aggiungi</button>
                        {{-- <form action="{{ route('admin.apartments.update', $service) }}" method="POST">
                            @csrf
                            @method('put')

                            <button class="btn btn-success">
                                Aggiungi
                            </button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
