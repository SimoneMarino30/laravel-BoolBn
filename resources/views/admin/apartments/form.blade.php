@extends('layouts.app')

@section('page-name', 'Modifica DB')

@section('content')
    <div class="container pt-5">
        @include('layouts.partials._validation')
    </div>
    <section class="container">
        <div class="row my-4">
            <div class="col-md-9">
                <h1>
                    {{ $apartment->id ? 'Modifica appartamento - ' . $apartment->title : 'Aggiungi un nuovo appartamento' }}
                </h1>
            </div>

            <div class="col-md-3 text-end">
                <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary">
                    Torna alla lista
                </a>
            </div>
        </div>

        <div class="text-center">
            @if (session('message_content'))
                <div class="alert alert-{{ session('message_type') ? session('message_type') : 'success' }} mt-4">
                    {{ session('message_content') }}
                </div>
            @endif
        </div>

        <div class="card">
            <div class="card-body">
                @if ($apartment->id)
                    <form action="{{ route('admin.apartments.update', $apartment) }}" enctype="multipart/form-data"
                        method="POST" class="row gy-3 form-edit" data-modalita="edit">
                        @method('put')
                    @else
                        <form action="{{ route('admin.apartments.store') }}" enctype="multipart/form-data" method="POST"
                            class="gy-3 form-create" data-modalita="create">
                @endif
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Nome appartamento</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') ?? $apartment->title }}" maxlength="100" required>
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="address" class="form-label">Indirizzo completo</label>
                            <input type="text"
                                class="form-control @error('address') is-invalid @enderror @error('latitude') is-invalid @enderror"
                                id="address" name="address" value="{{ old('address') ?? $apartment->address }}"
                                id="address" placeholder="Esempio: Via Marmorata, 100, Roma (RM), Italia" maxlength="255">
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('latitude')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            {{-- * Lista invisibile --}}
                            <div id="hidden_list" class="card position-absolute w-100 radius d-none">
                                <ul class="list">

                                </ul>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="rooms" class="form-label">Stanze da letto</label>
                                <input type="number" class="form-control @error('rooms') is-invalid @enderror"
                                    id="rooms" name="rooms" value="{{ old('rooms') ?? $apartment->rooms }}"
                                    min="1" max="10" required>
                                @error('rooms')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="beds" class="form-label">Numero letti</label>
                                <input type="number" class="form-control @error('beds') is-invalid @enderror"
                                    id="beds" name="beds" value="{{ old('beds') ?? $apartment->beds }}"
                                    min="1" max="20" required>
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
                                <input type="number" class="form-control @error('bathrooms') is-invalid @enderror"
                                    id="bathrooms" name="bathrooms" value="{{ old('bathrooms') ?? $apartment->bathrooms }}"
                                    min="1" max="8" required>
                                @error('bathrooms')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="mq" class="form-label">Numero mq</label>
                                <input type="number" class="form-control @error('mq') is-invalid @enderror" id="mq"
                                    name="mq" value="{{ old('mq') ?? $apartment->mq }}" min="20" required>
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
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" value="{{ old('price') ?? $apartment->price }}"
                                    required>
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                                <label for="visibility" class="form-check-label">Pubblicato</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="visibility" id="visibility"
                                        class="form-check-input @error('visibility') is-invalid @enderror" role="switch"
                                        @checked(old('visibility', $apartment->visibility)) value="1" />
                                    @error('visibility')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- * MODALE SERVIZI AGGIUNTIVI --}}
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <div class="ms-auto">
                                    {{-- * Servizi  --}}
                                    @if (count($services) > 0)
                                        {{-- * Button trigger modal --}}
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#service-model">
                                            Aggiungi servizi
                                        </button>

                                        {{-- * Modal --}}
                                        <div class="modal fade text-start" id="service-model" tabindex="-1"
                                            aria-labelledby="exampleModalScrollableTitle" aria-modal="true"
                                            role="dialog">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Servizi</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <h4>
                                                            Scegli uno o più servizi
                                                        </h4>
                                                        <div class="mb-3">
                                                            <label
                                                                class="form-check-label d-block mb-2 @error('services') text-danger @enderror">
                                                                Servizi
                                                            </label>
                                                            <ul id="services_list">
                                                                @foreach ($services as $service)
                                                                    <li>
                                                                        <div class="form-check form-check-inline">
                                                                            <input
                                                                                class="form-check-input  @error('services') is-invalid @enderror"
                                                                                type="checkbox"
                                                                                id="tech-{{ $service->id }}"
                                                                                name="services[]"
                                                                                value="{{ $service->id }}"
                                                                                @if (in_array($service->id, old('services', $apartment_services ?? []))) checked @endif>

                                                                            <label
                                                                                class="form-check-label @error('services') text-danger @enderror"
                                                                                for="tech-{{ $service->id }}">
                                                                                <i class="{{ $service->icon }}"></i>
                                                                                <span>{{ $service->name }}</span>
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            @error('services')
                                                                <p class="text-danger fw-bold">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="checkedServices" type="button"
                                                            class="btn btn-success" data-bs-dismiss="modal">Chiudi
                                                            e conferma</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <label for="description" class="form-label">Descrizione</label>
                                <textarea class="form-control @error('title') is-invalid @enderror" id="description" name="description" required>{{ old('description') ?? $apartment->description }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- ! INPUT INVISIBILI PER COORDINATE --}}
                            <div class="d-none">
                                <input type="text" id="latitude" name="latitude"
                                    value="{{ old('latitude') ?? $apartment->latitude }}">
                                <input type="text" id="longitude" name="longitude"
                                    value="{{ old('longitude') ?? $apartment->longitude }}">
                            </div>

                        </div>
                    </div>

                    {{-- * COLONNA 2 --}}
                    <div class="col-md-4 d-flex flex-column">
                        <div class="mb-3 form-group">
                            <label for="image">Immagine</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                id="image" name="image" value="{{ old('image', $apartment->image) }}">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- IMG PREVIEW --}}
                        <div id="image_preview_content" class="text-center">
                            <img src="{{ $apartment->getImageUri() }}" alt="" class="img-fluid mb-2"
                                id="image-preview">
                        </div>

                        <div class="mt-auto text-end">
                            <button type="submit" class="btn btn-primary">Invia</button>
                        </div>
                    </div>

                </div>
                </form>

                {{-- ! CONTAINER STAMPA SERVIZI AGGIUNTIVI --}}
                <div id="servicesContainer">

                </div>
            </div>
        </div>


    </section>
@endsection

@section('scripts')
    {{-- * Preview image --}}
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

    {{-- * Coordinates with tomtom --}}
    <script>
        // VARIABILI
        const apiKey = 'VTS7KTu4nrOLxN010rCYu364QXAVRCfK';

        const search = document.getElementById('address');
        const menuAutoComplete = document.getElementById('hidden_list');
        const menuAutoCompleteClass = menuAutoComplete.classList;
        const ulList = document.querySelector('ul.list');
        const latitude = document.getElementById('latitude');
        const longitude = document.getElementById('longitude');

        // All'input dell' #address
        search.addEventListener('input', function() {
            // se l'input dell'indirizzo non è vuoto
            if (search.value != '')

                // Faccio chiamata API
                fetchResults(search.value);

            // Gestisco la lista che si autocompleta
            addRemoveClass();

        })

        /**
         * Funzione che crea una lista che si autocompila, a seconda del valore iniziale dell'input #address(se contiene o meno un value)
         */
        function addRemoveClass() {
            console.log(menuAutoCompleteClass);
            if (search.value == '')
                menuAutoCompleteClass.add('d-none');
            else
                menuAutoCompleteClass.remove('d-none');
        }

        /**
         * Funzione che fa una chiamata alle API di TomTomDevelopers, non essendo specificate coordinate e raggio di partenza, la ricerca è globale
         * 
         * @param String {inputAddress} Indirizzo da dare come parametro alla funzione
         */
        function fetchResults(inputAddress) {
            fetch(
                    `https://api.tomtom.com/search/2/search/${inputAddress}.json?key=${apiKey}`
                )
                .then(response => response.json())
                .then(data => {

                    // Recupero Array di oggetti 'results', dove sono presenti tutti gli indirizzi che verranno stampati nella lista
                    console.log(data.results);

                    ulList.innerHTML = '';

                    // Se arriva il risultato
                    if (data.results != undefined)

                        // Per ogni risultato
                        data.results.forEach(function(currentValue, index, array) {

                            // Creo un elemento HTML <li> della lista autogenerata
                            const li = document.createElement('li');
                            li.append(currentValue.address.freeformAddress);

                            // Cliccando sull'elemento della lista autogenerata
                            li.addEventListener('click',
                                () => {
                                    // Aggiorno campo indirizzo
                                    search.value = currentValue.address.freeformAddress;

                                    // Faccio scomparire lista indirizzi consigliati
                                    menuAutoCompleteClass.add('d-none');
                                    ulList.innerHTML = '';

                                    // Cambio i valori degli input invisibili #latitude e #longitute
                                    latitude.value = currentValue.position.lat;
                                    longitude.value = currentValue.position.lon;

                                    console.log(currentValue.position.lat);
                                    console.log(currentValue.position.lon);
                                    console.log(latitude.value, 'lat');
                                    console.log(longitude.value, 'lon');
                                }
                            )

                            // Infine aggiungo alla lista
                            ulList.appendChild(li);
                        });
                });
        };

        // Verifica se click avviene dentro o fuori dalla lista
        document.addEventListener('click', function(event) {
            const isClickInsideMenu = menuAutoComplete.contains(event.target);

            if (!isClickInsideMenu) {
                menuAutoCompleteClass.add('d-none');
            }
        });
    </script>

    {{-- * Stampa icone servizi aggiuntivi nel form create/edit --}}

    <script>
        let checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        let servicesContainer = document.getElementById('servicesContainer');

        // Funzione per aggiungere un servizio al container
        function addServiceToContainer(service) {
            let serviceEl = document.createElement('div');
            serviceEl.innerHTML = `
            <input type="hidden" name="services[]" value="${service.id}">
            <i class="${service.icon}" aria-hidden="true"></i>
            <span>${service.name}</span>
        `;
            servicesContainer.appendChild(serviceEl);
        }

        // Aggiungo i servizi selezionati al container al caricamento della pagina
        checkboxes.forEach(function(checkbox) {
            let service = {
                id: checkbox.value,
                name: checkbox.nextElementSibling.querySelector('span').textContent,
                icon: checkbox.nextElementSibling.querySelector('i').classList.value
            };
            addServiceToContainer(service);
        });

        // Event listener per aggiornare il container quando si selezionano/rimuovono servizi
        document.addEventListener('change', function(event) {
            if (event.target.matches('input[type="checkbox"]')) {
                servicesContainer.innerHTML = '';
                checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
                checkboxes.forEach(function(checkbox) {
                    let service = {
                        id: checkbox.value,
                        name: checkbox.nextElementSibling.querySelector('span').textContent,
                        icon: checkbox.nextElementSibling.querySelector('i').classList.value
                    };
                    addServiceToContainer(service);
                });
            }
        });
    </script>
@endsection
