@extends('layouts.app')
@section('content')
    <form method="POST" action="/user/login" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputLogin" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Логин</label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <input name="login" type="text" class="form-control" id="inputLogin" placeholder="Логин" value="{{ old('login') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Пароль</label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Пароль">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-sign-in"></span>&nbsp;Войти</button>
            </div>
        </div>
    </form>
@endsection
