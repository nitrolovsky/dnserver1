@extends('layouts.app')

@section('content')

    <form class="form-horizontal">
        <div class="form-group row">
            <label class="col-xl-2 col-form-label">Идентификатор</label>
            <div class="col-xl-10">
                <p class="form-control-static">{{ $user->id or ''}}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-2 col-form-label">Логин</label>
            <div class="col-xl-10">
                <p class="form-control-static">{{ $user->login or ''}}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-2 col-form-label">ФИО</label>
            <div class="col-xl-10">
                <p class="form-control-static">{{ $user->fio or ''}}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-2 col-form-label">Учреждение</label>
            <div class="col-xl-10">
                <p class="form-control-static">{{ $user->company->name or ''}}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-2 col-form-label">Отдел</label>
            <div class="col-xl-10">
                <p class="form-control-static">{{ $user->department->name or ''}}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-2 col-form-label">Должность</label>
            <div class="col-xl-10">
                <p class="form-control-static">{{ $user->duty->name or ''}}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-2 col-form-label">Кабинет</label>
            <div class="col-xl-10">
                <p class="form-control-static">{{ $user->cabinet or ''}}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-2 col-form-label">Телефон</label>
            <div class="col-xl-10">
                <p class="form-control-static">{{ $user->phone or ''}}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-2 col-form-label">Email</label>
            <div class="col-xl-10">
                <p class="form-control-static">{{ $user->email or ''}}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xl-2 col-form-label">Мобильный</label>
            <div class="col-xl-10">
                <p class="form-control-static">{{ $user->mobile or ''}}</p>
            </div>
        </div>
        @if (Session::get('id') == $user->id or Session::get('access') > 14000)
            <div class="form-group row">
                <div class="offset-xl-2 col-xl-10">
                    <a href="/user/{{ $user->id }}/edit" class="btn btn-primary" role="button"><span class="fa fa-fw fa-pencil"></span>&nbsp;Редактировать</a>
                </div>
            </div>
        @endif
    </form>
@endsection
