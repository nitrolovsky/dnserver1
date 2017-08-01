@extends('layouts.app')

@section('content')
{{ count($user->computer_equipments) }}
    @if (count($user->computer_equipments) > 0)

        @foreach ($user->computer_equipments as $computer_equipment)

            {{ $computer_equipment->id }}
            <br>

        @endforeach

    @endif

@endsection
