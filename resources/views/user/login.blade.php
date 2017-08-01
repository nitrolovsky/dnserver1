@extends('layouts.app')

@section('content')
    <form method="POST" action="/user/login">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="login" class="col-xl-2 col-form-label">Логин</label>
            <div class="col-xl-10">
                <input name="login" type="text" class="form-control" id="login" placeholder="Логин" value="{{ old('login') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-xl-2 col-form-label">Пароль</label>
            <div class="col-xl-10">
                <input name="password" type="password" class="form-control" id="password" placeholder="Пароль">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-xl-2 col-xl-10">
                <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-sign-in"></span>&nbsp;Войти</button>
            </div>
        </div>
    </form>
@endsection
