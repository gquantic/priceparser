@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Регистрация</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <div class="mb-3">
                            <label for="name" class="col-form-label">Имя</label>

                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0">
                            <label for="">Форма регистрации</label>
                            <div class="d-flex justify-content-start">
                                <label for="legal_form_ur" class="col-form-label">
                                    <input type="radio" name="legal_form" value="1" id="legal_form_ur" checked> {{ __('Юр. лицо') }}
                                </label>
                                <label for="legal_form_fiz" class="col-form-label" style="margin-left: 15px;">
                                    <input type="radio" name="legal_form" value="2" id="legal_form_fiz"> {{ __('Физ. лицо') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class=" col-form-label ">Почта</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="col-form-label">Пароль</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="col-form-label">Повторите пароль</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="btn btn-primary w-100">
                                Регистрация
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
