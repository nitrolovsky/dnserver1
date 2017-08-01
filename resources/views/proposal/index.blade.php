@extends('layouts.app')

@section('content')
    <a href="/proposal/create" class="btn btn-primary" role="button"><span class="fa fa-fw fa-plus"></span>&nbsp;Сделать заявку</a>
    <br>
    <br>
    <form method="GET" action="/proposal" class="form-inline card card-block">
        @if (Request::get('user'))
            <input type="hidden" name="user" value="{{ Request::get('user') }}">
        @endif
        @if (Request::get('category'))
            <input type="hidden" name="category" value="{{ Request::get('category') }}">
        @endif
        <div class="form-group">
            <label class="sr-only" for="status">Статус</label>
            <select class="custom-select" name="status">
                <option value="all" {{ Request::get('status') == 'all' ? 'selected' : ''}}>Все</option>
                <option value="treated" {{ Request::get('status') == 'treated' ? 'selected' : ''}}>В работе</option>
                <option value="done" {{ Request::get('status') == 'done' ? 'selected' : ''}}>Выполнено</option>
            </select>
        </div>
        <div class="form-group">
            <label for="month" class="sr-only">Месяц</label>
            <input class="form-control" type="month" id="month" name="month" value="{{ Request::get('month')}}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-search"></span>&nbsp;Поиск</button>
        </div>
    </form>
    <br>
    @if (count($proposals) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Автор</th>
                    <th>Раздел</th>
                    <th>Описание</th>
                    <th>Комментарии</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proposals as $proposal)
                    <tr>
                        <td>
                            {{ date_format(new DateTime($proposal->created_at), 'd.m.Y H:i') }}
                        </td>
                        <td>
                            <?php $fio = explode(" ", $proposal->user->name); ?>
                            <a href="/user/{{ $proposal->user->id or '' }}">
                                @foreach ($fio as $item)
                                    {{ $item }}<br>
                                @endforeach
                            </a>
                        </td>
                        <td>
                            {{ $proposal->keyword->category_name }}
                            <br>
                            <br>
                            {{ $proposal->keyword->content }}
                        </td>
                        <td>
                            <a href="/proposal/{{ $proposal->id }}">
                                {{ $proposal->content }}
                            </a>
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            @if ($proposal->deleted_at)
                                <span class="tag tag-success">Выполнено</span>
                                @if ($proposal->deleted_by)
                                    <?php $fio = explode(" ", $proposal->deletedBy->name); ?>
                                    <a href="/user/{{ $proposal->deleted_by or '' }}">
                                        @foreach ($fio as $item)
                                            {{ $item }}<br>
                                        @endforeach
                                    </a>
                                @endif
                                <br>
                                {{ date_format(new DateTime($proposal->deleted_at), 'd.m.Y H:i') }}
                                <br>
                                <br>
                            @else
                                <span class="tag tag-danger">В работе</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if (count($proposals) > 0)
        @foreach ($proposals as $proposal)
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-xl-5">
                            <a href="/user/{{ $proposal->user->id or '' }}">{{ $proposal->user->name or '' }}</a>
                            <br>
                            {{ date_format(new DateTime($proposal->created_at), 'd.m.Y H:i') }}
                        </div>
                        <div class="col-xl-7">
                            <strong>{{ $proposal->keyword->content }}</strong>
                            <br>
                            {{ $proposal->keyword->category_name }}
                            <br>
                            <br>
                            <a href="/proposal/{{ $proposal->id }}">
                                {{ $proposal->content }}
                            </a>
                        </div>
                    </div>
                    @if ($proposal->deleted_at)
                        <br>
                        <div class="row">
                            <div class="col-xl-5">
                                <a href="/user/{{ $proposal->deleted_by or '' }}">{{ $proposal->deletedBy->name or '' }}</a>
                                <br>
                                {{ date_format(new DateTime($proposal->deleted_at), 'd.m.Y H:i') }}
                            </div>
                            <div class="col-xl-7">
                                <span class="tag tag-success">Выполнено</span>
                            </div>
                        </div>
                    @else
                        <br>
                        <div class="row">
                            <div class="col-xl-5">
                            </div>
                            <div class="col-xl-7">
                                <span class="tag tag-danger">В работе</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="text-xl-center text-lg-center text-md-center text-sm-center text-xs-center">
            {!! $proposals->appends(request()->input())->links(); !!}
        </div>
    @endif
@endsection
