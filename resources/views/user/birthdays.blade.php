@extends('layouts.app')

@section('content')
<table class="table table-hover">
    <thead>
        <tr class="row">
            <th class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                Дата рождения - {{ date("M") }}
            </th>
            <th class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                ФИО
            </th>
        </tr>
    </thead>
    <tbody>
        @if (count($users) > 0)
            @foreach ($users as $user)
                <tr class="row">
                    <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        {{ $user->birth_day or ''}}.{{ $user->birth_month}}.{{ date("Y") }}
                    </td>
                    <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <a href="/user/{{ $user->id }}">
                            {{ $user->fio or ''}}
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
@endsection
