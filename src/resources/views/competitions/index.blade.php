@extends('layouts.application')

@section('content')
    <div class="page-header">
        <h1>Current Competitions</h1>
    </div>

    <div class="row row-cards row-deck">
        @foreach ($competitions as $competition)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><a href="{{ route('competitions.show', $competition) }}">{{ $competition->name }}</a></h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $competition->description }}</p>
                        <a href="{{ route('competitions.show', $competition) }}" class="btn btn-block btn-success">View Competition</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    @if ($competitions->hasMorePages() )
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {{ $competitons->links() }} }}
                </div>
            </div>
        </div>
    @endif
@endsection
