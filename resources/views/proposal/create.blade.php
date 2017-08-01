@extends('layouts.app')

@section('breadcrumb')
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="/proposal">Заявки</a>
        <span class="breadcrumb-item active">Добавить</span>
    </nav>
@endsection

@section('content')
    <form method="POST" action="/proposal">
        {{ csrf_field() }}
        <fieldset class="form-group offset-xl-2">
            <legend >Расходные материалы</legend>
            <div class="custom-controls-stacked">
                @foreach($keywords as $keyword)
                    @if ($keyword->category == 'rashod')
                        <label class="custom-control custom-radio">
                            <input name="radio-stacked" type="radio" class="custom-control-input" name="keyword" value="{{ $keyword->id }}" {{ old('keyword') == $keyword->id ? 'checked=checked' : ''}}>
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">{{ $keyword->content }}</span>
                        </label>
                    @endif
                @endforeach
            </div>
        </fieldset>
        <fieldset class="form-group offset-xl-2">
            <legend >Отдел информатизации и связи</legend>
            <div class="custom-controls-stacked">
                @foreach($keywords as $keyword)
                    @if ($keyword->category == 'devices')
                        <label class="custom-control custom-radio">
                            <input name="radio-stacked" type="radio" class="custom-control-input" name="keyword" value="{{ $keyword->id }}" {{ old('keyword') == $keyword->id ? 'checked=checked' : ''}}>
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">{{ $keyword->content }}</span>
                        </label>
                    @endif
                @endforeach
            </div>
        </fieldset>
        <fieldset class="form-group offset-xl-2">
            <legend >Организационный отдел</legend>
            <div class="custom-controls-stacked">
                @foreach($keywords as $keyword)
                    @if ($keyword->category == 'device_o')
                        <label class="custom-control custom-radio">
                            <input name="radio-stacked" type="radio" class="custom-control-input" name="keyword" value="{{ $keyword->id }}" {{ old('keyword') == $keyword->id ? 'checked=checked' : ''}}>
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">{{ $keyword->content }}</span>
                        </label>
                    @endif
                @endforeach
            </div>
        </fieldset>
        <fieldset class="form-group offset-xl-2">
            <legend >Заказ хозяйственных и канцелярских товаров</legend>
            <div class="custom-controls-stacked">
                @foreach($keywords as $keyword)
                    @if ($keyword->category == 'device_k')
                        <label class="custom-control custom-radio">
                            <input name="radio-stacked" type="radio" class="custom-control-input" name="keyword" value="{{ $keyword->id }}" {{ old('keyword') == $keyword->id ? 'checked=checked' : ''}}>
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">{{ $keyword->content }}</span>
                        </label>
                    @endif
                @endforeach
            </div>
        </fieldset>
        <fieldset class="form-group offset-xl-2">
            <legend >Информационные системы</legend>
            <div class="custom-controls-stacked">
                @foreach($keywords as $keyword)
                    @if ($keyword->category == 'eis')
                        <label class="custom-control custom-radio">
                            <input name="radio-stacked" type="radio" class="custom-control-input" name="keyword" value="{{ $keyword->id }}" {{ old('keyword') == $keyword->id ? 'checked=checked' : ''}}>
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">{{ $keyword->content }}</span>
                        </label>
                    @endif
                @endforeach
            </div>
        </fieldset>
        <fieldset class="form-group offset-xl-2">
            <legend >Видеонаблюдение</legend>
            <div class="custom-controls-stacked">
                @foreach($keywords as $keyword)
                    @if ($keyword->category == 'vcam')
                        <label class="custom-control custom-radio">
                            <input name="radio-stacked" type="radio" class="custom-control-input" name="keyword" value="{{ $keyword->id }}" {{ old('keyword') == $keyword->id ? 'checked=checked' : ''}}>
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">{{ $keyword->content }}</span>
                        </label>
                    @endif
                @endforeach
            </div>
        </fieldset>
        <div class="form-group row">
            <label for="content" class="col-xl-2 col-form-label">Подробности</label>
            <div class="col-xl-10">
                <textarea name="content" class="form-control" rows="3" id="content">{{ old('content') }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-xl-2 col-xl-10">
                <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-paper-plane"></span>&nbsp;Отправить</button>
            </div>
        </div>
    </form>
@endsection
