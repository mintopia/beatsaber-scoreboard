@extends('layouts.application', [
    'title' => [
        'Competitions',
        $competition->name,
        'Add Leaderboard'
    ]
]
)

@section('content')
    <div class="page-header">
        <h1>
            Leaderboards
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form class="card" action="{{ route('admin.leaderboards.store', $competition->id) }}" method="post">
                {{ csrf_field() }}
                <div class="card-header">
                    <h3 class="card-title">Add Leaderboard</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            @include('admin.leaderboards._form')
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a class="btn btn-link" href="{{ route('admin.competitions.show', $competition) }}">Cancel</a>
                        <button class="btn btn-primary ml-auto" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
