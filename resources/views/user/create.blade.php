@extends('layouts.app')

@section('content')
    <form method="POST" action="/user">
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
            <label for="confirmPassword" class="col-xl-2 col-form-label">Повтор пароля</label>
            <div class="col-xl-10">
                <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="Повторите пароль">
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-xl-2 col-form-label">ФИО</label>
            <div class="col-xl-10">
                <input name="name" type="text" class="form-control" id="name" placeholder="ФИО" value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="company" class="col-xl-2 col-form-label">Учреждение</label>
            <div class="col-xl-10">
                <select name="company" class="form-control" id="company">
                    <option value="">Выберите учреждение</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                <select>
            </div>
        </div>
        <div class="form-group row">
            <label for="department" class="col-xl-2 col-form-label">Отдел</label>
            <div class="col-xl-10">
                <select name="department" class="form-control" id="department">
                    <option value="">Выберите отдел</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                <select>
            </div>
        </div>
        <div class="form-group row">
            <label for="duty" class="col-xl-2 col-form-label">Должность</label>
            <div class="col-xl-10">
                <select name="duty" class="form-control" id="duty">
                    <option value="">Выберите должность</option>
                    @foreach ($duties as $duty)
                        <option value="{{ $duty->id }}">{{ $duty->name }}</option>
                    @endforeach
                <select>
            </div>
        </div>
        <div class="form-group row">
            <label for="cabinet" class="col-xl-2 col-form-label">Кабинет</label>
            <div class="col-xl-10">
                <input name="cabinet" type="text" class="form-control" id="cabinet" placeholder="Кабинет" value="{{ old('cabinet') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-xl-2 col-form-label">Телефон</label>
            <div class="col-xl-10">
                <input name="phone" type="text" class="form-control" id="phone" placeholder="Телефон" value="{{ old('phone') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-xl-2 col-form-label">Email</label>
            <div class="col-xl-10">
                <input name="email" type="text" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="mobile" class="col-xl-2 col-form-label">Мобильный</label>
            <div class="col-xl-10">
                <input name="mobile" type="text" class="form-control" id="mobile" placeholder="Мобильный телефон" value="{{ old('mobile') }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-xl-2 col-xl-10">
                <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-user-plus"></span>&nbsp;Зарегистрироваться</button>
            </div>
        </div>
    </form>
@endsection
