@extends('layouts.app')

@section('page-name', 'Sign-in')

@section('content')
<div class="container pt-5">
    @include('layouts.partials._validation')
</div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">{{ __('Registrati') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- * NOME --}}
                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- * COGNOME --}}
                        <div class="mb-4 row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" autocomplete="surname" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- * DATA DI NASCITA --}}
                        <div class="mb-4 row">
                        <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}</label>

                        <div class="col-md-6">
                            <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" autocomplete="date_of_birth" autofocus>

                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    {{-- * EMAIL --}}
                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-Mail *') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" required oninvalid="myValidate()">

                                {{-- ! ALERT ERRORE CLIENT-SIDE --}}
                                <span id="email_invalid" class="invalid-feedback fw-bold" role="alert">
                                </span>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        {{-- * PASSWORD --}}
                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password"
                                required
                                minlength="8"
                                oninvalid="myValidate()">

                                {{-- ! ALERT ERRORE CLIENT-SIDE --}}
                                <span id="pwd_invalid" class="invalid-feedback fw-bold" role="alert">
                                </span>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" required minlength="8" oninvalid="myValidate()">
                            </div>

                            {{-- ! ALERT ERRORE CLIENT-SIDE --}}
                            <span id="pwd_confirm_invalid" class="invalid-feedback fw-bold" role="alert">
                            </span>
                        </div>

                        <div class="mb-4 row">
                            <div class="col fst-italic">
                                I campi contrassegnati con <span class="fw-bold">*</span> sono obbligatori.
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="send_button">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // DA IMPLEMENTARE SELEZIONANDO TUTTI I CAMPI CON ATTRIBUTO 'required'

    const emailEl = document.getElementById('email');
    const pwdEl = document.getElementById('password');
    const pwdConfirmEl = document.getElementById('password-confirm');

    const emailInvalidEl = document.getElementById('email_invalid');
    const pwdInvalidEl = document.getElementById('pwd_invalid');
    const pwdConfirmInvalidEl = document.getElementById('pwd_confirm_invalid');

    const errorMessage = 'Campo obbligatorio';

   function myValidate() {
        if(emailEl.value == '') {
            emailEl.classList.add('is-invalid');
            emailInvalidEl.innerHTML = errorMessage;
        } else {
            emailEl.classList.remove('is-invalid');
            emailInvalidEl.innerHTML = '';
        }

        if (pwdEl.value == ''){
            pwdEl.classList.add('is-invalid');
            pwdInvalidEl.innerHTML = errorMessage;
        } else {
            pwdEl.classList.remove('is-invalid');
            pwdInvalidEl.innerHTML = '';
        }

        if(pwdConfirmEl.value == '') {
            pwdConfirmEl.classList.add('is-invalid');
            pwdConfirmInvalidEl.innerHTML = errorMessage;
        } else {
            pwdConfirmEl.classList.remove('is-invalid');
            pwdConfirmInvalidEl.innerHTML = '';
        }
   };

</script>

@endsection
