@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ action('ComputerEquipmentController@store')}}">
        {{ csrf_field() }}

        <fieldset class="form-group offset-xl-2">
            <legend >Компьютерное оборудование</legend>

                @foreach($categories as $category)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="category_id" value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'checked=checked' : ''}}>
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach

        </fieldset>
        <div class="form-group row">
            <label for="text" class="col-xl-2 col-form-label">Подробности</label>
            <div class="col-xl-10">
                <textarea name="text" class="form-control" rows="3" id="text">{{ old('text') }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-xl-2 col-xl-10">
                <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-paper-plane"></span>&nbsp;Отправить</button>
            </div>
        </div>
    </form>
@endsection
