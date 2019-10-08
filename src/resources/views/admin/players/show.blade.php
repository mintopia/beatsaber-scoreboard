@extends('layouts.application', [
    'title' => [
        'Players',
        $player->name
    ]
]
)

@section('content')
    <div class="page-header">
        <h1>
            Players
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-3">
            <form class="card" method="post" action="{{ route('admin.players.update', $player) }}">
                {{ csrf_field() }}
                @method('PATCH')
                <div class="card-header">
                    <h3 class="card-title">{{ $player->name }}</h3>
                </div>
                <div class="card-body">
                    @include('admin.players._form')
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#deleteModal">Delete</button>
                    <button class="btn btn-primary ml-auto" type="submit">Save</button>
                </div>
            </form>
        </div>

        <div class="col-lg-9 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Scores</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Competition</th>
                            <th>Leaderboard</th>
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
                                    <a href="{{ route('admin.competitions.show', $score->leaderboard->competition) }}">{{ $score->leaderboard->competition->name }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.leaderboards.show', $score->leaderboard) }}">{{ $score->leaderboard->name }}</a>
                                </td>
                                <td>{{ $score->score }}</td>
                                <td>
                                    <span title="{{ $score->created_at->format('Y-m-d H:i:s') }}">{{ $score->created_at->diffForHumans() }}</span>
                                </td>
                                <td class="w-1">
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteScoreModal{{ $score->id }}"><i class="fe fe-trash"></i></button>

                                    <div class="modal fade" id="deleteScoreModal{{ $score->id }}" tabindex="-1" role="dialog" aria-labelledby="delete-link" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Score</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete a score of <strong>{{ $score->score }}</strong> for <strong>{{ $score->player->name }}</strong>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.scores.destroy', $score) }}" method="post">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-danger ml-auto" type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="delete-link" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Player</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $player->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.players.destroy', $player) }}" method="post">
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
