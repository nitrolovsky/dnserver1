@extends('layouts.app')
@section('content')
    @if (Session::get('access') > 1)
        <a href="/post/create" class="btn btn-primary" role="button"><span class="fa fa-fw fa-plus"></span>&nbsp;Добавить новость</a>
        <br>
        <br>
    @endif
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card">
                    @if (Session::has('id'))
                        @if ($post->user_id == Session::get('id') or Session::get('access') > 14000)
                        <div class="card-header">
                            <a href="/post/{{ $post->id }}/edit"><span class="fa fa-fw fa-pencil"></span>&nbsp;Редактировать</a>
                            @if ($post->enabled == "False")
                                &nbsp;&nbsp;&nbsp;<a href="#"><span class="fa fa-fw fa-eye"></span>&nbsp;Отобразить</a>
                            @endif
                        </div>

                        @endif
                    @endif
                        <div class="card-block">
                    <div class="card-title">
                        <h4><?= date_format(new DateTime($post->created_at), 'd.m.Y') ?> - {{ $post->category->name }}</h4>
                    </div>
                    <div class="card-text">
                        <?= htmlspecialchars_decode($post->full_text) ?>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="text-xl-center text-lg-center text-md-center text-sm-center text-xs-center">
            {!! $posts->links('vendor.pagination.bootstrap-4') !!}
        </div>
    @endif
@endsection
