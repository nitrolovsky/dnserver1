@extends('layouts.app')

@section('content')
    <h3>
        Заявка № {{ $proposal->id or ''}}
    </h3>
    <br>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Автор</td>
                <td><a href="/user/{{ $proposal->user->id or ''}}">{{ $proposal->user->name or ''}}</a></td>
            </tr>
            <tr>
                <td>Дата и время создания</td>
                <td>{{ date_format(new DateTime($proposal->created_at), 'd.m.Y H:i') }}</td>
            </tr>
            <tr>
                <td>Раздел</td>
                <td><strong>{{ $proposal->keyword->content }}</strong> / {{ $proposal->keyword->category_name }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $proposal->content }}</td>
            </tr>
            <tr>
                <td>Статус</td>
                <td><span class="tag tag-danger">В работе</span></td>
            </tr>
        </tbody>
    </table>

    @if (!$proposal->deleted_at)
        <form method="POST" action="/comment" class="card card-block">
            {{ csrf_field() }}
            <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">
            <fieldset class="form-group">
                <legend>Выберите тип действия</legend>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                    Добавление комментария
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                    Возвращение на правку
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                    Закрытие заявки
                  </label>
                </div>
              </fieldset>
            
            <div class="form-group">
                <label for="content">Напишите комментарий в данной поле</label>
                <textarea name="content" class="form-control" rows="3" id="content">{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-paper-plane"></span>&nbsp;Отправить</button>
        </form>
    @endif

    @if (!$proposal->deleted_at)
        @if (Session::get('id'))
            <form action="/proposal/{{ $proposal->id }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

            </form>
            <br>
        @endif
    @endif

    @if (count($proposal->comments) > 0)
        <br>
        <h3>
            Комментарии
        </h3>
        <br>
        @foreach ($proposal->comments->reverse() as $comment)
            @if ($comment->content)
                <div class="row">
                    <div class="col-xl-12">
                        {{ date_format(new DateTime($comment->created_at), 'd.m.Y H:i') }} <a href="/user/{{ $proposal->user->id or ''}}">{{ $comment->user->name or ''}}</a>
                        <br>
                        {{ $comment->content }}
                    </div>
                </div>
                <hr>
            @endif
        @endforeach
    @endif
@endsection
