@extends('layouts.application', [
    'title' => [
        'Competitions',
        $leaderboard->competition->name,
        'Leaderboards',
        $leaderboard->name
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

        <div class="col-md-12 col-lg-3">
            <form class="card" method="post" action="{{ route('admin.leaderboards.update', $leaderboard) }}">
                {{ csrf_field() }}
                @method('PATCH')
                <div class="card-header">
                    <h3 class="card-title">{{ $leaderboard->name }}</h3>
                </div>
                <div class="card-body">
                    @include('admin.leaderboards._form')
                </div>
                <div class="card-footer text-right">
                        <button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        <button class="btn btn-primary ml-auto" type="submit">Save</button>
                </div>
            </form>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Scores</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Score</th>
                            <th>Added</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($scores as $score)
                            <tr>
                                <td class="text-muted">{{ $score->id }}</td>
                                <td>
                                    <a href="{{ route('admin.players.show', $score->player) }}">{{ $score->player->name }}</a>
                                </td>
                                <td>{{ $score->score }}</td>
                                <td>
                                    <span title="{{ $score->created_at->format('Y-m-d H:i:s') }}">{{ $score->created_at->diffForHumans() }}</span>
                                </td>
                                <td class="w-1">
                                    <form action="{{ route('admin.scores.destroy', $score) }}" method="post" class="form-inline">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fe fe-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($scores->hasMorePages())
                    <div class="card-footer">
                        {{ $scores->links() }}
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-3 col-md-12">
            <form class="card" action="{{ route('admin.scores.store', $leaderboard->id) }}" method="post">
                {{ csrf_field() }}
                <div class="card-header">
                    <h3 class="card-title">Add Score</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label" for="player">Player</label>
                        <input class="form-control @error('player') is-invalid @enderror" type="text" name="player" placeholder="Player Name" value="{{ old('player') }}" />
                        @error('player')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="score">Score</label>
                        <input class="form-control @error('score') is-invalid @enderror" type="text" name="score" placeholder="Score" value="{{ old('score') }}" />
                        @error('score')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <button class="btn btn-primary ml-auto" type="submit">Add Score</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="delete-link" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Leaderboard</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $leaderboard->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.leaderboards.destroy', $leaderboard) }}" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger ml-auto" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
