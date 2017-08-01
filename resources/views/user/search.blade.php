@extends('layouts.app')

@section('content')
    <form method="POST" action="user-search" class="form-horizontal">
        {{ csrf_field() }}
        <div class="input-group">
            <input name="name" type="text" class="form-control" placeholder="Поиск сотрудников" value="{{ $name }}">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"><span class="fa fa-fw fa-search"></span>&nbsp;Поиск</button>
            </span>
        </div>
    </form>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    ФИО
                </th>
                <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    Отдел
                </th>
                <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    Должность
                </th>
                <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    Кабинет
                </th>
                <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    Телефон
                </th>
                <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    Email
                </th>
            </tr>
        </thead>
        <tbody>
            @if (count($users) > 0)
                @foreach ($users as $user)
                    <?php $fio = explode(" ", $user->name); ?>
                    <tr>
                        <td>
                            <a href="/user/{{ $user->id }}">
                                @foreach ($fio as $item)
                                    {{ $item }}<br>
                                @endforeach
                            </a>
                        </td>
                        <td>
                            {{ $departments[$user->department]->name or ''}}
                        </td>
                        <td>
                            {{ $duties[$user->duty]->name or ''}}
                        </td>
                        <td>
                            {{ $user->cabinet or ''}}
                        </td>
                        <td>
                            {{ $user->phone or ''}}
                        </td>
                        <td>
                            {{ $user->email or ''}}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="text-center">
        {!! $users->appends(['name' => $name])->links() !!}
    </div>
@endsection
