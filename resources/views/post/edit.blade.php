@extends('layouts.app')
@section('content')
    <form method="POST" action="/tiding/{{ $tiding->id }}" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="category" class="col-lg-3 col-md-3 control-label">Категория</label>
            <div class="col-lg-9 col-md-9">
                <select name="category" class="form-control" id="category">
                    <option value="">Выберите категорию</option>
                    @foreach ($categorys as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $tiding->category_id ? 'selected' : ''}}>{{ $category->value or ''}}</option>
                    @endforeach
                <select>
            </div>
        </div>
        <div class="form-group">
            <label for="text" class="col-lg-3 col-md-3 control-label">Текст</label>
            <div class="col-lg-9 col-md-9">
                <textarea name="text" class="form-control" rows="3" id="text">{{ $tiding->full_text }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox col-lg-offset-3 col-md-offset-3 col-lg-9 col-md-9">
                <label>
                    <input name="enabled" type="checkbox" {{ $tiding->enabled == 'False' ? 'checked' : ''}}>Скрывать новость
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-offset-3 col-md-offset-3 col-lg-9 col-md-9">
                <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;Сохранить изменения</button>
            </div>
        </div>
    </form>
@endsection
