@extends('layouts.app')

@section('page-name', $apartment->title)

@section('content')
    <section class="container text-center pt-4">

        @if (session('message_content'))
            <div class="alert alert-{{session('message_type') ? session('message_type') : 'success'}}">
                {{session('message_content')}}
            </div>
        @endif

        <h1 class="my-4">Dettaglio - {{$apartment->id}}</h1>

        <div class="d-flex justify-content-center">
            <a href="{{route('admin.apartments.index')}}" class="btn btn-primary me-3">
                Torna alla lista
            </a>
    
            <a href="{{route('admin.apartments.edit', $apartment)}}" class="btn btn-primary ms-3">
                Modifica progetto
            </a>
        </div>

        <div class="card clearfix my-4">
            <div class="card-header">
                <strong>
                    {{$apartment->title}}
                </strong>
            </div>

            <div class="card-body">
                <figure class="float-end ms-5 mb-3">
                    <img src="{{$apartment->getImageUri()}}" alt="{{$apartment->title}}" width="300">
                    <figcaption>
                        <p class="text-muted text-secondary m-0">
                            <strong>Stato:</strong>
                            <span class="{{$apartment->is_published ? 'text-success' : 'text-danger'}}">
                                {{$apartment->is_published ? 'Pubblicato' : 'Da pubblicare'}}
                            </span>
                        </p>
                    </figcaption>
                </figure>

                <div class="row">
                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Camere:</strong>
                            <br>
                            <span>{{ $apartment->rooms }}</span>
                        </p>
                    </div>

                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Letti:</strong>
                            <br>
                            <span>{{ $apartment->beds }}</span>
                        </p>
                    </div>

                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Bagni:</strong>
                            <br>
                            <span>{{ $apartment->bathrooms }}</span>
                        </p>
                    </div>

                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Prezzo:</strong>
                            <br>
                            <span>€ {{ $apartment->price }}</span>
                        </p>
                    </div>

                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Superficie:</strong>
                            <br>
                            <span>{{ $apartment->mq }} mq</span>
                        </p>
                    </div>

                    <div class="col-4">
                        <p class="my-col-text">
                            <strong>Indirizzo:</strong>
                            <br>
                            <span>{{ $apartment->address }}</span>
                        </p>
                    </div>
                </div>

                <p class="my-5">
                    <strong class="text-center">Descrizione:</strong>
                    <br>
                    {{$apartment->description}}
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore consequatur quam nam laboriosam mollitia asperiores! Exercitationem quis a quasi quibusdam nesciunt vel libero reprehenderit magni nisi aliquid nihil deserunt reiciendis excepturi accusamus doloremque dolorum blanditiis aspernatur error veniam dolore ab, accusantium sunt. Nulla ratione pariatur at? Accusamus dicta veritatis voluptate hic expedita! Optio laboriosam quis, nobis voluptatem quidem eaque, totam officia rerum rem blanditiis, architecto quo nesciunt impedit cupiditate. Recusandae beatae est deleniti placeat commodi sit ducimus quae nemo saepe cumque, quas, unde corrupti aperiam, officia odio eum laborum sint quisquam nesciunt. Exercitationem cumque quia perferendis adipisci, aspernatur laboriosam dignissimos dolor suscipit ipsam! Ex aut atque officia rem quaerat at deserunt officiis. Eius eveniet dignissimos illum vel aut debitis nihil? Dolor voluptatibus similique praesentium non excepturi consectetur a nam repudiandae, eos tempora eum mollitia ipsam earum nulla illo accusamus veniam sapiente error labore, quasi deleniti officiis culpa quibusdam? Distinctio quidem necessitatibus in aliquam iure impedit molestiae? Ab minima ad ratione sit veritatis modi, recusandae porro accusantium earum explicabo debitis velit, sunt beatae? Repudiandae iusto in vel voluptatibus laudantium eveniet voluptas nobis sed nesciunt ullam a sequi ea, est ducimus quaerat, illo non quia. Eius ducimus maxime repellendus laudantium, ut explicabo illo vel excepturi in pariatur omnis dolorum rem sequi? Eius, ad pariatur cum accusantium ipsum natus maxime unde commodi officiis cupiditate quam veniam delectus impedit expedita voluptates, perspiciatis est provident qui molestiae? Ex, facere! Dolore, laborum architecto recusandae quaerat nobis possimus sunt voluptates sapiente nesciunt eligendi? Maxime officia, inventore iusto rerum placeat facere magnam alias suscipit exercitationem expedita laudantium reiciendis voluptas a doloremque culpa autem accusamus explicabo incidunt optio debitis natus voluptate ad repudiandae? Recusandae, sint. Nesciunt nobis eos sint atque ipsam at temporibus, odio dolorem, reiciendis doloremque numquam esse exercitationem placeat saepe earum consequatur laudantium, illum consequuntur similique. Unde.
                </p>
            </div>

            <div>
                <p>
                    <strong>Servizi:</strong>
                </p>
                <ul>
                    @forelse ($apartment->services as $service)
                        <li class="d-inline-block me-3 my-1">
                            <i class="{{ $service->icon }}"></i>
                            {{ $service->name }}
                        </li>
                    @empty
                        Nessun servizio specificato
                    @endforelse 
                </ul>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <span>
                    <strong>Creato il:</strong>
                    {{$apartment->created_at}}
                </span>

                <span>
                    <strong>Ultima modifica:</strong>
                    {{$apartment->updated_at}}
                </span>
            </div>
        </div>
    </section>

@endsection