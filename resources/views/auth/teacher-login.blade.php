@extends('layouts/public')

@section('conteudo')
    <form class="form-signin text-center" method="POST" action="{{ route('teacher.login.submit') }}">
        @csrf
        <a href="{{url('/')}}"><img class="mb-4 " src="{{ URL::asset('img/seintegrado-logo.png')}}" alt="" width="100" height="76"></a>
        <div class="text-entrar">
            <ul>
                  <li>Bem vindo, Professor(a)!</li>
            </ul>
        </div>
        <br>
        <div class="form-group">
            <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
            <input type="email" id="email" name="email" class="form-control rounded-borders @error('email') is-invalid @enderror" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">{{ __('Senha') }}</label>
            <input type="password" id="password" name="password" class="form-control rounded-borders @error('password') is-invalid @enderror" placeholder="Senha" autocomplete="current-password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <br>
            <div class="col-md-6 ">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Lembre-me') }}
                    </label>
                </div>
            </div>

            <br>
            <button name="btn-login" class="btn btn-lg button-orange btn-block rounded-borders button-hover" type="submit">{{ __('Login') }}</button>


            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif
        </div>
    </form>
@stop