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
                <form action="{{ route('admin.apartments.store') }}" enctype="multipart/form-data" method="POST"
                    class="gy-3">
        @endif

        @csrf
        <div class="row">
            <div class="col-md-6" style="border: 2px solid red">
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
                        <label for="title" class="form-label">Add numero ospiti</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title') ?? $apartment->title }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea type="text" class="form-control @error('title') is-invalid @enderror" id="description" name="description"
                            value="{{ old('description') ?? $apartment->description }}"></textarea>
                        {{-- <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="title" name="title" value="{{ old('title') ?? $apartment->description }}"> --}}
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
@endsection
