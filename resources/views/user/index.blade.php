@extends('layouts.app')

@section('content')
    <form method="GET" action="/user" class="form-inline">
        <div class="form-group">
            <input name="keyword" type="text" class="form-control" placeholder="Поиск сотрудников" value="{{ Request::get('keyword') }}">
        </div>
        <button class="btn btn-primary" type="submit"><span class="fa fa-fw fa-search"></span>&nbsp;Поиск</button>
    </form>
    <br>
    <table class="table table-hover">
        <thead>
            <tr class="row">
                <th>
                    ФИО
                </th>
                <th>
                    Отдел
                </th>
                <th>
                    Должность
                </th>
                <th>
                    Кабинет
                </th>
                <th>
                    Телефон
                </th>
                <th>
                    Email
                </th>
            </tr>
        </thead>
        <tbody>
            @if (count($users) > 0)
                @foreach ($users as $user)
                    <?php $fio = explode(" ", $user->fio); ?>
                    <tr>
                        <td class="">
                            <a href="/user/{{ $user->id }}">
                                @foreach ($fio as $item)
                                    {{ $item }}<br>
                                @endforeach
                            </a>
                        </td>
                        <td>
                            {{ $user->department->name or ''}}
                        </td>
                        <td>
                            {{ $user->duty->name or ''}}
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
    <div class="text-xl-center text-lg-center text-md-center text-sm-center text-xs-center">
        {!! $users->appends(Request::only('keyword'))->links('vendor.pagination.bootstrap-4') !!}
    </div>
@endsection
