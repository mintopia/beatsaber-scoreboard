@extends('layouts.application', [
    'title' => [
        'Competitions',
        $competition->name
    ]
]
)

@section('content')
    <div class="page-header">
        <h1>
            Competitions
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-3">
            <form class="card" method="post" action="{{ route('admin.competitions.update', $competition) }}">
                {{ csrf_field() }}
                @method('PATCH')
                <div class="card-header">
                    <h3 class="card-title">{{ $competition->name }}</h3>
                </div>
                <div class="card-body">
                    @include('admin.competitions._form')
                </div>
                <div class="card-footer text-right">
                    <form action="{{ route('admin.competitions.destroy', $competition) }}" class="d-flex">
                        <a class="btn btn-outline-danger" href="javascript:void();">Delete</a>
                        <button class="btn btn-primary ml-auto" type="submit">Save</button>
                    </form>
                </div>
            </form>
        </div>

        <div class="col-lg-9 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Leaderboards</h3>
                    <a class="btn ml-auto btn-outline-success" href="{{ route('admin.leaderboards.create', $competition) }}">
                        <span class="fa fa-plus"></span>
                        Add Leaderboard
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Key</th>
                            <th>Active</th>
                            <th>Scoring</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leaderboards as $leaderboard)
                            <tr>
                                <td class="text-muted">{{ $leaderboard->id }}</td>
                                <td>
                                    <a href="{{ route('admin.leaderboards.show', $leaderboard) }}">{{ $leaderboard->name }}</a>
                                </td>
                                <td>{{ $leaderboard->key }}</td>
                                <td>
                                    @if ($leaderboard->active)
                                        <span class="status-icon bg-success"></span>
                                        Active
                                    @else<span class="status-icon bg-warning"></span>
                                    Not Active
                                    @endif
                                </td>
                                <td>{{ substr($leaderboard->score_type, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($leaderboards->hasMorePages())
                    <div class="card-footer">
                        {{ $leaderboards->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
