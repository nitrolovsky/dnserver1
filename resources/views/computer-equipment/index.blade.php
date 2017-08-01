@extends('layouts.app')
@section('content')
    <a href="{{ action('ComputerEquipmentController@create')}}" class="btn btn-primary" role="button"><span class="fa fa-fw fa-plus"></span>&nbsp;Создать заявку</a>
    <br>
    <br>
    <form method="GET" action="/proposal" class="form-inline">
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

    @if (count($computer_equipments) > 0)
        @foreach ($computer_equipments as $computer_equipment)
            <div class="card">
                <div class="card-block">
                    <div class="col-xl-3">
                        {{ date_format(new DateTime($computer_equipment->created_at), 'd.m.Y H:i') }}
                    </div>
                    <div class="col-xl-6">
                        <a href="/user/{{ $computer_equipment->user->id or '' }}">
                            {{ $computer_equipment->user->fio}}
                        </a>
                        <br>
                        {{ $computer_equipment->category->name }}
                        <br>
                        <strong>
                            {{ $computer_equipment->text }}
                        </strong>
                    </div>
                    <div class="col-xl-3">
                        <a class="btn btn-primary btn-sm" href="#" role="button">Просмотр</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if (count($computer_equipments) > 0)
        <table class="table table-bordered table-responsive">
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
                @foreach ($computer_equipments as $computer_equipment)
                    <tr>
                        <td>
                            {{ date_format(new DateTime($computer_equipment->created_at), 'd.m.Y H:i') }}
                        </td>
                        <td>
                            <?php $fio = explode(" ", $computer_equipment->user->fio); ?>
                            <a href="/user/{{ $proposal->user->id or '' }}">
                                @foreach ($fio as $item)
                                    {{ $item }}<br>
                                @endforeach
                            </a>
                        </td>
                        <td>
                            {{ $computer_equipment->category->name }}
                        </td>
                        <td>
                            <a href="/computer-equipment/{{ $computer_equipment->id }}">
                                {{ $computer_equipment->text }}
                            </a>
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            @if ($computer_equipment->status == 0)
                                <span class="tag tag-danger">В работе</span>
                            @elseif ($computer_equipment->status == 1)
                                <span class="tag tag-success">Выполнено</span>
                                <br>
                                {{ date_format(new DateTime($computer_equipment->done_at), 'd.m.Y H:i') }}
                                <br>
                                <?php $fio = explode(" ", $computer_equipment->doneUser->fio); ?>
                                <a href="/user/{{ $computer_equipment->done_user_id or '' }}">
                                    @foreach ($fio as $item)
                                        {{ $item }}<br>
                                    @endforeach
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div class="text-xl-center text-lg-center text-md-center text-sm-center text-xs-center">
        {!! $computer_equipments->appends(Request::only('keyword'))->links('vendor.pagination.bootstrap-4') !!}
    </div>
@endsection
