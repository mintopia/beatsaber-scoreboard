@extends('layouts.application')

@section('content')
    @foreach($competitions as $competition)
        <li><a href="{{ route('competitions.show', $competition->id) }}">{{ $competition->name }}</a></li>
    @endforeach

    {!! $competitions !!}
@endsection
